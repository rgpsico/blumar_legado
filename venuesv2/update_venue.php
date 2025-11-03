<?php
require_once '../util/connection.php';

$cod_venues    = $_GET["cod_venues"];
$mneu_for      = $_GET["mneu_for"];
$nome          = $_GET["nome"];
$especialidade = $_GET["especialidade"];
$citie         = $_GET["citie"]; // fk_cod_cidade
$descritivo_en = pg_escape_string($_GET["descritivo_en"] ?? '');
$descritivo_pt = pg_escape_string($_GET["descritivo_pt"] ?? '');
$descritivo_esp = pg_escape_string($_GET["descritivo_esp"] ?? '');
$foto1         = $_GET["foto1"] ?? '';
$foto2         = $_GET["foto2"] ?? '';
$ativo         = isset($_GET["ativo"]) && $_GET["ativo"] === 't' ? 'TRUE' : 'FALSE';

/* Novos campos */
$short_description_pt = pg_escape_string($_GET["short_description_pt"] ?? '');
$short_description_en = pg_escape_string($_GET["short_description_en"] ?? '');
$short_description_es = pg_escape_string($_GET["short_description_es"] ?? '');
$insight_pt           = pg_escape_string($_GET["insight_pt"] ?? '');
$insight_en           = pg_escape_string($_GET["insight_en"] ?? '');
$insight_es           = pg_escape_string($_GET["insight_es"] ?? '');
$price_range          = $_GET["price_range"] ?? '';
$capacity_min         = $_GET["capacity_min"] ?? '';
$capacity_max         = $_GET["capacity_max"] ?? '';
$address_line         = pg_escape_string($_GET["address_line"] ?? '');
$venue_city           = pg_escape_string($_GET["venue_city"] ?? '');
$state                = pg_escape_string($_GET["state"] ?? '');
$country              = pg_escape_string($_GET["country"] ?? '');
$latitude             = $_GET["latitude"] ?? '';
$longitude            = $_GET["longitude"] ?? '';
$foto3                = $_GET["foto3"] ?? '';
$foto4                = $_GET["foto4"] ?? '';
$foto5                = $_GET["foto5"] ?? '';
$floor_plan_image     = $_GET["floor_plan_image"] ?? '';
$product_link_url     = $_GET["product_link_url"] ?? '';



/* Se fk_cod_cidade for vazio ou 0, define como NULL */
$fk_cod_cidade_sql = ($citie === '' || $citie === '0') ? 'NULL' : intval($citie);

$update_venues = "
    UPDATE conteudo_internet.venues SET 
        mneu_for            = '$mneu_for',
        nome                = '$nome',
        fk_cod_cidade       = $fk_cod_cidade_sql,
        especialidade       = '$especialidade',
        descritivo_pt       = '$descritivo_pt',
        descritivo_en       = '$descritivo_en',
        descritivo_esp      = '$descritivo_esp',
        short_description_pt= '$short_description_pt',
        short_description_en= '$short_description_en',
        short_description_es= '$short_description_es',
        insight_pt          = '$insight_pt',
        insight_en          = '$insight_en',
        insight_es          = '$insight_es',
        price_range         = '$price_range',
        capacity_min        = NULLIF('$capacity_min', '')::integer,
        capacity_max        = NULLIF('$capacity_max', '')::integer,
        address_line        = '$address_line',
        city                = '$venue_city',
        state               = '$state',
        country             = '$country',
        latitude            = NULLIF('$latitude', '')::numeric,  -- Assuming latitude is numeric; adjust type if needed (e.g., ::double precision)
        longitude           = NULLIF('$longitude', '')::numeric, -- Same for longitude
        foto1               = '$foto1',
        foto2               = '$foto2',
        foto3               = '$foto3',
        foto4               = '$foto4',
        foto5               = '$foto5',
        floor_plan_image    = '$floor_plan_image',
        product_link_url    = '$product_link_url',
        ativo               = $ativo
    WHERE cod_venues = '$cod_venues';
";

pg_query($conn, $update_venues);

/* Continua o restante do seu código de registro de log e exibição de mensagem */
session_start();
$pk_acesso = $_SESSION['user'];
$ano  = date("Y");
$mes  = date("m");
$dia  = date("d");
$data_now =  "$ano-$mes-$dia";

$query_log = "
    INSERT INTO conteudo_internet.log_adm_conteudo
    (usuario, acao, data, fk_conteudo)
    VALUES
    (
        '$pk_acesso',
        'Alterou um Venue  - $nome',
        '$data_now',
        '6'
    );
";
pg_query($conn, $query_log);

echo 'VENUE ATUALIZADO COM SUCESSO!!!<br><br><br>';
require_once 'miolo_venues.php';
