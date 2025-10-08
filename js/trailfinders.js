//modulo do historico de alterações
	function acao_trailfinders () { 
	
											$.ajax({
											dataType: "html",  
											url: "trailfinders/miolo_trailfinders.php",  
											 
											error: function() {
												alert("Erro ao inserir o Miolo de Trailfinders!");
											},
											 
											success: function(resposta) {
												$("#container_miolo").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
		
		
	
	function novo_iti () { 
		
		$.ajax({
		dataType: "html",  
		url: "views/form_novo_iti.php",  
		 
		error: function() {
			alert("Erro ao inserir o Miolo de Trailfinders!");
		},
		 
		success: function(resposta) {
			$("#linha_miolo_trail").html(resposta);
			 
		} 
		
		
	});

}
	
	
		
	

	function insert_iti  () { 

		
		  if ($("#preloaded").is(":checked")) {  
				 var preloaded = "true"; 
			 } else {
				 var preloaded = "false";
			 }
		   	   
		
		
		$.ajax({
		dataType: "html",  
		url: "views/insert_iti.php",  
		type: 'POST',
		data: {
			 
			nome_iti: $("#nome_iti").val(),
			nome_cli: $("#nome_cli").val(),
			preloaded: preloaded
		  },
		  

		 error: function() {
			alert("Erro ao gerar Voucher!");
		},
		 success: function(resposta) {
			$("#linha_miolo_trail").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	
	
	
	
	
	
	
	function busca_iti  () { 

		$.ajax({
		dataType: "html",  
		url: "views/lista_itinerarios.php",  
		type: 'POST',
		data: {
			 
			user: $("#user").val(),
			date_out: $("#date_out").val(),
			date_in:  $("#date_in").val(),
			descript:  $("#descript").val()
		  },
		  

		 error: function() {
			alert("Erro ao gerar Voucher!");
		},
		 success: function(resposta) {
			$("#linha_miolo_trail").html(resposta);
		 
		 } 
	 });
	}
	
 
	
	
	function pega_preloads_trail  () { 

		$.ajax({
		dataType: "html",  
		url: "views/lista_itinerarios.php",  
		type: 'POST',
		data: {
			 
			preloads:  1
		  },
		  

		 error: function() {
			alert("Erro ao gerar Voucher!");
		},
		 success: function(resposta) {
			$("#linha_miolo_trail").html(resposta);
		 
		 } 
	 });
	}
	
 
	
	
	
	
	
	
	
	
	function pega_lista_trail () { 
		
		$.ajax({
		dataType: "html",  
		url: "views/lista_itinerarios.php",  
		 
		error: function() {
			alert("Erro ao inserir o Miolo de Trailfinders!");
		},
		 
		success: function(resposta) {
			$("#linha_miolo_trail").html(resposta);
			 
		} 
		
		
	});

}

	
	function pega_lista_trail2 () { 
		
		$.ajax({
		dataType: "html",  
		url: "lista_itinerarios.php",  
		 
		error: function() {
			alert("Erro ao inserir o Miolo de Trailfinders!");
		},
		 
		success: function(resposta) {
			$("#linha_miolo_trail").html(resposta);
			 
		} 
		
		
	});

}

	function sobe_iti  () { 

		$.ajax({
		dataType: "html",  
		url: "views/lista_itinerarios.php",  
		type: 'POST',
		data: {
			 navega: 1
		  },
		  

		 error: function() {
			alert("Erro ao gerar Voucher!");
		},
		 success: function(resposta) {
			$("#linha_miolo_trail").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	function desce_iti  () { 

		$.ajax({
		dataType: "html",  
		url: "views/lista_itinerarios.php",  
		type: 'POST',
		data: {
			 navega: 2
		  },
		  

		 error: function() {
			alert("Erro ao gerar Voucher!");
		},
		 success: function(resposta) {
			$("#linha_miolo_trail").html(resposta);
		 
		 } 
	 });
	}
	
	
	

	$(document).ready(function() { 
		   
		$("body").delegate("a.pegaiti", "click",  function(){   
	         retrive_iti($(this).children(".pegaiti_value").val());
	     });    
						   
			function retrive_iti (pk_iti) {
					 
                 $.ajax({
							dataType: "html",  
							url: "views/itinerario.php", 
							type: 'POST',
							cache: false,
							data: {
								pk_iti: pk_iti
							},
							error: function() {
								alert("Ocorreu algum erro ao retornar este Itinerario!");
							},
							success: function(resposta) {
								 $("#linha_miolo_trail").html(resposta);
					        } 
                 }); 
				
		 }
	});
		

	$(document).ready(function() { 
		   
		$("body").delegate("a.pegaiti2", "click",  function(){   
	         retrive_iti2($(this).children(".pegaiti_value2").val());
	     });    
						   
			function retrive_iti2 (pk_iti2) {
					 
                 $.ajax({
							dataType: "html",  
							url: "itinerario.php", 
							type: 'POST',
							cache: false,
							data: {
								pk_iti: pk_iti2
							},
							error: function() {
								alert("Ocorreu algum erro ao retornar este Itinerario!");
							},
							success: function(resposta) {
								 $("#linha_miolo_trail").html(resposta);
					        } 
                 }); 
				
		 }
	});
		
	
	
	
	

	$(document).ready(function() { 
		   
		$("body").delegate("a.editi", "click",  function(){   
	         retrive_editi($(this).children(".editi_value").val());
	     });    
						   
			function retrive_editi (pk_editi) {
					 
                 $.ajax({
							dataType: "html",  
							url: "views/edit_itinerario.php", 
							type: 'POST',
							cache: false,
							data: {
								pk_iti: pk_editi
							},
							error: function() {
								alert("Ocorreu algum erro ao retornar este Itinerario!");
							},
							success: function(resposta) {
								 $("#linha_miolo_trail").html(resposta);
					        } 
                 }); 
				
		 }
	});
		
	
	
	
	

	var city_tour;
	var cidade_id;
	var tour;

	$(function() { 
			  $('#city_tour').val("");
	         
			  
		$( "#city_tour" ).autocomplete({
	        source: "../util/busca_cidades.php",
			minLength: 2,
			select: function(event, ui) {
	      $('#cidade_id').val(ui.item.mneu);
	      $('.spinner').hide();
		  } 
			});
		 
		$( "#tour" ).autocomplete({
	         source:
			 function(request, response) {
	                $.ajax({
	                  url: "../util/busca_tour.php",
	                  data: { term: $("#tour").val() , idcidade:  $("#cidade_id").val()},
	                  dataType: "json",
	                  type: "GET",
	                  success: function(data){
	                      response(data);
	                  }
	                });
	              },
			 
			/* "busca_tour.cfm?idcidade=" + $("#cidade_id").val(ui.item.mneu),*/
			 minLength: 2,
			 select: function(event, ui) {
	         $('#tour_id').val(ui.item.mneutour);
		     },
		   close: function enviatour()
	        {
		
	                                           $.ajax({
												dataType: "html", // TIPO DE DATA QUE RETORNARÁ DA REQUISIÇÃO AJAX (xml, html, script, json, jsonp, text)
												url: "miolo_tour.php", // URL DA REQUISIÇÃO AJAX
												//type: "get", // TIPO DE REQUISIÇÃO (get, post, put, delete)
												// DADOS A SEREM ENVIADOS (nome: valor)
												data: {
													 
													tour_id: $("#tour_id").val(),
													desc_tour: $("#desc_tour").val()
												},
												 
												
												// FUNÇÃO ERRO
												error: function() {
													alert("Ocorreu algum erro ao buscar o descritivo do tour!");
												},
												// FUNÇÃO SUCESSO
												success: function(resposta) {
													$("#desc_tourtxt").html(resposta); 
													$("#city_tour").clearField();
													$("#tour").clearField();
												}
											});
			      }
	        });
		
		});

	


	var desc_htl;

	$(function() { 
	    
	    $( "#desc_htl" ).autocomplete({
	        source: 
			 function(request, response) {
	                $.ajax({
	                  url: "../util/busca_hotel.php",
	                  data: { term: $("#desc_htl").val() , idcidade:  $("#cidade_id").val()},
	                  dataType: "json",
	                  type: "GET",
					  // FUNÇÃO ERRO
					  error: function() {
						alert("Error when searching for hotel list!");
							},
	                  success: function(data){
	                      response(data);
	                  }
	                });
	              },
			minLength: 2
		 
			});

	});


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	$(document).ready(function() { 
		   
		$("body").delegate("a.pegaday", "click",  function(){   
	         retrive_pk_dbyd($(this).children(".pegaday_value").val());
	     });    
						   
			function retrive_pk_dbyd (pk_dbyd) {
					 
                 $.ajax({
							dataType: "html",  
							url: "edit_dia.php", 
							type: 'POST',
							cache: false,
							data: {
								pk_dbyd: pk_dbyd
							},
							error: function() {
								alert("Ocorreu algum erro ao retornar este dia do Itinerario!");
							},
							success: function(resposta) {
								 $("#box_form_trail").html(resposta);
					        } 
                 }); 
				
		 }
	});
		
	
	
	
	
	

	$(document).ready(function() { 
		   
		$("body").delegate("a.deliti", "click",  function(){   
			deliti_pk($(this).children(".deliti_value").val());
	     });    
						   
			function deliti_pk (pk_iti_del) {
					 
                 $.ajax({
							dataType: "html",  
							url: "views/delete_iti.php", 
							type: 'POST',
							cache: false,
							data: {
								pk_iti: pk_iti_del
							},
							 beforeSend: function() {
								 var answer = confirm ("Tem certeza que deseja apagar  o Itinerario " + pk_iti_del + " ?")
								 if (answer) {}
									  
								 else
									return false;
								  },
							error: function() {
								alert("Ocorreu algum erro ao apagar este Itinerario!");
							},
							success: function(resposta) {
								 $("#linha_miolo_trail").html(resposta);
					        } 
                 }); 
				
		 }
	});
		
	
		
 
	

	function edit_cadastro_iti  () { 

		$.ajax({
		dataType: "html",  
		url: "edit_cadastro_iti.php",  
		type: 'POST',
		data: {
			pk_iti:  $("#pk_iti").val()
		  },
	    error: function() {
			alert("Erro ao atualizar Itinerario!");
		},
		 success: function(resposta) {
			$("#filtros_trail").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	function update_cad_iti  () { 
	 
	if ($("#preloaded").is(":checked")) {  
		 var preloaded = "true"; 
	 } else {
		 var preloaded = "false";
	 }
   	   
	
		$.ajax({
		dataType: "html",  
		url: "update_cad_iti.php",  
		type: 'POST',
		data: {
			nome_iti: $("#nome_iti").val(),
			nome_cli: $("#nome_cli").val(),
			preloaded: preloaded,
			pk_iti:  $("#pk_iti").val()
		  },
	    error: function() {
			alert("Erro ao atualizar Itinerario!");
		},
		 success: function(resposta) {
			$("#filtros_trail").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	function inserir_conteudo  () { 
	 
	  
	
		$.ajax({
		dataType: "html",  
		url: "insert_dia.php",  
		type: 'POST',
		data: {
			date: $("#date").val(),
			day_n: $("#day_n").val(),
			pk_iti:  $("#pk_iti").val(),
			desc_tour:  $("#desc_tour").val(),
			meals:  $("#meals").val(),
			desc_htl:  $("#desc_htl").val(),
			pk_usuario:  $("#pk_usuario").val(),
            tour_id:  $("#tour_id").val()
		  },
	    error: function() {
			alert("Erro ao atualizar Itinerario!");
		},
		 success: function(resposta) {
				$("#box_forms").html(resposta);
				
				 
                $.ajax({
					dataType: "html",  
					url: "day_by_day.php",  
					type: 'POST',
					data: {
						pk_iti:  $("#pk_iti").val() 
					  },
					 error: function() {
						alert("Erro ao gerar Voucher!");
					},
					 success: function(resposta) {
						$("#dayb_list_iti").html(resposta);
					 
					 } 
				 });
			 
				
			  
			 
			// location.href = "edit_itinerario.php?pk_iti=" +  $("#pk_iti").val()
		 
		 } 
	 });
	}
	
	
	
	
	
	function update_day  () { 
	 
	  
	
		$.ajax({
		dataType: "html",  
		url: "update_day.php",  
		type: 'POST',
		data: {
			date: $("#date").val(),
			day_n: $("#day_n").val(),
			pk_iti:  $("#pk_iti").val(),
			desc_tour:  $("#desc_tour").val(),
			meals:  $("#meals").val(),
			desc_htl:  $("#desc_htl").val(),
			pk_usuario:  $("#pk_usuario").val(),
			pk_dbyd:  $("#pk_dbyd").val()
		  },
	    error: function() {
			alert("Erro ao atualizar Dia!");
		},
		 success: function(resposta) {
			 location.href = "edit_itinerario.php?pk_iti=" +  $("#pk_iti").val()
		 
		 } 
	 });
	}
	
	
	

	$(document).ready(function() { 
		   
		$("body").delegate("a.delday", "click",  function(){   
			delday_pk($(this).children(".delday_value").val());
	     });    
						   
			function delday_pk (pk_dbyd_del) {
					 
                 $.ajax({
							dataType: "html",  
							url: "delete_day.php", 
							type: 'POST',
							cache: false,
							data: {
								pk_usuario:  $("#pk_usuario").val(),
								pk_dbyd: pk_dbyd_del,
								pk_iti:  $("#pk_iti").val()
							},
							 beforeSend: function() {
								 var answer = confirm ("Tem certeza que deseja apagar este dia do Itinerario ")
								 if (answer) {}
									  
								 else
									return false;
								  },
							error: function() {
								alert("Ocorreu algum erro ao apagar este Itinerario!");
							},
							success: function(resposta) {
								 location.href = "edit_itinerario.php?pk_iti=" +  $("#pk_iti").val()
					        } 
                 }); 
				
		 }
	});
		
	
	
	
	function use_file  () { 
	 
	  
	
		$.ajax({
		dataType: "html",  
		url: "use_file.php",  
		type: 'POST',
		data: {
			file: $("#file").val(),
			pk_iti:  $("#pk_iti").val(),
			pk_usuario:  $("#pk_usuario").val() 
		  },
	    error: function() {
			alert("Erro ao atualizar itinerario!");
		},
		 success: function(resposta) {
			 location.href = "edit_itinerario.php?pk_iti=" +  $("#pk_iti").val()
			// $("#box_list_iti").html(resposta); 
		 } 
	 });
	}
	
	