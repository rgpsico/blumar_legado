function acao_hotelv2() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/miolo_hotel.php",
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when retrieving hotel content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}



function novo_hotelv2() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/novo_hotel.php",
		type: 'POST',
		data: {
			mneu_for: $("#mneu_for").val()
		},
		error: function () {
			alert("Error when inserting City content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}



function insere_novo_hotel() {




	var facilities1 = '';
	$("div#box16 :checkbox:checked").each(function () {
		facilities1 += $(this).val() + ",";
	});

	var has_convention_center = '';
	if ($("#has_convention_center").is(":checked")) {
		has_convention_center = "true";
	} else {
		has_convention_center = "false";
	}

	if ($("#flaghtl").is(":checked")) {
		var flaghtl = "true";
	} else {
		var flaghtl = "false";
	}

	if ($("#ativo_latino").is(":checked")) {
		var ativo_latino = "true";
	} else {
		var ativo_latino = "false";
	}

	if ($("#ativo_flat").is(":checked")) {
		var ativo_flat = "true";
	} else {
		var ativo_flat = "false";
	}

	if ($("#resort").is(":checked")) {
		var resort = "true";
	} else {
		var resort = "false";
	}

	if ($("#ecologico").is(":checked")) {
		var ecologico = "true";
	} else {
		var ecologico = "false";
	}

	if ($("#validafotopiscina").is(":checked")) {
		var validafotopiscina = "true";
	} else {
		var validafotopiscina = "false";
	}

	if ($("#bestdeal").is(":checked")) {
		var bestdeal = "true";
	} else {
		var bestdeal = "false";
	}

	if ($("#inet_mapa").is(":checked")) {
		var inet_mapa = "true";
	} else {
		var inet_mapa = "false";
	}

	if ($("#luxury").is(":checked")) {
		var luxury = "true";
	} else {
		var luxury = "false";
	}

	if ($("#novo").is(":checked")) {
		var novo = "true";
	} else {
		var novo = "false";
	}

	if ($("#favoritos").is(":checked")) {
		var favoritos = "true";
	} else {
		var favoritos = "false";
	}

	if ($("#pg6fq7").is(":checked")) {
		var pg6fq7 = "true";
	} else {
		var pg6fq7 = "false";
	}

	if ($("#pg4fq5").is(":checked")) {
		var pg4fq5 = "true";
	} else {
		var pg4fq5 = "false";
	}

	if ($("#chdgratis").is(":checked")) {
		var chdgratis = "true";
	} else {
		var chdgratis = "false";
	}

	if ($("#blumarrecomenda").is(":checked")) {
		var blumarrecomenda = "true";
	} else {
		var blumarrecomenda = "false";
	}

	if ($("#blumarreveillon").is(":checked")) {
		var blumarreveillon = "true";
	} else {
		var blumarreveillon = "false";
	}

	if ($("#ativo_mostrp").is(":checked")) {
		var ativo_mostrp = "true";
	} else {
		var ativo_mostrp = "false";
	}

	if ($("#allinclusive").is(":checked")) {
		var allinclusive = "true";
	} else {
		var allinclusive = "false";
	}

	if ($("#ativo_bnuts").is(":checked")) {
		var ativo_bnuts = "true";
	} else {
		var ativo_bnuts = "false";
	}




	$.ajax({
		dataType: "html",
		url: "hotelv2/insere_novo_hotel.php",
		type: 'POST',
		data: {

			mneu_for: $("#mneu_for").val(),
			descricao_pt: $("#descricao_pt").val(),
			descricao_en: $("#descricao_en").val(),
			descricao_esp: $("#descricao_esp").val(),
			descesp_grpfit: $("#descesp_grpfit").val(),
			regime_hotel_pt: $("#regime_hotel_pt").val(),
			regime_hotel_en: $("#regime_hotel_en").val(),
			regime_hotel_esp: $("#regime_hotel_esp").val(),
			rec_entret_pt: $("#rec_entret_pt").val(),
			rec_entret_en: $("#rec_entret_en").val(),
			rec_entret_esp: $("#rec_entret_esp").val(),
			otras_ativ_pt: $("#otras_ativ_pt").val(),
			otras_ativ_en: $("#otras_ativ_en").val(),
			otras_ativ_esp: $("#otras_ativ_esp").val(),
			alojamiento_pt: $("#alojamiento_pt").val(),
			alojamiento_en: $("#alojamiento_en").val(),
			alojamiento_esp: $("#alojamiento_esp").val(),
			gastronomia_pt: $("#gastronomia_pt").val(),
			gastronomia_en: $("#gastronomia_en").val(),
			gastronomia_esp: $("#gastronomia_esp").val(),
			servicios_pt: $("#servicios_pt").val(),
			servicios_en: $("#servicios_en").val(),
			servicios_esp: $("#servicios_esp").val(),
			convenciones_pt: $("#convenciones_pt").val(),
			convenciones_en: $("#convenciones_en").val(),
			convenciones_esp: $("#convenciones_esp").val(),
			campo_extra_pt: $("#campo_extra_pt").val(),
			campo_extra_en: $("#campo_extra_en").val(),
			campo_extra_esp: $("#campo_extra_esp").val(),
			complemento: $("#complemento").val(),
			hotel_cham: $("#hotel_cham").val(),
			foto_fachada: $("#foto_fachada").val(),
			fotofachada_tbn: $("#fotofachada_tbn").val(),
			fotopiscina: $("#fotopiscina").val(),
			fotoextra: $("#fotoextra").val(),
			fotoextra_recep: $("#fotoextra_recep").val(),
			ft_resort1: $("#ft_resort1").val(),
			ft_resort2: $("#ft_resort2").val(),
			ft_resort3: $("#ft_resort3").val(),
			categ1: $("#categ1").val(),
			loc1: $("#loc1").val(),
			qtd1: $("#qtd1").val(),
			foto1: $("#foto1").val(),
			categ2: $("#categ2").val(),
			loc2: $("#loc2").val(),
			qtd2: $("#qtd2").val(),
			foto2: $("#foto2").val(),
			categ3: $("#categ3").val(),
			loc3: $("#loc3").val(),
			qtd3: $("#qtd3").val(),
			foto3: $("#foto3").val(),
			categ4: $("#categ4").val(),
			loc4: $("#loc4").val(),
			qtd4: $("#qtd4").val(),
			foto4: $("#foto4").val(),
			htlurl: $("#htlurl").val(),
			mapa: $("#mapa").val(),
			map_eco: $("#map_eco").val(),
			url_htl_360: $("#url_htl_360").val(),
			arq_htl_360: $("#arq_htl_360").val(),
			url_video: $("#url_video").val(),
			arq_video: $("#arq_video").val(),
			obs_pt: $("#obs_pt").val(),
			obs_en: $("#obs_en").val(),
			obs_esp: $("#obs_esp").val(),
			historico_temp: $("#historico_temp").val(),
			flaghtl: flaghtl,
			ativo_latino: ativo_latino,
			ativo_flat: ativo_flat,
			resort: resort,
			ecologico: ecologico,
			validafotopiscina: validafotopiscina,
			bestdeal: bestdeal,
			inet_mapa: inet_mapa,
			luxury: luxury,
			novo: novo,
			favoritos: favoritos,
			htlestrelablumar: $("#htlestrelablumar").val(),
			classif_eco: $("#classif_eco").val(),
			pg6fq7: pg6fq7,
			pg4fq5: pg4fq5,
			chdgratis: chdgratis,
			blumarrecomenda: blumarrecomenda,
			blumarreveillon: blumarreveillon,
			allinclusive: allinclusive,
			desc_mostrp_ing: $("#desc_mostrp_ing").val(),
			ativo_mostrp: ativo_mostrp,
			facilities: facilities1,
			ativo_bnuts: ativo_bnuts,
			virtual_tour: $("#virtual_tour").val(),
			htl_num_quartos: $("#htl_num_quartos").val(),
			slug: $("#slug").val(),
			short_description_pt: $("#short_description_pt").val(),
			short_description_en: $("#short_description_en").val(),
			short_description_es: $("#short_description_es").val(),
			insight_pt: $("#insight_pt").val(),
			insight_en: $("#insight_en").val(),
			insight_es: $("#insight_es").val(),
			price_range: $("#price_range").val(),
			capacity_min: $("#capacity_min").val(),
			capacity_max: $("#capacity_max").val(),
			city_name: $("#city_name").val(),
			state: $("#state").val(),
			country: $("#country").val(),
			rating: $("#rating").val(),
			rating_count: $("#rating_count").val(),
			gallery_images: $("#gallery_images").val(),
			blueprint_image: $("#blueprint_image").val(),
			room_categories: $("#room_categories").val(),
			dining_experiences: $("#dining_experiences").val(),
			meeting_rooms_count: $("#meeting_rooms_count").val(),
			meeting_rooms_detail: $("#meeting_rooms_detail").val(),
			has_convention_center: has_convention_center,
			url_360_halls: $("#url_360_halls").val(),
			latitude: $("#latitude").val(),
			longitude: $("#longitude").val(),
			map_iframe_url: $("#map_iframe_url").val()

		},

		error: function () {
			alert("Error when inserting City content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}



function altera_hotel() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/altera_hotel.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}



function altera_hotel2() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/altera_hotel.php",
		type: 'POST',
		data: {

			frncod: $("#frncod2").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}



function listagem_htl_ingles() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/relatorio_hotel_ing.php",
		type: 'POST',
		data: {

			cidcod: $("#cidcod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}





function cadastro_fac() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/cadastro_facilidades.php",

		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}

function insere_fac() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/insert_facilidades.php",
		type: 'POST',
		data: {

			categ: $("#categ").val(),
			facilidade: $("#facilidade").val(),
			facilidadeingles: $("#facilidadeingles").val(),
			facilidadeespanhol: $("#facilidadeespanhol").val()


		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}















function update_hotel() {



	if ($("#flaghtl").is(":checked")) {
		var flaghtl = "true";
	} else {
		var flaghtl = "false";
	}

	if ($("#flaglatino").is(":checked")) {
		var flaglatino = "true";
	} else {
		var flaglatino = "false";
	}

	if ($("#flat").is(":checked")) {
		var flat = "true";
	} else {
		var flat = "false";
	}

	if ($("#resort").is(":checked")) {
		var resort = "true";
	} else {
		var resort = "false";
	}

	if ($("#ecologico").is(":checked")) {
		var ecologico = "true";
	} else {
		var ecologico = "false";
	}

	if ($("#flagfotopiscina").is(":checked")) {
		var flagfotopiscina = "true";
	} else {
		var flagfotopiscina = "false";
	}

	if ($("#bestdeal").is(":checked")) {
		var bestdeal = "true";
	} else {
		var bestdeal = "false";
	}

	if ($("#flaghtlimgmapa").is(":checked")) {
		var flaghtlimgmapa = "true";
	} else {
		var flaghtlimgmapa = "false";
	}


	if ($("#luxury").is(":checked")) {
		var luxury = "true";
	} else {
		var luxury = "false";
	}

	if ($("#novo").is(":checked")) {
		var novo = "true";
	} else {
		var novo = "false";
	}

	if ($("#favoritos").is(":checked")) {
		var favoritos = "true";
	} else {
		var favoritos = "false";
	}
	if ($("#pg6fq7").is(":checked")) {
		var pg6fq7 = "true";
	} else {
		var pg6fq7 = "false";
	}

	if ($("#pg4fq5").is(":checked")) {
		var pg4fq5 = "true";
	} else {
		var pg4fq5 = "false";
	}


	if ($("#chdgratis").is(":checked")) {
		var chdgratis = "true";
	} else {
		var chdgratis = "false";
	}

	if ($("#blumarrecomenda").is(":checked")) {
		var blumarrecomenda = "true";
	} else {
		var blumarrecomenda = "false";
	}

	if ($("#blumarreveillon").is(":checked")) {
		var blumarreveillon = "true";
	} else {
		var blumarreveillon = "false";
	}

	if ($("#allinclusive").is(":checked")) {
		var allinclusive = "true";
	} else {
		var allinclusive = "false";
	}

	if ($("#ativo_mostrp").is(":checked")) {
		var ativo_mostrp = "true";
	} else {
		var ativo_mostrp = "false";
	}


	if ($("#ativo_bnuts").is(":checked")) {
		var ativo_bnuts = "true";
	} else {
		var ativo_bnuts = "false";
	}

	if ($("#has_convention_center").is(":checked")) {
		var has_convention_center = "true";
	} else {
		var has_convention_center = "false";
	}








	$.ajax({
		dataType: "html",
		url: "hotelv2/update_hotel.php",
		type: 'POST',
		data: {
			frncod: $("#frncod").val(),
			mneu_for: $("#mneu_for").val(),
			//nome_htl: $("#nome_htl").val(),
			//estrelas_htl: $("#estrelas_htl").val(),
			//cidade_htl: $("#cidade_htl").val(),
			//htlendrua: $("#htlendrua").val(),
			htldsc: $("#htldsc").val(),
			htldscing: $("#htldscing").val(),
			htldscesp: $("#htldscesp").val(),
			descesp_grpfit: $("#descesp_grpfit").val(),
			regime_hotel_pt: $("#regime_hotel_pt").val(),
			regime_hotel_en: $("#regime_hotel_en").val(),
			regime_hotel: $("#regime_hotel").val(),
			rec_entret_pt: $("#rec_entret_pt").val(),
			rec_entret_en: $("#rec_entret_en").val(),
			rec_entret: $("#rec_entret").val(),
			otras_ativ_pt: $("#otras_ativ_pt").val(),
			otras_ativ_en: $("#otras_ativ_en").val(),
			otras_ativ: $("#otras_ativ").val(),
			alojamiento_pt: $("#alojamiento_pt").val(),
			alojamiento_en: $("#alojamiento_en").val(),
			alojamiento: $("#alojamiento").val(),
			gastronomia_pt: $("#gastronomia_pt").val(),
			gastronomia_en: $("#gastronomia_en").val(),
			gastronomia: $("#gastronomia").val(),
			servicios_pt: $("#servicios_pt").val(),
			servicios_en: $("#servicios_en").val(),
			servicios: $("#servicios").val(),
			convenciones_pt: $("#convenciones_pt").val(),
			convenciones_en: $("#convenciones_en").val(),
			convenciones: $("#convenciones").val(),
			campo_extra_pt: $("#campo_extra_pt").val(),
			campo_extra_en: $("#campo_extra_en").val(),
			campo_extra: $("#campo_extra").val(),
			complemento: $("#complemento").val(),
			hotel_cham: $("#hotel_cham").val(),
			htlimgfotofachada: $("#htlimgfotofachada").val(),
			fotofachada_tbn: $("#fotofachada_tbn").val(),
			htlfotopiscina: $("#htlfotopiscina").val(),
			fotoextra: $("#fotoextra").val(),
			fotoextra_recep: $("#fotoextra_recep").val(),
			ft_resort1: $("#ft_resort1").val(),
			ft_resort2: $("#ft_resort2").val(),
			ft_resort3: $("#ft_resort3").val(),
			htlurl: $("#htlurl").val(),
			htlimgmapa: $("#htlimgmapa").val(),
			map_eco: $("#map_eco").val(),
			url_htl_360: $("#url_htl_360").val(),
			arq_htl_360: $("#arq_htl_360").val(),
			url_video: $("#url_video").val(),
			arq_video: $("#arq_video").val(),
			virtual_tour: $("#virtual_tour").val(),
			htlobs: $("#htlobs").val(),
			htlobsing: $("#htlobsing").val(),
			htlobsesp: $("#htlobsesp").val(),
			historico_temp: $("#historico_temp").val(),
			htlestrelablumar: $("#htlestrelablumar").val(),
			classif_eco: $("#classif_eco").val(),
			desc_mostrp_ing: $("#desc_mostrp_ing").val(),
			flaghtl: flaghtl,
			flaglatino: flaglatino,
			flat: flat,
			resort: resort,
			ecologico: ecologico,
			flagfotopiscina: flagfotopiscina,
			bestdeal: bestdeal,
			ativo_bnuts: ativo_bnuts,
			flaghtlimgmapa: flaghtlimgmapa,
			luxury: luxury,
			novo: novo,
			favoritos: favoritos,
			pg6fq7: pg6fq7,
			pg4fq5: pg4fq5,
			chdgratis: chdgratis,
			blumarrecomenda: blumarrecomenda,
			blumarreveillon: blumarreveillon,
			allinclusive: allinclusive,
			ativo_mostrp: ativo_mostrp,
			covid_19_pt_url: $("#covid_19_pt_url").val(),
			htl_num_quartos: $("#htl_num_quartos").val(),
			slug: $("#slug").val(),
			short_description_pt: $("#short_description_pt").val(),
			short_description_en: $("#short_description_en").val(),
			short_description_es: $("#short_description_es").val(),
			insight_pt: $("#insight_pt").val(),
			insight_en: $("#insight_en").val(),
			insight_es: $("#insight_es").val(),
			price_range: $("#price_range").val(),
			capacity_min: $("#capacity_min").val(),
			capacity_max: $("#capacity_max").val(),
			city_name: $("#city_name").val(),
			state: $("#state").val(),
			country: $("#country").val(),
			rating: $("#rating").val(),
			rating_count: $("#rating_count").val(),
			gallery_images: $("#gallery_images").val(),
			blueprint_image: $("#blueprint_image").val(),
			room_categories: $("#room_categories").val(),
			dining_experiences: $("#dining_experiences").val(),
			meeting_rooms_count: $("#meeting_rooms_count").val(),
			meeting_rooms_detail: $("#meeting_rooms_detail").val(),
			has_convention_center: has_convention_center,
			url_360_halls: $("#url_360_halls").val(),
			latitude: $("#latitude").val(),
			longitude: $("#longitude").val(),
			map_iframe_url: $("#map_iframe_url").val()


		},

		error: function () {
			alert("Error when inserting City content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}




function altera_apto() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/altera_apto.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#miolo-alteracao").html(resposta);

		}


	});

}

function update_apto() {


	var pk_aptcod1 = '';
	$("div#aptcod").each(function () {
		pk_aptcod1 += $(this).find('input[type=hidden]').val() + ",";
	});

	var categ1 = '';
	$("div#box14apto").each(function () {
		categ1 += $(this).find('input[type=text],select').val() + ",";
	});

	var loc1 = '';
	$("div#box15apto").each(function () {
		loc1 += $(this).find('input[type=text],select').val() + ",";
	});

	var qtd1 = '';
	$("div#box16apto").each(function () {
		qtd1 += $(this).find('input[type=text]').val() + ",";
	});

	var foto1 = '';
	$("div#box17apto").each(function () {
		foto1 += $(this).find('input[type=text]').val() + ",";
	});





	$.ajax({
		dataType: "html",
		url: "hotelv2/update_apto.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val(),
			pk_aptcod: pk_aptcod1,
			categ: categ1,
			loc: loc1,
			qtd: qtd1,
			foto: foto1

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#miolo-alteracao").html(resposta);

		}


	});

}















function apaga_apto() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/apaga_apto.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#miolo-alteracao").html(resposta);

		}


	});

}






function back_htl() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/altera_hotel.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}



function add_apto() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/novo_apto.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}



function insere_novo_apto() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/insert_novo_apto.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val(),
			categ1: $("#categ1").val(),
			loc1: $("#loc1").val(),
			qtd1: $("#qtd1").val(),
			foto1: $("#foto1").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}
