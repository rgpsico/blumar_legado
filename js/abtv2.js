// Refatorado para usar views de abtv2/ e API em api/abt.php
// Assumindo endpoints da API:
// - GET/POST api/abt.php?requisicao=index -> listagem
// - GET api/abt.php?requisicao=show&id={id} -> dados para show
// - GET api/abt.php?requisicao=edit&id={id} -> dados para edit/create form
// - POST api/abt.php?requisicao=store -> criar novo
// - POST api/abt.php?requisicao=update&id={id} -> atualizar
// - POST api/abt.php?requisicao=destroy&id={id} -> deletar
// Para sub-entidades (tour, estilos, destinos): usar parâmetros como tipo='tour' ou entidade='tour'
// Ajuste conforme sua API exata.

function acao_abt() {
	$.ajax({
		dataType: "html",
		url: "abtv2/listar.php",  // View principal carregada de abtv2/
		error: function () {
			alert("Error when shown main ABT menu!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}

function novo_abt() {
	$.ajax({
		dataType: "html",
		url: "abtv2/create.php",  // View de create carregada de abtv2/
		error: function () {
			alert("Error when retrieving ABT form!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}

function input_novo_abt() {
	// Coleta dados do form (checkBoxes e fields)
	var formData = {
		nome: $("#nome").val(),
		date: $("#date").val(),
		foto_topo: $("#foto_topo").val(),
		titulo: $("#titulo").val(),
		campo_livre: $("#campo_livre").val(),
		foto_campo: $("#foto_campo").val(),
		foto_topo_bpass: $("#foto_topo_bpass").val(),
		foto1: $("#foto1").val(),
		foto2: $("#foto2").val(),
		foto3: $("#foto3").val(),
		foto4: $("#foto4").val(),
		ativo: $("#ativo").is(":checked") ? "true" : "false",
		ativo_home: $("#ativo_home").is(":checked") ? "true" : "false",
		topo_brasil_pass: $("#topo_brasil_pass").is(":checked") ? "true" : "false",
		ativo_riolife: $("#ativo_riolife").is(":checked") ? "true" : "false",
		lang: $("#lang").val(),
		preco_abt: $("#preco_abt").val(),
		cidade_cod: $("#cidade_cod").val(),
		link_quotes: $("#link_quotes").val(),
		link_quotes_be: $("#link_quotes_be").val(),
		tempo_abt: $("#tempo_abt").val(),
		classic: $("#classic").is(":checked") ? "true" : "false",
		romantic: $("#romantic").is(":checked") ? "true" : "false",
		family: $("#family").is(":checked") ? "true" : "false",
		beach: $("#beach").is(":checked") ? "true" : "false",
		boat: $("#boat").is(":checked") ? "true" : "false",
		special_interest: $("#special_interest").is(":checked") ? "true" : "false",
		adventure: $("#adventure").is(":checked") ? "true" : "false",
		cultural: $("#cultural").is(":checked") ? "true" : "false",
		active: $("#active").is(":checked") ? "true" : "false",
		nature: $("#nature").is(":checked") ? "true" : "false",
		food_drinks: $("#food_drinks").is(":checked") ? "true" : "false",
		night_out: $("#night_out").is(":checked") ? "true" : "false",
		new_mod: $("#newmod").is(":checked") ? "true" : "false"
	};

	// Cidades filtro como array
	var cid_filtro_arr = $("select[id='cid_filtro']").map(function () { return $(this).val(); }).get();
	formData.cod_cid_filtro_arr = cid_filtro_arr;

	$.ajax({
		dataType: "html",
		url: "api/abt.php",
		type: 'POST',
		data: {
			requisicao: 'store',  // Endpoint para store/create
			...formData  // Spread dos dados
		},
		error: function () {
			alert("Error when inserting ABT!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);  // Resposta pode ser redirect ou mensagem de sucesso + reload list
			acao_abt();  // Recarrega listagem após sucesso
		}
	});
}

function input_tour_abt() {
	var tourData = {
		pk_abt: $("#pk_abt").val(),
		dia_conteudo: $("#dia_conteudo").val(),
		titulo_conteudo: $("#titulo_conteudo").val(),
		descritivo_conteudo: $("#descritivo_conteudo").val(),
		foto1_conteudo: $("#foto1_conteudo").val(),
		lay: $("input[name='lay']:checked").val()  // Radio button
	};

	$.ajax({
		dataType: "html",
		url: "api/abt.php",
		type: 'POST',
		data: {
			requisicao: 'store_tour',  // Assumindo endpoint específico para tour
			...tourData
		},
		error: function () {
			alert("Error when inserting Tour ABT!");
		},
		success: function (resposta) {
			$("#tour_abt").html(resposta);  // Atualiza seção de tour
		}
	});
}

function add_filtro_cid() {
	var cid_filtro_arr = $("select[id='cid_filtro']").map(function () { return $(this).val(); }).get();

	$.ajax({
		dataType: "html",
		url: "api/abt.php",
		type: 'POST',
		data: {
			requisicao: 'add_destino',  // Endpoint para adicionar destino/cidade
			cod_cid_filtro_arr: cid_filtro_arr,
			pk_abt: $("#pk_abt").val()  // Assumindo contexto de ABT atual
		},
		error: function () {
			alert("Error when adding city filter!");
		},
		success: function (resposta) {
			$("#cid_filtro_miolo").html(resposta);
		}
	});
}

function alt_filtro_cid() {
	var cid_pk_abt_destinos = $("input[id='pk_abt_destinos']").map(function () { return $(this).val(); }).get();

	$.ajax({
		dataType: "html",
		url: "api/abt.php",
		type: 'POST',
		data: {
			requisicao: 'update_destinos',  // Endpoint para alterar destinos
			pk_abt_destinos_arr: cid_pk_abt_destinos
		},
		error: function () {
			alert("Error when updating city filter!");
		},
		success: function (resposta) {
			$("#cid_filtro_miolo").html(resposta);
		}
	});
}

$(document).ready(function () {
	$("body").delegate("a.pkremcid", "click", function () {
		remove_cid($(this).children(".pkremcidvalue").val());
	});

	function remove_cid(pkcid) {
		$.ajax({
			dataType: "html",
			url: "api/abt.php",
			type: 'POST',
			cache: false,
			data: {
				requisicao: 'remove_destino',  // Endpoint para remover destino
				pk_abt: $("#pk_abt").val(),
				pk_abt_destinos: pkcid
			},
			beforeSend: function () {
				$("#loading").fadeIn("slow");
			},
			error: function () {
				alert("Ocorreu algum erro ao apagar a cidade!");
			},
			success: function (resposta) {
				$("#cid_filtro_miolo").html(resposta);
			},
			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});
	}
});

$(document).ready(function () {
	$("body").delegate("a.pkabtconteudo", "click", function () {
		retrive_tour($(this).children(".pkabtconteudoValue").val());
	});

	function retrive_tour(pktour) {
		$.ajax({
			dataType: "html",
			url: "api/abt.php",
			cache: false,
			data: {
				requisicao: 'show_tour',  // Endpoint para show tour
				pk_abt: $("#pk_abt").val(),
				pkabttour: pktour
			},
			beforeSend: function () {
				$("#loading").fadeIn("slow");
			},
			error: function () {
				alert("Ocorreu algum erro ao retornar o ABT tour!");
			},
			success: function (resposta) {
				$("#container_miolo").html(resposta);
			},
			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});
	}
});

function update_tour_abt() {
	var tourData = {
		pk_abt: $("#pk_abt").val(),
		dia_conteudo: $("#dia_conteudo").val(),
		titulo_conteudo: $("#titulo_conteudo").val(),
		descritivo_conteudo: $("#descritivo_conteudo").val(),
		foto1_conteudo: $("#foto1_conteudo").val(),
		lay: $("input[name='lay']:checked").val(),
		pk_abt_conteudo: $("#pk_abt_conteudo").val()
	};

	$.ajax({
		dataType: "html",
		url: "api/abt.php",
		type: 'POST',
		data: {
			requisicao: 'update_tour',  // Endpoint para update tour
			...tourData
		},
		error: function () {
			alert("Error when updating Tour ABT!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}

function altera_abt() {
	var pk = $("#pk_abt").val();
	if (pk == 0) return alert("Selecione um ABT!");

	$.ajax({
		dataType: "html",
		url: "abtv2/edit.php",  // View de edit carregada de abtv2/
		type: 'POST',
		data: {
			id: pk  // Para carregar dados no form
		},
		error: function () {
			alert("Erro ao retornar formulario para alteração!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}

function altera_abt2() {
	// Similar a altera_abt, mas para lang=2 (ajuste se necessário)
	var pk = $("#pk_abt2").val();
	if (pk == 0) return alert("Selecione um ABT!");

	$.ajax({
		dataType: "html",
		url: "abtv2/edit.php",
		type: 'POST',
		data: {
			id: pk
		},
		error: function () {
			alert("Erro ao retornar formulario para alteração!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}

function update_cad_bt() {
	// Alias para altera_abt
	altera_abt();
}

function update_abt() {
	// Similar a input_novo_abt, mas com requisicao='update'
	var formData = {
		pk_abt: $("#pk_abt").val(),
		nome: $("#nome").val(),
		date: $("#date").val(),
		// ... (todos os outros fields como em input_novo_abt)
		ativo: $("#ativo").is(":checked") ? "true" : "false",
		// ... (checkBoxes)
	};

	var cid_filtro_arr = $("select[id='cid_filtro']").map(function () { return $(this).val(); }).get();
	formData.cod_cid_filtro_arr = cid_filtro_arr;

	$.ajax({
		dataType: "html",
		url: "api/abt.php",
		type: 'POST',
		data: {
			requisicao: 'update',  // Endpoint para update
			id: formData.pk_abt,
			...formData
		},
		error: function () {
			alert("Error when updating ABT!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
			acao_abt();  // Recarrega listagem
		}
	});
}

function novo_tour_abt() {
	var pk_abt = $("#pk_abt").val();
	if (!pk_abt) return alert("Selecione um ABT primeiro!");

	$.ajax({
		dataType: "html",
		url: "abtv2/create_tour.php",  // Assumindo view específica para tour em abtv2/
		type: 'POST',
		data: {
			pk_abt: pk_abt
		},
		error: function () {
			alert("Error when retrieving ABT Tour form!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}

function lista_abt() {
	$.ajax({
		dataType: "html",
		url: "abtv2/index.php",  // View de listagem em abtv2/ (show all)
		type: 'POST',
		data: {
			requisicao: 'index'  // Opcional, se API retornar HTML
		},
		error: function () {
			alert("Error when retrieving ABT list!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}

$(document).ready(function () {
	$("body").delegate("a.pkabt", "click", function () {
		retrive_abt($(this).children(".pkabtvalue").val());
	});

	function retrive_abt(pkabt) {
		$.ajax({
			dataType: "html",
			url: "abtv2/show.php",  // View de show em abtv2/
			cache: false,
			data: {
				id: pkabt
			},
			beforeSend: function () {
				$("#loading").fadeIn("slow");
			},
			error: function () {
				alert("Ocorreu algum erro ao retornar o ABT!");
			},
			success: function (resposta) {
				$("#container_miolo").html(resposta);
			},
			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});
	}
});

function insere_estilo() {
	$.ajax({
		dataType: "html",
		url: "api/abt.php",
		type: 'POST',
		data: {
			requisicao: 'store_estilo',  // Endpoint para inserir estilo
			pk_abt: $("#pk_abt").val(),
			estilo: $("#estilo").val()
		},
		error: function () {
			alert("Erro ao inserir estilo!");
		},
		success: function (resposta) {
			$("#estilos_do_abt").html(resposta);
		}
	});
}

$(document).ready(function () {
	$("body").delegate("a.pkestilo", "click", function () {
		apaga_estilo($(this).children(".pkestilovalue").val());
	});

	function apaga_estilo(pk_estilo) {
		$.ajax({
			dataType: "html",
			url: "api/abt.php",
			type: 'POST',
			cache: false,
			data: {
				requisicao: 'destroy_estilo',  // Endpoint para deletar estilo
				pk_abt: $("#pk_abt").val(),
				pk_estilo: pk_estilo
			},
			beforeSend: function () {
				$("#loading").fadeIn("slow");
			},
			error: function () {
				alert("Ocorreu algum erro ao apagar o estilo!");
			},
			success: function (resposta) {
				$("#estilos_do_abt").html(resposta);
			},
			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});
	}
});

$(document).ready(function () {
	$("body").delegate("a.delpkabt", "click", function () {
		del_tour($(this).children(".delpkabtValue").val());
	});

	function del_tour(pktourdel) {
		var answer = confirm("ATENÇÃO, tem certeza que deseja apagar este dia!?");
		if (!answer) return;

		$.ajax({
			dataType: "html",
			url: "api/abt.php",
			type: 'POST',
			cache: false,
			data: {
				requisicao: 'destroy_tour',  // Endpoint para deletar tour dia
				pk_abt: $("#pk_abt").val(),
				pkabttour: pktourdel
			},
			beforeSend: function () {
				$("#loading").fadeIn("slow");
			},
			error: function () {
				alert("Ocorreu algum erro ao apagar o tour!");
			},
			success: function (resposta) {
				$("#container_miolo").html(resposta);
			},
			complete: function () {
				$("#loading").fadeOut("slow");
			}
		});
	}
});