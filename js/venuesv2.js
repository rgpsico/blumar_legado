// Função helper para scroll suave ao topo
function scrollToTop() {
	// Tenta scrollar o container principal ou a janela
	if ($('#container_miolo').length) {
		$('#container_miolo')[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
	}
	// Scroll da janela também
	$('html, body').animate({ scrollTop: 0 }, 300);
}

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
			scrollToTop(); // Scroll para o topo após carregar
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
			scrollToTop(); // Scroll para o topo após carregar
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
			scrollToTop(); // Scroll para o topo após carregar
		}
	});
}

// Função para editar venue (já existe, só adaptando)
function editar_venue(cod_venues) {
	$.ajax({
		dataType: "html",
		url: "venuesv2/form_altera_venue.php",
		data: {
			cod_venue: cod_venues
		},
		error: function () {
			alert("Error when retrieving venue form!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
			scrollToTop(); // Scroll para o topo após carregar
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
			scrollToTop(); // Scroll para o topo após carregar
		}
	});
}

// Função para excluir venue
function excluir_venue(cod_venues, nome) {
	if (confirm('Tem certeza que deseja excluir o venue "' + nome + '"?')) {
		$.ajax({
			dataType: "html",
			method: "POST",
			url: "venuesv2/excluir_venue.php",
			data: {
				cod_venues: cod_venues
			},
			error: function () {
				alert("Erro ao excluir venue!");
			},
			success: function (resposta) {
				if (resposta.trim() === 'success' || resposta.indexOf('success') !== -1) {
					alert("Venue excluído com sucesso!");
					// Recarregar a listagem
					acao_venuesv2();
				} else {
					alert("Erro ao excluir venue: " + resposta);
				}
			}
		});
	}
}

// Função para carregar páginas com filtros (usada na paginação)
function carregar_pagina_venues(page) {
	var search = $('#search_venue').val();
	var city = $('#filter_city').val();
	var active = $('#filter_active').val();

	var params = '?page=' + page;
	if (search) params += '&search=' + encodeURIComponent(search);
	if (city) params += '&city=' + encodeURIComponent(city);
	if (active !== '') params += '&active=' + active;

	$.ajax({
		dataType: "html",
		url: "venuesv2/miolo_venues.php" + params,
		error: function () {
			alert("Erro ao carregar a página!");
		},
		success: function (resposta) {
			$("#container_miolo").html(resposta);
			scrollToTop(); // Scroll para o topo após carregar
		}
	});
}

// Função para filtrar venues
function filtrar_venues() {
	carregar_pagina_venues(1);
}