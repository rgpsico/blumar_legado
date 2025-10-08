	function acao_contatos () { 

						$.ajax({
						dataType: "html",  
						url: "miolo_contatos.php",  
						
						error: function() {
							alert("Error ao mostrar a página principal de Contatos!");
						},
						 
						success: function(resposta) {
							$("#container_miolo").html(resposta);
							 
						} 
						
						
					});

	}
	
	


	$(document).ready(function() { 

		
		$("body").delegate("a.contato", "click",  function(){   
			busca_contato($(this).children(".contatoValue").val());
	     });    
			 
		
	});
				   
	                 function busca_contato (idcontato) {
					 

								   $.ajax({
									dataType: "html", 
									url: "retrieve_contato.php", 
									cache: false,
									data: {
										 
										codcontato: idcontato,
										valorstatus: $("#valorstatus").val(),
										advancedsearch: $("#advancedsearch").val()
										
									},
									 
									
									// FUN��O ERRO
									error: function() { 
										alert("An error occur when retrieving contact!");
									},
									// FUN��O SUCESSO
									 success: function(resposta) {
											$("#mapa-eco").html(resposta);
											$("#mapa-eco").modal(
													{
														overlayClose:true, 
														containerCss:{
															 height:700,
															 width:890
															 }
															 
														});
										 
									 },
									  complete: function() {
										$("#loading").fadeOut("slow");
									} 
			 }); 

	}

	                 
 function updatecontato(  ) { 
	                	 if ($("#news1").is(":checked")) {  
	            			 var news1 = "true"; 
	            		} else {
	            			 var news1 = "false";
	            		}
	            			
	            	 if ($("#news2").is(":checked")) {  
	            		 var news2 = "true"; 
	            	} else {
	            		 var news2 = "false";
	            	}
	            		
	            	 if ($("#news3").is(":checked")) {  
	            		 var news3 = "true"; 
	            	} else {
	            		 var news3 = "false";
	            	} 
	            	 
	            	 
	            	 if ($("#pu1").is(":checked")) {  
	            		 var pu1 = "true"; 
	            	} else {
	            		 var pu1 = "false";
	            	} 
	            	 
	            	 if ($("#pu2").is(":checked")) {  
	            		 var pu2 = "true"; 
	            	} else {
	            		 var pu2 = "false";
	            	} 
	            	 
	            	 if ($("#pu3").is(":checked")) {  
	            		 var pu3 = "true"; 
	            	} else {
	            		 var pu3 = "false";
	            	} 
	            	  	
	            	 if ($("#divulgado").is(":checked")) {  
	            		 var divulgado = "true"; 
	            	} else {
	            		 var divulgado = "false";
	            	} 
	            	 
	                        $.ajax({
	                        	dataType: "html", 
	                        	url: "update_contato.php", 
	                            type: "POST",
	                        	data: {
	                        		 
	                        		tratamento: $("#tratamento").val(),
	                         		nome: $("#nome").val(),
	                         		segundo_nome: $("#segundo_nome").val(),
	                         		sobrenome: $("#sobrenome").val(),
	                         		empresa: $("#empresa").val(),
	                         		cargo: $("#cargo").val(),
	                         		rede: $("#rede").val(),
	                         		telefone: $("#telefone").val(),
	                         		telefone1: $("#telefone1").val(),
	                         		telefone2: $("#telefone2").val(),
	                         		telefone3: $("#telefone3").val(),
	                         		celular: $("#celular").val(),
	                         		fax: $("#fax").val(),
	                         		email1: $("#email1").val(),
	                         		email2: $("#email2").val(),
	                         		email3: $("#email3").val(),
	                         		obsemail1: $("#obsemail1").val(),
	                         		obsemail2: $("#obsemail2").val(),
	                         		obsemail3: $("#obsemail3").val(),
	                         		news1: news1,
	                         		news2: news2,
	                         		news3: news3,
	                         		pu1: pu1,
	                         		pu2: pu2,
	                         		pu3: pu3,
	                         		url: $("#url").val(),
	                         		endereco: $("#endereco").val(),
	                         		cidade: $("#cidade").val(),
	                         		estado: $("#estado").val(),
	                         		pais: $("#pais").val(),
	                         		cep: $("#cep").val(),
	                         		origem: $("#origem").val(),
	                         		categoria: $("#categoria").val(),
	                         		notas: $("#notas").val(),
	                        	    id: $("#id").val(),
	                        	    valorstatus: $("#valorstatus").val(),
	                        	    advancedsearch: $("#advancedsearch").val(),
	                        	    divulgado: divulgado,
	                        	    mneu_for: $("#mneu_for").val(),
	                         		mneu_cli: $("#mneu_cli").val()
	                        	},
	                        	 beforeSend: function() {
	                        		 $("#loading").fadeIn("slow");
	                        	 },
	                        	// FUN��O ERRO
	                        	error: function() {
	                        		alert("Erro ao inserir o contato!");
	                        	},
	                        	// FUN��O SUCESSO
	                        	success: function(resposta) {
	                        		$("#miolo-contatos").html(resposta);
	                        		$("#mapa-eco").fadeOut("slow");
	                        		$.modal.close(); 
	                        	},
	                        	complete: function() {
	                        		$("#loading").fadeOut("slow");
	                        	} 
	                        	
	                        	
	                        	
	                        });

	               }

	                 
 
 
 
 
 function  delcontato( ) { 
	                		
	                 
	                        		
	                        $.ajax({
	                        	dataType: "html", 
	                        	url: "delete_contato.php", 
	                            type: 'POST',
	                        	data: {
	                        		valorstatus: $("#valorstatus").val(),
	                        		advancedsearch: $("#advancedsearch").val(),
	                        		id: $("#id").val() 
	                        	},
	                        	 beforeSend: function() {
	                        		 
	                        		 var answer = confirm ("Tem certeza que deseja apagar este contato?")
									 if (answer) {}
										  
									 else
										return false;
										 
	                        		 
	                        		 
	                        		 
	                        		 $("#loading").fadeIn("slow");
	                        	 },
	                        	// FUN��O ERRO
	                        	error: function() {
	                        		alert("Erro ao apagar contato!");
	                        	},
	                        	// FUN��O SUCESSO
	                        	success: function(resposta) {
	                        		$("#miolo-contatos").html(resposta);
	                        		$("#mapa-eco").fadeOut("slow");
	                        		$.modal.close(); 
	                        	},
	                        	complete: function() {
	                        		$("#loading").fadeOut("slow");
	                        	} 
	                        	
	                        	
	                        	
	                        });

	               }
 
 
 
 
 
 
 
 
 
 
 
 
	                 
	                 function buscaformcontato(  ) { 
	                		
	                		$.ajax({
	                		dataType: "html", 
	                		url: "form_contato.php",

	                		cache: false,
	                	 
	                		 beforeSend: function() {
	                			 $("#loading").fadeIn("slow");
	                		 },
	                		// FUN��O ERRO
	                		error: function() {
	                			alert("Erro ao buscar o formulario!");
	                		},
	                		// FUN��O SUCESSO
	                		success: function(resposta) {
	                			$("#miolo").html(resposta);
	                			 
	                		},
	                		complete: function() {
	                			$("#loading").fadeOut("slow");
	                		} 
	                		
	                		
	                		
	                	});

	                	}

	                 
	                                 
	                 
	                 
 function  inserecategoria( ) { 
	                		
	                 
	                        		
	                        $.ajax({
	                        	dataType: "html", 
	                        	url: "insere_categoria.php", 
	                           
	                            type: 'POST',
	                        	data: {
	                        		new_cat: $("#new_cat").val() 
	                        	},
	                        	 beforeSend: function() {
	                        		 $("#loading").fadeIn("slow");
	                        	 },
	                        	// FUN��O ERRO
	                        	error: function() {
	                        		alert("Erro ao inserir o categoria!");
	                        	},
	                        	// FUN��O SUCESSO
	                        	success: function(resposta) {
	                        		$("#box-form-tipocontato").html(resposta);
	                        	 
	                        	},
	                        	complete: function() {
	                        		$("#loading").fadeOut("slow");
	                        	} 
	                        	
	                        	
	                        	
	                        });

	               }
 
 
     
 function  insererede( ) { 
	                		
		                 
                 		
	                        $.ajax({
	                        	dataType: "html", 
	                        	url: "insere_rede.php", 
	                            cache: false,
	                            type: 'POST',
	                        	data: {
	                        		new_rede: $("#new_rede").val() 
	                        	},
	                        	 beforeSend: function() {
	                        		  $("#loading").fadeIn("slow");
	                        	 },
	                        	// FUN��O ERRO
	                        	error: function() {
	                        		alert("Erro ao inserir o categoria!");
	                        	},
	                        	// FUN��O SUCESSO
	                        	success: function(resposta) {
	                        		$("#box-form-tiporede").html(resposta);
	                        	 
	                        	},
	                        	complete: function() {
	                        		$("#loading").fadeOut("slow");
	                        	} 
	                        	
	                        	
	                        	
	                        });

	               }
  
 
 
 
 function  inserecontato( ) { 
		
	 if ($("#news1").is(":checked")) {  
			 var news1 = "true"; 
		} else {
			 var news1 = "false";
		}
			
	 if ($("#news2").is(":checked")) {  
		 var news2 = "true"; 
	} else {
		 var news2 = "false";
	}
		
	 if ($("#news3").is(":checked")) {  
		 var news3 = "true"; 
	} else {
		 var news3 = "false";
	} 
	 
	 
	 if ($("#pu1").is(":checked")) {  
		 var pu1 = "true"; 
	} else {
		 var pu1 = "false";
	} 
	 
	 if ($("#pu2").is(":checked")) {  
		 var pu2 = "true"; 
	} else {
		 var pu2 = "false";
	} 
	 
	 if ($("#pu3").is(":checked")) {  
		 var pu3 = "true"; 
	} else {
		 var pu3 = "false";
	} 
	  
	 
	 if ($("#divulgado").is(":checked")) {  
		 var divulgado = "true"; 
	} else {
		 var divulgado = "false";
	} 
	 
     $.ajax({
     	dataType: "html", 
     	url: "insere_contato.php", 
        type: 'POST',
     	data: {
     		tratamento: $("#tratamento").val(),
     		nome: $("#nome").val(),
     		segundo_nome: $("#segundo_nome").val(),
     		sobrenome: $("#sobrenome").val(),
     		empresa: $("#empresa").val(),
     		cargo: $("#cargo").val(),
     		rede: $("#rede").val(),
     		telefone: $("#telefone").val(),
     		telefone1: $("#telefone1").val(),
     		telefone2: $("#telefone2").val(),
     		telefone3: $("#telefone3").val(),
     		celular: $("#celular").val(),
     		fax: $("#fax").val(),
     		email1: $("#email1").val(),
     		email2: $("#email2").val(),
     		email3: $("#email3").val(),
     		obsemail1: $("#obsemail1").val(),
     		obsemail2: $("#obsemail2").val(),
     		obsemail3: $("#obsemail3").val(),
     		news1: news1,
     		news2: news2,
     		news3: news3,
     		pu1: pu1,
     		pu2: pu2,
     		pu3: pu3,
     		url: $("#url").val(),
     		endereco: $("#endereco").val(),
     		cidade: $("#cidade").val(),
     		estado: $("#estado").val(),
     		pais: $("#pais").val(),
     		cep: $("#cep").val(),
     		origem: $("#origem").val(),
     		categoria: $("#categoria").val(),
     		notas: $("#notas").val(),
     		mneu_for: $("#mneu_for").val(),
     		mneu_cli: $("#mneu_cli").val(),
     		divulgado: divulgado
     	},
     	 beforeSend: function() {
     		 $("#loading").fadeIn("slow");
     	 },
     	// FUN��O ERRO
     	error: function() {
     		alert("Erro ao inserir o categoria!");
     	},
     	// FUN��O SUCESSO
     	success: function(resposta) {
     		$("#miolo").html(resposta);
     	 
     	},
     	complete: function() {
     		$("#loading").fadeOut("slow");
     	} 
     	
     	
     	
     });

}
 
 
 
 
 

 function buscalistagem(  ) { 
 	
 	$.ajax({
 	dataType: "html", 
 	url: "listagem.php",
    beforeSend: function() {
 		 $("#loading").fadeIn("slow");
 	 },
 	// FUN��O ERRO
 	error: function() {
 		alert("Erro ao buscar o formulario!");
 	},
 	// FUN��O SUCESSO
 	success: function(resposta) {
 		$("#miolo").html(resposta);
 		 
 	},
 	complete: function() {
 		$("#loading").fadeOut("slow");
 	} 
 	
 	
 	
 });

 }

 

 
 $(document).ready(function() { 

		
//		script para a parte de busca corrida de A a Z
		     
			
		   $("body").delegate("a.sobe", "click",  function(){   
			   pega_navega($(this).children(".sobeValue").val());
            });  
		
		
		
		
	});
				   
	                 function pega_navega (idnavega) {
					 

								   $.ajax({
									dataType: "html", 
									url: "miolo-navagacao.php", 
									cache: false,
									data: {
										 
										codnavega: idnavega
								     },
									 
									
									// FUN��O ERRO
									error: function() { 
										alert("An error occur when deleting the citie!");
									},
									// FUN��O SUCESSO
									 success: function(resposta) {
											$("#miolo-contatos").html(resposta);
											 
									 },
									  complete: function() {
										$("#loading").fadeOut("slow");
									} 
			 }); 

	}

	                 
	             	      
	                 
	//  script para a parte de busca por uma letra               
	  $(document).ready(function() { 

	                 			
		                $("body").delegate("a.letra", "click",  function(){   
		                	pega_letra($(this).children(".letraValue").val());
		                 });  
	                		
	                		
	                	});
	                				   
	                	                 function pega_letra (idletra) {
	                					 

	                								   $.ajax({
	                									dataType: "html", 
	                									url: "miolo-navagacao.php", 
	                									cache: false,
	                									data: {
	                										 
	                										codnavega: idletra
	                									 },
	                									 // FUN��O ERRO
	                									error: function() { 
	                										alert("An error occur when deleting the citie!");
	                									},
	                									// FUN��O SUCESSO
	                									 success: function(resposta) {
	                											$("#miolo-contatos").html(resposta);
	                											 
	                									 },
	                									  complete: function() {
	                										$("#loading").fadeOut("slow");
	                									} 
	                			 }); 

	                	}
	                	                 
	                	                 
	                	                 

    	                 function buscacontato ( ) {
    					 
            	                	 if ($("#divulgadoav").is(":checked")) {  
            		            		 var divulgadoav = "true"; 
            		            	} else {
            		            		 var divulgadoav = "false";
            		            	} 
    	                	 
            	                	 if ($("#newsav").is(":checked")) {  
            		            		 var newsav = "true"; 
            		            	} else {
            		            		 var newsav = "false";
            		            	}
            	                	
            	                	 
            	                	 if ($("#puav").is(":checked")) {  
            		            		 var puav = "true"; 
            		            	} else {
            		            		 var puav = "false";
            		            	}
            	                	 
            	                	 
    	                	 

    								   $.ajax({
    									dataType: "html", 
    									url: "miolo-busca-avancada.php",
    									type: 'POST',
    									cache: false,
    									data: {
    										 divulgadoav: divulgadoav,
    										 newsav: newsav,
    										 puav: puav,
    										 codbuscavancada: $("#navega").val() + "," + $("#paisav").val() + "," + $("#origemav").val() + "," + $("#intav").val() + "," + $("#inicio").val()  
    								     },
    									 
    								     beforeSend: function() {
    							     		 $("#loading").fadeIn("slow");
    							     	 },
    									// FUN��O ERRO
    									error: function() { 
    										alert("Erro ao solicitar a busca!");
    									},
    									// FUN��O SUCESSO
    									 success: function(resposta) {
    											$("#miolo-contatos").html(resposta);
    											 
    									 },
    									  complete: function() {
    										$("#loading").fadeOut("slow");
    									} 
    			                       }); 

	   }
	             	               
	                	                 

    	                 function gera_mailing ( ) {
    					 
            	                	 if ($("#divulgadoav").is(":checked")) {  
            		            		 var divulgadoav = "true"; 
            		            	} else {
            		            		 var divulgadoav = "false";
            		            	} 
    	                	 
            	                	 if ($("#newsav").is(":checked")) {  
            		            		 var newsav = "true"; 
            		            	} else {
            		            		 var newsav = "false";
            		            	}
            	                	
            	                	 
            	                	 if ($("#puav").is(":checked")) {  
            		            		 var puav = "true"; 
            		            	} else {
            		            		 var puav = "false";
            		            	}
            	                	 
            	                	 
    	                	 

    								   $.ajax({
    									dataType: "html", 
    									url: "monta_mailing.php",
    									type: 'POST',
    									cache: false,
    									data: {
    										 divulgadoav: divulgadoav,
    										 newsav: newsav,
    										 puav: puav,
    										 codbuscavancada: $("#navega").val() + "," + $("#paisav").val() + "," + $("#origemav").val() + "," + $("#intav").val() + "," + $("#inicio").val()  
    								     },
    									 
    								     beforeSend: function() {
    							     		 $("#loading").fadeIn("slow");
    							     	 },
    									// FUN��O ERRO
    									error: function() { 
    										alert("Erro ao solicitar a busca!");
    									},
    									// FUN��O SUCESSO
    									 success: function(resposta) {
    											$("#miolo").html(resposta);
    											 
    									 },
    									  complete: function() {
    										$("#loading").fadeOut("slow");
    									} 
    			                       }); 

	   }
	             	               
	          
    	                 $("body").delegate("a.mudaos", "click",  function(){   
    	                     retrive_os($(this).children(".mudaos_value").val());
    	                 });                  
    	                 
	                	                 
