 
	function acao_log_tarifario () { 
	
											$.ajax({
											dataType: "html",  
											url: "log_acesso_tarifario/miolo_acesso_tarifario.php",  
											  // FUN��O ERRO
											
											 beforeSend: 
												 function() 
												 {  $("#loading").fadeIn("slow"); 
												  
												 },
											error: function() {
												alert("Erro ao mostrar o Log do tarifario!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} ,
											complete: function() {
												$("#loading").fadeOut("slow");
											} 
											
											
										});
	
	}
	
	
		
	
	
	function pega_log_clientes () { 
		
		$.ajax({
		dataType: "html",  
		url: "log_acesso_tarifario/pega_log_clientes.php",  
		type: 'POST',
		data: {
			 
			fk_cad_cli: $("#fk_cad_cli").val() },
	    beforeSend: 
				 function() 
				 {  $("#loading").fadeIn("slow"); 
				  
				 },
		error: function() {
			alert("Erro ao mostrar o Log do tarifario por cliente!");
		},
		 
		success: function(resposta) {
			$("#corpo_log").html(resposta);
			 
		},
		complete: function() {
			$("#loading").fadeOut("slow");
		}  
		
		
	});

}

	
	
		
	
	
	function filtra_log () { 
		
		$.ajax({
		dataType: "html",  
		url: "log_acesso_tarifario/pega_log_data.php",  
		type: 'POST',
		data: {
			 
			fk_cad_cli: $("#fk_cad_cli").val(),
			log_in: $("#log_in").val(),
			log_out: $("#log_out").val()

			
			
			},
		beforeSend: 
					 function() 
					 {  $("#loading").fadeIn("slow"); 
					  
					 },
		error: function() {
			alert("Erro ao mostrar o Log do tarifario por cliente!");
		},
		 
		success: function(resposta) {
			$("#corpo_log").html(resposta);
			 
		}, 
		complete: function() {
			$("#loading").fadeOut("slow");
		}  
		
	});

}
	
	
	
	
 
	
	