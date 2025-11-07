
	function acao_news () { 
	
											$.ajax({
											dataType: "html",  
											url: "newsletter/miolo_news.php",  
											 
											error: function() {
												alert("Erro ao mostrar o menu de newsletter!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	function nova_news () { 
		
		$.ajax({
		dataType: "html",  
		url: "newsletter/form_nova_news.php",  
		  // FUN��O ERRO
		error: function() {
			alert("Erro a mostrar o formulario de cadastro de newsletter!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	

	function conteudo_minisite () { 
	
											$.ajax({
											dataType: "html",  
											url: "newsletter/conteudo_minisite.php",  
											type: 'POST',
											data: {
												 
												pk_news: $("#pk_news").val() 
												 
											},
											error: function() {
												alert("Erro ao mostrar conteudo do minisite!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	

	function conteudo_especialista () { 
	
											$.ajax({
											dataType: "html",  
											url: "newsletter/form_conteudo_especialista.php",  
											type: 'POST',
											data: {
												 
												pk_news: $("#pk_news").val() 
												 
											},
											error: function() {
												alert("Erro ao mostrar conteudo do minisite!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	function lista_news () { 
		
		$.ajax({
		dataType: "html",  
		url: "newsletter/lista_news.php",  
		  // FUN��O ERRO
		error: function() {
			alert("Erro a mostrar a listagem de newsletters!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	
	

	function duplica_news () { 
	
											$.ajax({
											dataType: "html",  
											url: "newsletter/duplica_news.php",  
											type: 'POST',
											data: {
												 
												pk_news: $("#pk_news").val() 
												 
											},
											 beforeSend: function() {
												 var answer = confirm ("Tem certeza que deseja duplicar esta newsletter?")
												 if (answer) {}
													  
												 else
													return false;
													 $("#loading").fadeIn("slow");
												  },
											error: function() {
												alert("Erro ao mostrar conteudo do minisite!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	
	
	function input_nova_news () { 
		
		
		   if ($("#titulo_ativo").is(":checked")) {  
				 var titulo_ativo = "true"; 
			 } else {
				 var titulo_ativo = "false";
			 }
		
		   if ($("#ativo_web").is(":checked")) {  
				 var ativo_web = "true"; 
			 } else {
				 var ativo_web = "false";
			 }

		   if ($("#ativo_home").is(":checked")) {  
				 var ativo_home = "true"; 
			 } else {
				 var ativo_home = "false";
			 }
		
		   if ($("#recep").is(":checked")) {  
				 var recep = "true"; 
			 } else {
				 var recep = "false";
			 }
		   
		   if ($("#novo_layout").is(":checked")) {  
				 var novo_layout = "true"; 
			 } else {
				 var novo_layout = "false";
			 }
		
		   if ($("#ativo_passion").is(":checked")) {  
				 var ativo_passion = "true"; 
			 } else {
				 var ativo_passion = "false";
			 }
		   
		   	
		   if ($("#ativo_be").is(":checked")) {  
				 var ativo_be = "true"; 
			 } else {
				 var ativo_be = "false";
			 }


		    var emp = $("input[name='empresa']:checked").val();
		   
											$.ajax({
											dataType: "html",  
											url: "newsletter/insere_nova_news.php",  
											type: 'POST',
											data: {
												 
												nome: $("#nome").val(),
												data_extenso: $("#data_extenso").val(),
												img_topo: $("#img_topo").val(),
												alt_topo: $("#alt_topo").val(),
												titulo: $("#titulo").val(),
												pdf: $("#pdf").val(),
												bloco_livre: $("#bloco_livre").val(),
												foto_bloco: $("#foto_bloco").val(),
												alt_livre: $("#alt_livre").val(),
												chamada1_bloco: $("#chamada1_bloco").val(),
												chamada_bloco: $("#chamada_bloco").val(),
												more_poducts: $("#more_poducts").val(),
												empresa: emp,
												titulo_ativo: titulo_ativo,
												ativo_web: ativo_web,
												ativo_home: ativo_home,
												recep: recep,
												novo_layout: novo_layout,
												ativo_be: ativo_be,
												ativo_passion: ativo_passion
											  
											},
											
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	
	
	function input_destaque_news () { 
		
		
		   if ($("#titulo_ativo").is(":checked")) {  
				 var titulo_ativo = "true"; 
			 } else {
				 var titulo_ativo = "false";
			 }
		
		   if ($("#link_ativo").is(":checked")) {  
				 var link_ativo = "true"; 
			 } else {
				 var link_ativo = "false";
			 }

		   var laydest = $("input[name='lay']:checked").val();
		   
		   
											$.ajax({
											dataType: "html",  
											url: "newsletter/insere_destaque.php",  
											type: 'POST',
											data: {
												 
												dia_conteudo: $("#dia_conteudo").val(),
												titulo_news: $("#titulo_news").val(),
												sub_titulo_news: $("#sub_titulo_news").val(),
												link_endereco: $("#link_endereco").val(),
												img_link: $("#img_link").val(),
												descritivo_conteudo: $("#descritivo_conteudo").val(),
												img1_conteudo: $("#img1_conteudo").val(),
												img_reduz: $("#img_reduz").val(),
												alt: $("#alt").val(),
												expert: $("#expert").val(),
												lay: laydest,
												pk_news: $("#pk_news").val(),
											    titulo_ativo: titulo_ativo,
												link_ativo: link_ativo
												 
											},
											
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	$(document).ready(function() { 
		   
		$("body").delegate("a.newsconteudo", "click",  function(){   
             retrive_destaque($(this).children(".newsconteudoValue").val());
	     });    
						   
						   
	                         function retrive_destaque (pkdest) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "newsletter/retrive_destaque.php", 
											
											cache: false,
											data: {
												 
												pk_news: $("#pk_news").val(),
												pkdest:  pkdest
												
											},
											// FUN��O ANTES DE ENVIAR
											 beforeSend: function() {
												 $("#loading").fadeIn("slow");
											 },
											
											
											// FUN��O ERRO
											error: function() {
												alert("Ocorreu algum erro ao retornar o abt tour!");
											},
											// FUN��O SUCESSO
											 success: function(resposta) {
												 $("#container").html(resposta);
												 
											 },
											 
											    complete: function() {
												$("#loading").fadeOut("slow");
											}
											 }); 
	  
		 }
});
	
	
	
	function altera_news () { 
		
		
		 
		   
		   
											$.ajax({
											dataType: "html",  
											url: "newsletter/form_update_news.php",  
											type: 'POST',
											data: {
												 
												pk_news: $("#pk_news").val() 
												 
											},
											
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	

	function update_news () { 
		
		
		   if ($("#titulo_ativo").is(":checked")) {  
				 var titulo_ativo = "true"; 
			 } else {
				 var titulo_ativo = "false";
			 }
		
		   if ($("#ativo_web").is(":checked")) {  
				 var ativo_web = "true"; 
			 } else {
				 var ativo_web = "false";
			 }

		   if ($("#ativo_home").is(":checked")) {  
				 var ativo_home = "true"; 
			 } else {
				 var ativo_home = "false";
			 }
		
		   if ($("#recep").is(":checked")) {  
				 var recep = "true"; 
			 } else {
				 var recep = "false";
			 }
		   
		   if ($("#novo_layout").is(":checked")) {  
				 var novo_layout = "true"; 
			 } else {
				 var novo_layout = "false";
			 }
		
		   if ($("#ativo_passion").is(":checked")) {  
				 var ativo_passion = "true"; 
			 } else {
				 var ativo_passion = "false";
			 }
		   

			 	   if ($("#ativo_be").is(":checked")) {  
				 var ativo_be = "true"; 
			 } else {
				 var ativo_be = "false";
			 }


		   var emp = $("input[name='empresa']:checked").val();
		   
		   
											$.ajax({
											dataType: "html",  
											url: "newsletter/update_news.php",  
											type: 'POST',
											data: {
												pk_news: $("#pk_news").val(),
												nome: $("#nome").val(),
												data_extenso: $("#data_extenso").val(),
												img_topo: $("#img_topo").val(),
												alt_topo: $("#alt_topo").val(),
												titulo: $("#titulo").val(),
												pdf: $("#pdf").val(),
												bloco_livre: $("#bloco_livre").val(),
												foto_bloco: $("#foto_bloco").val(),
												alt_livre: $("#alt_livre").val(),
												chamada1_bloco: $("#chamada1_bloco").val(),
												chamada_bloco: $("#chamada_bloco").val(),
												more_poducts: $("#more_poducts").val(),
												empresa: emp,
												titulo_ativo: titulo_ativo,
												ativo_web: ativo_web,
												ativo_home: ativo_home,
												recep: recep,
												novo_layout: novo_layout,
												ativo_passion: ativo_passion,
												ativo_be: ativo_be
											 
											},
											
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
		
	
	
 
	
	
	function novo_destaque () { 
		
		$.ajax({
		dataType: "html",  
		url: "newsletter/form_destaques_news.php",  
		type: 'POST',
		data: {
			 
			pk_news: $("#pk_news").val() 
			 
		},
		error: function() {
			alert("Erro a mostrar o formulario de cadastro de destaques!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	
	function update_destaque_news () { 
		
		
		   if ($("#titulo_ativo").is(":checked")) {  
				 var titulo_ativo = "true"; 
			 } else {
				 var titulo_ativo = "false";
			 }
		
		   if ($("#link_ativo").is(":checked")) {  
				 var link_ativo = "true"; 
			 } else {
				 var link_ativo = "false";
			 }

		   var laydest = $("input[name='lay']:checked").val();
		   
		   
											$.ajax({
											dataType: "html",  
											url: "newsletter/update_destaque.php",  
											type: 'POST',
											data: {
												 
												dia_conteudo: $("#dia_conteudo").val(),
												titulo_news: $("#titulo_news").val(),
												sub_titulo_news: $("#sub_titulo_news").val(),
												link_endereco: $("#link_endereco").val(),
												img_link: $("#img_link").val(),
												descritivo_conteudo: $("#descritivo_conteudo").val(),
												img1_conteudo: $("#img1_conteudo").val(),
												img_reduz: $("#img_reduz").val(),
												alt: $("#alt").val(),
												lay: laydest,
												expert: $("#expert").val(),
												pk_news: $("#pk_news").val(),
											    titulo_ativo: titulo_ativo,
												link_ativo: link_ativo,
												pk_news_conteudo: $("#pk_news_conteudo").val() 
											},
											
											error: function() {
												alert("Erro ao atualizar um destaque!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
		
	
	$(document).ready(function() { 
		   
		$("body").delegate("a.pkprodutos", "click",  function(){   
             retrive_produtos($(this).children(".pkprodutosvalue").val());
	     });    
						   
						   
	                         function retrive_produtos (pkprod) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "newsletter/form_conteudo_minisite.php", 
											
											cache: false,
											data: {
												 
												pk_news: $("#pk_news").val(),
												pk_produtos:  pkprod
												
											},
											// FUN��O ANTES DE ENVIAR
											 beforeSend: function() {
												 $("#loading").fadeIn("slow");
											 },
											
											
											// FUN��O ERRO
											error: function() {
												alert("Ocorreu algum erro ao retornar o abt tour!");
											},
											// FUN��O SUCESSO
											 success: function(resposta) {
												 $("#container").html(resposta);
												 
											 },
											 
											    complete: function() {
												$("#loading").fadeOut("slow");
											}
											 }); 
	  
		 }
});
	
	
	
	
	$(document).ready(function() { 
		   
		$("body").delegate("a.delconteudo", "click",  function(){   
			delete_conteudo ($(this).children(".delconteudovalue").val());
	     });    
						   
						   
	                         function delete_conteudo (pkdestk) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "newsletter/deleta_destaque.php", 
											type: 'POST',
											cache: false,
											data: {
												 
												pk_news: $("#pk_news").val(),
												pkdest:  pkdestk
												
											},
											 
											 beforeSend: function() {
												 var answer = confirm ("Tem certeza que deseja apagar este destaque?")
												 if (answer) {}
													  
												 else
													return false;
													 $("#loading").fadeIn("slow");
												  },
											
											
											// FUN��O ERRO
											error: function() {
												alert("Ocorreu algum erro ao apagar este destaque!");
											},
											// FUN��O SUCESSO
											 success: function(resposta) {
												 $("#container").html(resposta);
												 
											 },
											 
											    complete: function() {
												$("#loading").fadeOut("slow");
											}
											 }); 
	  
		 }
});
	
	