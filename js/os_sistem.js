
function acao_os () { 

				$.ajax({
				dataType: "html",  
				url: "sistem_os/index.php",  
				 
				error: function() {
					alert("Erro ao mostrar o menu de cadastro de OS!");
				},
				 
				success: function(resposta) {
					$("#container_miolo").html(resposta);
					 
				} 
				
				
			});

}

function novo_os () { 

	$.ajax({
	dataType: "html",  
	url: "nova_os.php",  
	 
	error: function() {
		alert("Erro ao mostrar o cadastro de OS!");
	},
	 
	success: function(resposta) {
		$("#dashboard_os").html(resposta);
		 
	} 
	
	
});

}




function gera_os () { 

	$.ajax({
	dataType: "html",  
	url: "gera_os.php",  
	type: 'POST',
	data: {
		file: $("#file").val() 
	  },
	  

	 error: function() {
		alert("Erro ao gerar os!");
	},
	 success: function(resposta) {
		$("#corpo_os").html(resposta);
	 
	 } 
 });
}



function expande_guia () { 

	$.ajax({
	dataType: "html",  
	url: "pega_guia_os.php",  
	type: 'POST',
	data: {
		file: $("#file").val(),
		main_guia: $("#main_guia").val()
	  },
	 error: function() {
		alert("Erro ao pegar guias!");
	},
	 success: function(resposta) {
		$("#miolo_os_linha").html(resposta);
	 
	 } 
 });
}




function envia_os () { 

	$.ajax({
	dataType: "html",  
	url: "envia_os.php",  
	type: 'POST',
	data: {
		
		file: $("#file").val(),
		main_guia: $("#main_guia").val(),
		id_guias1: $("#id_guias1").val(),
		id_guias2: $("#id_guias2").val(),
		id_guias3: $("#id_guias3").val(),
		id_guias4: $("#id_guias4").val(),
		id_guias5: $("#id_guias5").val(),
		id_guias6: $("#id_guias6").val(),
		id_guias7: $("#id_guias7").val(),
		id_guias8: $("#id_guias8").val(),
		id_guias9: $("#id_guias9").val(),
		id_guias10: $("#id_guias10").val(),
		id_guias11: $("#id_guias11").val(),
		id_guias12: $("#id_guias12").val(),
		id_guias13: $("#id_guias13").val(),
		id_guias14: $("#id_guias14").val(),
		id_guias15: $("#id_guias15").val(),
		id_guias16: $("#id_guias16").val(),
		obsemail: $("#obsemail").val()
	  },
	  
	 beforeSend: 
		 function() 
		 { 
		  if ($("#main_guia").val() == "-1")
				 {
					alert("Escolha um guia principal para esta OS");
					return false;
				} 
		  
		  $("#loading").fadeIn("slow"); 
		  
		 },
	  
	  
	 error: function() {
		alert("Erro ao enviar OS!");
	},
	 success: function(resposta) {
		$("#corpo_os").html(resposta);
	 
	 },
	 complete: function() {
			$("#loading").fadeOut("slow");
		} 
 });
}


function adm_os () { 

	$.ajax({
	dataType: "html",  
	url: "adm_os.php",  
	 
	error: function() {
		alert("Erro ao mostrar o cadastro de OS!");
	},
	 
	success: function(resposta) {
		$("#dashboard_os").html(resposta);
		 
	} 
	
	
});

}





