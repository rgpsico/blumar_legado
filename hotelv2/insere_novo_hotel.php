<?php

require_once '../util/connection.php';


// ========================================
// FUNÇÕES AUXILIARES
// ========================================

/**
 * Obtém valor do POST com valor padrão se não existir
 */
function getPostValue($key, $default = '')
{
	return isset($_POST[$key]) ? $_POST[$key] : $default;
}

/**
 * Sanitiza e prepara valor para SQL
 */
function sqlSafe($value)
{
	// Trata valores vazios, nulos ou strings vazias
	if ($value === '' || $value === null || $value === 'NULL') {
		return "NULL";
	}

	// Trata booleanos
	if (is_bool($value)) {
		return $value ? 'TRUE' : 'FALSE';
	}

	// Trata strings 'true' e 'false'
	$lowerValue = strtolower(trim($value));
	if ($lowerValue === 'true' || $lowerValue === 'false') {
		return strtoupper($lowerValue);
	}

	// Trata números
	if (is_numeric($value)) {
		return $value;
	}

	// Escapa strings
	return "'" . pg_escape_string($value) . "'";
}

/**
 * Obtém valor do POST, sanitiza e prepara para SQL
 */
function getPostSafe($key, $default = '')
{
	$value = getPostValue($key, $default);
	return sqlSafe($value);
}

// ========================================
// OBTER DADOS DO FORMULÁRIO - REMOVER ESTA SEÇÃO ANTIGA
// ========================================
// APAGUE TODAS AS LINHAS DO TIPO:
// $regime_hotel_pt = pg_escape_string($_POST["regime_hotel_pt"]);
// Porque agora usaremos getPostValue() e getPostSafe() diretamente

$mneu_for = getPostValue("mneu_for");
$nome_htl = $mneu_for;

// Validação básica
if (empty($mneu_for)) {
	die("Erro: mneu_for é obrigatório!");
}

// ========================================
// PASSO 1: INSERT INICIAL (apenas campos essenciais)
// ========================================
$query_insert_base = "
INSERT INTO conteudo_internet.ci_hotel (
    mneu_for,
    htldsc,
    htldscing,
    htldscesp,
    htlimgfotofachada,
    htlfotopiscina,
    htlurl,
    htl_num_quartos,
    htlestrelablumar,
    resort,
    flaghtl
) VALUES (
    " . getPostSafe("mneu_for") . ",
    " . getPostSafe("descricao_pt") . ",
    " . getPostSafe("descricao_en") . ",
    " . getPostSafe("descricao_esp") . ",
    " . getPostSafe("foto_fachada") . ",
    " . getPostSafe("fotopiscina") . ",
    " . getPostSafe("htlurl") . ",
    " . getPostSafe("htl_num_quartos") . ",
    " . sqlSafe(getPostValue("htlestrelablumar") ?: null) . ",
    " . getPostSafe("resort") . ",
    " . getPostSafe("flaghtl") . "
) RETURNING frncod";

$result_insert = pg_query($conn, $query_insert_base);

if (!$result_insert) {
	die("Erro ao inserir hotel: " . pg_last_error($conn));
}

$row = pg_fetch_assoc($result_insert);
$frncod = $row['frncod'];

echo "Hotel inserido - ID: $frncod<br>";

// ========================================
// PASSO 2: UPDATE - Descrições de Resort
// ========================================
// Use getPostValue() aqui, NÃO use variáveis criadas anteriormente
$descesp_grpfit = getPostValue("descesp_grpfit");
$regime_hotel_pt = getPostValue("regime_hotel_pt");
$regime_hotel_en = getPostValue("regime_hotel_en");
$regime_hotel_esp = getPostValue("regime_hotel_esp");
$rec_entret_pt = getPostValue("rec_entret_pt");
$rec_entret_en = getPostValue("rec_entret_en");
$rec_entret_esp = getPostValue("rec_entret_esp");

// Só faz UPDATE se pelo menos um campo foi preenchido
if ($descesp_grpfit || $regime_hotel_pt || $regime_hotel_en || $rec_entret_pt) {
	$query_update_resort = "
    UPDATE conteudo_internet.ci_hotel SET
        descesp_grpfit = " . getPostSafe("descesp_grpfit") . ",
        regime_hotel_pt = " . getPostSafe("regime_hotel_pt") . ",
        regime_hotel_en = " . getPostSafe("regime_hotel_en") . ",
        regime_hotel = " . getPostSafe("regime_hotel_esp") . ",
        rec_entret_pt = " . getPostSafe("rec_entret_pt") . ",
        rec_entret_en = " . getPostSafe("rec_entret_en") . ",
        rec_entret = " . getPostSafe("rec_entret_esp") . "
    WHERE frncod = $frncod";

	pg_query($conn, $query_update_resort);
	echo "Descrições de resort atualizadas<br>";
}

