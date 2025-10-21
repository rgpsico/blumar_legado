<?php
require_once '../util/connection.php';

// ============================================
// FUNÇÕES HELPER PARA SANITIZAÇÃO
// ============================================
function sanitize_value($value, $default = '')
{
	$cleaned = isset($value) ? $value : $default;
	return pg_escape_string($cleaned);
}

function sanitize_json($value, $default = '[]')
{
	$clean = isset($value) ? trim($value) : '';
	if (empty($clean)) {
		return $default;
	}
	// Assuming input is a valid JSON string; escape it for SQL
	return pg_escape_string($clean);
}

function sanitize_int($value)
{
	$clean = isset($value) ? trim($value) : '';
	return empty($clean) ? 'NULL' : (int)$clean;
}

function sanitize_int_default($value, $default = 0)
{
	$clean = isset($value) ? trim($value) : '';
	return empty($clean) ? $default : (int)$clean;
}

function sanitize_float($value)
{
	$clean = isset($value) ? trim($value) : '';
	return empty($clean) ? 'NULL' : (float)$clean;
}

function sanitize_checkbox($value)
{
	return isset($value) && ($value === 'on' || $value === 't' || $value === 'true') ? 't' : 'f';
}

// ============================================
// IDENTIFICADORES PRINCIPAIS
// ============================================
$mneu_for = sanitize_value(isset($_POST["mneu_for"]) ? $_POST["mneu_for"] : '');
$frncod = sanitize_value(isset($_POST["frncod"]) ? $_POST["frncod"] : '');
$nome_htl = sanitize_value(isset($_POST["nome_htl"]) ? $_POST["nome_htl"] : 'Update_hotel');

// ============================================
// GRUPO 1: DESCRIÇÕES PRINCIPAIS
// ============================================
$htldsc = sanitize_value(isset($_POST["htldsc"]) ? $_POST["htldsc"] : '');
$htldscing = sanitize_value(isset($_POST["htldscing"]) ? $_POST["htldscing"] : '');
$htldscesp = sanitize_value(isset($_POST["htldscesp"]) ? $_POST["htldscesp"] : '');
$descesp_grpfit = sanitize_value(isset($_POST["descesp_grpfit"]) ? $_POST["descesp_grpfit"] : '');
$hotel_cham = sanitize_value(isset($_POST["hotel_cham"]) ? $_POST["hotel_cham"] : '');

// ============================================
// GRUPO 2: CONTEÚDO RESORT - PORTUGUÊS
// ============================================
$regime_hotel_pt = sanitize_value(isset($_POST["regime_hotel_pt"]) ? $_POST["regime_hotel_pt"] : '');
$rec_entret_pt = sanitize_value(isset($_POST["rec_entret_pt"]) ? $_POST["rec_entret_pt"] : '');
$otras_ativ_pt = sanitize_value(isset($_POST["otras_ativ_pt"]) ? $_POST["otras_ativ_pt"] : '');
$alojamiento_pt = sanitize_value(isset($_POST["alojamiento_pt"]) ? $_POST["alojamiento_pt"] : '');
$gastronomia_pt = sanitize_value(isset($_POST["gastronomia_pt"]) ? $_POST["gastronomia_pt"] : '');
$servicios_pt = sanitize_value(isset($_POST["servicios_pt"]) ? $_POST["servicios_pt"] : '');
$convenciones_pt = sanitize_value(isset($_POST["convenciones_pt"]) ? $_POST["convenciones_pt"] : '');
$campo_extra_pt = sanitize_value(isset($_POST["campo_extra_pt"]) ? $_POST["campo_extra_pt"] : '');