$(document).ready(function() { 
	   
	$("body").delegate("a.veros", "click",  function(){   
         retrive_os($(this).children(".verosvalue").val());
     });    
					   
					   
                         function retrive_os (pk_osfile) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "retrieve_os.php", 
										type: 'POST',
										cache: false,
										data: {
											 pk_osfile:  pk_osfile
											
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#dashboard_os").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	






$(document).ready(function() { 
	   
	$("body").delegate("a.editos", "click",  function(){   
         edit_os($(this).children(".editosvalue").val());
     });    
					   
					   
                         function edit_os (edit_osfile) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "edit_os.php", 
										type: 'POST',
										cache: false,
										data: {
											 pk_osfile:  edit_osfile
											
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#dashboard_os").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});



function update_os () { 
	
	
	if ($("#pax_report").is(":checked")) {  
			 var pax_report = "true"; 
		} else {
			 var pax_report = "false";
		}
	
	

	$.ajax({
	dataType: "html",  
	url: "update_os.php",  
	type: 'POST',
	data: {
		pk_osfile: $("#pk_osfile").val(),
		//mudastatus: $("#mudastatus").val(),
		pax_report: pax_report 
		//pk_osnumero: $("#pk_osnumero").val()
	  },
	 error: function() {
		alert("Erro ao pegar guias!");
	},
	 success: function(resposta) {
		$("#updatestatusos").html(resposta);
	 
	 } 
 });
}





$(document).ready(function() { 
	   
	$("body").delegate("a.verprest", "click",  function(){   
         retrive_prest($(this).children(".verprestvalue").val());
     });    
					   
					   
                         function retrive_prest (pk_osfile) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "miolo_cont_prestacao.php", 
										type: 'POST',
										cache: false,
										data: {
											 pk_osfile:  pk_osfile
											
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#dashboard_os").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	
 


function insert_prestacao_srv () { 

	if ($("#recibo").is(":checked")) {  
		 var recibo = "true"; 
	} else {
		 var recibo = "false";
	}
	
	if ($("#prestacao_status").is(":checked")) {  
		 var prestacao_status = "true"; 
	} else {
		 var prestacao_status = "false";
	}
	
	
	$.ajax({
	dataType: "html",  
	url: "insert_prestacao_srv.php",  
	type: 'POST',
	data: {
		valor0: $("#valor0").val(), 
		valor1: $("#valor1").val(), 
		valor2: $("#valor2").val(), 
		valor3: $("#valor3").val(), 
		valor4: $("#valor4").val(), 
		valor5: $("#valor5").val(), 
		valor6: $("#valor6").val(), 
		valor7: $("#valor7").val(), 
		valor8: $("#valor8").val(), 
		valor9: $("#valor9").val(), 
		valor10: $("#valor10").val(), 
		valor11: $("#valor11").val(), 
		valor12: $("#valor12").val(), 
		valor13: $("#valor13").val(), 
		valor14: $("#valor14").val(), 
		valor15: $("#valor15").val(), 
		valor16: $("#valor16").val(), 
		
		pk_osguia0: $("#pk_osguia0").val(), 
		pk_osguia1: $("#pk_osguia1").val(), 
		pk_osguia2: $("#pk_osguia2").val(), 
		pk_osguia3: $("#pk_osguia3").val(), 
		pk_osguia4: $("#pk_osguia4").val(), 
		pk_osguia5: $("#pk_osguia5").val(), 
		pk_osguia6: $("#pk_osguia6").val(), 
		pk_osguia7: $("#pk_osguia7").val(), 
		pk_osguia8: $("#pk_osguia8").val(), 
		pk_osguia9: $("#pk_osguia9").val(), 
		pk_osguia10: $("#pk_osguia10").val(), 
		pk_osguia11: $("#pk_osguia11").val(), 
		pk_osguia12: $("#pk_osguia12").val(), 
		pk_osguia13: $("#pk_osguia13").val(), 
		pk_osguia14: $("#pk_osguia14").val(), 
		pk_osguia15: $("#pk_osguia15").val(), 
		pk_osguia16: $("#pk_osguia16").val(), 
		
		pk_osfile: $("#pk_osfile").val(), 
		pk_osnumero: $("#pk_osnumero").val(), 
		recibo: recibo,
		descritivo: $("#descritivo").val(), 
		valordes: $("#valordes").val(), 
		cod_nf: $("#cod_nf").val(), 
		descritivoopc: $("#descritivoopc").val(),
		cia: $("#cia").val(),
		data: $("#data").val(),
		moeda: $("#moeda").val(),
		npax: $("#npax").val(),
		valor: $("#valor").val(),
		comiss: $("#comiss").val(),
		tp_receb: $("#tp_receb").val(),
		prestacao_status: prestacao_status
		
		
	},
	  

	 error: function() {
		alert("Erro ao gerar os!");
	},
	 success: function(resposta) {
		$("#dashboard_os").html(resposta);
	 
	 } 
 });
}




$(document).ready(function() { 
	   
	$("body").delegate("a.deldespesa", "click",  function(){   
		apagadespesas_os($(this).children(".deldespesaValue").val());
     });    
					   
					   
                         function apagadespesas_os (apagadespesas) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "deldespesas.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_osdes:  apagadespesas,
											pk_osfile: $("#pk_osfile").val(),
											pk_osnumero: $("#pk_osnumero").val()
										},
										 
										 beforeSend: function() {
											 var answer = confirm ("Tem certeza que deseja apagar esta despesa?")
											 if (answer) {}
												  
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
									 
										 success: function(resposta) {
											 $("#dashboard_os").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});


$(document).ready(function() { 
	   
	$("body").delegate("a.editdespesa", "click",  function(){   
		editdespesas_os($(this).children(".editdespesaValue").val());
     });    
					   
					   
                         function editdespesas_os (editdespesas) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "editdespesas.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_osdes:  editdespesas,
											pk_osfile: $("#pk_osfile").val() 
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
									 
										 success: function(resposta) {
											 $("#edit_despesas").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});


function update_despesa () { 

	if ($("#recibo").is(":checked")) {  
		 var recibo = "true"; 
	} else {
		 var recibo = "false";
	}
	
	
	$.ajax({
	dataType: "html",  
	url: "update_despesa.php",  
	type: 'POST',
	data: {
		pk_osfile: $("#pk_osfile").val(),
		recibo: recibo,
		descritivo: $("#descritivo").val(), 
		valordes: $("#valordes").val(),
		pk_osdes: $("#pk_osdes").val(),
		cod_nf: $("#cod_nf").val(),
		pk_osnumero: $("#pk_osnumero").val()
		
	  },
	  

	 error: function() {
		alert("Erro ao gerar os!");
	},
	 success: function(resposta) {
		$("#dashboard_os").html(resposta);
	 
	 } 
 });
}


$(document).ready(function() { 
	   
	$("body").delegate("a.delopc", "click",  function(){   
		delopc_os($(this).children(".delopcValue").val());
     });    
					   
					   
                         function delopc_os (delopcio) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "deleteopcionais.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_opc:  delopcio,
											pk_osfile: $("#pk_osfile").val(),
											pk_osnumero: $("#pk_osnumero").val() 
										},
										 
										 beforeSend: function() {
											 var answer = confirm ("Tem certeza que deseja apagar este opcional?")
											 if (answer) {}
												  
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
											  
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
									 
										 success: function(resposta) {
											 $("#dashboard_os").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});






$(document).ready(function() { 
	   
	$("body").delegate("a.editopc", "click",  function(){   
		editopc_os($(this).children(".editopcValue").val());
     });    
					   
					   
                         function editopc_os (editopcio) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "edit_opcionais.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_opc:  editopcio,
											pk_osfile: $("#pk_osfile").val(),
											pk_osnumero: $("#pk_osnumero").val() 
										},
										 
										 error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
									 
										 success: function(resposta) {
											 $("#edit_opcionais").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});






function insert_update_opcionais () { 

 
	
	$.ajax({
	dataType: "html",  
	url: "insert_update_opcionais.php",  
	type: 'POST',
	data: {
		pk_osfile: $("#pk_osfile").val(),
		pk_opc: $("#pk_opc").val(), 
		descritivoopc: $("#descritivoopc").val(),
		cia: $("#cia").val(),
		data: $("#data").val(),
		moeda: $("#moeda").val(),
		npax: $("#npax").val(),
		valor: $("#valor").val(),
		comiss: $("#comiss").val(),
		tp_receb: $("#tp_receb").val(),
		pk_osnumero: $("#pk_osnumero").val()
	  },
	  

	 error: function() {
		alert("Erro ao gerar os!");
	},
	 success: function(resposta) {
		$("#dashboard_os").html(resposta);
	 
	 } 
 });
}




function update_status_os () { 

	if ($("#os_status_financeiro").is(":checked")) {  
		 var os_status_financeiro = "2"; 
	} else {
		 var os_status_financeiro = "1";
	}
	
	
	$.ajax({
	dataType: "html",  
	url: "update_status_financeiro.php",  
	type: 'POST',
	data: {
		pk_osfile: $("#pk_osfile").val(),
		pk_osnumero: $("#pk_osnumero").val(), 
		os_status_financeiro: os_status_financeiro
	  },
	  

	 error: function() {
		alert("Erro ao gerar os!");
	},
	 success: function(resposta) {
		$("#os_linha_status").html(resposta);
	 
	 } 
 });
}



function atualizado () { 

 
	
	$.ajax({
	 
		 beforeSend: function() {
		            $("#loading").fadeIn("slow");
			  },
	   complete: function() {
			$("#loading").fadeOut("slow");
		}
  

 });
}




$(document).ready(function() { 
	   
	$("body").delegate("a.redirect", "click",  function(){   
         redirect_guide($(this).children(".redirectvalue").val());
     });    
					   
					   
                         function redirect_guide (pk_osguia) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "select_new_guide.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_osguia:  pk_osguia
											
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao selecionar um novo guia!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#redirect_line").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	



function change_guide () { 
 
	
	$.ajax({
	dataType: "html",  
	url: "change_guide.php",  
	type: 'POST',
	data: {
		pk_osguia: $("#pk_osguia").val(),
		pk_osfile: $("#pk_osfile").val(), 
		main_guia: $("#main_guia").val()
	  },
	  

	 error: function() {
		alert("Erro ao alterar um guia !");
	},
	 success: function(resposta) {
		$("#dashboard_os").html(resposta);
	 
	 } 
 });
}




function relatorio_os () { 

				$.ajax({
				dataType: "html",  
				url: "mapa_os.php",  
				 
				error: function() {
					alert("Erro ao mostrar o Mapa de OS!");
				},
				 
				success: function(resposta) {
					$("#dashboard_os").html(resposta);
					 
				} 
				
				
			});

}


	