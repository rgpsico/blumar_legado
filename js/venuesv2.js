// Adicionar/atualizar estas funções no seu arquivo JS existente

function acao_venuesv2() {
	$.ajax({
		dataType: "html",
		url: "venuesv2/miolo_venues.php",
		error: function () {
			alert("Error when retrieving venues main page content!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}

// Função para visualizar venue
function ver_venue(cod_venues) {
	$.ajax({
		dataType: "html",
		url: "venuesv2/ver_venue.php",
		data: {
			cod_venues: cod_venues
		},
		error: function () {
			alert("Erro ao carregar detalhes do venue!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}


function novo_venuev2() {

	$.ajax({
		dataType: "html",
		url: "venuesv2/form_novo_venue.php",

		error: function () {
			alert("Error when retrieving venues main page content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}


// Função para editar venue (já existe, só adaptando)
function editar_venue(cod_venues) {
	$.ajax({
		url: "venuesv2/form_altera_venue.php?cod_venue=" + cod_venues,
		data: {
			cod_venue: cod_venues
		},
		error: function () {
			alert("Error when retrieving venue form!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
		}
	});
}



function novo_venue() {

	$.ajax({
		dataType: "html",
		url: "venues/form_novo_venue.php",

		error: function () {
			alert("Error when retrieving venues main page content!");
		},

		success: function (resposta) {
			$("#container_miolo").html(resposta);

		}


	});

}


// Função para excluir venue
function excluir_venue(cod_venues, nome) {
	if (confirm('Tem certeza que deseja excluir o venue "' + nome + '"?')) {
		$.ajax({
			dataType: "html",
			url: "venuesv2/excluir_venue.php",
			data: {
				cod_venues: cod_venues
			},
			error: function () {
				alert("Erro ao excluir venue!");
			},
			success: function (resposta) {
				// Recarregar a listagem
				acao_venuesv2();
				alert("Venue excluído com sucesso!");
			}
		});
	}
}