// ============================================
// GRUPO 3: CONTEÚDO RESORT - INGLÊS
// ============================================
$regime_hotel_en = sanitize_value(isset($_POST["regime_hotel_en"]) ? $_POST["regime_hotel_en"] : '');
$rec_entret_en = sanitize_value(isset($_POST["rec_entret_en"]) ? $_POST["rec_entret_en"] : '');
$otras_ativ_en = sanitize_value(isset($_POST["otras_ativ_en"]) ? $_POST["otras_ativ_en"] : '');
$alojamiento_en = sanitize_value(isset($_POST["alojamiento_en"]) ? $_POST["alojamiento_en"] : '');
$gastronomia_en = sanitize_value(isset($_POST["gastronomia_en"]) ? $_POST["gastronomia_en"] : '');
$servicios_en = sanitize_value(isset($_POST["servicios_en"]) ? $_POST["servicios_en"] : '');
$convenciones_en = sanitize_value(isset($_POST["convenciones_en"]) ? $_POST["convenciones_en"] : '');
$campo_extra_en = sanitize_value(isset($_POST["campo_extra_en"]) ? $_POST["campo_extra_en"] : '');

// ============================================
// GRUPO 4: CONTEÚDO RESORT - ESPANHOL
// ============================================
$regime_hotel = sanitize_value(isset($_POST["regime_hotel"]) ? $_POST["regime_hotel"] : '');
$rec_entret = sanitize_value(isset($_POST["rec_entret"]) ? $_POST["rec_entret"] : '');
$otras_ativ = sanitize_value(isset($_POST["otras_ativ"]) ? $_POST["otras_ativ"] : '');
$alojamiento = sanitize_value(isset($_POST["alojamiento"]) ? $_POST["alojamiento"] : '');
$gastronomia = sanitize_value(isset($_POST["gastronomia"]) ? $_POST["gastronomia"] : '');
$servicios = sanitize_value(isset($_POST["servicios"]) ? $_POST["servicios"] : '');
$convenciones = sanitize_value(isset($_POST["convenciones"]) ? $_POST["convenciones"] : '');
$campo_extra = sanitize_value(isset($_POST["campo_extra"]) ? $_POST["campo_extra"] : '');
$complemento = sanitize_value(isset($_POST["complemento"]) ? $_POST["complemento"] : '');

// ============================================
// GRUPO 5: FOTOS PRINCIPAIS
// ============================================
$htlimgfotofachada = sanitize_value(isset($_POST["htlimgfotofachada"]) ? $_POST["htlimgfotofachada"] : '');
$fotofachada_tbn = sanitize_value(isset($_POST["fotofachada_tbn"]) ? $_POST["fotofachada_tbn"] : '');
$htlfotopiscina = sanitize_value(isset($_POST["htlfotopiscina"]) ? $_POST["htlfotopiscina"] : '');
$fotoextra = sanitize_value(isset($_POST["fotoextra"]) ? $_POST["fotoextra"] : '');
$fotoextra_recep = sanitize_value(isset($_POST["fotoextra_recep"]) ? $_POST["fotoextra_recep"] : '');

// ============================================
// GRUPO 6: FOTOS EXTRAS (RESORT)
// ============================================
$ft_resort1 = sanitize_value(isset($_POST["ft_resort1"]) ? $_POST["ft_resort1"] : '');
$ft_resort2 = sanitize_value(isset($_POST["ft_resort2"]) ? $_POST["ft_resort2"] : '');
$ft_resort3 = sanitize_value(isset($_POST["ft_resort3"]) ? $_POST["ft_resort3"] : '');
$gallery_images = sanitize_json(isset($_POST["gallery_images"]) ? $_POST["gallery_images"] : '');
$blueprint_image = sanitize_value(isset($_POST["blueprint_image"]) ? $_POST["blueprint_image"] : '');

// ============================================
// GRUPO 7: MAPAS E LOCALIZAÇÃO
// ============================================
$htlurl = sanitize_value(isset($_POST["htlurl"]) ? $_POST["htlurl"] : '');
$htlimgmapa = sanitize_value(isset($_POST["htlimgmapa"]) ? $_POST["htlimgmapa"] : '');
$map_eco = sanitize_value(isset($_POST["map_eco"]) ? $_POST["map_eco"] : '');
$map_iframe_url = sanitize_value(isset($_POST["map_iframe_url"]) ? $_POST["map_iframe_url"] : '');
$latitude = sanitize_float(isset($_POST["latitude"]) ? $_POST["latitude"] : '');
$longitude = sanitize_float(isset($_POST["longitude"]) ? $_POST["longitude"] : '');