// ========================================
// PASSO 3: UPDATE - Atividades e Serviços
// ========================================
$otras_ativ_pt = getPostValue("otras_ativ_pt");
$alojamiento_pt = getPostValue("alojamiento_pt");
$gastronomia_pt = getPostValue("gastronomia_pt");
$servicios_pt = getPostValue("servicios_pt");

if ($otras_ativ_pt || $alojamiento_pt || $gastronomia_pt || $servicios_pt) {
	$query_update_servicos = "
    UPDATE conteudo_internet.ci_hotel SET
        otras_ativ_pt = " . getPostSafe("otras_ativ_pt") . ",
        otras_ativ_en = " . getPostSafe("otras_ativ_en") . ",
        otras_ativ = " . getPostSafe("otras_ativ_esp") . ",
        alojamiento_pt = " . getPostSafe("alojamiento_pt") . ",
        alojamiento_en = " . getPostSafe("alojamiento_en") . ",
        alojamiento = " . getPostSafe("alojamiento_esp") . ",
        gastronomia_pt = " . getPostSafe("gastronomia_pt") . ",
        gastronomia_en = " . getPostSafe("gastronomia_en") . ",
        gastronomia = " . getPostSafe("gastronomia_esp") . ",
        servicios_pt = " . getPostSafe("servicios_pt") . ",
        servicios_en = " . getPostSafe("servicios_en") . ",
        servicios = " . getPostSafe("servicios_esp") . "
    WHERE frncod = $frncod";

	pg_query($conn, $query_update_servicos);
	echo "Serviços atualizados<br>";
}

// ========================================
// PASSO 4: UPDATE - Convenções e Extras
// ========================================
$convenciones_pt = getPostValue("convenciones_pt");
$campo_extra_pt = getPostValue("campo_extra_pt");
$complemento = getPostValue("complemento");
$hotel_cham = getPostValue("hotel_cham");

if ($convenciones_pt || $campo_extra_pt || $complemento || $hotel_cham) {
	$query_update_extras = "
    UPDATE conteudo_internet.ci_hotel SET
        convenciones_pt = " . getPostSafe("convenciones_pt") . ",
        convenciones_en = " . getPostSafe("convenciones_en") . ",
        convenciones = " . getPostSafe("convenciones_esp") . ",
        campo_extra_pt = " . getPostSafe("campo_extra_pt") . ",
        campo_extra_en = " . getPostSafe("campo_extra_en") . ",
        campo_extra = " . getPostSafe("campo_extra_esp") . ",
        complemento = " . getPostSafe("complemento") . ",
        hotel_cham = " . getPostSafe("hotel_cham") . "
    WHERE frncod = $frncod";

	pg_query($conn, $query_update_extras);
	echo "Extras atualizados<br>";
}

// ========================================
// PASSO 5: UPDATE - Fotos Adicionais
// ========================================
$fotofachada_tbn = getPostValue("fotofachada_tbn");
$fotoextra = getPostValue("fotoextra");
$fotoextra_recep = getPostValue("fotoextra_recep");
$ft_resort1 = getPostValue("ft_resort1");
$ft_resort2 = getPostValue("ft_resort2");
$ft_resort3 = getPostValue("ft_resort3");

if ($fotofachada_tbn || $fotoextra || $ft_resort1 || $ft_resort2 || $ft_resort3) {
	$query_update_fotos = "
    UPDATE conteudo_internet.ci_hotel SET
        fotofachada_tbn = " . getPostSafe("fotofachada_tbn") . ",
        fotoextra = " . getPostSafe("fotoextra") . ",
        fotoextra_recep = " . getPostSafe("fotoextra_recep") . ",
        ft_resort1 = " . getPostSafe("ft_resort1") . ",
        ft_resort2 = " . getPostSafe("ft_resort2") . ",
        ft_resort3 = " . getPostSafe("ft_resort3") . "
    WHERE frncod = $frncod";

	pg_query($conn, $query_update_fotos);
	echo "Fotos adicionais atualizadas<br>";
}

