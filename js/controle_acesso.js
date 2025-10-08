 

function acao_controle_acesso () { 

	$.ajax({
	dataType: "html",  
	url: "controle_acesso/miolo_controle_acesso.php",  
	
	error: function() {
		alert("Error ao mostrar a página principal de Contatos!");
	},
	 
	success: function(resposta) {
		$("#container_miolo").html(resposta);
		 
	} 
	
	
});

}



function  altera_permissao_func( ) { 
	
    $.ajax({
    	dataType: "html", 
    	url: "controle_acesso/update_permissao_func.php", 
        type: 'POST',
    	data: {
    		pk_acesso: $("#pk_acesso").val() 
    	},
       error: function() {
    		alert("Erro ao retornar o usuario!");
    	},
        success: function(resposta) {
    		$("#container_miolo").html(resposta);
    	 } 
     });
 }





function  input_update_permissao( ) { 
	

	if ($("#cad_abt").is(":checked")) {  
		 var cad_abt = "true"; 
	} else {
		 var cad_abt = "false";
	} 

   if ($("#cad_beach_house").is(":checked")) {  
		 var cad_beach_house = "true"; 
	} else {
		 var cad_beach_house = "false";
	} 
	
   if ($("#cad_expert").is(":checked")) {  
		 var cad_expert = "true"; 
	} else {
		 var cad_expert = "false";
	} 	
	
   if ($("#cad_cidade").is(":checked")) {  
		 var cad_cidade = "true"; 
	} else {
		 var cad_cidade = "false";
	} 	
	
	
   if ($("#cad_cliente").is(":checked")) {  
		 var cad_cliente = "true"; 
	} else {
		 var cad_cliente = "false";
	} 	
	
	
   if ($("#cad_contatos").is(":checked")) {  
		 var cad_contatos = "true"; 
	} else {
		 var cad_contatos = "false";
	} 	
	
   if ($("#cad_deluxe").is(":checked")) {  
		 var cad_deluxe = "true"; 
	} else {
		 var cad_deluxe = "false";
	} 	
	
   if ($("#cad_destaque_fit").is(":checked")) {  
		 var cad_destaque_fit = "true"; 
	} else {
		 var cad_destaque_fit = "false";
	} 	
	
	
   if ($("#cad_guias").is(":checked")) {  
		 var cad_guias = "true"; 
	} else {
		 var cad_guias = "false";
	} 	
   
	
   if ($("#cad_hotel").is(":checked")) {  
		 var cad_hotel = "true"; 
	} else {
		 var cad_hotel = "false";
	} 	
   
	
   if ($("#cad_inspections").is(":checked")) {  
		 var cad_inspections = "true"; 
	} else {
		 var cad_inspections = "false";
	} 	
   
	
   if ($("#cad_eco").is(":checked")) {  
		 var cad_eco = "true"; 
	} else {
		 var cad_eco = "false";
	} 	
   
	
   if ($("#log_conteudo").is(":checked")) {  
		 var log_conteudo = "true"; 
	} else {
		 var log_conteudo = "false";
	} 	
   
	
   if ($("#log_tarifario").is(":checked")) {  
		 var log_tarifario = "true"; 
	} else {
		 var log_tarifario = "false";
	} 	
   
	
   if ($("#cad_minisite").is(":checked")) {  
		 var cad_minisite = "true"; 
	} else {
		 var cad_minisite = "false";
	} 	
   
	
   if ($("#cad_news").is(":checked")) {  
		 var cad_news = "true"; 
	} else {
		 var cad_news = "false";
	} 	
   
	
   if ($("#cad_os_handling").is(":checked")) {  
		 var cad_os_handling = "true"; 
	} else {
		 var cad_os_handling = "false";
	} 	
   
	
   if ($("#cad_os_financeiro").is(":checked")) {  
		 var cad_os_financeiro = "true"; 
	} else {
		 var cad_os_financeiro = "false";
	} 	
   
	
   if ($("#cad_os_usuario").is(":checked")) {  
		 var cad_os_usuario = "true"; 
	} else {
		 var cad_os_usuario = "false";
	} 	
   
   
	
   if ($("#cad_prod_update").is(":checked")) {  
		 var cad_prod_update = "true"; 
	} else {
		 var cad_prod_update = "false";
	} 	
   
	
   if ($("#cad_quotes").is(":checked")) {  
		 var cad_quotes = "true"; 
	} else {
		 var cad_quotes = "false";
	} 	
   
	
   if ($("#cad_func").is(":checked")) {  
		 var cad_func = "true"; 
	} else {
		 var cad_func = "false";
	} 	
   
	
   if ($("#cad_renovation").is(":checked")) {  
		 var cad_renovation = "true"; 
	} else {
		 var cad_renovation = "false";
	} 	
   
	
   if ($("#cad_restaurante").is(":checked")) {  
		 var cad_restaurante = "true"; 
	} else {
		 var cad_restaurante = "false";
	} 	
   
	
   if ($("#cad_tours").is(":checked")) {  
		 var cad_tours = "true"; 
	} else {
		 var cad_tours = "false";
	} 	
   
	
   if ($("#cad_various").is(":checked")) {  
		 var cad_various = "true"; 
	} else {
		 var cad_various = "false";
	} 	
   
   
	
   if ($("#cad_venues").is(":checked")) {  
		 var cad_venues = "true"; 
	} else {
		 var cad_venues = "false";
	} 	
   
	
   if ($("#consulta").is(":checked")) {  
		 var consulta = "true"; 
	} else {
		 var consulta = "false";
	} 
   
   
   if ($("#cad_trip_request").is(":checked")) {  
		 var cad_trip_request = "true"; 
	} else {
		 var cad_trip_request = "false";
	} 
   
   if ($("#cad_trip_request_dir").is(":checked")) {  
		 var cad_trip_request_dir = "true"; 
	} else {
		 var cad_trip_request_dir = "false";
	} 
   

   if ($("#cad_tariff_tools").is(":checked")) {  
		 var cad_tariff_tools = "true"; 
	} else {
		 var cad_tariff_tools = "false";
	} 
   

   if ($("#cad_trailfinders").is(":checked")) {  
		 var cad_trailfinders = "true"; 
	} else {
		 var cad_trailfinders = "false";
	} 
   
      if ($("#cad_webservices").is(":checked")) {  
		 var cad_webservices = "true"; 
	} else {
		 var cad_webservices = "false";
	} 
   
   
    if ($("#cad_file_web").is(":checked")) {  
		 var cad_file_web = "true"; 
	} else {
		 var cad_file_web = "false";
	}
   

   
    if ($("#acesso_tariff_cliente").is(":checked")) {  
		 var acesso_tariff_cliente = "true"; 
	} else {
		 var acesso_tariff_cliente = "false";
	}

   
    if ($("#video_bank").is(":checked")) {  
		 var video_bank = "true"; 
	} else {
		 var video_bank = "false";
	}

	if ($("#cad_blognacional").is(":checked")) {  
		var cad_blognacional = "true"; 
   } else {
		var cad_blognacional = "false";
   }



    $.ajax({
    	dataType: "html", 
    	url: "controle_acesso/insert_update_permissao.php", 
        type: 'POST',
    	data: {
    		pk_acesso: $("#pk_acesso").val(),
    		cad_abt: cad_abt,
    		cad_beach_house: cad_beach_house,
    		cad_expert: cad_expert,
    		cad_cidade: cad_cidade,
    		cad_cliente: cad_cliente,
    		cad_contatos: cad_contatos,
    		cad_deluxe: cad_deluxe,
    		cad_destaque_fit: cad_destaque_fit,
    		cad_guias: cad_guias,
    		cad_hotel: cad_hotel,
    		cad_inspections: cad_inspections,
    		cad_eco: cad_eco,
    		log_conteudo: log_conteudo,
    		log_tarifario: log_tarifario,
    		cad_minisite: cad_minisite,
    		cad_news: cad_news,
    		cad_os_handling: cad_os_handling,
    		cad_os_financeiro: cad_os_financeiro,
    		cad_os_usuario: cad_os_usuario,
    		cad_prod_update: cad_prod_update,
    		cad_quotes: cad_quotes,
    		cad_func: cad_func,
    		cad_renovation: cad_renovation,
    		cad_restaurante: cad_restaurante,
    		cad_tours: cad_tours,
    		cad_various: cad_various,
    		cad_venues: cad_venues,
    		consulta: consulta,
    		cad_trip_request: cad_trip_request,
    		cad_trip_request_dir: cad_trip_request_dir,
    		cad_tariff_tools: cad_tariff_tools,
    		cad_trailfinders: cad_trailfinders,
    		cad_webservices: cad_webservices,
            cad_file_web: cad_file_web,
            acesso_tariff_cliente: acesso_tariff_cliente,
            video_bank: video_bank,
    		cad_blognacional: cad_blognacional
    	},
       error: function() {
    		alert("Erro ao retornar o usuario!");
    	},
        success: function(resposta) {
    		$("#container_miolo").html(resposta);
    	 } 
     });
 }