// ============================================
// GRUPO 8: VÍDEOS E TOURS 360
// ============================================
$url_htl_360 = sanitize_value(isset($_POST["url_htl_360"]) ? $_POST["url_htl_360"] : '');
$arq_htl_360 = sanitize_value(isset($_POST["arq_htl_360"]) ? $_POST["arq_htl_360"] : '');
$url_video = sanitize_value(isset($_POST["url_video"]) ? $_POST["url_video"] : '');
$arq_video = sanitize_value(isset($_POST["arq_video"]) ? $_POST["arq_video"] : '');
$virtual_tour = sanitize_value(isset($_POST["virtual_tour"]) ? $_POST["virtual_tour"] : '');
$url_360_halls = sanitize_value(isset($_POST["url_360_halls"]) ? $_POST["url_360_halls"] : '');

// ============================================
// GRUPO 9: DOCUMENTOS COVID-19
// ============================================
$covid_19_pt_url = sanitize_value(isset($_POST["covid_19_pt_url"]) ? $_POST["covid_19_pt_url"] : '');
$covid_19_en_url = sanitize_value(isset($_POST["covid_19_en_url"]) ? $_POST["covid_19_en_url"] : '');

// ============================================
// GRUPO 10: OBSERVAÇÕES
// ============================================
$htlobs = sanitize_value(isset($_POST["htlobs"]) ? $_POST["htlobs"] : '');
$htlobsing = sanitize_value(isset($_POST["htlobsing"]) ? $_POST["htlobsing"] : '');
$htlobsesp = sanitize_value(isset($_POST["htlobsesp"]) ? $_POST["htlobsesp"] : '');
$historico_temp = sanitize_value(isset($_POST["historico_temp"]) ? $_POST["historico_temp"] : '');

// ============================================
// GRUPO 11: FLAGS E MARCAÇÕES GERAIS
// ============================================
$flaghtl = sanitize_checkbox(isset($_POST["flaghtl"]) ? $_POST["flaghtl"] : '');
$flaglatino = sanitize_checkbox(isset($_POST["flaglatino"]) ? $_POST["flaglatino"] : '');
$flat = sanitize_checkbox(isset($_POST["flat"]) ? $_POST["flat"] : '');
$resort = sanitize_checkbox(isset($_POST["resort"]) ? $_POST["resort"] : '');
$ecologico = sanitize_checkbox(isset($_POST["ecologico"]) ? $_POST["ecologico"] : '');
$flagfotopiscina = sanitize_checkbox(isset($_POST["flagfotopiscina"]) ? $_POST["flagfotopiscina"] : '');
$bestdeal = sanitize_checkbox(isset($_POST["bestdeal"]) ? $_POST["bestdeal"] : '');
$ativo_bnuts = sanitize_checkbox(isset($_POST["ativo_bnuts"]) ? $_POST["ativo_bnuts"] : '');

// ============================================
// GRUPO 12: FLAGS DESTAQUES FIT
// ============================================
$flaghtlimgmapa = sanitize_checkbox(isset($_POST["flaghtlimgmapa"]) ? $_POST["flaghtlimgmapa"] : '');
$luxury = sanitize_checkbox(isset($_POST["luxury"]) ? $_POST["luxury"] : '');
$novo = sanitize_checkbox(isset($_POST["novo"]) ? $_POST["novo"] : '');
$favoritos = sanitize_checkbox(isset($_POST["favoritos"]) ? $_POST["favoritos"] : '');

// ============================================
// GRUPO 13: FLAGS SITE NACIONAL
// ============================================
$pg6fq7 = sanitize_checkbox(isset($_POST["pg6fq7"]) ? $_POST["pg6fq7"] : '');
$pg4fq5 = sanitize_checkbox(isset($_POST["pg4fq5"]) ? $_POST["pg4fq5"] : '');
$chdgratis = sanitize_checkbox(isset($_POST["chdgratis"]) ? $_POST["chdgratis"] : '');
$blumarrecomenda = sanitize_checkbox(isset($_POST["blumarrecomenda"]) ? $_POST["blumarrecomenda"] : '');
$blumarreveillon = sanitize_checkbox(isset($_POST["blumarreveillon"]) ? $_POST["blumarreveillon"] : '');
$allinclusive = sanitize_checkbox(isset($_POST["allinclusive"]) ? $_POST["allinclusive"] : '');
$ativo_mostrp = sanitize_checkbox(isset($_POST["ativo_mostrp"]) ? $_POST["ativo_mostrp"] : '');

