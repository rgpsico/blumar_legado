
	function acao_log () { 
	
											$.ajax({
											dataType: "html",  
											url: "log/miolo_log.php",  
											 
											error: function() {
												alert("Erro ao mostrar o menu de Log de conteudo!");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
 
	

	function lista_log () { 
	
											$.ajax({
											dataType: "html",  
											url: "log/lista_log.php",  
											 
											error: function() {
												alert("Erro ao mostrar o menu de Log de conteudo!");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
		
	
	function lista_topico () { 
		
		$.ajax({
		dataType: "html",  
		url: "log/lista_topico.php",  
		 
		error: function() {
			alert("Erro ao mostrar o menu de Log de conteudo!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
	
	
 
	
	function busca_log () { 
		
		$.ajax({
		dataType: "html",  
		url: "log/log_topico.php",  
		type: 'POST',
		data: {
			 
			pk_conteudo: $("#pk_conteudo").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar o menu de Log de conteudo!");
		},
		 
		success: function(resposta) {
			$("#lista_topico").html(resposta);
			 
		} 
		
		
	});

}	

	function lista_user () { 
	
											$.ajax({
											dataType: "html",  
											url: "log/lista_user.php",  
											 
											error: function() {
												alert("Erro ao mostrar o menu de Log de conteudo!");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
			
	
	function busca_user () { 
		
		$.ajax({
		dataType: "html",  
		url: "log/log_user.php",  
		type: 'POST',
		data: {
			 
			pk_usuario: $("#pk_usuario").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar o menu de Log de conteudo!");
		},
		 
		success: function(resposta) {
			$("#lista_topico").html(resposta);
			 
		} 
		
		
	});

}	