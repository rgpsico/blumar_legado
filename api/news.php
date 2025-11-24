<?php
require_once __DIR__ . '/../util/connection.php';
header('Content-Type: application/json; charset=utf-8');

$request = $_REQUEST['request'] ?? null;

function ensureTables($conn)
{
    // Tabela de especialistas
    $createEspecialista = <<<SQL
        CREATE TABLE IF NOT EXISTS newsletter_especialistas (
            id SERIAL PRIMARY KEY,
            nome TEXT NOT NULL,
            cargo TEXT DEFAULT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    SQL;
    pg_query($conn, $createEspecialista);

    // Tabela de comentários
    $createComentarios = <<<SQL
        CREATE TABLE IF NOT EXISTS newsletter_comentarios_especialista (
            id SERIAL PRIMARY KEY,
            pk_news INTEGER NOT NULL,
            especialista_id INTEGER NOT NULL REFERENCES newsletter_especialistas(id) ON DELETE CASCADE,
            titulo TEXT,
            subtitulo TEXT,
            comentario TEXT,
            link TEXT,
            imagem TEXT,
            atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE (pk_news, especialista_id)
        );
    SQL;
    pg_query($conn, $createComentarios);
}

function seedEspecialistas($conn)
{
    $countResult = pg_query($conn, 'SELECT COUNT(*) AS total FROM newsletter_especialistas');
    $total = (int) pg_fetch_result($countResult, 0, 'total');

    if ($total === 0) {
        $defaults = [
            ['nome' => 'Especialista 1', 'cargo' => 'Consultor'],
            ['nome' => 'Especialista 2', 'cargo' => 'Analista'],
            ['nome' => 'Especialista 3', 'cargo' => 'Coordenador']
        ];
        foreach ($defaults as $item) {
            pg_query_params(
                $conn,
                'INSERT INTO newsletter_especialistas (nome, cargo) VALUES ($1, $2)',
                [$item['nome'], $item['cargo']]
            );
        }
    }
}

if (!$request) {
    echo json_encode(['success' => false, 'message' => 'Requisição inválida']);
    exit;
}

ensureTables($conn);
seedEspecialistas($conn);

switch ($request) {
    case 'listar_especialistas':
        $result = pg_query($conn, 'SELECT id, nome, cargo FROM newsletter_especialistas ORDER BY nome ASC');
        $data = [];
        while ($row = pg_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $data]);
        break;

    case 'carregar_comentario_especialista':
        $especialistaId = (int) ($_POST['especialista_id'] ?? 0);
        $pkNews = (int) ($_POST['pk_news'] ?? 0);

        if (!$especialistaId) {
            echo json_encode(['success' => false, 'message' => 'Especialista não informado.']);
            break;
        }

        $especialistaResult = pg_query_params(
            $conn,
            'SELECT id, nome, cargo FROM newsletter_especialistas WHERE id = $1',
            [$especialistaId]
        );
        $especialista = pg_fetch_assoc($especialistaResult) ?: ['id' => $especialistaId, 'nome' => 'Especialista', 'cargo' => ''];

        $comentarioResult = pg_query_params(
            $conn,
            'SELECT titulo, subtitulo, comentario, link, imagem FROM newsletter_comentarios_especialista WHERE pk_news = $1 AND especialista_id = $2',
            [$pkNews, $especialistaId]
        );
        $comentario = pg_fetch_assoc($comentarioResult) ?: [];

        echo json_encode([
            'success' => true,
            'especialista' => $especialista,
            'comentario' => $comentario,
        ]);
        break;

    case 'salvar_comentario_especialista':
        $especialistaId = (int) ($_POST['especialista_id'] ?? 0);
        $pkNews = (int) ($_POST['pk_news'] ?? 0);

        if (!$especialistaId || !$pkNews) {
            echo json_encode(['success' => false, 'message' => 'Informe o especialista e a newsletter.']);
            break;
        }

        $titulo = $_POST['titulo'] ?? null;
        $subtitulo = $_POST['subtitulo'] ?? null;
        $comentario = $_POST['comentario'] ?? null;
        $link = $_POST['link'] ?? null;
        $imagem = $_POST['imagem'] ?? null;

        $upsertSQL = <<<SQL
            INSERT INTO newsletter_comentarios_especialista
                (pk_news, especialista_id, titulo, subtitulo, comentario, link, imagem, atualizado_em)
            VALUES ($1, $2, $3, $4, $5, $6, $7, CURRENT_TIMESTAMP)
            ON CONFLICT (pk_news, especialista_id)
            DO UPDATE SET titulo = EXCLUDED.titulo,
                          subtitulo = EXCLUDED.subtitulo,
                          comentario = EXCLUDED.comentario,
                          link = EXCLUDED.link,
                          imagem = EXCLUDED.imagem,
                          atualizado_em = CURRENT_TIMESTAMP;
        SQL;

        $ok = pg_query_params(
            $conn,
            $upsertSQL,
            [$pkNews, $especialistaId, $titulo, $subtitulo, $comentario, $link, $imagem]
        );

        if ($ok) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao salvar o comentário.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Ação não suportada']);
        break;
}
