<?php
session_start();
require_once '../util/connection.php';
header('Content-Type: application/json');

// Configurações - CAMINHO ABSOLUTO PARA A RAIZ DAS IMAGENS (Windows)
$root_dir = 'Z:/wwwinternet/bancoimagemfotos/'; // Raiz absoluta das imagens
$tipos_resolucao = [
    'tam_1' => [135, 90],   // thumbnail
    'tam_2' => [300, 200],
    'tam_3' => [450, 300],
    'tam_4' => [840, 560],
    'tam_5' => null         // original (sem redimensionar)
];
$max_size = 10 * 1024 * 1024; // 10MB

// Mapeamento de tp_produto para pasta base (ajuste nomes conforme estrutura existente)
$mapa_pastas = [
    1 => 'hotel',      // Hotel
    2 => 'tour',       // Tour
    3 => 'venue',      // Venue
    4 => 'restaurante', // Restaurante
    5 => 'gifts',      // Gifts
    6 => 'transportes', // Transportes
    7 => 'various',    // Various
    8 => 'tours_incentives',
    9 => 'tours_technical',
    10 => 'cidade',    // Cidade
    11 => 'inspection' // Inspection Report
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método inválido']);
    exit;
}

$tp_produto = (int) ($_POST['tp_produto'] ?? 0);
if ($tp_produto == 0) {
    echo json_encode(['success' => false, 'error' => 'Tipo de produto não selecionado']);
    exit;
}

$pasta_base = $mapa_pastas[$tp_produto] ?? 'geral'; // Pasta base por tipo

// Busca nome da cidade para subpasta (se aplicável)
$nome_subpasta = '';
if (!empty($_POST['cidade_cod']) && $_POST['cidade_cod'] != '0') {
    $cidade_cod = (int) $_POST['cidade_cod'];
    $query_cidade = "SELECT nome_en FROM tarifario.cidade_tpo WHERE cidade_cod = $cidade_cod";
    $result_cidade = pg_exec($conn, $query_cidade);
    if ($result_cidade && pg_numrows($result_cidade) > 0) {
        $nome_subpasta = strtolower(pg_result($result_cidade, 0, 'nome_en'));
        $nome_subpasta = preg_replace('/[^a-zA-Z0-9\s-]/', '', $nome_subpasta); // Sanitiza nome
        $nome_subpasta = str_replace(' ', '_', $nome_subpasta); // Substitui espaços por _
    }
}

// Pasta final: root/pasta_base/{nome_subpasta}/ (usa barras normais no Windows)
$pasta_tipo = $root_dir . $pasta_base . '/' . $nome_subpasta . '/';
if (!is_dir($pasta_tipo)) {
    mkdir($pasta_tipo, 0755, true);
}