// ============================================
// GRUPO 14: CLASSIFICAÇÕES
// ============================================
$htlestrelablumar_raw = sanitize_value(isset($_POST["htlestrelablumar"]) ? $_POST["htlestrelablumar"] : '');
$htlestrelablumar = empty($htlestrelablumar_raw) ? 'NULL' : "'" . $htlestrelablumar_raw . "'";
$classif_eco = sanitize_int_default(isset($_POST["classif_eco"]) ? $_POST["classif_eco"] : '', 0);
$desc_mostrp_ing = sanitize_value(isset($_POST["desc_mostrp_ing"]) ? $_POST["desc_mostrp_ing"] : '');

// ============================================
// GRUPO 15: DADOS ADICIONAIS BÁSICOS
// ============================================
$htl_num_quartos = sanitize_int(isset($_POST["htl_num_quartos"]) ? $_POST["htl_num_quartos"] : '');
$slug = sanitize_value(isset($_POST["slug"]) ? $_POST["slug"] : '');
$price_range = sanitize_value(isset($_POST["price_range"]) ? $_POST["price_range"] : '');

// ============================================
// GRUPO 16: DESCRIÇÕES CURTAS
// ============================================
$short_description_pt = sanitize_value(isset($_POST["short_description_pt"]) ? $_POST["short_description_pt"] : '');
$short_description_en = sanitize_value(isset($_POST["short_description_en"]) ? $_POST["short_description_en"] : '');
$short_description_es = sanitize_value(isset($_POST["short_description_es"]) ? $_POST["short_description_es"] : '');

// ============================================
// GRUPO 17: INSIGHTS
// ============================================
$insight_pt = sanitize_value(isset($_POST["insight_pt"]) ? $_POST["insight_pt"] : '');
$insight_en = sanitize_value(isset($_POST["insight_en"]) ? $_POST["insight_en"] : '');
$insight_es = sanitize_value(isset($_POST["insight_es"]) ? $_POST["insight_es"] : '');

// ============================================
// GRUPO 18: CAPACIDADE E LOCALIZAÇÃO
// ============================================
$capacity_min = sanitize_int(isset($_POST["capacity_min"]) ? $_POST["capacity_min"] : '');
$capacity_max = sanitize_int(isset($_POST["capacity_max"]) ? $_POST["capacity_max"] : '');
$city_name = sanitize_value(isset($_POST["city_name"]) ? $_POST["city_name"] : '');
$state = sanitize_value(isset($_POST["state"]) ? $_POST["state"] : '');
$country = sanitize_value(isset($_POST["country"]) ? $_POST["country"] : '');

// ============================================
// GRUPO 19: AVALIAÇÕES
// ============================================
$rating = sanitize_float(isset($_POST["rating"]) ? $_POST["rating"] : '');
$rating_count = sanitize_int(isset($_POST["rating_count"]) ? $_POST["rating_count"] : '');

// ============================================
// GRUPO 20: EXPERIÊNCIAS E CATEGORIAS
// ============================================
$room_categories = sanitize_value(isset($_POST["room_categories"]) ? $_POST["room_categories"] : '');
$dining_experiences = sanitize_value(isset($_POST["dining_experiences"]) ? $_POST["dining_experiences"] : '');

// ============================================
// GRUPO 21: REUNIÕES E CONVENÇÕES
// ============================================
$meeting_rooms_count = sanitize_int(isset($_POST["meeting_rooms_count"]) ? $_POST["meeting_rooms_count"] : '');
$meeting_rooms_detail = sanitize_value(isset($_POST["meeting_rooms_detail"]) ? $_POST["meeting_rooms_detail"] : '');
$has_convention_center = sanitize_checkbox(isset($_POST["has_convention_center"]) ? $_POST["has_convention_center"] : '');