// ========================================
// PASSO 6: UPDATE - Mapas e Mídia
// ========================================
$mapa = getPostValue("mapa");
$map_eco = getPostValue("map_eco");
$url_htl_360 = getPostValue("url_htl_360");
$arq_htl_360 = getPostValue("arq_htl_360");
$url_video = getPostValue("url_video");
$arq_video = getPostValue("arq_video");
$virtual_tour = getPostValue("virtual_tour");

if ($mapa || $url_htl_360 || $url_video || $virtual_tour || $map_eco) {
	$query_update_midia = "
    UPDATE conteudo_internet.ci_hotel SET
        htlimgmapa = " . getPostSafe("mapa") . ",
        map_eco = " . getPostSafe("map_eco") . ",
        url_htl_360 = " . getPostSafe("url_htl_360") . ",
        arq_htl_360 = " . getPostSafe("arq_htl_360") . ",
        url_video = " . getPostSafe("url_video") . ",
        arq_video = " . getPostSafe("arq_video") . ",
        virtual_tour = " . getPostSafe("virtual_tour") . "
    WHERE frncod = $frncod";

	pg_query($conn, $query_update_midia);
	echo "Mídia atualizada<br>";
}

// ========================================
// PASSO 7: UPDATE - Observações
// ========================================
$obs_pt = getPostValue("obs_pt");
$obs_en = getPostValue("obs_en");
$obs_esp = getPostValue("obs_esp");
$historico_temp = getPostValue("historico_temp");

if ($obs_pt || $obs_en || $obs_esp || $historico_temp) {
	$query_update_obs = "
    UPDATE conteudo_internet.ci_hotel SET
        htlobs = " . getPostSafe("obs_pt") . ",
        htlobsing = " . getPostSafe("obs_en") . ",
        htlobsesp = " . getPostSafe("obs_esp") . ",
        historico_temp = " . getPostSafe("historico_temp") . "
    WHERE frncod = $frncod";

	pg_query($conn, $query_update_obs);
	echo "Observações atualizadas<br>";
}

// ========================================
// PASSO 8: UPDATE - Flags e Marcações
// ========================================
$query_update_flags = "
UPDATE conteudo_internet.ci_hotel SET
    flaglatino = " . getPostSafe("ativo_latino") . ",
    flat = " . getPostSafe("ativo_flat") . ",
    ecologico = " . getPostSafe("ecologico") . ",
    flagfotopiscina = " . getPostSafe("validafotopiscina") . ",
    bestdeal = " . getPostSafe("bestdeal") . ",
    flaghtlimgmapa = " . getPostSafe("inet_mapa") . ",
    luxury = " . getPostSafe("luxury") . ",
    novo = " . getPostSafe("novo") . ",
    favoritos = " . getPostSafe("favoritos") . ",
    pg6fq7 = " . getPostSafe("pg6fq7") . ",
    pg4fq5 = " . getPostSafe("pg4fq5") . ",
    chdgratis = " . getPostSafe("chdgratis") . ",
    blumarrecomenda = " . getPostSafe("blumarrecomenda") . ",
    blumarreveillon = " . getPostSafe("blumarreveillon") . ",
    allinclusive = " . getPostSafe("allinclusive") . ",
    ativo_mostrp = " . getPostSafe("ativo_mostrp") . ",
    ativo_bnuts = " . getPostSafe("ativo_bnuts") . "
WHERE frncod = $frncod";

pg_query($conn, $query_update_flags);
echo "Flags atualizadas<br>";

// ========================================
// PASSO 9: UPDATE - Classificações
// ========================================
$desc_mostrp_ing = getPostValue("desc_mostrp_ing");
$classif_eco = getPostValue("classif_eco");
$classif_lux = getPostValue("classif_lux");

if ($desc_mostrp_ing || $classif_eco || $classif_lux) {
	$query_update_classif = "
    UPDATE conteudo_internet.ci_hotel SET
        desc_mostrp_ing = " . getPostSafe("desc_mostrp_ing") . ",
        classif_eco = " . getPostSafe("classif_eco") . ",
        classif_lux = " . getPostSafe("classif_lux") . "
    WHERE frncod = $frncod";

	pg_query($conn, $query_update_classif);
	echo "Classificações atualizadas<br>";
}

// ========================================
// PASSO 10: UPDATE - Campos Novos (Site)
// ========================================
$slug = getPostValue("slug");
$short_description_pt = getPostValue("short_description_pt");
$city_name = getPostValue("city_name");
$latitude = getPostValue("latitude");
$longitude = getPostValue("longitude");

