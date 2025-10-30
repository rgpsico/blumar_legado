







function nova_imagem() {

	$.ajax({
		dataType: "html",
		url: "form_new_img.php",
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () {
			alert("Erro ao mostrar o formulario de cadastro de imagem!");
		},
		success: function (resposta) {
			$("#diplay_banco2").html(resposta);
		},
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}





function nova_imagem_auto() {

	$.ajax({
		dataType: "html",
		url: "form_new_img_auto.php",
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () {
			alert("Erro ao mostrar o formulario de cadastro de imagem!");
		},
		success: function (resposta) {
			$("#diplay_banco2").html(resposta);
		},
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}





function pega_tp_produto() {

	$.ajax({
		dataType: "html",
		url: "pega_tp_produto.php",
		type: 'POST',
		data: { tp_produto: $("#tp_produto").val() },
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao listar produtos!"); },
		success: function (resposta) { $("#miolo_produto").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}



function pega_tour() {

	$.ajax({
		dataType: "html",
		url: "pega_tour.php",
		type: 'POST',
		data: { fk_tpocidcod: $("#pegatour").val() },
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao listar tours!"); },
		success: function (resposta) { $("#formalteratour").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}




function insert_new_image() {


	if ($("#ativo_cli").is(":checked")) {
		var ativo_cli = "true";
	} else {
		var ativo_cli = "false";
	}

	if ($("#fachada").is(":checked")) {
		var fachada = "true";
	} else {
		var fachada = "false";
	}

	$.ajax({
		dataType: "html",
		url: "insert_new_image.php",
		type: 'POST',
		data: {
			tp_produto: $("#tp_produto").val(),
			mneu_for: $("#mneu_for").val(),
			nome_produto: $("#nome_produto").val(),
			ativo_cli: ativo_cli,
			fachada: fachada,
			cidade_cod: $("#cidade_cod").val(),
			tam_1: $("#tam_1").val(),
			tam_2: $("#tam_2").val(),
			tam_3: $("#tam_3").val(),
			tam_4: $("#tam_4").val(),
			tam_5: $("#tam_5").val(),
			zip: $("#zip").val(),
			legenda: $("#legenda").val(),
			legenda_pt: $("#legenda_pt").val(),
			legenda_esp: $("#legenda_esp").val(),
			autor: $("#autor").val(),
			palavras_chave: $("#palavras_chave").val(),
			autorizacao: $("#autorizacao").val()


		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao inserir imagens!"); },
		success: function (resposta) {
			$("#diplay_banco2").html(resposta);

			$.ajax({
				dataType: "html",
				url: "miolo_navegacao.php",
				success: function (resposta) {
					$("#miolo_nav").html(resposta);
				}
			});


		},
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}



function insert_auto_image() {

	if ($("#ativo_cli").is(":checked")) {
		var ativo_cli = "true";
	} else {
		var ativo_cli = "false";
	}

	if ($("#med").is(":checked")) {
		var med = "true";
	} else {
		var med = "false";
	}


	if ($("#grd").is(":checked")) {
		var grd = "true";
	} else {
		var grd = "false";
	}


	if ($("#orig").is(":checked")) {
		var orig = "true";
	} else {
		var orig = "false";
	}

	if ($("#zip").is(":checked")) {
		var zip = "true";
	} else {
		var zip = "false";
	}




	$.ajax({
		dataType: "html",
		url: "insert_auto_image.php",
		type: 'POST',
		data: {
			tp_produto: $("#tp_produto").val(),
			mneu_for: $("#mneu_for").val(),
			nome_produto: $("#nome_produto").val(),
			cidade_cod: $("#cidade_cod").val(),
			ativo_cli: ativo_cli,
			path_img: $("#path_img").val(),
			med: med,
			grd: grd,
			orig: orig,
			zip: zip,
			autor: $("#autor").val(),
			autorizacao: $("#autorizacao").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao inserir imagens!"); },
		success: function (resposta) {
			$("#miolo_autoimage").html(resposta);
		},
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}














function pega_cid_htl() {

	$.ajax({
		dataType: "html",
		url: "pega_cid_htl.php",
		type: 'POST',
		data: { mneu_for: $("#mneu_for").val() },
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao pegar a cidade do hotel!"); },
		success: function (resposta) { $("#cidcod").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}






function pega_cid_rest() {

	$.ajax({
		dataType: "html",
		url: "pega_cid_rest.php",
		type: 'POST',
		data: { mneu_for: $("#mneu_for").val() },
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao pegar a cidade restaurante!"); },
		success: function (resposta) { $("#cidcod").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}




function pega_cid_venue() {

	$.ajax({
		dataType: "html",
		url: "pega_cid_venue.php",
		type: 'POST',
		data: {
			mneu_for: $("#mneu_for").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao pegar a cidade restaurante!"); },
		success: function (resposta) { $("#cidcod").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}





// hotel
function pega_cid_tp1() {

	$.ajax({
		dataType: "html",
		url: "pega_cid_tp1.php",
		type: 'POST',
		data: {
			navega_cidade_cod: $("#navega_cidade_cod1").val(),
			tp: 1

		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a lista de hoteis da cidade!"); },
		success: function (resposta) { $("#miolo_prod1").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}


//tours
function pega_cid_tp2() {

	$.ajax({
		dataType: "html",
		url: "pega_galeria_tour.php",
		type: 'POST',
		data: {
			navega_cidade_cod: $("#navega_cidade_cod2").val(),
			tp: 2

		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a lista de Tours da cidade!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}


//venues
function pega_cid_tp3() {

	$.ajax({
		dataType: "html",
		url: "pega_cid_tp1.php",
		type: 'POST',
		data: {
			navega_cidade_cod: $("#navega_cidade_cod3").val(),
			tp: 3

		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a lista de Venues!"); },
		success: function (resposta) { $("#miolo_prod3").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}



//cidades
function pega_cid_tp10() {

	$.ajax({
		dataType: "html",
		url: "pega_cid_tp10.php",
		type: 'POST',
		data: {
			navega_cidade_cod: $("#navega_cidade_cod10").val(),
			tp: 10

		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a lista de imagens da cidade!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}










function pega_galeria_inspection() {

	$.ajax({
		dataType: "html",
		url: "pega_galeria_inspection.php",
		type: 'POST',
		data: {
			mneu_for: $("#navega_cidade_cod11").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a s imagens do hotel!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}







function pega_htl() {

	$.ajax({
		dataType: "html",
		url: "pega_htl.php",
		type: 'POST',
		data: {
			tpmneu_for: $("#tpmneu_for1").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a s imagens do hotel!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}







function pega_galeria_tour() {

	$.ajax({
		dataType: "html",
		url: "pega_galeria_tour.php",
		type: 'POST',
		data: {
			navega_cidade_cod: $("#fk_cidcod").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar as imagens do Tour!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}


function pega_galeria_venues() {

	$.ajax({
		dataType: "html",
		url: "pega_galeria_venues.php",
		type: 'POST',
		data: {
			tpmneu_for: $("#tpmneu_for3").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar as imagens de Venue!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}




function pega_cidade() {

	$.ajax({
		dataType: "html",
		url: "pega_cid_tp10.php",
		type: 'POST',
		data: {
			navega_cidade_cod: $("#fk_cidcod").val(),
			tp: 10
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar as imagens da cidade!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}




$(document).ready(function () {

	$("body").delegate("a.imgpath", "click", function () {
		pk_bco($(this).children(".imgpathvalue").val());
	});
	function pk_bco(pk_bco_img) {

		$.ajax({
			dataType: "html",
			url: "edit_imagem.php",
			type: 'POST',
			cache: false,
			data: {
				pk_bco_img: pk_bco_img
			},
			beforeSend: function () { $("#loading").fadeIn("slow"); },
			error: function () {
				alert("Ocorreu algum erro ao retornar imagem para edição!");
			},
			success: function (resposta) {
				$("#diplay_banco2").html(resposta);
			},
			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});

	}
});






$(document).ready(function () {

	$("body").delegate("a.imgpathbusca_htl", "click", function () {
		pk_bco_htl($(this).children(".imgpathvaluebusca_htl").val());
	});
	function pk_bco_htl(tpmneu_for_img_htl) {

		$.ajax({
			dataType: "html",
			url: "pega_htl_busca.php",
			type: 'POST',
			cache: false,
			data: {
				tpmneu_for: tpmneu_for_img_htl
			},
			beforeSend: function () { $("#loading").fadeIn("slow"); },
			error: function () {
				alert("Ocorreu algum erro ao retornar imagem para edição!");
			},
			success: function (resposta) {
				$("#diplay_banco2").html(resposta);
			},
			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});

	}
});



$(document).ready(function () {

	$("body").delegate("a.imgpathbusca", "click", function () {
		pk_bcobusca($(this).children(".imgpathvaluebusca").val());
	});
	function pk_bcobusca(pk_bco_imgbusca) {

		$.ajax({
			dataType: "html",
			url: "edit_imagembusca.php",
			type: 'POST',
			cache: false,
			data: {
				pk_bco_img: pk_bco_imgbusca
			},
			beforeSend: function () { $("#loading").fadeIn("slow"); },
			error: function () {
				alert("Ocorreu algum erro ao retornar imagem para edição!");
			},
			success: function (resposta) {
				$("#diplay_banco2").html(resposta);
			},
			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});

	}
});






$(document).ready(function () {

	$("body").delegate("a.imgpathbusca_cid", "click", function () {
		pk_bcobusca_cid($(this).children(".imgpathvaluebusca_cid").val());
	});
	function pk_bcobusca_cid(pk_bco_imgbusca_cid) {

		$.ajax({
			dataType: "html",
			url: "pega_cid_tp10_busca.php",
			type: 'POST',
			cache: false,
			data: {
				navega_cidade_cod: pk_bco_imgbusca_cid
			},
			beforeSend: function () { $("#loading").fadeIn("slow"); },
			error: function () {
				alert("Ocorreu algum erro ao retornar imagem para edição!");
			},
			success: function (resposta) {
				$("#diplay_banco2").html(resposta);
			},
			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});

	}
});









function back_searchcid_result() {

	$.ajax({
		dataType: "html",
		url: "pega_cid_tp10_busca.php",
		type: 'POST',
		data: {
			navega_cidade_cod: $("#fk_cidcod").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a s imagens do hotel!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}









function back_searchhtl_result() {

	$.ajax({
		dataType: "html",
		url: "pega_htl_busca.php",
		type: 'POST',
		data: {
			tpmneu_for: $("#tpmneu_for1").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a s imagens do hotel!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}



function back_search_result() {

	$.ajax({
		dataType: "html",
		url: "search_images.php",
		type: 'POST',
		data: {
			tpmneu_for: $("#tpmneu_for1").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Error when returning to search results!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}












function update_image() {


	if ($("#ativo_cli").is(":checked")) {
		var ativo_cli = "true";
	} else {
		var ativo_cli = "false";
	}

	if ($("#fachada").is(":checked")) {
		var fachada = "true";
	} else {
		var fachada = "false";
	}


	if ($("#nacional").is(":checked")) {
		var nacional = "true";
	} else {
		var nacional = "false";
	}

	$.ajax({
		dataType: "html",
		url: "update_image.php",
		type: 'POST',
		data: {
			tp_produto: $("#tp_produto").val(),
			mneu_for: $("#mneu_for").val(),
			nome_produto: $("#nome_produto").val(),
			ativo_cli: ativo_cli,
			fachada: fachada,
			nacional: nacional,
			cidade_cod: $("#cidade_cod").val(),
			tam_1: $("#tam_1").val(),
			tam_2: $("#tam_2").val(),
			tam_3: $("#tam_3").val(),
			tam_4: $("#tam_4").val(),
			tam_5: $("#tam_5").val(),
			zip: $("#zip").val(),
			legenda: $("#legenda").val(),
			legenda_pt: $("#legenda_pt").val(),
			legenda_esp: $("#legenda_esp").val(),
			autor: $("#autor").val(),
			palavras_chave: $("#palavras_chave").val(),
			autorizacao: $("#autorizacao").val(),
			pk_bco_img: $("#pk_bco_img").val(),
			ordem: $("#ordem").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao inserir imagens!"); },
		success: function (resposta) {
			$("#diplay_banco2").html(resposta);
			/*
			$.ajax({
					dataType: "html",  
					url: "miolo_navegacao.php",
					success: function(resposta) {
						$("#miolo_nav").html(resposta);
						  } 
					 });
		
			 */
		},
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}



$(document).ready(function () {

	$("body").delegate("a.imgpatht2", "click", function () {
		imgt2($(this).children(".imgpatht2value").val());
	});


	function imgt2(pk_bco_imgt2) {


		$.ajax({
			dataType: "html",
			url: "imgt2.php",
			type: 'POST',
			cache: false,
			data: {
				pk_bco_img: pk_bco_imgt2
			},


			error: function () {
				alert("Ocorreu algum erro ao retornar o tamanho 2!");
			},

			success: function (resposta) {
				$("#mapa-eco").html(resposta);
				$("#mapa-eco").modal(
					{
						overlayClose: true,
						containerCss: {
							height: 420,
							width: 440
						}

					});
			},

			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});

	}
});








$(document).ready(function () {

	$("body").delegate("a.imgpatht3", "click", function () {
		imgt3($(this).children(".imgpatht3value").val());
	});


	function imgt3(pk_bco_imgt3) {


		$.ajax({
			dataType: "html",
			url: "imgt3.php",
			type: 'POST',
			cache: false,
			data: {
				pk_bco_img: pk_bco_imgt3
			},


			error: function () {
				alert("Ocorreu algum erro ao retornar o tamanho 3!");
			},

			success: function (resposta) {
				$("#mapa-eco").html(resposta);
				$("#mapa-eco").modal(
					{
						overlayClose: true,
						containerCss: {
							height: 533,
							width: 460
						}

					});
			},

			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});

	}
});






$(document).ready(function () {

	$("body").delegate("a.imgpatht4", "click", function () {
		imgt4($(this).children(".imgpatht4value").val());
	});


	function imgt4(pk_bco_imgt4) {


		$.ajax({
			dataType: "html",
			url: "imgt4.php",
			type: 'POST',
			cache: false,
			data: {
				pk_bco_img: pk_bco_imgt4
			},


			error: function () {
				alert("Ocorreu algum erro ao retornar o tamanho 3!");
			},

			success: function (resposta) {
				$("#mapa-eco").html(resposta);
				$("#mapa-eco").modal(
					{
						overlayClose: true,
						containerCss: {
							height: 700,
							width: 870
						}

					});
			},

			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});

	}
});





$(document).ready(function () {

	$("body").delegate("a.imgpatht5", "click", function () {
		imgt5($(this).children(".imgpatht5value").val());
	});


	function imgt5(pk_bco_imgt5) {


		$.ajax({
			dataType: "html",
			url: "imgt5.php",
			type: 'POST',
			cache: false,
			data: {
				pk_bco_img: pk_bco_imgt5
			},


			error: function () {
				alert("Ocorreu algum erro ao retornar o tamanho 3!");
			},

			success: function (resposta) {
				$("#mapa-eco").html(resposta);
				$("#mapa-eco").modal(
					{
						overlayClose: true,
						containerCss: {
							height: 700,
							width: 1000
						}

					});
			},

			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});

	}
});





function apaga_htl() {

	$.ajax({
		dataType: "html",
		url: "delete_htl_pic.php",
		type: 'POST',
		data: {
			pk_bco_img: $("#pk_bco_img").val(),
			mneu_for: $("#tpmneu_for1").val(),
			tp_produto: $("#tp_produto").val(),
			fk_cidcod: $("#fk_cidcod").val()
		},
		beforeSend: function () {
			var answer = confirm("Tem certeza que deseja apagar esta imagem?")
			if (answer) { }

			else
				return false;

		},
		error: function () { alert("Erro ao apagar a imagem!!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}






//tours
function busca_imagem() {

	$.ajax({
		dataType: "html",
		url: "search_images.php",
		type: 'POST',
		data: {
			busca: $("#busca").val()

		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Error on search argument!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}



//tours
function joga_busca_imagem() {

	$.ajax({
		dataType: "html",
		url: "search_images.php",
		type: 'POST',
		data: {
			busca: $("#joga_busca").val()

		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Error on search argument!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}




//cidades
function joga_cidade_cod10() {

	$.ajax({
		dataType: "html",
		url: "pega_cid_tp10.php",
		type: 'POST',
		data: {
			navega_cidade_cod: $("#joga_cidade_cod10").val(),
			tp: 10

		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a lista de imagens da cidade!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}




function joga_tpmneu_for1() {

	$.ajax({
		dataType: "html",
		url: "pega_htl.php",
		type: 'POST',
		data: {
			tpmneu_for: $("#joga_tpmneu_for1").val()
		},
		beforeSend: function () { $("#loading").fadeIn("slow"); },
		error: function () { alert("Erro ao retornar a s imagens do hotel!"); },
		success: function (resposta) { $("#diplay_banco2").html(resposta); },
		complete: function () { $("#loading").fadeOut("slow"); }
	});
}













