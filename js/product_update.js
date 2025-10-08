
	function acao_produpdate () { 
	
											$.ajax({
											dataType: "html",  
											url: "product_update/miolo_product_update.php",  
											 
											error: function() {
												alert("Erro ao mostrar o menu de product update !");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	

	function novo_prod_update () { 
	
											$.ajax({
											dataType: "html",  
											url: "product_update/form_new_product_update.php",  
											 
											error: function() {
												alert("Erro ao mostrar o Form de novo product update !");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}

	
	

	function input_new_product_update () { 
		
		
		   if ($("#news_blumar").is(":checked")) {  
				 var news_blumar = "true"; 
			 } else {
				 var news_blumar = "false";
			 }
		
		   if ($("#news_riolife").is(":checked")) {  
				 var news_riolife = "true"; 
			 } else {
				 var news_riolife = "false";
			 }

			 
			 if ($("#news_bebrazil").is(":checked")) {  
				var news_bebrazil = "true"; 
			} else {
				var news_bebrazil = "false";
			}




		   if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }
		
		   if ($("#new_principal").is(":checked")) {  
				 var new_principal = "true"; 
			 } else {
				 var new_principal = "false";
			 }
		 
		    if ($("#news_eventos").is(":checked")) {  
				 var news_eventos = "true"; 
			 } else {
				 var news_eventos = "false";
			 }
		   
		   
		    var destaque = $("input[name='destaque']:checked").val();
		   
											$.ajax({
											dataType: "html",  
											url: "product_update/input_new_product_update.php",  
											type: 'POST',
											data: {
												 
												titulo: $("#titulo").val(),
												data_news: $("#data_news").val(),
												foto: $("#foto").val(),
												important: $("#important").val(),
												destaque: destaque,
												news_blumar: news_blumar,
												news_riolife: news_riolife,
												ativo: ativo,
												new_principal: new_principal,
                                                news_eventos: news_eventos,
												news_bebrazil: news_bebrazil 
											  
											},
											
											error: function() {
												alert("Error when inserting Product update content!");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
	
 

	function novo_rates_update () { 
	
											$.ajax({
											dataType: "html",  
											url: "product_update/form_rates_update.php",  
											type: 'POST',
											data: {
												  
												pk_recep_news: $("#pk_recep_news").val()
											},
											error: function() {
												alert("Erro ao mostrar o menu de product update !");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
		
	
	
	function input_rate_update () { 
		
		 
		   
											$.ajax({
											dataType: "html",  
											url: "product_update/input_rate_update.php",  
											type: 'POST',
											data: {
												 
												status: $("#status").val(),
												nov_a: $("#nov_a").val(),
												nov_b: $("#nov_b").val(),
												nov_c: $("#nov_c").val(),  
												pk_recep_news: $("#pk_recep_news").val()
											},
											
											error: function() {
												alert("Error when inserting Product update content!");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
							 
												
												 
											} 
											
											
										});
	
	}
	
	
	
	 
	
	function update_produpdat () { 
		
		$.ajax({
		dataType: "html",  
		url: "product_update/form_update_produpdate.php",  
		type: 'POST',
		data: {
			  
			pk_recep_news: $("#pk_recep_news").val()
		},
		error: function() {
			alert("Erro ao mostrar o Form de novo product update !");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}

 
	

	function insert_update_produpdate () { 
		
		
		   if ($("#news_blumar").is(":checked")) {  
				 var news_blumar = "true"; 
			 } else {
				 var news_blumar = "false";
			 }
		
		   if ($("#news_riolife").is(":checked")) {  
				 var news_riolife = "true"; 
			 } else {
				 var news_riolife = "false";
			 }

		   if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }
		
		   if ($("#new_principal").is(":checked")) {  
				 var new_principal = "true"; 
			 } else {
				 var new_principal = "false";
			 }
		 
		    if ($("#news_eventos").is(":checked")) {  
				 var news_eventos = "true"; 
			 } else {
				 var news_eventos = "false";
			 }
		   
			 if ($("#news_bebrazil").is(":checked")) {  
				var news_bebrazil = "true"; 
			} else {
				var news_bebrazil = "false";
			}
		  
			 


		    var destaque = $("input[name='destaque']:checked").val();
		   
											$.ajax({
											dataType: "html",  
											url: "product_update/update_product_update.php",  
											type: 'POST',
											data: {
												 
												titulo: $("#titulo").val(),
												data_news: $("#data_news").val(),
												foto: $("#foto").val(),
												important: $("#important").val(),
												destaque: destaque,
												news_blumar: news_blumar,
												news_riolife: news_riolife,
												ativo: ativo,
												new_principal: new_principal,
												pk_recep_news: $("#pk_recep_news").val(),
                                                news_eventos: news_eventos,
												news_bebrazil: news_bebrazil
											  
											},
											
											error: function() {
												alert("Error when inserting Product update content!");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	
	$(document).ready(function() { 
		   
		$("body").delegate("a.ratesup", "click",  function(){   
             retrive_rates($(this).children(".ratesupValue").val());
	     });    
						   
						   
	                         function retrive_rates (pkratesup) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "product_update/retrive_rate_update.php", 
											type: 'POST',
											cache: false,
											data: {
												 
												pk_recep_news: $("#pk_recep_news").val(),
												pk_recep_atualizacoes:  pkratesup
												
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
												 $("#container_miolo").html(resposta);
												 
											 },
											 
											    complete: function() {
												$("#loading").fadeOut("slow");
											}
											 }); 
	  
		 }
});
		
	
	
	
	function update_rate_update () { 
		
		 
		   
		$.ajax({
		dataType: "html",  
		url: "product_update/update_rate_update.php",  
		type: 'POST',
		data: {
			 
			status: $("#status").val(),
			campo1: $("#campo1").val(),
			campo2: $("#campo2").val(),
			campo3: $("#campo3").val(),  
			pk_recep_news: $("#pk_recep_news").val(),
			pk_recep_atualizacoes: $("#pk_recep_atualizacoes").val() 
		},
		
		error: function() {
			alert("Error when inserting Product update content!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
	 
			
			 
		} 
		
		
	});

}

	
	$(document).ready(function() { 
		   
		$("body").delegate("a.delratesup", "click",  function(){   
             del_rates($(this).children(".delratesupValue").val());
	     });    
						   
						   
	                         function del_rates (delpkratesup) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "product_update/delete_rate_update.php", 
											type: 'POST',
											cache: false,
											data: {
												 
												pk_recep_news: $("#pk_recep_news").val(),
												pk_recep_atualizacoes:  delpkratesup
												
											},
											 beforeSend: function() {
												 var answer = confirm ("Tem certeza que deseja apagar este Rate Update?")
												 if (answer) {}
													  
												 else
													return false;
													 $("#loading").fadeIn("slow");
												  },
											
											// FUN��O ERRO
											error: function() {
												alert("Ocorreu algum erro ao retornar o abt tour!");
											},
											// FUN��O SUCESSO
											 success: function(resposta) {
												 $("#container_miolo").html(resposta);
												 
											 },
											 
											    complete: function() {
												$("#loading").fadeOut("slow");
											}
											 }); 
	  
		 }
});
			
	
	
	
		
	

	function novo_attention_update () { 
	
											$.ajax({
											dataType: "html",  
											url: "product_update/form_attention_update.php",  
											type: 'POST',
											data: {
												  
												pk_recep_news: $("#pk_recep_news").val()
											},
											error: function() {
												alert("Erro ao mostrar o form de attention de product update !");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
		
	
	
	

	function novo_attention_update () { 
	
											$.ajax({
											dataType: "html",  
											url: "product_update/form_attention_update.php",  
											type: 'POST',
											data: {
												  
												pk_recep_news: $("#pk_recep_news").val()
											},
											error: function() {
												alert("Erro ao mostrar o form de attention de product update !");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
		
	
	
	
	function input_attention_update () { 
		
		$.ajax({
		dataType: "html",  
		url: "product_update/input_attention_update.php",  
		type: 'POST',
		data: {
			  
			pk_recep_news: $("#pk_recep_news").val(),
			destaque_news: $("#destaque_news").val(),
			descritivo_news: $("#descritivo_news").val()
		 	
		},
		error: function() {
			alert("Erro ao mostrar o form de attention de product update !");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}

	
	$(document).ready(function() { 
		   
		$("body").delegate("a.attentup", "click",  function(){   
             retrive_attentup($(this).children(".attentupValue").val());
	     });    
						   
						   
	                         function retrive_attentup (pkattentup) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "product_update/retrive_attent_update.php", 
											type: 'POST',
											cache: false,
											data: {
												 
												pk_recep_news: $("#pk_recep_news").val(),
												pk_news_recep_novidades:  pkattentup
												
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
												 $("#container_miolo").html(resposta);
												 
											 },
											 
											    complete: function() {
												$("#loading").fadeOut("slow");
											}
											 }); 
	  
		 }
});
			
	
	
	
	function update_attention_update () { 
		
		$.ajax({
		dataType: "html",  
		url: "product_update/update_attention_update.php",  
		type: 'POST',
		data: {
			  
			pk_recep_news: $("#pk_recep_news").val(),
			pk_news_recep_novidades: $("#pk_news_recep_novidades").val(),
			destaque_news: $("#destaque_news").val(),
			descritivo_news: $("#descritivo_news").val()
		 	
		},
		error: function() {
			alert("Erro ao mostrar o form de attention de product update !");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}

	
	
	$(document).ready(function() { 
		   
		$("body").delegate("a.delattentup", "click",  function(){   
             del_atten($(this).children(".delattentupValue").val());
	     });    
						   
						   
	                         function del_atten (delatten) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "product_update/delete_attention_update.php", 
											type: 'POST',
											cache: false,
											data: {
												 
												pk_recep_news: $("#pk_recep_news").val(),
												pk_news_recep_novidades:  delatten
												
											},
											 beforeSend: function() {
												 var answer = confirm ("Tem certeza que deseja apagar este ATTENTION de Product Update?")
												 if (answer) {}
													  
												 else
													return false;
													 $("#loading").fadeIn("slow");
												  },
											
											// FUN��O ERRO
											error: function() {
												alert("Ocorreu algum erro ao retornar o abt tour!");
											},
											// FUN��O SUCESSO
											 success: function(resposta) {
												 $("#container_miolo").html(resposta);
												 
											 },
											 
											    complete: function() {
												$("#loading").fadeOut("slow");
											}
											 }); 
	  
		 }
});
			
		
	
	

	function lista_productupdate () { 
	
											$.ajax({
											dataType: "html",  
											url: "product_update/lista_product_update.php",  
											 
											error: function() {
												alert("Erro ao mostrar o menu de product update !");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
		
	
	
	
	function duplicar_update () { 
		
		$.ajax({
		dataType: "html",  
		url: "product_update/duplicar_update.php",  
		type: 'POST',
		data: {
			  
			pk_recep_news: $("#pk_recep_news").val() 
		 	
		},
		error: function() {
			alert("Erro ao duplicar Product Update!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
	
	


	function duplicar_update2 () { 
		
		
		   if ($("#news_blumar").is(":checked")) {  
				 var news_blumar = "true"; 
			 } else {
				 var news_blumar = "false";
			 }
		
		   if ($("#news_riolife").is(":checked")) {  
				 var news_riolife = "true"; 
			 } else {
				 var news_riolife = "false";
			 }

		   if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }
		
		   if ($("#new_principal").is(":checked")) {  
				 var new_principal = "true"; 
			 } else {
				 var new_principal = "false";
			 }
		 
		   
		   
		   
		    var destaque = $("input[name='destaque']:checked").val();
		   
											$.ajax({
											dataType: "html",  
											url: "product_update/duplicar_update2.php",  
											type: 'POST',
											data: {
												 
												titulo: $("#titulo").val(),
												data_news: $("#data_news").val(),
												foto: $("#foto").val(),
												important: $("#important").val(),
												destaque: destaque,
												news_blumar: news_blumar,
												news_riolife: news_riolife,
												ativo: ativo,
												new_principal: new_principal,
												pk_recep_news: $("#pk_recep_news").val()
											  
											},
											
											error: function() {
												alert("Erro ao duplicar Product Update!");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	