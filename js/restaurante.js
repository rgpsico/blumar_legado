	function acao_restaurante () { 

						$.ajax({
						dataType: "html",  
						url: "restaurante/miolo_restaurante.php",  
						
						error: function() {
							alert("Error when retrieving restaurants main page content!");
						},
						 
						success: function(resposta) {
							$("#container").html(resposta);
							 
						} 
						
						
					});

	}
	
	
	function novo_restaurante () { 

		$.ajax({
		dataType: "html",  
		url: "restaurante/form_novo_restaurante.php",  

		error: function() {
			alert("Error when retrieving new restaurants form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	
	
	
	function insere_novo_restaurante () { 
		
		
		 if ($("#selo_fav").is(":checked")) {  
			 var selo_fav = "true"; 
		 } else {
			 var selo_fav = "false";
		 }

		 if ($("#wview").is(":checked")) {  
			 var wview = "true"; 
		 } else {
			 var wview = "false";
		 }
		 
		 if ($("#selo_boteco").is(":checked")) {  
			 var selo_boteco = "true"; 
		 } else {
			 var selo_boteco = "false";
		 }
		 
		 if ($("#selo_budget").is(":checked")) {  
			 var selo_budget = "true"; 
		 } else {
			 var selo_budget = "false";
		 }
		
		 if ($("#selo_highend").is(":checked")) {  
			 var selo_highend = "true"; 
		 } else {
			 var selo_highend = "false";
		 }
		
		 if ($("#selo_livemusic").is(":checked")) {  
			 var selo_livemusic = "true"; 
		 } else {
			 var selo_livemusic = "false";
		 }
		 
		 if ($("#selo_romantic").is(":checked")) {  
			 var selo_romantic = "true"; 
		 } else {
			 var selo_romantic = "false";
		 }
		 
		 if ($("#selo_selfservice").is(":checked")) {  
			 var selo_selfservice = "true"; 
		 } else {
			 var selo_selfservice = "false";
		 }
		
		 if ($("#selo_trendy").is(":checked")) {  
			 var selo_trendy = "true"; 
		 } else {
			 var selo_trendy = "false";
		 }
		 
		 if ($("#selo_veggie").is(":checked")) {  
			 var selo_veggie = "true"; 
		 } else {
			 var selo_veggie = "false";
		 }
		 
		 if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		 
		 if ($("#ativo_riolife").is(":checked")) {  
			 var ativo_riolife = "true"; 
		 } else {
			 var ativo_riolife = "false";
		 }
		 
		 if ($("#fav_riolife").is(":checked")) {  
			 var fav_riolife = "true"; 
		 } else {
			 var fav_riolife = "false";
		 }
		 
       if ($("#selo_michelin").is(":checked")) {  
			 var selo_michelin = "true"; 
		 } else {
			 var selo_michelin = "false";
		 }
		 
		 
		 if ($("#welkome").is(":checked")) {  
			var welkome = "true"; 
		} else {
			var welkome = "false";
		}
		

		 
		$.ajax({
		dataType: "html",  
		url: "restaurante/insere_novo_restaurante.php",  
		data: {
			 
			mneu_for: $("#mneu_for").val(), 
			cod_serv: $("#cod_serv").val(),
			nome: $("#nome").val(),
			especialidade: $("#especialidade").val(),
			citie: $("#citie").val(),
			address: $("#address").val(),
			tel: $("#tel").val(),
			classif: $("#classif").val(),
			descritivo: $("#descritivo").val(),
			descritivo_pt: $("#descritivo_pt").val(),
			descritivo_esp: $("#descritivo_esp").val(),
			foto1: $("#foto1").val(),
			foto2: $("#foto2").val(),
			url_insta: $("#url_insta").val(),
			selo_fav: selo_fav,
			wview: wview,
			selo_boteco: selo_boteco,
			selo_budget: selo_budget,
			selo_highend: selo_highend,
			selo_livemusic: selo_livemusic,
			selo_romantic: selo_romantic,
			selo_selfservice: selo_selfservice,
			selo_trendy: selo_trendy,
			selo_veggie: selo_veggie,
			ativo: ativo,
			ativo_riolife: ativo_riolife,
			fav_riolife: fav_riolife,
            selo_michelin: selo_michelin,
			welkome: welkome

			
			 
		},
		error: function() {
			alert("Error when inserting new eco form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}


 
	function select_cid_rest () { 

		$.ajax({
		dataType: "html",  
		url: "restaurante/select_restaurante.php",  
		data: {
			cod_cid: $("#cod_cid").val() 
		},
		error: function() {
			alert("Error when retrieving new restaurants form!");
		},
		 
		success: function(resposta) {
			$("#rest_list").html(resposta);
			 
		} 
		
		
	});

}



 
	function altera_restaurante () { 

		$.ajax({
		dataType: "html",  
		url: "restaurante/form_altera_restaurante.php",  
		data: {
			cod_rest: $("#cod_rest").val() 
		},
		error: function() {
			alert("Error when retrieving new restaurants form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	



	

	function update_restaurante () { 
		
		
		 if ($("#selo_fav").is(":checked")) {  
			 var selo_fav = "true"; 
		 } else {
			 var selo_fav = "false";
		 }

		 if ($("#wview").is(":checked")) {  
			 var wview = "true"; 
		 } else {
			 var wview = "false";
		 }
		 
		 if ($("#selo_boteco").is(":checked")) {  
			 var selo_boteco = "true"; 
		 } else {
			 var selo_boteco = "false";
		 }
		 
		 if ($("#selo_budget").is(":checked")) {  
			 var selo_budget = "true"; 
		 } else {
			 var selo_budget = "false";
		 }
		
		 if ($("#selo_highend").is(":checked")) {  
			 var selo_highend = "true"; 
		 } else {
			 var selo_highend = "false";
		 }
		
		 if ($("#selo_livemusic").is(":checked")) {  
			 var selo_livemusic = "true"; 
		 } else {
			 var selo_livemusic = "false";
		 }
		 
		 if ($("#selo_romantic").is(":checked")) {  
			 var selo_romantic = "true"; 
		 } else {
			 var selo_romantic = "false";
		 }
		 
		 if ($("#selo_selfservice").is(":checked")) {  
			 var selo_selfservice = "true"; 
		 } else {
			 var selo_selfservice = "false";
		 }
		
		 if ($("#selo_trendy").is(":checked")) {  
			 var selo_trendy = "true"; 
		 } else {
			 var selo_trendy = "false";
		 }
		 
		 if ($("#selo_veggie").is(":checked")) {  
			 var selo_veggie = "true"; 
		 } else {
			 var selo_veggie = "false";
		 }
		 
		 if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		 
		 if ($("#ativo_riolife").is(":checked")) {  
			 var ativo_riolife = "true"; 
		 } else {
			 var ativo_riolife = "false";
		 }
		 
		 if ($("#fav_riolife").is(":checked")) {  
			 var fav_riolife = "true"; 
		 } else {
			 var fav_riolife = "false";
		 }
		 
		 if ($("#selo_michelin").is(":checked")) {  
			 var selo_michelin = "true"; 
		 } else {
			 var selo_michelin = "false";
		 }

		 if ($("#welkome").is(":checked")) {  
			var welkome = "true"; 
		} else {
			var welkome = "false";
		}


		$.ajax({
		dataType: "html",  
		url: "restaurante/update_restaurante.php",
		type: 'POST',
		data: {
			
			cod_rest: $("#cod_rest").val(), 
			mneu_for: $("#mneu_for").val(), 
			cod_serv: $("#cod_serv").val(),
			nome: $("#nome").val(),
			especialidade: $("#especialidade").val(),
			citie: $("#citie").val(),
			address: $("#address").val(),
			tel: $("#tel").val(),
			classif: $("#classif").val(),
			descritivo: $("#descritivo").val(),
			descritivo_pt: $("#descritivo_pt").val(),
			descritivo_esp: $("#descritivo_esp").val(),
			foto1: $("#foto1").val(),
			foto2: $("#foto2").val(),
			url_insta: $("#url_insta").val(),
			selo_fav: selo_fav,
			wview: wview,
			selo_boteco: selo_boteco,
			selo_budget: selo_budget,
			selo_highend: selo_highend,
			selo_livemusic: selo_livemusic,
			selo_romantic: selo_romantic,
			selo_selfservice: selo_selfservice,
			selo_trendy: selo_trendy,
			selo_veggie: selo_veggie,
			ativo: ativo,
			ativo_riolife: ativo_riolife,
			fav_riolife: fav_riolife,
            selo_michelin: selo_michelin,
			welkome:welkome
			 
		},
		error: function() {
			alert("Error when updating restaurant!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	function template_restaurante () { 

		$.ajax({
		dataType: "html",  
		url: "restaurante/template_restaurante.php",  
		data: {
			cod_rest: $("#cod_rest_template").val() 
		},
		error: function() {
			alert("Error when retrieving  restaurants template!");
		},
		 
		success: function(resposta) {
			$("#template_restaurantes").html(resposta);
			 
		} 
		
		
	});

}	
	
	function listagem_simples_restaurante () { 

		$.ajax({
		dataType: "html",  
		url: "restaurante/listagem_simples_restaurante.php",  
		
		error: function() {
			alert("Error when retrieving  restaurants simple list!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	function listagem_simples_restaurante_riolife () { 

		$.ajax({
		dataType: "html",  
		url: "restaurante/listagem_simples_restaurante_riolife.php",  
		
		error: function() {
			alert("Error when retrieving  restaurants simple list!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	function listagem_restaurante_favoritos () { 

		$.ajax({
		dataType: "html",  
		url: "restaurante/listagem_restaurante_favoritos.php",  
		
		error: function() {
			alert("Error when retrieving  restaurants simple list!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
		
	
	function listagem_restaurante_favoritos_riolife () { 

		$.ajax({
		dataType: "html",  
		url: "restaurante/listagem_restaurante_favoritos_riolife.php",  
		
		error: function() {
			alert("Error when retrieving  restaurants simple list!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	