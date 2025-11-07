	function acao_various () { 

						$.ajax({
						dataType: "html",  
						url: "various/miolo_various.php",  
						
						error: function() {
							alert("Error when retrieving various main page content!");
						},
						 
						success: function(resposta) {
							$("#container").html(resposta);
							 
						} 
						
						
					});

	}
	
	function novo_various () { 

		$.ajax({
		dataType: "html",  
		url: "various/form_novo_various.php",  
		
		error: function() {
			alert("Error when retrieving various form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	
	
	 function insere_novo_various () { 
			
			 if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }
			 
		   
			$.ajax({
			dataType: "html",  
			url: "various/insere_novo_various.php",  
			data: {
				 
				mneu_for: $("#mneu_for").val(), 
				nome: $("#nome").val(),
				especialidade: $("#especialidade").val(),
				citie: $("#citie").val(),
				descritivo_en: $("#descritivo_en").val(),
				descritivo_pt: $("#descritivo_pt").val(),
				descritivo_esp: $("#descritivo_esp").val(),
				foto1: $("#foto1").val(),
				foto2: $("#foto2").val(),
				ativo: ativo 
				 
			},
			error: function() {
				alert("Error when inserting new various form!");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});

	}	
	 
	 
	 
	 
		
		function altera_various () { 

			$.ajax({
			dataType: "html",  
			url: "various/form_altera_various.php",  
			data: {
				cod_various: $("#cod_various").val() 
			},
			error: function() {
				alert("Error when retrieving various form!");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});

	}
	 
		
		
		
		
		 function update_various () { 
				
			 if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }
			 
		   
			$.ajax({
			dataType: "html",  
			url: "various/update_various.php",  
			data: {
				
				cod_various:   $("#cod_various").val(), 
				mneu_for: $("#mneu_for").val(), 
				nome: $("#nome").val(),
				especialidade: $("#especialidade").val(),
				citie: $("#citie").val(),
				descritivo_en: $("#descritivo_en").val(),
				descritivo_pt: $("#descritivo_pt").val(),
				descritivo_esp: $("#descritivo_esp").val(),
				foto1: $("#foto1").val(),
				foto2: $("#foto2").val(),
				ativo: ativo 
				 
			},
			error: function() {
				alert("Error when updating  a various !");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});

	}
		
	
		 
		 
		 function lista_various () { 

				$.ajax({
				dataType: "html",  
				url: "various/template_various.php",  
				data: {
					cod_various: $("#cod_list_various").val() 
				},
				error: function() {
					alert("Error when retrieving venue form!");
				},
				 
				success: function(resposta) {
					$("#template_restaurantes").html(resposta);
					 
				} 
				
				
			});

		}	
		
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
	