//	    script para a parte de busca corrida de A a Z
	      
	           $(document).ready(function() { 
	         
	                	             		
	                $("body").delegate("a.sobeavan", "click",  function(){   
	                	pega_navegaavan($(this).children(".sobeavanValue").val());
	                 });    
	                
	                
	                
	                	             });
	                	             			   
	                	                              function pega_navegaavan (idnavegaavan) {
	                	             				 

	                	             							   $.ajax({
	                	             								dataType: "html", 
	                	             								url: "miolo-busca-avancada.php", 
	                	             								type: 'POST',
	                	             								cache: false,
	                	             								data: {
	                	             									 
	                	             									codbuscavancada: idnavegaavan
	                	             							     },
	                	             								 
	                	             								
	                	             								// FUN��O ERRO
	                	             								error: function() { 
	                	             									alert("An error occur when deleting the citie!");
	                	             								},
	                	             								// FUN��O SUCESSO
	                	             								 success: function(resposta) {
	                	             										$("#miolo-contatos").html(resposta);
	                	             										 
	                	             								 },
	                	             								  complete: function() {
	                	             									$("#loading").fadeOut("slow");
	                	             								} 
	                	             		 }); 

	                	             }
	          	                 
	                	                 


var busca;

$(function() { 
	$('#busca').val("");
	$("#busca").autocomplete({
	source: "busca_contato.php",
	minLength: 1, 
	select: function(event, ui) {
	$('#codcont').val(ui.item.id);
	$('#codtipo').val(ui.item.tipo);
	},
	    close: 	function enviarForm() {
	        $.ajax({
	        dataType: "html",  
	        url: "miolo-navagacao.php",  
	        cache: false,
	        data: {
	              codnavega:  $("#codnavega").val() + "," + $("#codtipo").val() + "," + $("#codcont").val() + "," + $("#codinicio").val() 
	        },
	        beforeSend: function() {
	              $("#loading").fadeIn("slow");
	          },
	         error: function() {
	               alert("Ocorreu algum erro ao buscar o contato!");
	              },
	         success: function(resposta) {
	                  $("#miolo-contatos").html(resposta);
	               },
	          complete: function() {
	        	     $("#loading").fadeOut("slow");
	        	     response(data);
	        	   
	        	      
	          }
	       });
	        
	  },
	  complete: function(data) {
 	   
 	     response(data);
 	   
 	      
   }
	
	 });
});

	
 

