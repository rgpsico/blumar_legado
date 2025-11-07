
	function acao_abt () { 
	
											$.ajax({
											dataType: "html",  
											url: "abt/miolo_abt.php",  
											  // FUN��O ERRO
											error: function() {
												alert("Error when shown main ABT menu!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	function novo_abt () { 
		
		$.ajax({
		dataType: "html",  
		url: "abt/novo_abt.php",  
		  // FUN��O ERRO
		error: function() {
			alert("Error when retrieving ABT form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	 
	function input_novo_abt () { 
	
		
		   if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }
		
		   if ($("#ativo_home").is(":checked")) {  
				 var ativo_home = "true"; 
			 } else {
				 var ativo_home = "false";
			 }

		   if ($("#topo_brasil_pass").is(":checked")) {  
				 var topo_brasil_pass = "true"; 
			 } else {
				 var topo_brasil_pass = "false";
			 }
 

 if ($("#ativo_riolife").is(":checked")) {  
				 var ativo_riolife = "true"; 
			 } else {
				 var ativo_riolife = "false";
			 }
		
 



			 if ($("#classic").is(":checked")) {  
				var classic = "true"; 
			} else {
				var classic = "false";
			}
	   


			if ($("#romantic").is(":checked")) {  
				var romantic = "true"; 
			} else {
				var romantic = "false";
			}
	   


			if ($("#family").is(":checked")) {  
				var family = "true"; 
			} else {
				var family = "false";
			}
	   


			if ($("#beach").is(":checked")) {  
				var beach = "true"; 
			} else {
				var beach = "false";
			}
	   

			if ($("#boat").is(":checked")) {  
				var boat = "true"; 
			} else {
				var boat = "false";
			}
	   


			if ($("#special_interest").is(":checked")) {  
				var special_interest = "true"; 
			} else {
				var special_interest = "false";
			}
	   


			if ($("#adventure").is(":checked")) {  
				var adventure = "true"; 
			} else {
				var adventure = "false";
			}
	   


			if ($("#cultural").is(":checked")) {  
				var cultural = "true"; 
			} else {
				var cultural = "false";
			}
	   



			if ($("#active").is(":checked")) {  
				var active = "true"; 
			} else {
				var active = "false";
			}
	   


			if ($("#nature").is(":checked")) {  
				var nature = "true"; 
			} else {
				var nature = "false";
			}
	   


			if ($("#food_drinks").is(":checked")) {  
				var food_drinks = "true"; 
			} else {
				var food_drinks = "false";
			}
	   



			if ($("#night_out").is(":checked")) {  
				var night_out = "true"; 
			} else {
				var night_out = "false";
			}


			if ($("#newmod").is(":checked")) {  
				var new_mod = "true"; 
			} else {
				var new_mod = "false";
			}
		 
			 
	   
			var cid_filtro_arr = $("select[id='cid_filtro']")
			.map(function(){return $(this).val();}).get();	
		
		
											$.ajax({
											dataType: "html",  
											url: "abt/insere_novo_abt.php",  
											type: 'POST',
											data: {
												 
												nome: $("#nome").val(),
												date: $("#date").val(),
												foto_topo: $("#foto_topo").val(),
												titulo: $("#titulo").val(),
												campo_livre: $("#campo_livre").val(),
												foto_campo: $("#foto_campo").val(),
												foto_topo_bpass: $("#foto_topo_bpass").val(),
												foto1: $("#foto1").val(),
												foto2: $("#foto2").val(),
												foto3: $("#foto3").val(),
												foto4: $("#foto4").val(),
												ativo: ativo,
												ativo_home: ativo_home,
												topo_brasil_pass: topo_brasil_pass,
											    ativo_riolife: ativo_riolife,
											    lang: $("#lang").val(),
										        preco_abt: $("#preco_abt").val(),
                                                cidade_cod: $("#cidade_cod").val(),
												link_quotes: $("#link_quotes").val(),
												link_quotes_be: $("#link_quotes_be").val(),
												tempo_abt: $("#tempo_abt").val(),
												classic: classic,
												romantic: romantic, 
												family:  family,
												beach: beach,
												boat: boat, 
												special_interest: special_interest,
												adventure: adventure,
												cultural: cultural,
												active: active,
												nature: nature,
												food_drinks: food_drinks,
												night_out: night_out,
												cod_cid_filtro_arr: cid_filtro_arr,
                                                new_mod: new_mod




											},
											
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	
	
	function input_tour_abt () { 
		
		
		  
		
											$.ajax({
											dataType: "html",  
											url: "abt/insere_tour_abt.php",  
											type: 'POST',
											data: {
												 
												pk_abt: $("#pk_abt").val(),
												dia_conteudo: $("#dia_conteudo").val(),
												titulo_conteudo: $("#titulo_conteudo").val(),
												descritivo_conteudo: $("#descritivo_conteudo").val(),
												foto1_conteudo: $("#foto1_conteudo").val(),
												lay: $("#lay").val() 
											 
											 },
											
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#tour_abt").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	




	
	function add_filtro_cid () { 

		var cid_filtro_arr = $("select[id='cid_filtro']")
		.map(function(){return $(this).val();}).get();	

	 
		
		$.ajax({
		dataType: "html",  
		url: "abt/add_cid_filtro.php",  
		type: 'POST',
		data: {
			
			cod_cid_filtro_arr: cid_filtro_arr
		 },
		
		error: function() {
			alert("Error when inserting City content!");
		},
		 
		success: function(resposta) {
			$("#cid_filtro_miolo").html(resposta);
			 
		} 
		
		
	});

}







	
function alt_filtro_cid () { 

	var cid_pk_abt_destinos = $("input[id='pk_abt_destinos']")
	.map(function(){return $(this).val();}).get();	

 
	
	$.ajax({
	dataType: "html",  
	url: "abt/altera_cid_filtro.php",  
	type: 'POST',
	data: {
		
		pk_abt_destinos_arr: cid_pk_abt_destinos
	 },
	
	error: function() {
		alert("Error when inserting City content!");
	},
	 
	success: function(resposta) {
		$("#cid_filtro_miolo").html(resposta);
		 
	} 
	
	
});

}














$(document).ready(function() { 
		   
	$("body").delegate("a.pkremcid", "click",  function(){   
		 remove_cid($(this).children(".pkremcidvalue").val());
	 });    
					   
					   
						 function remove_cid (pkcid) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "abt/remove_cidade_arr.php", 
										type: 'POST',
										cache: false,
										data: {
											 
											pk_abt: $("#pk_abt").val(),
											pk_abt_destinos:  pkcid
											
										},
										// FUN��O ANTES DE ENVIAR
										 beforeSend: function() {
											 $("#loading").fadeIn("slow");
										 },
										
										
										// FUN��O ERRO
										error: function() {
											alert("Ocorreu algum erro ao aapagar a cidade!");
										},
										// FUN��O SUCESSO
										 success: function(resposta) {
											 $("#cid_filtro_miolo").html(resposta);
											 
										 },
										 
											complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});






















	$(document).ready(function() { 
		   
		$("body").delegate("a.pkabtconteudo", "click",  function(){   
             retrive_tour($(this).children(".pkabtconteudoValue").val());
	     });    
						   
						   
	                         function retrive_tour (pktour) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "abt/retrive_abt_tour.php", 
											
											cache: false,
											data: {
												 
												pk_abt: $("#pk_abt").val(),
												pkabttour:  pktour
												
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
	
	















	
	function update_tour_abt () { 
		
		
		  
		
											$.ajax({
											dataType: "html",  
											url: "abt/update_tour_abt.php",  
											type: 'POST',
											data: {
												 
												pk_abt: $("#pk_abt").val(),
												dia_conteudo: $("#dia_conteudo").val(),
												titulo_conteudo: $("#titulo_conteudo").val(),
												descritivo_conteudo: $("#descritivo_conteudo").val(),
												foto1_conteudo: $("#foto1_conteudo").val(),
												lay: $("input[id='lay']:checked").val(),
												pk_abt_conteudo: $("#pk_abt_conteudo").val()
											 
											 },
											
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	function altera_abt () { 
		
		
		  
		
											$.ajax({
											dataType: "html",  
											url: "abt/form_altera_abt.php",  
											type: 'POST',
											data: {
												 
												pk_abt: $("#pk_abt").val() 
											 
											 
											 },
											
											error: function() {
												alert("Erro ao retornar formulario para alteração!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	




	function altera_abt2 () { 
		
		
		  
		
											$.ajax({
											dataType: "html",  
											url: "abt/form_altera_abt.php",  
											type: 'POST',
											data: {
												 
												pk_abt: $("#pk_abt2").val() 
											 
											 
											 },
											
											error: function() {
												alert("Erro ao retornar formulario para alteração!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	





 
	
	function update_cad_bt () { 
		
		
		  
		
											$.ajax({
											dataType: "html",  
											url: "abt/form_altera_abt.php",  
											type: 'POST',
											data: {
												 
												pk_abt: $("#pk_abt").val() 
											 
											 },
											
											error: function() {
												alert("Error when inserting abt content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	















	 
	function update_abt () { 
	
		
		   if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }
		
		   if ($("#ativo_home").is(":checked")) {  
				 var ativo_home = "true"; 
			 } else {
				 var ativo_home = "false";
			 }

		   if ($("#topo_brasil_pass").is(":checked")) {  
				 var topo_brasil_pass = "true"; 
			 } else {
				 var topo_brasil_pass = "false";
			 }
		
		
		   if ($("#ativo_riolife").is(":checked")) {  
				 var ativo_riolife = "true"; 
			 } else {
				 var ativo_riolife = "false";
			 }





			 if ($("#classic").is(":checked")) {  
				var classic = "true"; 
			} else {
				var classic = "false";
			}
	   


			if ($("#romantic").is(":checked")) {  
				var romantic = "true"; 
			} else {
				var romantic = "false";
			}
	   


			if ($("#family").is(":checked")) {  
				var family = "true"; 
			} else {
				var family = "false";
			}
	   


			if ($("#beach").is(":checked")) {  
				var beach = "true"; 
			} else {
				var beach = "false";
			}
	   

			if ($("#boat").is(":checked")) {  
				var boat = "true"; 
			} else {
				var boat = "false";
			}
	   


			if ($("#special_interest").is(":checked")) {  
				var special_interest = "true"; 
			} else {
				var special_interest = "false";
			}
	   


			if ($("#adventure").is(":checked")) {  
				var adventure = "true"; 
			} else {
				var adventure = "false";
			}
	   


			if ($("#cultural").is(":checked")) {  
				var cultural = "true"; 
			} else {
				var cultural = "false";
			}
	   



			if ($("#active").is(":checked")) {  
				var active = "true"; 
			} else {
				var active = "false";
			}
	   


			if ($("#nature").is(":checked")) {  
				var nature = "true"; 
			} else {
				var nature = "false";
			}
	   


			if ($("#food_drinks").is(":checked")) {  
				var food_drinks = "true"; 
			} else {
				var food_drinks = "false";
			}
	   



			if ($("#night_out").is(":checked")) {  
				var night_out = "true"; 
			} else {
				var night_out = "false";
			}
	   

			if ($("#newmod").is(":checked")) {  
				var new_mod = "true"; 
			} else {
				var new_mod = "false";
			}
			


   
			var cid_filtro_arr = $("select[id='cid_filtro']")
			.map(function(){return $(this).val();}).get();	











											$.ajax({
											dataType: "html",  
											url: "abt/update_abt.php",  
											type: 'POST',
											data: {
												
												pk_abt: $("#pk_abt").val(), 
												nome: $("#nome").val(),
												date: $("#date").val(),
												foto_topo: $("#foto_topo").val(),
												titulo: $("#titulo").val(),
												campo_livre: $("#campo_livre").val(),
												foto_campo: $("#foto_campo").val(),
												foto_topo_bpass: $("#foto_topo_bpass").val(),
												foto1: $("#foto1").val(),
												foto2: $("#foto2").val(),
												foto3: $("#foto3").val(),
												foto4: $("#foto4").val(),
												ativo: ativo,
												ativo_home: ativo_home,
												topo_brasil_pass: topo_brasil_pass,
											    ativo_riolife:ativo_riolife,
											    lang: $("#lang").val(),
										        preco_abt: $("#preco_abt").val(),
                                                cidade_cod: $("#cidade_cod").val(),
												link_quotes: $("#link_quotes").val(),
												link_quotes_be: $("#link_quotes_be").val(),
												tempo_abt: $("#tempo_abt").val(),
												classic: classic,
												romantic: romantic, 
												family:  family,
												beach: beach,
												boat: boat, 
												special_interest: special_interest,
												adventure: adventure,
												cultural: cultural,
												active: active,
												nature: nature,
												food_drinks: food_drinks,
												night_out: night_out,
												cod_cid_filtro_arr: cid_filtro_arr,
												new_mod: new_mod 
												
											},
											
											error: function() {
												alert("Error when inserting City content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	
	
	function novo_tour_abt () { 
		
		$.ajax({
		dataType: "html",  
		url: "abt/abt_tour_form.php", 
		type: 'POST',
		data: {
			 
			pk_abt: $("#pk_abt").val() 
		 
		 
		 },
	 
		error: function() {
			alert("Error when retrieving ABT form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	
	
	
	
	function lista_abt () { 
		
		$.ajax({
		dataType: "html",  
		url: "abt/lista_abt.php", 
		type: 'POST',
		 error: function() {
			alert("Error when retrieving ABT form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	$(document).ready(function() { 
		   
		$("body").delegate("a.pkabt", "click",  function(){   
             retrive_abt($(this).children(".pkabtvalue").val());
	     });    
						   
						   
	                         function retrive_abt (pkabt) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "abt/abt_individual.php", 
											
											cache: false,
											data: {
												 
												 
												pkabt:  pkabt
												
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
	
	
	function insere_estilo () { 
		
		
		  
		
											$.ajax({
											dataType: "html",  
											url: "abt/insere_estilo.php",  
											type: 'POST',
											data: {
												 
												pk_abt: $("#pk_abt").val(), 
											    estilo: $("#estilo").val() 
											 },
											
											error: function() {
												alert("Erro ao retornar formulario para alteração!");
											},
											 
											success: function(resposta) {
												$("#estilos_do_abt").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	

	$(document).ready(function() { 
		   
		$("body").delegate("a.pkestilo", "click",  function(){   
             apaga_estilo($(this).children(".pkestilovalue").val());
	     });    
						   
						   
	                         function apaga_estilo (pk_estilo) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "abt/apagar_estilo.php", 
											type: 'POST',
											cache: false,
											data: {
												 
												pk_abt: $("#pk_abt").val(),
												pk_estilo:  pk_estilo
												
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
												 $("#estilos_do_abt").html(resposta);
												 
											 },
											 
											    complete: function() {
												$("#loading").fadeOut("slow");
											}
											 }); 
	  
		 }
});
	
	
	
	
	
	
	
	
	
	
	$(document).ready(function() { 
		   
		$("body").delegate("a.delpkabt", "click",  function(){   
             del_tour($(this).children(".delpkabtValue").val());
	     });    
						   
						   
	                         function del_tour (pktourdel) {
							 
		  
										   $.ajax({
											dataType: "html",  
											url: "abt/delete_abt_tour.php", 
											type: 'POST',
											cache: false,
											data: {
												 
												pk_abt: $("#pk_abt").val(),
												pkabttour:  pktourdel
												
											},
											// FUN��O ANTES DE ENVIAR
											beforeSend: function() {
											 var answer = confirm ("ATENÇÃO, tem certeza que deseja apagar este dia!!?")
											 if (answer) {}
												  
											 else
												return false;
												 
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
	

	