function apaga_fac_htl() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/apaga_fac_htl.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}

function add_fac_htl() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/add_fac_htl.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}



function insert_add_fac_htl() {



	var facilities1 = '';
	$("div#box17 :checkbox:checked").each(function () {
		facilities1 += $(this).val() + ",";
	});



	$.ajax({
		dataType: "html",
		url: "hotelv2/insert_add_fac_htl.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val(),
			facilities: facilities1

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Erro ao inserir novas facilidades no hotel!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}

function add_fac_apto() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/add_fac_apto.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}

function insert_add_fac_apto() {



	var facilities1 = '';
	$("div#box17 :checkbox:checked").each(function () {
		facilities1 += $(this).val() + ",";
	});



	$.ajax({
		dataType: "html",
		url: "hotelv2/insert_add_fac_apto.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val(),
			facilities: facilities1

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Erro ao inserir novas facilidades no hotel!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}


function apaga_fac_apto() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/apaga_fac_apto.php",
		type: 'POST',
		data: {

			frncod: $("#frncod").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}





function listagem_selo_new() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/relatorio-hoteis-selo-new.php",

		error: function () {
			alert("Error when retrieving hotel content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}




function listagem_selo_unique() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/relatorio-hoteis-selo-unique.php",

		error: function () {
			alert("Error when retrieving hotel content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}


function listagem_selo_luxury() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/relatorio-hoteis-selo-luxury.php",

		error: function () {
			alert("Error when retrieving hotel content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}

function listagem_marc_nacional() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/relatorio-hoteis-nacional.php",

		error: function () {
			alert("Error when retrieving hotel content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}


function listagem_selo_favoritos() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/relatorio-hoteis-selo-favoritos.php",

		error: function () {
			alert("Error when retrieving hotel content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}


function listagem_health_safe() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/relatorio_hoteis_health_safe.php",

		error: function () {
			alert("Error when retrieving hotel content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}


function listagem_shealth_safe() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/relatorio_hoteis_sem_health.php",

		error: function () {
			alert("Error when retrieving hotel content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}


function consulta_hotel() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/template_hotel.php",
		type: 'POST',
		data: {

			mneu_for: $("#consultahotel").val()

		},
		// FUNÇÃO ERRO
		error: function () {
			alert("Error when returning hotel for changes!");
		},

		success: function (resposta) {

			var url = "hotel/template_hotel.php?mneu_for=" + $("#consultahotel").val();
			window.open(url, 'myNewPage', 'width=625, height=540, scrollbars=yes');



		}


	});

}





function insere_estilo_htl() {




	$.ajax({
		dataType: "html",
		url: "hotelv2/insere_estilo.php",
		type: 'POST',
		data: {

			mneu_for: $("#mneu_for").val(),
			estilo: $("#estilo").val()
		},

		error: function () {
			alert("Erro ao retornar formulario para alteração!");
		},

		success: function (resposta) {
			$("#estilos_do_htl").html(resposta);

		}


	});

}

$(document).ready(function () {

	$("body").delegate("a.pkestilohtl", "click", function () {
		apaga_estilohtl($(this).children(".pkestilohtlvalue").val());
	});


	function apaga_estilohtl(pk_estilohtl) {


		$.ajax({
			dataType: "html",
			url: "hotelv2/apagar_estilo.php",
			type: 'POST',
			cache: false,
			data: {

				mneu_for: $("#mneu_for").val(),
				pk_estilo: pk_estilohtl

			},
			// FUNÇÃO ANTES DE ENVIAR
			beforeSend: function () {
				$("#loading").fadeIn("slow");
			},


			// FUNÇÃO ERRO
			error: function () {
				alert("Ocorreu algum erro ao retornar o abt tour!");
			},
			// FUNÇÃO SUCESSO
			success: function (resposta) {
				$("#estilos_do_htl").html(resposta);

			},

			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});

	}
});






function del_covid19pt() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/del_covid19pt.php",
		type: 'POST',
		data: {
			frncod: $("#frncod").val()
		},
		error: function () {
			alert("Error when inserting City content!");
		},

		success: function (resposta) {
			$("#del_covid19pt").html(resposta);

		}


	});

}


function del_covid19en() {

	$.ajax({
		dataType: "html",
		url: "hotelv2/del_covid19en.php",
		type: 'POST',
		data: {
			frncod: $("#frncod").val()
		},
		error: function () {
			alert("Error when inserting City content!");
		},

		success: function (resposta) {
			$("#del_covid19en").html(resposta);

		}


	});

}