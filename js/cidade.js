 
	function acao_cidade () { 
	
											$.ajax({
											dataType: "html",  
											url: "cidades/miolo_cidade.php",  
											  // FUN��O ERRO
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	 
	function nova_cidade () { 
	
											$.ajax({
											dataType: "html",  
											url: "cidades/nova_cidade.php",  
											  // FUN��O ERRO
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
		
	 
	function insere_nova_cidade () { 
	
		
		
		   if ($("#vai_tour").is(":checked")) {  
				 var vai_tour = "true"; 
			 } else {
				 var vai_tour = "false";
			 }
		
		
		
											$.ajax({
											dataType: "html",  
											url: "cidades/insere_nova_cidade.php",  
											type: 'POST',
											data: {
												 
												nome_pt: $("#cidade_nome").val(),
												nome_en: $("#cidade_nome_en").val(),
												nome_esp: $("#cidade_nome_esp").val(),
												regiao: $("#regiao").val(),
												descritivo_pt: $("#cidade_desc").val(),
												descritivo_en: $("#cidade_desc_en").val(),
												descritivo_esp: $("#cidade_desc_esp").val(),
												foto1: $("#cidadeoto1").val(),
												foto2: $("#cidadeoto2").val(),
												foto3: $("#cidadeoto3").val(),
												foto_capa: $("#fotocapa").val(),
												mapa_google: $("#mapa_google").val(),
												mapa_local: $("#mapa_local").val(),
												destino_pt: $("#destino_pt").val(),
												destino_en: $("#destino_en").val(),
												destino_esp: $("#destino_esp").val(),
												inf_rev_pt: $("#inf_rev_pt").val(),
												inf_rev_en: $("#inf_rev_en").val(),
												inf_rev_esp: $("#inf_rev_esp").val(),
												inf_tras_pt: $("#inf_tras_pt").val(),
												inf_tras_en: $("#inf_tras_en").val(),
												inf_tras_esp: $("#inf_tras_esp").val(),
												aereo_pt: $("#aereo_pt").val(),
												aereo_en: $("#aereo_en").val(),
												aereo_esp: $("#aereo_esp").val(),
												voucher_pt: $("#voucher_pt").val(),
												voucher_en: $("#voucher_en").val(),
												voucher_esp: $("#voucher_esp").val(),
												cond_gerais_pt: $("#cond_gerais_pt").val(),
												cond_gerais_en: $("#cond_gerais_en").val(),
												cond_gerais_esp: $("#cond_gerais_esp").val(),
												cid_foto1: $("#cid_foto1").val(),
												cid_foto2: $("#cid_foto2").val(),
												cid_foto3: $("#cid_foto3").val(),
												cid_foto4: $("#cid_foto4").val(),
												cid_foto5: $("#cid_foto5").val(),
												cid_foto6: $("#cid_foto6").val(),
												title: $("#title").val(),
												description: $("#description").val(),
												keywords: $("#keywords").val(),
												titulo_pg: $("#titulo_pg").val(),
												title_pacote: $("#title_pacote").val(),
												description_pacote: $("#description_pacote").val(),
												keyword_pacote: $("#keyword_pacote").val(),
												titulo_paniga_pacote: $("#titulo_paniga_pacote").val(),
												foto_atracao: $("#foto_atracao").val(),
												chamada_atracao: $("#chamada_atracao").val(),
												conteudo_atracao: $("#conteudo_atracao").val(),
												foto_info_import: $("#foto_info_import").val(),
												chamada_info_import: $("#chamada_info_import").val(),
												conteudo_info_import: $("#conteudo_info_import").val(),
												foto_como_chegar: $("#foto_como_chegar").val(),
												chamada_como_chegar: $("#chamada_como_chegar").val(),
												conteudo_como_chegar: $("#conteudo_como_chegar").val(),
												foto_praias: $("#foto_praias").val(),
												chamada_praias: $("#chamada_praias").val(),
												conteudo_praias: $("#conteudo_praias").val(),
												foto_cid_proximas: $("#foto_cid_proximas").val(),
												chamada_cid_proximas: $("#chamada_cid_proximas").val(),
												conteudo_cid_proximas: $("#conteudo_cid_proximas").val(),
												foto_suit: $("#foto_suit").val(),
												chamada_suit: $("#chamada_suit").val(),
												conteudo_suit: $("#conteudo_suit").val(),
												foto_arte: $("#foto_arte").val(),
												chamada_arte: $("#chamada_arte").val(),
												conteudo_arte: $("#conteudo_arte").val(),
												foto_onde_comer: $("#foto_onde_comer").val(),
												chamada_onde_comer: $("#chamada_onde_comer").val(),
												conteudo_onde_comer: $("#conteudo_onde_comer").val(),
												foto_natureza: $("#foto_natureza").val(),
												chamada_natureza: $("#chamada_natureza").val(),
												conteudo_natureza: $("#conteudo_natureza").val(),
												foto_noite: $("#foto_noite").val(),
												chamada_noite: $("#chamada_noite").val(),
												conteudo_noite: $("#conteudo_noite").val(),
												foto_compras: $("#foto_compras").val(),
												chamada_compras: $("#chamada_compras").val(),
												conteudo_compras: $("#conteudo_compras").val(),
												foto_melhor_epoca: $("#foto_melhor_epoca").val(),
												chamada_melhor_epoca: $("#chamada_melhor_epoca").val(),
												conteudo_melhor_epoca: $("#conteudo_melhor_epoca").val(),
												foto_transporte: $("#foto_transporte").val(),
												chamada_transporte: $("#chamada_transporte").val(),
												conteudo_transporte: $("#conteudo_transporte").val(),
												
												tumbfotobb1: $("#tumbfotobb1").val(),
												tumbfotobb2: $("#tumbfotobb2").val(),
												tumbfotobb3: $("#tumbfotobb3").val(),
												tumbfotobb4: $("#tumbfotobb4").val(),
												tumbfotobb5: $("#tumbfotobb5").val(),
												tumbfotobb6: $("#tumbfotobb6").val(),
												tumbfotobb7: $("#tumbfotobb7").val(),
												tumbfotobb8: $("#tumbfotobb8").val(),
												tumbfotobb9: $("#tumbfotobb9").val(),
												
												legendafotobb1: $("#legendafotobb1").val(),
												legendafotobb2: $("#legendafotobb2").val(),
												legendafotobb3: $("#legendafotobb3").val(),
												legendafotobb4: $("#legendafotobb4").val(),
												legendafotobb5: $("#legendafotobb5").val(),
												legendafotobb6: $("#legendafotobb6").val(),
												legendafotobb7: $("#legendafotobb7").val(),
												legendafotobb8: $("#legendafotobb8").val(),
												legendafotobb9: $("#legendafotobb9").val(),
												
												fotobb1: $("#fotobb1").val(),
												fotobb2: $("#fotobb2").val(),
												fotobb3: $("#fotobb3").val(),
												fotobb4: $("#fotobb4").val(),
												fotobb5: $("#fotobb5").val(),
												fotobb6: $("#fotobb6").val(),
												fotobb7: $("#fotobb7").val(),
												fotobb8: $("#fotobb8").val(),
												fotobb9: $("#fotobb9").val(),
																			
												vai_tour: vai_tour,
												
												
												
												img_cid: $("#img_cid").val(),
												cid: $("#cid").val(),
												title_htl: $("#title_htl").val(),
												description_htl: $("#description_htl").val(),
												keywords_htl: $("#keywords_htl").val(),
												titulo_pg_htl: $("#titulo_pg_htl").val(),
												youtube: $("#youtube").val(),
												foto_webservices: $("#foto_webservices").val(),
												foto_nova_cote: $("#foto_nova_cote").val(),
												average_temp: $("#average_temp").val(),
												rainy_season: $("#rainy_season").val(),
												dry_season: $("#dry_season").val(),
												best_time: $("#best_time").val(),
												about: $("#about").val()
												
											},
											
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	 
	function altera_cidade () { 
	
											$.ajax({
											dataType: "html",  
											url: "cidades/altera_cidade.php",  
											data:
											{
												cidade_cod: $("#citie").val() 
												
											},
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	function update_cidade () { 
		
		
		   if ($("#vai_tour").is(":checked")) {  
				 var vai_tour = "true"; 
			 } else {
				 var vai_tour = "false";
			 }
		
		
			 if ($("#bco_img_riolife").is(":checked")) {  
				var bco_img_riolife = "true"; 
			} else {
				var bco_img_riolife = "false";
			}
	   
		
		
		
		$.ajax({
		dataType: "html",  
		url: "cidades/update_cidade.php",  
		type: 'POST',
		data: {
			 
			nome_pt: $("#cidade_nome").val(),
			nome_en: $("#cidade_nome_en").val(),
			nome_esp: $("#cidade_nome_esp").val(),
			regiao: $("#regiao").val(),
			descritivo_pt: $("#cidade_desc").val(),
			descritivo_en: $("#cidade_desc_en").val(),
			descritivo_esp: $("#cidade_desc_esp").val(),
			foto1: $("#cidadeoto1").val(),
			foto2: $("#cidadeoto2").val(),
			foto3: $("#cidadeoto3").val(),
			foto_capa: $("#fotocapa").val(),
			mapa_google: $("#mapa_google").val(),
			mapa_local: $("#mapa_local").val(),
			destino_pt: $("#destino_pt").val(),
			destino_en: $("#destino_en").val(),
			destino_esp: $("#destino_esp").val(),
			inf_rev_pt: $("#inf_rev_pt").val(),
			inf_rev_en: $("#inf_rev_en").val(),
			inf_rev_esp: $("#inf_rev_esp").val(),
			inf_tras_pt: $("#inf_tras_pt").val(),
			inf_tras_en: $("#inf_tras_en").val(),
			inf_tras_esp: $("#inf_tras_esp").val(),
			aereo_pt: $("#aereo_pt").val(),
			aereo_en: $("#aereo_en").val(),
			aereo_esp: $("#aereo_esp").val(),
			voucher_pt: $("#voucher_pt").val(),
			voucher_en: $("#voucher_en").val(),
			voucher_esp: $("#voucher_esp").val(),
			cond_gerais_pt: $("#cond_gerais_pt").val(),
			cond_gerais_en: $("#cond_gerais_en").val(),
			cond_gerais_esp: $("#cond_gerais_esp").val(),
			cid_foto1: $("#cid_foto1").val(),
			cid_foto2: $("#cid_foto2").val(),
			cid_foto3: $("#cid_foto3").val(),
			cid_foto4: $("#cid_foto4").val(),
			cid_foto5: $("#cid_foto5").val(),
			cid_foto6: $("#cid_foto6").val(),
			title: $("#title").val(),
			description: $("#description").val(),
			keywords: $("#keywords").val(),
			titulo_pg: $("#titulo_pg").val(),
			title_pacote: $("#title_pacote").val(),
			description_pacote: $("#description_pacote").val(),
			keyword_pacote: $("#keyword_pacote").val(),
			titulo_paniga_pacote: $("#titulo_paniga_pacote").val(),
			foto_atracao: $("#foto_atracao").val(),
			chamada_atracao: $("#chamada_atracao").val(),
			conteudo_atracao: $("#conteudo_atracao").val(),
			foto_info_import: $("#foto_info_import").val(),
			chamada_info_import: $("#chamada_info_import").val(),
			conteudo_info_import: $("#conteudo_info_import").val(),
			foto_como_chegar: $("#foto_como_chegar").val(),
			chamada_como_chegar: $("#chamada_como_chegar").val(),
			conteudo_como_chegar: $("#conteudo_como_chegar").val(),
			foto_praias: $("#foto_praias").val(),
			chamada_praias: $("#chamada_praias").val(),
			conteudo_praias: $("#conteudo_praias").val(),
			foto_cid_proximas: $("#foto_cid_proximas").val(),
			chamada_cid_proximas: $("#chamada_cid_proximas").val(),
			conteudo_cid_proximas: $("#conteudo_cid_proximas").val(),
			foto_suit: $("#foto_suit").val(),
			chamada_suit: $("#chamada_suit").val(),
			conteudo_suit: $("#conteudo_suit").val(),
			foto_arte: $("#foto_arte").val(),
			chamada_arte: $("#chamada_arte").val(),
			conteudo_arte: $("#conteudo_arte").val(),
			foto_onde_comer: $("#foto_onde_comer").val(),
			chamada_onde_comer: $("#chamada_onde_comer").val(),
			conteudo_onde_comer: $("#conteudo_onde_comer").val(),
			foto_natureza: $("#foto_natureza").val(),
			chamada_natureza: $("#chamada_natureza").val(),
			conteudo_natureza: $("#conteudo_natureza").val(),
			foto_noite: $("#foto_noite").val(),
			chamada_noite: $("#chamada_noite").val(),
			conteudo_noite: $("#conteudo_noite").val(),
			foto_compras: $("#foto_compras").val(),
			chamada_compras: $("#chamada_compras").val(),
			conteudo_compras: $("#conteudo_compras").val(),
			foto_melhor_epoca: $("#foto_melhor_epoca").val(),
			chamada_melhor_epoca: $("#chamada_melhor_epoca").val(),
			conteudo_melhor_epoca: $("#conteudo_melhor_epoca").val(),
			foto_transporte: $("#foto_transporte").val(),
			chamada_transporte: $("#chamada_transporte").val(),
			conteudo_transporte: $("#conteudo_transporte").val(),
			fotobb1: $("#fotobb1").val(),
			tumbfotobb1: $("#tumbfotobb1").val(),
			legendafotobb1: $("#legendafotobb1").val(),
			fotobb2: $("#fotobb2").val(),
			tumbfotobb2: $("#tumbfotobb2").val(),
			legendafotobb2: $("#legendafotobb2").val(),
			fotobb3: $("#fotobb3").val(),
			tumbfotobb3: $("#tumbfotobb3").val(),
			legendafotobb3: $("#legendafotobb3").val(),
			fotobb4: $("#fotobb4").val(),
			tumbfotobb4: $("#tumbfotobb4").val(),
			legendafotobb4: $("#legendafotobb4").val(),
			fotobb5: $("#fotobb5").val(),
			tumbfotobb5: $("#tumbfotobb5").val(),
			legendafotobb5: $("#legendafotobb5").val(),
			fotobb6: $("#fotobb6").val(),
			tumbfotobb6: $("#tumbfotobb6").val(),
			legendafotobb6: $("#legendafotobb6").val(),
			fotobb7: $("#fotobb7").val(),
			tumbfotobb7: $("#tumbfotobb7").val(),
			legendafotobb7: $("#legendafotobb7").val(),
			fotobb8: $("#fotobb8").val(),
			tumbfotobb8: $("#tumbfotobb8").val(),
			legendafotobb8: $("#legendafotobb8").val(),
			fotobb9: $("#fotobb9").val(),
			tumbfotobb9: $("#tumbfotobb9").val(),
			legendafotobb9: $("#legendafotobb9").val(),
			vai_tour: vai_tour,
			img_cid: $("#img_cid").val(),
			cid: $("#cid").val(),
			title_htl: $("#title_htl").val(),
			description_htl: $("#description_htl").val(),
			keywords_htl: $("#keywords_htl").val(),
			titulo_pg_htl: $("#titulo_pg_htl").val(),
			youtube: $("#youtube").val(),
			foto_webservices: $("#foto_webservices").val(),
			foto_nova_cote: $("#foto_nova_cote").val(),
			average_temp: $("#average_temp").val(),
			rainy_season: $("#rainy_season").val(),
			dry_season: $("#dry_season").val(),
			best_time: $("#best_time").val(),
			about: $("#about").val(),
			cidade_cod: $("#cidade_cod").val(),
			bco_img_riolife: bco_img_riolife
					
			
		},
		
		error: function() {
			alert("Error when inserting City content!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}

	
	
	 
	function lista_cidade_video () { 
	
											$.ajax({
											dataType: "html",  
											url: "cidades/lista_cidade_video.php",  
											  // FUN��O ERRO
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	function consulta_cidade () { 
		
						$.ajax({
								dataType: "html",  
								url: "cidades/consulta_cidade.php",  
								data:
								{
									cidade_cod: $("#cities").val() 
									
								},
								error: function() {
									alert("Error when retrieving City content!");
								},
								 
								success: function(resposta) {
									$("#container").html(resposta);
									 
								} 
						
						
					});

}
	
	
	
	 
	function del_covidcid9pt () { 
	
											$.ajax({
											dataType: "html",  
											url: "cidades/del_covid19pt.php",  
											type: 'POST',
											data: {
												 cidade_cod: $("#cidade_cod").val() 
											},
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#del_covid19pt").html(resposta);
												 
											} 
											
											
										});
	
	}
		
	
	 
	function del_covidcid9en () { 
	
											$.ajax({
											dataType: "html",  
											url: "cidades/del_covid19en.php",  
											type: 'POST',
											data: {
												 cidade_cod: $("#cidade_cod").val() 
											},
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#del_covid19en").html(resposta);
												 
											} 
											
											
										});
	
	}
		
	
		