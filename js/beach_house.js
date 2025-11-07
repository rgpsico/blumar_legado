	function acao_beach_house () { 

						$.ajax({
						dataType: "html",  
						url: "beach_house/miolo_beach_house.php",  
						
						error: function() {
							alert("Error ao mostrar a página principal de Beach House!");
						},
						 
						success: function(resposta) {
							$("#container").html(resposta);
							 
						} 
						
						
					});

	}
	
	
	
	function novo_beach_house () { 

		$.ajax({
		dataType: "html",  
		url: "beach_house/form_novo_beach_house.php",  
		
		error: function() {
			alert("Error ao mostrar o formulario de Beach House!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	

	 
	function insert_beach_house () { 
		
		
		if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			} else {
				 var ativo = "false";
			}
				
	 
		
	    var cor = $("input[name='cor']:checked").val();
		
					$.ajax({
					dataType: "html",  
					url: "beach_house/insert_beach_house.php",  
					type: 'POST',
					data: {
						 
						nome: $("#nome").val(), 
						cidade: $("#cidade").val(),
						descritivo: $("#descritivo").val(),
						foto1: $("#foto1").val(),
						foto2: $("#foto2").val(),
						foto3: $("#foto3").val(),
						cor: cor,
						ativo: ativo 
				   },
					error: function() {
						alert("Erro ao mostrar o menu de cadastro de Beach House!");
					},
					 
					success: function(resposta) {
						$("#container").html(resposta);
						 
					} 
					
					
				});

	}
	
	
	 
	
	 
	function altera_beach_house () { 
		
 
		
					$.ajax({
					dataType: "html",  
					url: "beach_house/form_update_beach_house.php",  
					type: 'POST',
					data: {
						 
						pk_beach: $("#pk_beach").val()  
				   },
					error: function() {
						alert("Erro ao mostrar o menu de cadastro de Beach House!");
					},
					 
					success: function(resposta) {
						$("#container").html(resposta);
						 
					} 
					
					
				});

	}
	
	
	
function insert_update_beach_house () { 
		
		
		if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			} else {
				 var ativo = "false";
			}
				
	 
		
	    var cor = $("input[name='cor']:checked").val();
		
					$.ajax({
					dataType: "html",  
					url: "beach_house/insert_update_beach_house.php",  
					type: 'POST',
					data: {
						pk_beach: $("#pk_beach").val(), 
						nome: $("#nome").val(), 
						cidade: $("#cidade").val(),
						descritivo: $("#descritivo").val(),
						foto1: $("#foto1").val(),
						foto2: $("#foto2").val(),
						foto3: $("#foto3").val(),
						cor: cor,
						ativo: ativo 
				   },
					error: function() {
						alert("Erro ao mostrar o menu de cadastro de Beach House!");
					},
					 
					success: function(resposta) {
						$("#container").html(resposta);
						 
					} 
					
					
				});

	}
	
	
	

function template_beach () { 
	

	
				$.ajax({
				dataType: "html",  
				url: "beach_house/template_beach_house.php",  
				type: 'POST',
				data: {
					 
					pk_beach: $("#pk_template_beach").val()  
			   },
				error: function() {
					alert("Erro ao mostrar o menu de cadastro de Beach House!");
				},
				 
				success: function(resposta) {
					$("#box_deluxe").html(resposta);
					 
				} 
				
				
			});

}
	
	
	