function  pega_produpdate_mailing( ) { 
	
    
		
    $.ajax({
    	dataType: "html", 
    	url: "monta_produpdate_mailing.php", 
        cache: false,
        type: 'POST',
    	data: {
    		pk_recep_news: $("#pk_recep_news").val() 
    	},
    	 beforeSend: function() {
    		  $("#loading").fadeIn("slow");
    	 },
    	// FUN��O ERRO
    	error: function() {
    		alert("Erro ao pegar product update!");
    	},
    	// FUN��O SUCESSO
    	success: function(resposta) {
    		$("#miolo-textarea").html(resposta);
    	 
    	},
    	complete: function() {
    		$("#loading").fadeOut("slow");
    	} 
    	
    	
    	
    });

}


function  pega_news_mailing( ) { 
	
    
	
    $.ajax({
    	dataType: "html", 
    	url: "monta_news_mailing.php", 
        cache: false,
        type: 'POST',
    	data: {
    		pk_news: $("#pk_news").val() 
    	},
    	 beforeSend: function() {
    		  $("#loading").fadeIn("slow");
    	 },
    	// FUN��O ERRO
    	error: function() {
    		alert("Erro ao pegar product update!");
    	},
    	// FUN��O SUCESSO
    	success: function(resposta) {
    		$("#miolo-textarea").html(resposta);
    	 
    	},
    	complete: function() {
    		$("#loading").fadeOut("slow");
    	} 
    	
    	
    	
    });

}




function  enviar_mailing_contatos( ) { 
	
	var enderecos = $("input[id='add']")
    .map(function(){return $(this).val();}).get();
	
	//var content = CKEDITOR.instances.editor1.getData();
	
	
	
    $.ajax({
    	dataType: "html", 
    	url: "envia_mailing_contatos.php", 
        cache: false,
        type: 'POST',
    	data: {
    		editor1:  $("#editor1").val(),
    		subject: $("#subject").val(),
    	    emails:enderecos
    		
    	},
    	 beforeSend: function() {
    		  $("#loading").fadeIn("slow");
    	 },
    	// FUN��O ERRO
    	error: function() {
    		alert("Erro ao pegar product update!");
    	},
    	// FUN��O SUCESSO
    	success: function(resposta) {
    		$("#miolo").html(resposta);
    	 
    	},
    	complete: function() {
    		$("#loading").fadeOut("slow");
    	} 
    	
    	
    	
    });

}








Shadowbox.init({modal: true}); 
function swaptabs (showthis, hidethis) {
	var style2 = document.getElementById(showthis).style;style2.display = "block";
	var style3 = document.getElementById(hidethis).style;style3.display = "none";
}  

 

 
 