// Processa upload da imagem
if (isset($_FILES['imagem_original']) && $_FILES['imagem_original']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['imagem_original'];
    if ($file['size'] > $max_size) {
        echo json_encode(['success' => false, 'error' => 'Arquivo muito grande']);
        exit;
    }
    $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $extensoes_validas = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($extensao, $extensoes_validas)) {
        echo json_encode(['success' => false, 'error' => 'Tipo de arquivo inválido']);
        exit;
    }

    // Gera ID único
    $id_unico = time() . '_' . rand(1000, 9999);
    $nome_base = $id_unico . '.' . $extensao;

    // Move original
    $caminho_original = $pasta_tipo . $nome_base;
    if (!move_uploaded_file($file['tmp_name'], $caminho_original)) {
        echo json_encode(['success' => false, 'error' => 'Erro ao salvar arquivo']);
        exit;
    }

    // Paths relativos para DB (relativo à web root: bancoimagemfotos/pasta_base/subpasta/nome.jpg)
    $paths = ['tam_5' => 'bancoimagemfotos/' . $pasta_base . '/' . $nome_subpasta . '/' . $nome_base];

    // Carrega imagem
    $imagem = null;
    $save_func = null;
    $quality = null;
    switch ($extensao) {
        case 'jpg':
        case 'jpeg':
            $imagem = imagecreatefromjpeg($caminho_original);
            $save_func = 'imagejpeg';
            $quality = 90;
            break;
        case 'png':
            $imagem = imagecreatefrompng($caminho_original);
            $save_func = 'imagepng';
            $quality = 9; // Compression level for PNG
            break;
        case 'gif':
            $imagem = imagecreatefromgif($caminho_original);
            $save_func = 'imagegif';
            $quality = null;
            break;
    }
    if (!$imagem) {
        unlink($caminho_original);
        echo json_encode(['success' => false, 'error' => 'Erro ao processar imagem']);
        exit;
    }

    $largura_orig = imagesx($imagem);
    $altura_orig = imagesy($imagem);

    // Redimensiona com crop para manter aspect ratio e preencher o tamanho exato
    foreach ($tipos_resolucao as $chave => $dimensoes) {
        if ($dimensoes === null) continue;

        $nova_largura = $dimensoes[0];
        $nova_altura = $dimensoes[1];

        // Ratio para cover (crop)
        $ratio = max($nova_largura / $largura_orig, $nova_altura / $altura_orig);
        $largura_calc = intval($largura_orig * $ratio);
        $altura_calc = intval($altura_orig * $ratio);

        // Resize to calc
        $resized = imagecreatetruecolor($largura_calc, $altura_calc);
        if ($extensao === 'png') {
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
            imagefill($resized, 0, 0, $transparent);
        }
        imagecopyresampled($resized, $imagem, 0, 0, 0, 0, $largura_calc, $altura_calc, $largura_orig, $altura_orig);

        // Crop center
        $nova_imagem = imagecreatetruecolor($nova_largura, $nova_altura);
        if ($extensao === 'png') {
            imagealphablending($nova_imagem, false);
            imagesavealpha($nova_imagem, true);
            $transparent = imagecolorallocatealpha($nova_imagem, 255, 255, 255, 127);
            imagefill($nova_imagem, 0, 0, $transparent);
        }
        $x = intval(($largura_calc - $nova_largura) / 2);
        $y = intval(($altura_calc - $nova_altura) / 2);
        imagecopy($nova_imagem, $resized, 0, 0, $x, $y, $nova_largura, $nova_altura);

        // Salva
        $caminho_redim = $pasta_tipo . $id_unico . '_' . $chave . '.' . $extensao;
        if ($save_func === 'imagejpeg') {
            $save_func($nova_imagem, $caminho_redim, $quality);
        } else {
            $save_func($nova_imagem, $caminho_redim, $quality);
        }
        imagedestroy($resized);
        imagedestroy($nova_imagem);

        $paths[$chave] = 'bancoimagemfotos/' . $pasta_base . '/' . $nome_subpasta . '/' . basename($caminho_redim);
    }
    imagedestroy($imagem);

    // Gera ZIP
    $zip_path = $pasta_tipo . $id_unico . '.zip';
    $zip = new ZipArchive();
    $zip_success = false;
    if ($zip->open($zip_path, ZipArchive::CREATE) === TRUE) {
        // Adiciona arquivos usando caminhos locais absolutos
        $zip->addFile($caminho_original, $nome_base); // Original
        foreach (array_keys($tipos_resolucao) as $chave) {
            if ($chave !== 'tam_5') {
                $nome_redim = $id_unico . '_' . $chave . '.' . $extensao;
                $caminho_redim_local = $pasta_tipo . $nome_redim;
                if (file_exists($caminho_redim_local)) {
                    $zip->addFile($caminho_redim_local, $nome_redim);
                }
            }
        }
        $zip_success = $zip->close();
    }
    if ($zip_success && file_exists($zip_path)) {
        $paths['zip'] = 'bancoimagemfotos/' . $pasta_base . '/' . $nome_subpasta . '/' . $id_unico . '.zip';
    } else {
        $paths['zip'] = '';
    }

    // Insere no banco (mesmo código anterior)
    $mneu_for = $_POST['mneu_for'] ?? '0'; // VARCHAR
    $fk_cidcod = (int) ($_POST['cidade_cod'] ?? 0); // NUMERIC
    $nome_produto = $_POST['nome_produto'] ?? ''; // VARCHAR
    $legenda = $_POST['legenda'] ?? ''; // VARCHAR
    $legenda_pt = $_POST['legenda_pt'] ?? ''; // VARCHAR
    $legenda_esp = $_POST['legenda_esp'] ?? ''; // VARCHAR
    $autor = $_POST['autor'] ?? ''; // VARCHAR
    $autorizacao = $_POST['autorizacao'] ?? ''; // text
    $palavras_chave = $_POST['palavras_chave'] ?? ''; // text
    $ativo_cli = isset($_POST['ativo_cli']) ? 't' : 'f'; // BOOLEAN
    $fachada = isset($_POST['fachada']) ? 't' : 'f'; // BOOLEAN
    $av = 'f'; // BOOLEAN default
    $av3 = 'f'; // BOOLEAN default
    $origem = ''; // text
    $data_cadastro = date('Y-m-d'); // DATE
    $dt_validade = null; // DATE
    $nacional = 't'; // BOOLEAN
    $ordem = 0; // NUMERIC
    $id_hotel = null; // INT
    $id_service = null; // INT
    $id_city = null; // INT
    $id_special_destination = null; // INT

    $query_insert = "INSERT INTO banco_imagem.bco_img (mneu_for, fk_cidcod, tam_1, tam_2, tam_3, tam_4, tam_5, zip, legenda, autor, origem, autorizacao, data_cadastro, palavras_chave, tp_produto, ativo_cli, nome_produto, legenda_pt, legenda_esp, av3, av, dt_validade, fachada, nacional, ordem, id_hotel, id_service, id_city, id_special_destination) 
                     VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19, $20, $21, $22, $23, $24, $25, $26, $27, $28, $29)";

    $result = pg_query_params($conn, $query_insert, [
        $mneu_for,
        $fk_cidcod,
        $paths['tam_1'] ?? '',
        $paths['tam_2'] ?? '',
        $paths['tam_3'] ?? '',
        $paths['tam_4'] ?? '',
        $paths['tam_5'],
        $paths['zip'],
        $legenda,
        $autor,
        $origem,
        $autorizacao,
        $data_cadastro,
        $palavras_chave,
        $tp_produto,
        $ativo_cli,
        $nome_produto,
        $legenda_pt,
        $legenda_esp,
        $av3,
        $av,
        $dt_validade,
        $fachada,
        $nacional,
        $ordem,
        $id_hotel,
        $id_service,
        $id_city,
        $id_special_destination
    ]);

    if ($result) {
        echo json_encode(['success' => true, 'paths' => $paths, 'id' => pg_last_oid($result)]);
    } else {
        // Cleanup files on error
        foreach (array_values($paths) as $rel_path) {
            $full_path = $root_dir . $rel_path;
            if (file_exists($full_path)) {
                unlink($full_path);
            }
        }
        if (isset($zip_path) && file_exists($zip_path)) {
            unlink($zip_path);
        }
        echo json_encode(['success' => false, 'error' => 'Erro ao inserir no banco: ' . pg_last_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Nenhum arquivo enviado ou erro no upload']);
}
