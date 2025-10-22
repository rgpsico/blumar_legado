 
	
	
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


	 


	
	
	function cidade_hotelb () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_hotelb").val() ,
			id_bank: 12 
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_hotelb").html(resposta);
		 
		 } 
	 });
	}

 

	
	function pega_hotel () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#hotel").val()  
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}

	
	 
	
	
	function cidade_hotel () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_hotel").val(),
			id_bank: 1
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_hotel").html(resposta);
		 
		 } 
	 });
	}

 	
	
	
	function pega_hotelb () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#hotelb").val()  
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}

	
	
	function cidade_tours () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_tours").val(),  
			id_bank: 2
		  },
		  

		 error: function() {
			alert("Erro ao pegar hoteis!");
		},
		 success: function(resposta) {
			$("#miolo_tours").html(resposta);
		 
		 } 
	 });
	}
 
	
		
	function pega_tourb () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#tourb").val()  
		  },
		  

		 error: function() {
			alert("Erro ao pegar tours!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	
	
	function cidade_rest () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_rest").val(),  
			id_bank: 3 
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_rest").html(resposta);
		 
		 } 
	 });
	}

function pega_restb () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#restb").val()  
		  },
		  

		 error: function() {
			alert("Erro ao pegar tours!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	
	
	
	
	
	
		
	function cidade_gifts () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_gifts").val(),  
			id_bank: 4   
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_gifts").html(resposta);
		 
		 } 
	 });
	}
	
	
	function pega_giftsb () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#giftsb").val()  
		  },
		  

		 error: function() {
			alert("Erro ao pegar tours!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	
	
	function cidade_transp () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_transp").val(),  
			id_bank: 5     
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_transp").html(resposta);
		 
		 } 
	 });
	}
	
	
	function pega_transpb () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#transpb").val()  
		  },
		  

		 error: function() {
			alert("Erro ao pegar transports!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}
	
	
 
 
 
 
 
	
	
	
	function cidade_venues () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_venues").val(),  
			id_bank: 6       
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_venues").html(resposta);
		 
		 } 
	 });
	}
	
	
		function pega_venuesb () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#venuesb").val()  
		  },
		  

		 error: function() {
			alert("Erro ao pegar venues!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	
	function cidade_various () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_various").val(),  
			id_bank: 7         
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_various").html(resposta);
		 
		 } 
	 });
	}
	
	function pega_variousb () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#variousb").val()  
		  },
		  

		 error: function() {
			alert("Erro ao pegar various!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	function cidade_touri () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_touri").val(),  
			id_bank: 8           
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_touri").html(resposta);
		 
		 } 
	 });
	}
	
		function pega_tourib () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#tourib").val()  
		  },
		  

		 error: function() {
			alert("Erro ao pegar various!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	
	
	function cidade_tourt () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_tourt").val(),  
			id_bank: 9             
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_tourt").html(resposta);
		 
		 } 
	 });
	}
	
	function pega_tourtb () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#tourtb").val()  
		  },
		  

		 error: function() {
			alert("Erro ao pegar various!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	
	function cidade_carros () { 

		$.ajax({
		dataType: "html",  
		url: "lista_hoteis_cidade.php",  
		type: 'POST',
		data: {
			string_cidade_hotel: $("#string_cidade_carros").val(),  
			id_bank: 10               
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_carros").html(resposta);
		 
		 } 
	 });
	}
	
	function pega_carrosb () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#carrosb").val()  
		  },
		  

		 error: function() {
			alert("Erro ao pegar various!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	
	function preferred () { 

		$.ajax({
		dataType: "html",  
		url: "hotel_cidadeb.php",  
		type: 'POST',
		data: {
			hotelb: $("#preferred_path").val()  
		  },
		  

		 error: function() {
			alert("Erro ao gerar os!");
		},
		 success: function(resposta) {
			$("#miolo_bancoimg").html(resposta);
		 
		 } 
	 });
	}

	
	