if ($slug || $short_description_pt || $city_name || $latitude || $longitude) {
	$query_update_site = "
    UPDATE conteudo_internet.ci_hotel SET
        slug = " . getPostSafe("slug") . ",
        short_description_pt = " . getPostSafe("short_description_pt") . ",
        short_description_en = " . getPostSafe("short_description_en") . ",
        short_description_es = " . getPostSafe("short_description_es") . ",
        insight_pt = " . getPostSafe("insight_pt") . ",
        insight_en = " . getPostSafe("insight_en") . ",
        insight_es = " . getPostSafe("insight_es") . ",
        price_range = " . getPostSafe("price_range") . ",
        capacity_min = " . getPostSafe("capacity_min") . ",
        capacity_max = " . getPostSafe("capacity_max") . ",
        city_name = " . getPostSafe("city_name") . ",
        state = " . getPostSafe("state") . ",
        country = " . getPostSafe("country") . ",
        rating = " . getPostSafe("rating") . ",
        rating_count = " . getPostSafe("rating_count") . ",
        gallery_images = " . getPostSafe("gallery_images") . ",
        blueprint_image = " . getPostSafe("blueprint_image") . ",
        room_categories = " . getPostSafe("room_categories") . ",
        dining_experiences = " . getPostSafe("dining_experiences") . ",
        meeting_rooms_count = " . getPostSafe("meeting_rooms_count") . ",
        meeting_rooms_detail = " . getPostSafe("meeting_rooms_detail") . ",
        has_convention_center = " . getPostSafe("has_convention_center") . ",
        url_360_halls = " . getPostSafe("url_360_halls") . ",
        latitude = " . getPostSafe("latitude") . ",
        longitude = " . getPostSafe("longitude") . ",
        map_iframe_url = " . getPostSafe("map_iframe_url") . "
    WHERE frncod = $frncod";

	pg_query($conn, $query_update_site);
	echo "Dados do site atualizados<br>";
}

// ========================================
// INSERÇÃO DE APARTAMENTOS
// ========================================
for ($i = 1; $i <= 4; $i++) {
	$foto = getPostValue("foto$i");

	if ($foto && trim($foto) !== '') {
		$query_apto = "
        INSERT INTO conteudo_internet.ci_apartamento
        (aptocatcod, aptoloccod, aptqtd, aptoimgfoto, frncod)
        VALUES
        (" . getPostSafe("categ$i") . ", " . getPostSafe("loc$i") . ", " . getPostSafe("qtd$i") . ", " . getPostSafe("foto$i") . ", $frncod)";

		$result_apto = pg_query($conn, $query_apto);

		if ($result_apto) {
			echo "Apartamento $i inserido<br>";
		} else {
			echo "Erro ao inserir apartamento $i: " . pg_last_error($conn) . "<br>";
		}
	}
}

// ========================================
// INSERÇÃO DE FACILIDADES
// ========================================
$facilities = isset($_POST["facilities"]) ? $_POST["facilities"] : [];

if (is_array($facilities) && count($facilities) > 0) {
	foreach ($facilities as $tpofaccod) {
		$tpofaccod_safe = pg_escape_string($tpofaccod);

		$query_fac = "
        INSERT INTO conteudo_internet.ci_hotel_facilidade
        (mneu_for, flagfacinet, tpofaccod)
        VALUES
        ($frncod, TRUE, '$tpofaccod_safe')";

		$result_fac = pg_query($conn, $query_fac);

		if (!$result_fac) {
			echo "Erro ao inserir facilidade: " . pg_last_error($conn) . "<br>";
		}
	}
	echo "Facilidades inseridas (" . count($facilities) . " itens)<br>";
}

// ========================================
// LOG DE AUDITORIA
// ========================================
session_start();
$pk_acesso = isset($_SESSION['user']) ? $_SESSION['user'] : 'sistema';
$data_now = date("Y-m-d");

$query_log = "
INSERT INTO conteudo_internet.log_adm_conteudo
(usuario, acao, data, fk_conteudo)
VALUES
(" . sqlSafe($pk_acesso) . ", 'Inseriu o hotel - $mneu_for-$nome_htl', " . sqlSafe($data_now) . ", 2)";

pg_query($conn, $query_log);

echo "<br><br><strong style='color: green; font-size: 18px;'>✓ Hotel inserido com sucesso! ID: $frncod</strong>";