// ============================================
// INÍCIO DOS UPDATES NO BANCO
// ============================================

try {
	// UPDATE 1: Descrições Principais
	$sql1 = "
		UPDATE conteudo_internet.ci_hotel
		SET htldsc = '$htldsc',
			htldscing = '$htldscing',
			htldscesp = '$htldscesp',
			descesp_grpfit = '$descesp_grpfit',
			hotel_cham = '$hotel_cham'
		WHERE frncod = '$frncod'
	";
	$result1 = pg_query($conn, $sql1);
	if (!$result1) throw new Exception("Erro no UPDATE 1: Descrições Principais");

	// UPDATE 2: Conteúdo Resort - Português
	$sql2 = "
		UPDATE conteudo_internet.ci_hotel
		SET regime_hotel_pt = '$regime_hotel_pt',
			rec_entret_pt = '$rec_entret_pt',
			otras_ativ_pt = '$otras_ativ_pt',
			alojamiento_pt = '$alojamiento_pt',
			gastronomia_pt = '$gastronomia_pt',
			servicios_pt = '$servicios_pt',
			convenciones_pt = '$convenciones_pt',
			campo_extra_pt = '$campo_extra_pt'
		WHERE frncod = '$frncod'
	";
	$result2 = pg_query($conn, $sql2);
	if (!$result2) throw new Exception("Erro no UPDATE 2: Conteúdo Resort PT");

	// UPDATE 3: Conteúdo Resort - Inglês
	$sql3 = "
		UPDATE conteudo_internet.ci_hotel
		SET regime_hotel_en = '$regime_hotel_en',
			rec_entret_en = '$rec_entret_en',
			otras_ativ_en = '$otras_ativ_en',
			alojamiento_en = '$alojamiento_en',
			gastronomia_en = '$gastronomia_en',
			servicios_en = '$servicios_en',
			convenciones_en = '$convenciones_en',
			campo_extra_en = '$campo_extra_en'
		WHERE frncod = '$frncod'
	";
	$result3 = pg_query($conn, $sql3);
	if (!$result3) throw new Exception("Erro no UPDATE 3: Conteúdo Resort EN");

	// UPDATE 4: Conteúdo Resort - Espanhol
	$sql4 = "
		UPDATE conteudo_internet.ci_hotel
		SET regime_hotel = '$regime_hotel',
			rec_entret = '$rec_entret',
			otras_ativ = '$otras_ativ',
			alojamiento = '$alojamiento',
			gastronomia = '$gastronomia',
			servicios = '$servicios',
			convenciones = '$convenciones',
			campo_extra = '$campo_extra',
			complemento = '$complemento'
		WHERE frncod = '$frncod'
	";
	$result4 = pg_query($conn, $sql4);
	if (!$result4) throw new Exception("Erro no UPDATE 4: Conteúdo Resort ES");

	// UPDATE 5: Fotos Principais
	$sql5 = "
		UPDATE conteudo_internet.ci_hotel
		SET htlimgfotofachada = '$htlimgfotofachada',
			fotofachada_tbn = '$fotofachada_tbn',
			htlfotopiscina = '$htlfotopiscina',
			fotoextra = '$fotoextra',
			fotoextra_recep = '$fotoextra_recep'
		WHERE frncod = '$frncod'
	";
	$result5 = pg_query($conn, $sql5);
	if (!$result5) throw new Exception("Erro no UPDATE 5: Fotos Principais");

	// UPDATE 6: Fotos Extras (Resort)
	$sql6 = "
		UPDATE conteudo_internet.ci_hotel
		SET ft_resort1 = '$ft_resort1',
			ft_resort2 = '$ft_resort2',
			ft_resort3 = '$ft_resort3',
			gallery_images = '$gallery_images',
			blueprint_image = '$blueprint_image'
		WHERE frncod = '$frncod'
	";
	$result6 = pg_query($conn, $sql6);
	if (!$result6) throw new Exception("Erro no UPDATE 6: Fotos Extras");

	// UPDATE 7: Mapas e Localização
	$sql7 = "
		UPDATE conteudo_internet.ci_hotel
		SET htlurl = '$htlurl',
			htlimgmapa = '$htlimgmapa',
			map_eco = '$map_eco',
			map_iframe_url = '$map_iframe_url',
			latitude = $latitude,
			longitude = $longitude
		WHERE frncod = '$frncod'
	";
	$result7 = pg_query($conn, $sql7);
	if (!$result7) throw new Exception("Erro no UPDATE 7: Mapas e Localização");

	// UPDATE 8: Vídeos e Tours 360
	$sql8 = "
		UPDATE conteudo_internet.ci_hotel
		SET url_htl_360 = '$url_htl_360',
			arq_htl_360 = '$arq_htl_360',
			url_video = '$url_video',
			arq_video = '$arq_video',
			virtual_tour = '$virtual_tour',
			url_360_halls = '$url_360_halls'
		WHERE frncod = '$frncod'
	";
	$result8 = pg_query($conn, $sql8);
	if (!$result8) throw new Exception("Erro no UPDATE 8: Vídeos e Tours");

	// UPDATE 9: Documentos COVID-19
	$sql9 = "
		UPDATE conteudo_internet.ci_hotel
		SET covid_19_pt_url = '$covid_19_pt_url',
			covid_19_en_url = '$covid_19_en_url'
		WHERE frncod = '$frncod'
	";
	$result9 = pg_query($conn, $sql9);
	if (!$result9) throw new Exception("Erro no UPDATE 9: COVID-19");

	// UPDATE 10: Observações
	$sql10 = "
		UPDATE conteudo_internet.ci_hotel
		SET htlobs = '$htlobs',
			htlobsing = '$htlobsing',
			htlobsesp = '$htlobsesp',
			historico_temp = '$historico_temp'
		WHERE frncod = '$frncod'
	";
	$result10 = pg_query($conn, $sql10);
	if (!$result10) throw new Exception("Erro no UPDATE 10: Observações");

	// UPDATE 11: Flags e Marcações Gerais
	$sql11 = "
		UPDATE conteudo_internet.ci_hotel
		SET flaghtl = '$flaghtl',
			flaglatino = '$flaglatino',
			flat = '$flat',
			resort = '$resort',
			ecologico = '$ecologico',
			flagfotopiscina = '$flagfotopiscina',
			bestdeal = '$bestdeal',
			ativo_bnuts = '$ativo_bnuts'
		WHERE frncod = '$frncod'
	";
	$result11 = pg_query($conn, $sql11);
	if (!$result11) throw new Exception("Erro no UPDATE 11: Flags Gerais");

	// UPDATE 12: Flags Destaques FIT
	$sql12 = "
		UPDATE conteudo_internet.ci_hotel
		SET flaghtlimgmapa = '$flaghtlimgmapa',
			luxury = '$luxury',
			novo = '$novo',
			favoritos = '$favoritos'
		WHERE frncod = '$frncod'
	";
	$result12 = pg_query($conn, $sql12);
	if (!$result12) throw new Exception("Erro no UPDATE 12: Flags FIT");

	// UPDATE 13: Flags Site Nacional
	$sql13 = "
		UPDATE conteudo_internet.ci_hotel
		SET pg6fq7 = '$pg6fq7',
			pg4fq5 = '$pg4fq5',
			chdgratis = '$chdgratis',
			blumarrecomenda = '$blumarrecomenda',
			blumarreveillon = '$blumarreveillon',
			allinclusive = '$allinclusive',
			ativo_mostrp = '$ativo_mostrp'
		WHERE frncod = '$frncod'
	";
	$result13 = pg_query($conn, $sql13);
	if (!$result13) throw new Exception("Erro no UPDATE 13: Flags Site Nacional");

	// UPDATE 14: Classificações
	$sql14 = "
		UPDATE conteudo_internet.ci_hotel
		SET htlestrelablumar = $htlestrelablumar,
			classif_eco = $classif_eco,
			desc_mostrp_ing = '$desc_mostrp_ing'
		WHERE frncod = '$frncod'
	";
	$result14 = pg_query($conn, $sql14);
	if (!$result14) throw new Exception("Erro no UPDATE 14: Classificações");

	// UPDATE 15: Dados Adicionais Básicos
	$sql15 = "
		UPDATE conteudo_internet.ci_hotel
		SET htl_num_quartos = $htl_num_quartos,
			slug = '$slug',
			price_range = '$price_range'
		WHERE frncod = '$frncod'
	";
	$result15 = pg_query($conn, $sql15);
	if (!$result15) throw new Exception("Erro no UPDATE 15: Dados Básicos");

	// UPDATE 16: Descrições Curtas
	$sql16 = "
		UPDATE conteudo_internet.ci_hotel
		SET short_description_pt = '$short_description_pt',
			short_description_en = '$short_description_en',
			short_description_es = '$short_description_es'
		WHERE frncod = '$frncod'
	";
	$result16 = pg_query($conn, $sql16);
	if (!$result16) throw new Exception("Erro no UPDATE 16: Descrições Curtas");

	// UPDATE 17: Insights
	$sql17 = "
		UPDATE conteudo_internet.ci_hotel
		SET insight_pt = '$insight_pt',
			insight_en = '$insight_en',
			insight_es = '$insight_es'
		WHERE frncod = '$frncod'
	";
	$result17 = pg_query($conn, $sql17);
	if (!$result17) throw new Exception("Erro no UPDATE 17: Insights");

	// UPDATE 18: Capacidade e Localização
	$sql18 = "
		UPDATE conteudo_internet.ci_hotel
		SET capacity_min = $capacity_min,
			capacity_max = $capacity_max,
			city_name = '$city_name',
			state = '$state',
			country = '$country'
		WHERE frncod = '$frncod'
	";
	$result18 = pg_query($conn, $sql18);
	if (!$result18) throw new Exception("Erro no UPDATE 18: Capacidade");

	// UPDATE 19: Avaliações
	$sql19 = "
		UPDATE conteudo_internet.ci_hotel
		SET rating = $rating,
			rating_count = $rating_count
		WHERE frncod = '$frncod'
	";
	$result19 = pg_query($conn, $sql19);
	if (!$result19) throw new Exception("Erro no UPDATE 19: Avaliações");

	// UPDATE 20: Experiências e Categorias
	$sql20 = "
		UPDATE conteudo_internet.ci_hotel
		SET room_categories = '$room_categories',
			dining_experiences = '$dining_experiences'
		WHERE frncod = '$frncod'
	";
	$result20 = pg_query($conn, $sql20);
	if (!$result20) throw new Exception("Erro no UPDATE 20: Experiências");

	// UPDATE 21: Reuniões e Convenções
	$sql21 = "
		UPDATE conteudo_internet.ci_hotel
		SET meeting_rooms_count = $meeting_rooms_count,
			meeting_rooms_detail = '$meeting_rooms_detail',
			has_convention_center = '$has_convention_center'
		WHERE frncod = '$frncod'
	";
	$result21 = pg_query($conn, $sql21);
	if (!$result21) throw new Exception("Erro no UPDATE 21: Reuniões");

	// ============================================
	// LOG DA OPERAÇÃO
	// ============================================
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$pk_acesso = isset($_SESSION['user']) ? $_SESSION['user'] : 'sistema';

	$data_now = date("Y-m-d");

	$query_log = "
		INSERT INTO conteudo_internet.log_adm_conteudo
		(usuario, acao, data, fk_conteudo)
		VALUES
		('$pk_acesso', 'Atualizou o hotel - $mneu_for-$nome_htl', '$data_now', '2')
	";
	pg_query($conn, $query_log);



	echo '<div class="alert alert-success">';
	echo '<h4>✓ HOTEL ATUALIZADO COM SUCESSO!</h4>';
	echo '<p>Todos os 21 grupos de dados foram atualizados.</p>';
	echo '</div>';
	echo "<hr>";

	$update_apto = 0;
	require_once 'miolo_hotel.php';
} catch (Exception $e) {
	echo '<div class="alert alert-danger">';
	echo '<h4>✗ ERRO AO ATUALIZAR HOTEL</h4>';
	echo '<p>' . $e->getMessage() . '</p>';
	echo '<p>Erro PostgreSQL: ' . pg_last_error($conn) . '</p>';
	echo '</div>';
}
