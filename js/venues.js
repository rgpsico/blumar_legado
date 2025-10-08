	function acao_venues () { 

						$.ajax({
						dataType: "html",  
						url: "venues/miolo_venues.php",  
						
						error: function() {
							alert("Error when retrieving venues main page content!");
						},
						 
						success: function(resposta) {
							$("#container_miolo").html(resposta);
							 
						} 
						
						
					});

	}
	
	
	function novo_venue () { 

		$.ajax({
		dataType: "html",  
		url: "venues/form_novo_venue.php",  
		
		error: function() {
			alert("Error when retrieving venues main page content!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}

	
		
	
 function insere_novo_venue () { 
		
		 if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		 
	   
		$.ajax({
		dataType: "html",  
		url: "venues/insere_novo_venue.php",  
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
			alert("Error when inserting new venue form!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
	
	
 
	
	function altera_venue () { 

		$.ajax({
		dataType: "html",  
		url: "venues/form_altera_venue.php",  
		data: {
			cod_venue: $("#cod_venue").val() 
		},
		error: function() {
			alert("Error when retrieving venue form!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}

	
	
	 function update_venue () { 
			
		 if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		 
	   
		$.ajax({
		dataType: "html",  
		url: "venues/update_venue.php",  
		data: {
			
			cod_venues:   $("#cod_venues").val(), 
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
			alert("Error when updating  a venue !");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
		
	
		
		function lista_venue () { 

			$.ajax({
			dataType: "html",  
			url: "venues/template_venue.php",  
			data: {
				cod_venues: $("#cod_list_venue").val() 
			},
			error: function() {
				alert("Error when retrieving venue form!");
			},
			 
			success: function(resposta) {
				$("#template_restaurantes").html(resposta);
				 
			} 
			
			
		});

	}	
	
	
	
	
	
	
	
	