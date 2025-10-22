 
	
	
	function submitfrmcidade () { 

		$.ajax({
		dataType: "html",  
		url: "lista_imagens.php",  
		type: 'POST',
		data: {
			string_cidade: $("#string_cidade").val()  
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}


	
	
	

	$(document).ready(function() { 
		   
		$("body").delegate("a.imgpath", "click",  function(){   
			path_img($(this).children(".imgpathvalue").val());
	     });    
						   
						   
	                         function path_img (path) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "mostra_img.php", 
											type: 'POST',
											cache: false,
											data: {
												path: path
											},
											error: function() {
												alert("Ocorreu algum erro ao gerar o file!");
											},
										 
											 success: function(resposta) {
												 $("#mapa-eco").html(resposta);
													$("#mapa-eco").modal(
															{
																overlayClose:true, 
																containerCss:{
																	 height:400,
																	 width:450 
																	 }
																	 
																});
											 
												 
											 },
											 
											    complete: function() {
												$("#loading").fadeOut("slow");
											}
											 }); 
	  
		 }
	});


	 


	
	
	function cidade_hotel () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_hotel").val()  
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_hotel").html(resposta);
		 
		 } 
	 });
	}

 
	
	
	
	function pega_hotel () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidade.php",  
		type: 'POST',
		data: {
			hotel: $("#hotel").val()  
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}

	
	