function  cadastra_permissao_func( ) { 
	
    $.ajax({
    	dataType: "html", 
    	url: "controle_acesso/cadastro_permissao_func.php", 
        type: 'POST',
    	data: {
    		pk_usuario: $("#pk_usuario").val() 
    	},
       error: function() {
    		alert("Erro ao retornar o usuario!");
    	},
        success: function(resposta) {
    		$("#container_miolo").html(resposta);
    	 } 
     });
 }






function  insert_permissao( ) { 
	

	if ($("#cad_abt").is(":checked")) {  
		 var cad_abt = "true"; 
	} else {
		 var cad_abt = "false";
	} 

   if ($("#cad_beach_house").is(":checked")) {  
		 var cad_beach_house = "true"; 
	} else {
		 var cad_beach_house = "false";
	} 
	
   if ($("#cad_expert").is(":checked")) {  
		 var cad_expert = "true"; 
	} else {
		 var cad_expert = "false";
	} 	
	
   if ($("#cad_cidade").is(":checked")) {  
		 var cad_cidade = "true"; 
	} else {
		 var cad_cidade = "false";
	} 	
	
	
   if ($("#cad_cliente").is(":checked")) {  
		 var cad_cliente = "true"; 
	} else {
		 var cad_cliente = "false";
	} 	
	
	
   if ($("#cad_contatos").is(":checked")) {  
		 var cad_contatos = "true"; 
	} else {
		 var cad_contatos = "false";
	} 	
	
   if ($("#cad_deluxe").is(":checked")) {  
		 var cad_deluxe = "true"; 
	} else {
		 var cad_deluxe = "false";
	} 	
	
   if ($("#cad_destaque_fit").is(":checked")) {  
		 var cad_destaque_fit = "true"; 
	} else {
		 var cad_destaque_fit = "false";
	} 	
	
	
   if ($("#cad_guias").is(":checked")) {  
		 var cad_guias = "true"; 
	} else {
		 var cad_guias = "false";
	} 	
   
	
   if ($("#cad_hotel").is(":checked")) {  
		 var cad_hotel = "true"; 
	} else {
		 var cad_hotel = "false";
	} 	
   
	
   if ($("#cad_inspections").is(":checked")) {  
		 var cad_inspections = "true"; 
	} else {
		 var cad_inspections = "false";
	} 	
   
	
   if ($("#cad_eco").is(":checked")) {  
		 var cad_eco = "true"; 
	} else {
		 var cad_eco = "false";
	} 	
   
	
   if ($("#log_conteudo").is(":checked")) {  
		 var log_conteudo = "true"; 
	} else {
		 var log_conteudo = "false";
	} 	
   
	
   if ($("#log_tarifario").is(":checked")) {  
		 var log_tarifario = "true"; 
	} else {
		 var log_tarifario = "false";
	} 	
   
	
   if ($("#cad_minisite").is(":checked")) {  
		 var cad_minisite = "true"; 
	} else {
		 var cad_minisite = "false";
	} 	
   
	
   if ($("#cad_news").is(":checked")) {  
		 var cad_news = "true"; 
	} else {
		 var cad_news = "false";
	} 	
   
	
   if ($("#cad_os_handling").is(":checked")) {  
		 var cad_os_handling = "true"; 
	} else {
		 var cad_os_handling = "false";
	} 	
   
	
   if ($("#cad_os_financeiro").is(":checked")) {  
		 var cad_os_financeiro = "true"; 
	} else {
		 var cad_os_financeiro = "false";
	} 	
   
	
   if ($("#cad_os_usuario").is(":checked")) {  
		 var cad_os_usuario = "true"; 
	} else {
		 var cad_os_usuario = "false";
	} 	
   
   
	
   if ($("#cad_prod_update").is(":checked")) {  
		 var cad_prod_update = "true"; 
	} else {
		 var cad_prod_update = "false";
	} 	
   
	
   if ($("#cad_quotes").is(":checked")) {  
		 var cad_quotes = "true"; 
	} else {
		 var cad_quotes = "false";
	} 	
   
	
   if ($("#cad_func").is(":checked")) {  
		 var cad_func = "true"; 
	} else {
		 var cad_func = "false";
	} 	
   
	
   if ($("#cad_renovation").is(":checked")) {  
		 var cad_renovation = "true"; 
	} else {
		 var cad_renovation = "false";
	} 	
   
	
   if ($("#cad_restaurante").is(":checked")) {  
		 var cad_restaurante = "true"; 
	} else {
		 var cad_restaurante = "false";
	} 	
   
	
   if ($("#cad_tours").is(":checked")) {  
		 var cad_tours = "true"; 
	} else {
		 var cad_tours = "false";
	} 	
   
	
   if ($("#cad_various").is(":checked")) {  
		 var cad_various = "true"; 
	} else {
		 var cad_various = "false";
	} 	
   
   
	
   if ($("#cad_venues").is(":checked")) {  
		 var cad_venues = "true"; 
	} else {
		 var cad_venues = "false";
	} 	
   
   
	
   if ($("#consulta").is(":checked")) {  
		 var consulta = "true"; 
	} else {
		 var consulta = "false";
	} 
   
   if ($("#cad_trip_request").is(":checked")) {  
		 var cad_trip_request = "true"; 
	} else {
		 var cad_trip_request = "false";
	} 
 
   if ($("#cad_trip_request_dir").is(":checked")) {  
		 var cad_trip_request_dir = "true"; 
	} else {
		 var cad_trip_request_dir = "false";
	} 


   if ($("#cad_tariff_tools").is(":checked")) {  
		 var cad_tariff_tools = "true"; 
	} else {
		 var cad_tariff_tools = "false";
	} 


   if ($("#cad_trailfinders").is(":checked")) {  
		 var cad_trailfinders = "true"; 
	} else {
		 var cad_trailfinders = "false";
	} 
   
     if ($("#cad_webservices").is(":checked")) {  
		 var cad_webservices = "true"; 
	} else {
		 var cad_webservices = "false";
	} 
   
   
   
       if ($("#cad_file_web").is(":checked")) {  
		 var cad_file_web = "true"; 
	} else {
		 var cad_file_web = "false";
	}
   
   
       
    if ($("#acesso_tariff_cliente").is(":checked")) {  
		 var acesso_tariff_cliente = "true"; 
	} else {
		 var acesso_tariff_cliente = "false";
	}



     if ($("#video_bank").is(":checked")) {  
		 var video_bank = "true"; 
	} else {
		 var video_bank = "false";
	}
   

	
     if ($("#cad_blognacional").is(":checked")) {  
		 var cad_blognacional = "true"; 
	} else {
		 var cad_blognacional = "false";
	}




   
    $.ajax({
    	dataType: "html", 
    	url: "controle_acesso/insert_permissao.php", 
        type: 'POST',
    	data: {
    		nome: $("#nome").val(),
    		pk_usuario: $("#pk_usuario").val(),
    		cad_abt: cad_abt,
    		cad_beach_house: cad_beach_house,
    		cad_expert: cad_expert,
    		cad_cidade: cad_cidade,
    		cad_cliente: cad_cliente,
    		cad_contatos: cad_contatos,
    		cad_deluxe: cad_deluxe,
    		cad_destaque_fit: cad_destaque_fit,
    		cad_guias: cad_guias,
    		cad_hotel: cad_hotel,
    		cad_inspections: cad_inspections,
    		cad_eco: cad_eco,
    		log_conteudo: log_conteudo,
    		log_tarifario: log_tarifario,
    		cad_minisite: cad_minisite,
    		cad_news: cad_news,
    		cad_os_handling: cad_os_handling,
    		cad_os_financeiro: cad_os_financeiro,
    		cad_os_usuario: cad_os_usuario,
    		cad_prod_update: cad_prod_update,
    		cad_quotes: cad_quotes,
    		cad_func: cad_func,
    		cad_renovation: cad_renovation,
    		cad_restaurante: cad_restaurante,
    		cad_tours: cad_tours,
    		cad_various: cad_various,
    		cad_venues: cad_venues,
    		consulta: consulta,
    		cad_trip_request: cad_trip_request,
    		cad_trip_request_dir: cad_trip_request_dir,
    		cad_tariff_tools: cad_tariff_tools,
    		cad_trailfinders: cad_trailfinders,
			cad_webservices: cad_webservices,
            cad_file_web: cad_file_web,
            acesso_tariff_cliente: acesso_tariff_cliente,
            video_bank: video_bank,
    		cad_blognacional: cad_blognacional
    	},
       error: function() {
    		alert("Erro ao retornar o usuario!");
    	},
        success: function(resposta) {
    		$("#container_miolo").html(resposta);
    	 } 
     });
 }

