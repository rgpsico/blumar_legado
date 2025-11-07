 
	function acao_tours () { 
	
											$.ajax({
											dataType: "html",  
											url: "tours/miolo_tours.php",  
											  // FUN��O ERRO
											error: function() {
												alert("Error when retrieving tours content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}

	 
	 
	function pega_tours_s_depto () { 
	
		 var tous_sdepto = 'semdepto';
											$.ajax({
											dataType: "html",  
											url: "tours/miolo_tours.php",  
											data: {
												 
												tous_sdepto: tous_sdepto 
												
											},
											error: function() {
												alert("Error when retrieving tours content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}

	
	
	function lista_tours_latino () { 
	
		 var idtp = '1';
		
											$.ajax({
											dataType: "html",  
											url: "tours/lista_tours_latino.php",  
											data: {
												 
												 id: idtp 
												
											},
											error: function() {
												alert("Error when retrieving latin tours content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}

	
	function lista_tours_ingles () { 
		
		 var idtp = '2';
		
											$.ajax({
											dataType: "html",  
											url: "tours/lista_tours_latino.php",  
											data: {
												 
												 id: idtp 
												
											},
											error: function() {
												alert("Error when retrieving english tours content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}

	
	
	
	
	
	
	
	
	
	function lista_tours () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/monta_lista_tours_latino.php",  
		data: {
			 
			codcid: $("#codcid").val(), 
			 id: $("#id").val() 
			
		},
		  // FUN��O ERRO
		error: function() {
			alert("Error when retrieving tours content!");
		},
		 
		success: function(resposta) {
			$("#container_tours_latino").html(resposta);
			 
		} 
		
		
	});

}
	
	 
	function lista_tours_completo () { 
	
											$.ajax({
											dataType: "html",  
											url: "tours/miolo_tours_completo.php",  
											  // FUN��O ERRO
											error: function() {
												alert("Error when retrieving tours content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	function cad_srv_tar () { 
		
								$.ajax({
								dataType: "html",  
								url: "tours/admin_tours.php",  
								  // FUN��O ERRO
								error: function() {
									alert("Error when retrieving tours content!");
								},
								 
								success: function(resposta) {
									$("#container").html(resposta);
									 
								} 
								
		
	});

}
	
     function busca_desc_srv () { 
							
							$.ajax({
							dataType: "html",  
							url: "tours/busca_desc_srv.php",  
							data: {
								 
								citie: $("#citie").val(), 
								lang: $("#lang").val() 
								
							},
							error: function() {
								alert("Error when retrieving tours content!");
							},
							 
							success: function(resposta) {
								$("#miolo_desc_srv").html(resposta);
								 
							} 
							
					
					});
					
					}
	

	function single_tour () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/form_single_tour.php",  
		data: {
			 
			serv: $("#serv").val() 
			
		},
		error: function() {
			alert("Error when retrieving tours content!");
		},
		 
		success: function(resposta) {
			$("#miolo_single_tour").html(resposta);
			 
		} 
		

});

}
	
	
	
		
 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function insere_sgl_tour () { 
		
		
		   if ($("#ativo").is(":checked")) {  
				 var ativo = "t"; 
			 } else {
				 var ativo = "f";
			 }
     
		
		   if ($("#ativo_imp").is(":checked")) {  
				 var ativo_imp = "t"; 
			 } else {
				 var ativo_imp = "f";
			 }
   

		   if ($("#ativo_trf").is(":checked")) {  
				 var ativo_trf = "t"; 
			 } else {
				 var ativo_trf = "f";
			 }
		   
		
		
		
		$.ajax({
		dataType: "html",  
		url: "tours/insere_single_tour.php",  
		data: {
			 
			serv: $("#cod_serv").val(),
			nome_serv: $("#nome_serv").val(),
			descricao_pt: $("#descricao_pt").val(),
			obs_pt: $("#obs_pt").val(),
			nome: $("#nome").val(),
			descricao_en: $("#descricao_en").val(),
			obs_en: $("#obs_en").val(),
			nombre: $("#nombre").val(),
			descricao_esp: $("#descricao_esp").val(),
			obs_esp: $("#obs_esp").val(),
			foto1: $("#foto1").val(),
			fornecedor: $("#fornecedor").val(),
			ativo: ativo,
			ativo_imp: ativo_imp,
			ativo_trf: ativo_trf
			
			
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#miolo_desc_srv").html(resposta);
			 
		} 
		

});

}	
		
	
	function lista_tours_selo_new () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/lista_tours_selo_new.php",  
		data: {
			 
			serv: $("#serv").val() 
			
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		

});

}	
	
		
	
	function insere_novo_tour () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/form_novo_tour.php",  
		data: {
			 
			citietour: $("#citietour").val() 
			
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		

});

}
	
	
	
	function input_novo_tour () { 
		
		
		   if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }
  
		   if ($("#ativo_brasil").is(":checked")) {  
				 var ativo_brasil = "true"; 
			 } else {
				 var ativo_brasil = "false";
			 }
		   
		   if ($("#ativo_latino").is(":checked")) {  
				 var ativo_latino = "true"; 
			 } else {
				 var ativo_latino = "false";
			 }
		   
		   if ($("#ativo_tar").is(":checked")) {  
				 var ativo_tar = "true"; 
			 } else {
				 var ativo_tar = "false";
			 }
		     
		
		   if ($("#ativo_imp").is(":checked")) {  
				 var ativo_imp = "true"; 
			 } else {
				 var ativo_imp = "false";
			 }


		   if ($("#ativo_trf").is(":checked")) {  
				 var ativo_trf = "true"; 
			 } else {
				 var ativo_trf = "false";
			 }
		   
		
		   if ($("#ativo_tourinc").is(":checked")) {  
				 var ativo_tourinc = "true"; 
			 } else {
				 var ativo_tourinc = "false";
			 }
		   
		   if ($("#ativo_tourtec").is(":checked")) {  
				 var ativo_tourtec = "true"; 
			 } else {
				 var ativo_tourtec = "false";
			 }
		   
		   if ($("#ativo_ecologico_latino").is(":checked")) {  
				 var ativo_ecologico_latino = "true"; 
			 } else {
				 var ativo_ecologico_latino = "false";
			 }
		   
		   if ($("#novo_tour").is(":checked")) {  
				 var novo_tour = "true"; 
			 } else {
				 var novo_tour = "false";
			 }
		
		   
		   
		   if ($("#ativo_riolife_quotes").is(":checked")) {  
				 var ativo_riolife_quotes = "true"; 
			 } else {
				 var ativo_riolife_quotes = "false";
			 }
		 
		   
		   if ($("#ativo_eventos").is(":checked")) {  
				 var ativo_eventos = "true"; 
			 } else {
				 var ativo_eventos = "false";
			 } 
		   
		   if ($("#ativo_japones").is(":checked")) {  
				 var ativo_japones = "true"; 
			 } else {
				 var ativo_japones = "false";
			 } 
		   
		   
		   if ($("#ativo_enquiry").is(":checked")) {  
				 var ativo_enquiry = "true"; 
			 } else {
				 var ativo_enquiry = "false";
			 } 
		   
		   
		   if ($("#ativo_riolife").is(":checked")) {  
				 var ativo_riolife = "true"; 
			 } else {
				 var ativo_riolife = "false";
			 } 
		   
		    
		   if ($("#ativo_cotes").is(":checked")) {  
				 var ativo_cotes = "true"; 
			 } else {
				 var ativo_cotes = "false";
			 }
		
		   
		    
		   if ($("#ativo_ij").is(":checked")) {  
				 var ativo_ij = "true"; 
			 } else {
				 var ativo_ij = "false";
			 }
		



    
		   if ($("#ativo_sight").is(":checked")) {  
				 var ativo_sight = "true"; 
			 } else {
				 var ativo_sight = "false";
			 }



            if ($("#ativo_cultural").is(":checked")) {  
				 var ativo_cultural = "true"; 
			 } else {
				 var ativo_cultural = "false";
			 }



            if ($("#ativo_active").is(":checked")) {  
				 var ativo_active = "true"; 
			 } else {
				 var ativo_active = "false";
			 }



    if ($("#ativo_nature").is(":checked")) {  
				 var ativo_nature = "true"; 
			 } else {
				 var ativo_nature = "false";
			 }

    if ($("#ativo_food").is(":checked")) {  
				 var ativo_food = "true"; 
			 } else {
				 var ativo_food = "false";
			 }

    if ($("#ativo_night").is(":checked")) {  
				 var ativo_night = "true"; 
			 } else {
				 var ativo_night = "false";
			 }
  

     if ($("#soul_tours").is(":checked")) {  
				 var soul_tours = "true"; 
			 } else {
				 var soul_tours = "false";
			 }



     if ($("#soul_tours_riolife").is(":checked")) {  
				 var soul_tours_riolife = "true"; 
			 } else {
				 var soul_tours_riolife = "false";
			 }



        if ($("#disable_pax").is(":checked")) {  
				 var disable_pax = "true"; 
			 } else {
				 var disable_pax = "false";
			 }
    
        if ($("#seatbelts").is(":checked")) {  
				 var seatbelts = "true"; 
			 } else {
				 var seatbelts = "false";
			 }





      if ($("#sunday").is(":checked")) {  
				 var sunday = "true"; 
			 } else {
				 var sunday = "false";
			 }

      if ($("#monday").is(":checked")) {  
				 var monday = "true"; 
			 } else {
				 var monday = "false";
			 }

      if ($("#tuesday").is(":checked")) {  
				 var tuesday = "true"; 
			 } else {
				 var tuesday = "false";
			 }

      if ($("#wednesday").is(":checked")) {  
				 var wednesday = "true"; 
			 } else {
				 var wednesday = "false";
			 }

      if ($("#thursday").is(":checked")) {  
				 var thursday = "true"; 
			 } else {
				 var thursday = "false";
			 }

      if ($("#friday").is(":checked")) {  
				 var friday = "true"; 
			 } else {
				 var friday = "false";
			 }

      if ($("#saturday").is(":checked")) {  
				 var saturday = "true"; 
			 } else {
				 var saturday = "false";
			 }


		   
		$.ajax({
		dataType: "html",  
		url: "tours/insere_novo_tour.php",
		type: 'POST',
		data: {
			 
			serv: $("#cod_serv").val(),
			nome_pt: $("#nome_pt").val(),
			descricao_pt: $("#descricao_pt").val(),
			nome_en: $("#nome_en").val(),
			descricao_en: $("#descricao_en").val(),
			nome_esp: $("#nome_esp").val(),
			descricao_esp: $("#descricao_esp").val(),
			descesp_fit: $("#descesp_fit").val(),
			foto1: $("#foto1").val(),
			tour_video: $("#tour_video").val(),
			obs_en: $("#obs_en").val(),
			obs_pt: $("#obs_pt").val(),
			obs_esp: $("#obs_esp").val(),
			ativo: ativo,
			ativo_brasil: ativo_brasil,
			ativo_latino: ativo_latino,
			ativo_tar: ativo_tar,
			ativo_imp: ativo_imp,
			ativo_trf: ativo_trf,
			ativo_tourinc: ativo_tourinc,
			ativo_tourtec: ativo_tourtec,
			ativo_ecologico_latino: ativo_ecologico_latino,
			novo_tour: novo_tour,
			ativo_riolife_quotes: ativo_riolife_quotes,
			ativo_eventos:ativo_eventos,
			ativo_japones:ativo_japones,
			ativo_enquiry:ativo_enquiry,
			ativo_riolife:ativo_riolife,
			ativo_cotes:ativo_cotes,
			ativo_ij:ativo_ij,
			ativo_sight: ativo_sight,
			ativo_cultural: ativo_cultural,
			ativo_active: ativo_active,
			ativo_nature: ativo_nature,
			ativo_food: ativo_food,
			ativo_night: ativo_night,
			soul_tours: soul_tours,
            soul_tours_riolife: soul_tours_riolife,
			fk_cidade_tpo: $("#fk_cidade_tpo").val(),
			foto2: $("#foto2").val(),
			duracao: $("#duracao").val(),
			fk_tpocidcod: $("#fk_tpocidcod").val(), 
			nome_quotes: $("#nome_quotes").val(),
            disable_pax: disable_pax,
            seatbelts: seatbelts,
            map: $("#map").val(),
            depart_time: $("#depart_time").val(),
            min_pax: $("#min_pax").val(),
			max_pax: $("#max_pax").val(),
            instruct_guides: $("#instruct_guides").val(),
            instruct_driver: $("#instruct_driver").val(),
			highlights: $("#highlights").val(),
			inclusions: $("#inclusions").val(),
			exclusions: $("#exclusions").val(),
			vehicle_type: $("#vehicle_type").val(),
			vehicle_type_other: $("#vehicle_type_other").val(),
			chd_policy: $("#chd_policy").val(),
			difficulty: $("#difficulty").val(),
			cancel_policy: $("#cancel_policy").val(),
			message_voucher: $("#message_voucher").val(),
			message_voucher: $("#message_voucher").val(),
			sunday: sunday,
			monday: monday,
			thursday: thursday,
			tuesday: tuesday,
			wednesday: wednesday,
			friday: friday,
			saturday: saturday,
            baggage: $("#baggage").val(),
            supplier: $("#supplier").val()

		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		

});

}		
	
	
	
	function altera_tour () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/altera_tour.php",  
		data: {
			 
			citietour: $("#alteratour").val() 
			
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#formalteratour").html(resposta);
			 
		} 
		

});

}	
	

	
	
	
	function altera_cod_tour () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/form_altera_tour.php",  
		data: {
			 
			pktour: $("#tours").val() 
			
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		

});

}			
	
	
		
	function altera_cod_soul_tour () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/form_altera_tour.php",  
		data: {
			 
			pktour: $("#soul_tours").val() 
			
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		

});

}			
	
	
	
	function ver_tour () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/lista_cid_tour.php",  
		data: {
			 
			citietour: $("#vertour").val() 
			
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#formalteratour2").html(resposta);
			 
		} 
		

});

}	
	
	
	
	function template_tour () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/template_tour.php",  
		data: {
			 
			pktour: $("#templatetours").val() 
			
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#box-template").html(resposta);
			 
		} 
		

});

}		
	
	
	
	
	
	
	
	function insert_date_tour () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/insert_date_tour.php",  
		type: 'POST',
        data: {
			 
			pk_descritivo_tours: $("#pk_descritivo_tours").val(),
            obs: $("#obs_dt").val(),
			dt_in: $("#data_news").val(),
			dt_out: $("#data_news2").val() 
			
		},
		error: function() {
			alert("Error when inserting a date!");
		},
		 
		success: function(resposta) {
			$("#dates_notop").html(resposta);
			 
		} 
		

});

}		
	
	
	
	
	
	
	
	
	
	
	
	
	
	function update_tour () { 
		
		
		   if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }

		      if ($("#ativo_tar").is(":checked")) {  
				 var ativo_tar = "true"; 
			 } else {
				 var ativo_tar = "false";
			 }
		   
		   if ($("#ativo_brasil").is(":checked")) {  
				 var ativo_brasil = "true"; 
			 } else {
				 var ativo_brasil = "false";
			 }
		   
		   if ($("#ativo_latino").is(":checked")) {  
				 var ativo_latino = "true"; 
			 } else {
				 var ativo_latino = "false";
			 }
		   
		   
		   if ($("#ativo_imp").is(":checked")) {  
				 var ativo_imp = "true"; 
			 } else {
				 var ativo_imp = "false";
			 }


		   if ($("#ativo_trf").is(":checked")) {  
				 var ativo_trf = "true"; 
			 } else {
				 var ativo_trf = "false";
			 }
		   
		
		   if ($("#ativo_tourinc").is(":checked")) {  
				 var ativo_tourinc = "true"; 
			 } else {
				 var ativo_tourinc = "false";
			 }
		   
		   if ($("#ativo_tourtec").is(":checked")) {  
				 var ativo_tourtec = "true"; 
			 } else {
				 var ativo_tourtec = "false";
			 }
		   
		   if ($("#ativo_ecologico_latino").is(":checked")) {  
				 var ativo_ecologico_latino = "true"; 
			 } else {
				 var ativo_ecologico_latino = "false";
			 }
		   
		   if ($("#ativo_cotes").is(":checked")) {  
				 var ativo_cotes = "true"; 
			 } else {
				 var ativo_cotes = "false";
			 }
		
		   
		   if ($("#ativo_riolife").is(":checked")) {  
				 var ativo_riolife = "true"; 
			 } else {
				 var ativo_riolife = "false";
			 }
		
		   
		   
		   if ($("#novo_tour").is(":checked")) {  
				 var novo_tour = "true"; 
			 } else {
				 var novo_tour = "false";
			 }
		
		   
		   
    
		   if ($("#ativo_sight").is(":checked")) {  
				 var ativo_sight = "true"; 
			 } else {
				 var ativo_sight = "false";
			 }



            if ($("#ativo_cultural").is(":checked")) {  
				 var ativo_cultural = "true"; 
			 } else {
				 var ativo_cultural = "false";
			 }



            if ($("#ativo_active").is(":checked")) {  
				 var ativo_active = "true"; 
			 } else {
				 var ativo_active = "false";
			 }



    if ($("#ativo_nature").is(":checked")) {  
				 var ativo_nature = "true"; 
			 } else {
				 var ativo_nature = "false";
			 }

    if ($("#ativo_food").is(":checked")) {  
				 var ativo_food = "true"; 
			 } else {
				 var ativo_food = "false";
			 }

    if ($("#ativo_night").is(":checked")) {  
				 var ativo_night = "true"; 
			 } else {
				 var ativo_night = "false";
			 }


		
     if ($("#soul_tours").is(":checked")) {  
				 var soul_tours = "true"; 
			 } else {
				 var soul_tours = "false";
			 }
   
		   
		   
		   
		   
		   
		   
		   
		   
		   if ($("#ativo_riolife_quotes").is(":checked")) {  
				 var ativo_riolife_quotes = "true"; 
			 } else {
				 var ativo_riolife_quotes = "false";
			 }
		   
		   
		   
		   
		   if ($("#ativo_eventos").is(":checked")) {  
				 var ativo_eventos = "true"; 
			 } else {
				 var ativo_eventos = "false";
			 }
		  
		   
		   
		   if ($("#ativo_japones").is(":checked")) {  
				 var ativo_japones = "true"; 
			 } else {
				 var ativo_japones = "false";
			 }
		   
		  
		   if ($("#ativo_enquiry").is(":checked")) {  
				 var ativo_enquiry = "true"; 
			 } else {
				 var ativo_enquiry = "false";
			 }
		   
		   
		   
		   if ($("#ativo_ij").is(":checked")) {  
				 var ativo_ij = "true"; 
			 } else {
				 var ativo_ij = "false";
			 }
		   
		   
		   
		   if ($("#to_del").is(":checked")) {  
				 var to_del = "true"; 
			 } else {
				 var to_del = "false";
			 }
		   
		   
		   
		   		   
		   
		   if ($("#soul_tours_riolife").is(":checked")) {  
				 var soul_tours_riolife = "true"; 
			 } else {
				 var soul_tours_riolife = "false";
			 }
		   
		   
		   
		   
		   
        if ($("#disable_pax").is(":checked")) {  
				 var disable_pax = "true"; 
			 } else {
				 var disable_pax = "false";
			 }
    
        if ($("#seatbelts").is(":checked")) {  
				 var seatbelts = "true"; 
			 } else {
				 var seatbelts = "false";
			 }


		   


      if ($("#sunday").is(":checked")) {  
				 var sunday = "true"; 
			 } else {
				 var sunday = "false";
			 }

      if ($("#monday").is(":checked")) {  
				 var monday = "true"; 
			 } else {
				 var monday = "false";
			 }

      if ($("#tuesday").is(":checked")) {  
				 var tuesday = "true"; 
			 } else {
				 var tuesday = "false";
			 }

      if ($("#wednesday").is(":checked")) {  
				 var wednesday = "true"; 
			 } else {
				 var wednesday = "false";
			 }

      if ($("#thursday").is(":checked")) {  
				 var thursday = "true"; 
			 } else {
				 var thursday = "false";
			 }

      if ($("#friday").is(":checked")) {  
				 var friday = "true"; 
			 } else {
				 var friday = "false";
			 }

      if ($("#saturday").is(":checked")) {  
				 var saturday = "true"; 
			 } else {
				 var saturday = "false";
			 }

		   
		   
		$.ajax({
		dataType: "html",  
		url: "tours/update_tour.php",
		type: 'POST',
		data: {
			 
			cod_serv: $("#cod_serv").val(),
			cod_compl: $("#cod_compl").val(),
			cod_trailfinders: $("#cod_trailfinders").val(),
			nome_pt: $("#nome_pt").val(),
			descricao_pt: $("#descricao_pt").val(),
			nome_en: $("#nome_en").val(),
			descricao_en: $("#descricao_en").val(),
			nome_esp: $("#nome_esp").val(),
			descricao_esp: $("#descricao_esp").val(),
			descesp_fit: $("#descesp_fit").val(),
			descesp_nac: $("#descesp_nac").val(),
			foto1: $("#foto1").val(),
			tour_video: $("#tour_video").val(),
			obs_en: $("#obs_en").val(),
			obs_pt: $("#obs_pt").val(),
			obs_esp: $("#obs_esp").val(),
			ativo: ativo,
			ativo_tar: ativo_tar,
			ativo_brasil: ativo_brasil,
			ativo_latino: ativo_latino,
			ativo_imp: ativo_imp,
			ativo_trf: ativo_trf,
			ativo_tourinc: ativo_tourinc,
			ativo_tourtec: ativo_tourtec,
			ativo_ecologico_latino: ativo_ecologico_latino,
			ativo_cotes: ativo_cotes,
			ativo_riolife: ativo_riolife,
			novo_tour: novo_tour,
			ativo_riolife_quotes: ativo_riolife_quotes,
			ativo_eventos: ativo_eventos,
			ativo_japones: ativo_japones,
			ativo_enquiry: ativo_enquiry,
			ativo_ij: ativo_ij,
			to_del:to_del,
			ativo_sight: ativo_sight,
			ativo_cultural: ativo_cultural,
			ativo_active: ativo_active,
			ativo_nature: ativo_nature,
			ativo_food: ativo_food,
			ativo_night: ativo_night,
            soul_tours: soul_tours,
            soul_tours_riolife: soul_tours_riolife,
			cod_classif: $("#cod_classif").val(),
			pk_descritivo_tours: $("#pk_descritivo_tours").val(), 
			duracao: $("#duracao").val(), 
			nome_quotes: $("#nome_quotes").val(),
            disable_pax: disable_pax,
            seatbelts: seatbelts,
            map: $("#map").val(),
            depart_time: $("#depart_time").val(),
            min_pax: $("#min_pax").val(),
			max_pax: $("#max_pax").val(),
            instruct_guides: $("#instruct_guides").val(),
            instruct_driver: $("#instruct_driver").val(),
			highlights: $("#highlights").val(),
			inclusions: $("#inclusions").val(),
			exclusions: $("#exclusions").val(),
			vehicle_type: $("#vehicle_type").val(),
			vehicle_type_other: $("#vehicle_type_other").val(),
			chd_policy: $("#chd_policy").val(),
			difficulty: $("#difficulty").val(),
			cancel_policy: $("#cancel_policy").val(),
			message_voucher: $("#message_voucher").val(),
			 tour_instruct: $("#tour_instruct").val(),
			sunday: sunday,
			monday: monday,
			thursday: thursday,
			tuesday: tuesday,
			wednesday: wednesday,
			friday: friday,
			saturday: saturday,
            baggage: $("#baggage").val(),
            supplier: $("#supplier").val() 
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		

});

}		
		 
	
	 
	
	
	function update_tour_outros_deptos () { 
		
		if ($("#ativo_latino").is(":checked")) {  
				 var ativo_latino = "true"; 
			 } else {
				 var ativo_latino = "false";
			 }
		   
		if ($("#ativo_tourinc").is(":checked")) {  
				 var ativo_tourinc = "true"; 
			 } else {
				 var ativo_tourinc = "false";
			 }
		   
		 if ($("#ativo_cotes").is(":checked")) {  
				 var ativo_cotes = "true"; 
			 } else {
				 var ativo_cotes = "false";
			 }
		
		  if ($("#ativo_riolife_quotes").is(":checked")) {  
				 var ativo_riolife_quotes = "true"; 
			 } else {
				 var ativo_riolife_quotes = "false";
			 }
		   
		   if ($("#ativo_eventos").is(":checked")) {  
				 var ativo_eventos = "true"; 
			 } else {
				 var ativo_eventos = "false";
			 }
		  
		  if ($("#ativo_japones").is(":checked")) {  
				 var ativo_japones = "true"; 
			 } else {
				 var ativo_japones = "false";
			 }
		   
		  if ($("#ativo_enquiry").is(":checked")) {  
				 var ativo_enquiry = "true"; 
			 } else {
				 var ativo_enquiry = "false";
			 }
		   
		  if ($("#ativo_ij").is(":checked")) {  
				 var ativo_ij = "true"; 
			 } else {
				 var ativo_ij = "false";
			 }
		   
	$.ajax({
		dataType: "html",  
		url: "tours/update_tour_sdepto.php",
		type: 'POST',
		data: {
			nome_en: $("#nome_en").val(),
			ativo_cotes: ativo_cotes,
			ativo_tourinc: ativo_tourinc,
			ativo_enquiry: ativo_enquiry,
			ativo_japones: ativo_japones,
			ativo_eventos: ativo_eventos,
			ativo_riolife_quotes: ativo_riolife_quotes,
			ativo_ij: ativo_ij,
			ativo_latino: ativo_latino,
			pk_descritivo_tours: $("#pk_descritivo_tours").val() 
						
		},
		error: function() {
			alert("Error when retrieving hotel content!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		

});

}		
		

	
	
$(document).ready(function() { 
	   
	$("body").delegate("a.edit_dt", "click",  function(){   
         retrive_edit_dt($(this).children(".edit_dt_value").val());
     });    
					   
					   
                         function retrive_edit_dt (pk_edit_dt) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "tours/edit_data.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_tour_calendar:  pk_edit_dt,
			                                pk_descritivo_tours: $("#pk_descritivo_tours").val() 
											
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#dates_notop").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	

	
	function update_date_tour () { 
		
		$.ajax({
		dataType: "html",  
		url: "tours/update_date_tour.php",  
		type: 'POST',
        data: {
			pk_tour_calendar: $("#pk_tour_calendar").val(), 
			pk_descritivo_tours: $("#pk_descritivo_tours").val(),
            obs: $("#obs_dt").val(),
			dt_in: $("#data_news").val(),
			dt_out: $("#data_news2").val() 
			
		},
		error: function() {
			alert("Error when updating a date!");
		},
		 
		success: function(resposta) {
			$("#dates_notop").html(resposta);
			 
		} 
		

});

}		
	
	
	
		
	
$(document).ready(function() { 
	   
	$("body").delegate("a.del_dt", "click",  function(){   
         retrive_del_dt($(this).children(".del_dt_value").val());
     });    
					   
					   
                         function retrive_del_dt (pk_del_dt) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "tours/delete_data.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_tour_calendar:  pk_del_dt,
			                                pk_descritivo_tours: $("#pk_descritivo_tours").val() 
											
										},
										  beforeSend: function() {
											 var answer = confirm ("Tem certeza que deseja apagar esta data?")
											 if (answer) {}
												  
											 else
												return false;
												 
											  },
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#dates_notop").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	
	
	