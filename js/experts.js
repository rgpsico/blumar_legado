
	function acao_expert () { 
	
											$.ajax({
											dataType: "html",  
											url: "experts/miolo_experts.php",  
											 
											error: function() {
												alert("Erro ao mostrar o menu de Brazilian Experts !");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	

	function novo_expert () { 
	
											$.ajax({
											dataType: "html",  
											url: "experts/form_novo_experts.php",  
											 
											error: function() {
												alert("Erro ao mostrar o formulario Expert!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	

	
		
	function insert_expert () { 
			
		    var depto = $("input[name='depto']:checked").val();
			
			 $.ajax({
			dataType: "html",  
			url: "experts/insert_novo_expert.php",  
			type: 'POST',
			data: {
				 
				pk_usuario: $("#pk_usuario").val(),
			    foto1: $("#foto1").val(),
			    foto2: $("#foto2").val(),
			    foto3: $("#foto3").val(),
			    foto4: $("#foto4").val(),
			    foto5: $("#foto5").val(),
				idiomas: $("#idiomas").val(),
				texto: $("#texto").val(),
				texto_ing: $("#texto_ing").val(),
				texto_esp: $("#texto_esp").val(),
				depto: depto
				 
			},
			error: function() {
				alert("Erro ao inserir um novo Brazilian Expert!");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});
	
	}

	
	
	
	
	function altera_experts () { 
			
		 
			
			 $.ajax({
			dataType: "html",  
			url: "experts/form_update_expert.php",  
			type: 'POST',
			data: {
				 
				pk_br_experts: $("#pk_br_experts").val() 
				 
			},
			error: function() {
				alert("Erro ao retornar o formulario de Brazilian Experts!");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});
	
	}
	
	

	
	function update_expert () { 
			
		    var depto = $("input[name='depto']:checked").val();
			
			 $.ajax({
			dataType: "html",  
			url: "experts/update_expert.php",  
			type: 'POST',
			data: {
			    foto1: $("#foto1").val(),
			    foto2: $("#foto2").val(),
			    foto3: $("#foto3").val(),
			    foto4: $("#foto4").val(),
			    foto5: $("#foto5").val(),
				idiomas: $("#idiomas").val(),
				texto: $("#texto").val(),
				texto_ing: $("#texto_ing").val(),
				texto_esp: $("#texto_esp").val(),
				depto: depto,
				email: $("#email").val(),
				skype: $("#skype").val(),
				pk_foto_experts1: $("#pk_foto_experts1").val(), 
				pk_foto_experts2: $("#pk_foto_experts2").val(),
				pk_foto_experts3: $("#pk_foto_experts3").val(),
				pk_foto_experts4: $("#pk_foto_experts4").val(),
				pk_foto_experts5: $("#pk_foto_experts5").val(),
				pk_br_experts: $("#pk_br_experts").val(),
				nome: $("#nome").val()
				 
			},
			error: function() {
				alert("Erro ao inserir um novo Brazilian Expert!");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});
	
	}

	
	 function insert_foto_expert () { 
			
		 
			
			 $.ajax({
			dataType: "html",  
			url: "experts/form_foto_expert.php",  
			type: 'POST',
			data: {
				 
				pk_br_experts: $("#pk_br_experts").val() 
				 
			},
			error: function() {
				alert("Erro ao retornar o formulario de foto Brazilian Experts!");
			},
			 
			success: function(resposta) {
				$("#abt_right").html(resposta);
				 
			} 
			
			
		});
	
	}
	
	 	
	 function insert_ft_expert () { 
			
		 
			
		 $.ajax({
		dataType: "html",  
		url: "experts/insert_foto_expert.php",  
		type: 'POST',
		data: {
			 
			pk_br_experts: $("#pk_br_experts").val(), 
			addfoto: $("#addfoto").val()  
		},
		error: function() {
			alert("Erro ao retornar o formulario de foto Brazilian Experts!");
		},
		 
		success: function(resposta) {
			$("#abt_right").html(resposta);
			 
			$( function insert_ft_expert () { 
					    $.ajax({
						dataType: "html",  
						url: "experts/miolo_foto_expert.php",  
						type: 'POST',
						data: {
							 
							pk_br_experts: $("#pk_br_experts").val() 
						},
						error: function() {
							alert("Erro ao retornar o formulario de foto Brazilian Experts!");
						},
						 
						success: function(resposta) {
							$("#miolo_foto_expert").html(resposta);
						 } 
					 });
		           }
			 );
		
			 
			 
			 
			 
			 
		} 
		
		
	});

}
	 
	 
	  
		
	 function template_experts () { 
			
		 
			
			 $.ajax({
			dataType: "html",  
			url: "experts/template_expert.php",  
			type: 'POST',
			data: {
				 
				pk_br_experts: $("#pk_br_experts2").val() 
				 
			},
			error: function() {
				alert("Erro ao retornar o formulario de foto Brazilian Experts!");
			},
			 
			success: function(resposta) {
				$("#template_brazilian_experts").html(resposta);
				 
			} 
			
			
		});
	
	}	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	