
function acao_clientes () { 

				$.ajax({
				dataType: "html",  
				url: "clientes/miolo_clientes.php",  
				 beforeSend: function() {   $("#loading").fadeIn("slow");  },
				error: function() {
					alert("Erro ao mostrar o menu de Clientes!");
				},
				 success: function(resposta) {
					$("#container").html(resposta);
				 },
				   complete: function() { $("#loading").fadeOut("slow"); } 
			 });
 }




function novo_cliente () { 

				$.ajax({
				dataType: "html",  
				url: "form_novo_cliente.php",
				type: 'POST',
				data: { url_status_cliente: 4  },
				error: function() {
					alert("Erro ao mostrar o formulario de Clientes!");
				},
				 success: function(resposta) {
					$("#diplay_clientes").html(resposta);
				 } 
			 });
 }




function pega_clientes_ativos () { 

	$.ajax({
	dataType: "html",  
	url: "miolo_clientes.php",  
	type: 'POST',
	data: { filtro_status_cliente: $("#filtro_status_cliente").val()   },
	beforeSend: function() { $("#loading").fadeIn("slow"); },
	error: function() {alert("Erro ao mostrar o formulario de Clientes!"); },
	success: function(resposta) { $("#container_conteudo").html(resposta); },
	complete: function() { $("#loading").fadeOut("slow"); }  
 });
}


function pega_clientes_nucleo () { 

	$.ajax({
	dataType: "html",  
	url: "miolo_clientes.php",  
	type: 'POST',
	data: { pk_nucleo: $("#pk_nucleo").val() },
	beforeSend: function() {   $("#loading").fadeIn("slow");  }, 
	error: function() { alert("Erro ao mostrar o formulario de Clientes!"); },
	success: function(resposta) { $("#container_conteudo").html(resposta); },
	complete: function() { $("#loading").fadeOut("slow"); }  
 });
}





function pega_clientes_logo () { 

	$.ajax({
	dataType: "html",  
	url: "miolo_clientes.php",  
	type: 'POST',
	data: {tp_logo: $("#tp_logo").val() },
	beforeSend: function() {   $("#loading").fadeIn("slow");  }, 
	error: function() { alert("Erro ao mostrar o formulario de Clientes!"); },
	success: function(resposta) { $("#container_conteudo").html(resposta); },
	complete: function() { $("#loading").fadeOut("slow"); }   
 });
}





function pega_tp_sistemas () { 

	$.ajax({
	dataType: "html",  
	url: "miolo_clientes.php",  
	type: 'POST',
	data: { tp_sistemas: $("#tp_sistemas").val() },
	beforeSend: function() {   $("#loading").fadeIn("slow");  }, 
	error: function() { alert("Erro ao mostrar o formulario de Clientes!"); },
	success: function(resposta) { $("#container_conteudo").html(resposta); } ,
	complete: function() { $("#loading").fadeOut("slow"); }  
 });
}







function pega_clientes_sistema () { 

				$.ajax({
				dataType: "html",  
				url: "pega_clientes_sistema.php",  
				type: 'POST',
				data: { emp: $("#emp").val() },
			    error: function() { alert("Erro ao mostrar o formulario de Clientes!"); },
				 success: function(resposta) {
					$("#select_clientes").html(resposta);
				 
				 } 
			 });
				
				
	
				
 }




function carrega_form_imagem () { 

	$.ajax({
	dataType: "html",  
	url: "iframeimagem.php",  
	type: 'POST',
	data: {
		cli: $("#cli").val() 
	  },
	 error: function() {
		alert("Erro ao mostrar o formulario de imagens!");
	},
	 success: function(resposta) {
		$("#logocliente").html(resposta);
	 
	 } 
  });
	
 
	$.ajax({
		dataType: "html",  
		url: "nome_cliente_avulso.php",  
		type: 'POST',
		data: {
			cli: $("#cli").val() 
		  },
		 error: function() {
			alert("Erro ao mostrar o formulario de imagens!");
		},
		 success: function(resposta) {
			$("#nome_clientes").html(resposta);
		 
		 } 
	 });
	
	
	$.ajax({
		dataType: "html",  
		url: "iframeimagem2.php",  
		type: 'POST',
		data: {
			cli: $("#cli").val() 
		  },
		 error: function() {
			alert("Erro ao mostrar o formulario de imagens!");
		},
		 success: function(resposta) {
			$("#logocliente2").html(resposta);
		 
		 } 
	  });
		
	
	
}






function insert_cliente () { 

	   if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
	   	   
	   if ($("#ativar_usuario_no_salesystem").is(":checked")) {  
			 var ativar_usuario_no_salesystem = "true"; 
		 } else {
			 var ativar_usuario_no_salesystem = "false";
		 }
		   
	   if ($("#desativar_reservas_online").is(":checked")) {  
			 var desativar_reservas_online = "true"; 
		 } else {
			 var desativar_reservas_online = "false";
		 }
	
	   if ($("#desativar_tarifario").is(":checked")) {  
			 var desativar_tarifario = "true"; 
		 } else {
			 var desativar_tarifario = "false";
		 }
	   	   
	   if ($("#usa_allotment").is(":checked")) {  
			 var usa_allotment = "true"; 
		 } else {
			 var usa_allotment = "false";
		 }
	   
	   if ($("#extranet").is(":checked")) {  
			 var extranet = "true"; 
		 } else {
			 var extranet = "false";
		 }
	 	   
	   if ($("#ativo_cote").is(":checked")) {  
			 var ativo_cote = "true"; 
		 } else {
			 var ativo_cote = "false";
		 }
	   	   
	   if ($("#ativo_virtuoso").is(":checked")) {  
			 var ativo_virtuoso = "true"; 
		 } else {
			 var ativo_virtuoso = "false";
		 }
	   
	    
	   if ($("#consome_allotment").is(":checked")) {  
			 var consome_allotment = "true"; 
		 } else {
			 var consome_allotment = "false";
		 }
	   	   
	   if ($("#disponibilizar_datas_em_servicos").is(":checked")) {  
			 var disponibilizar_datas_em_servicos = "true"; 
		 } else {
			 var disponibilizar_datas_em_servicos = "false";
		 }
	   
 
	   if ($("#conteudo_riolife").is(":checked")) {  
			 var conteudo_riolife = "true"; 
		 } else {
			 var conteudo_riolife = "false";
		 }
	   	   
		 if ($("#bco_img").is(":checked")) {  
			var bco_img = "true"; 
		} else {
			var bco_img = "false";
		}
    
	
	$.ajax({
	dataType: "html",  
	url: "insert_cliente.php",  
	type: 'POST',
	data: {
		emp: $("#emp").val(),
		cli: $("#cli").val(),
		logo: $('#logo').val(),
		lang: $("#lang").val(),
		moeda: $("#moeda").val(),
		nucleo: $("#nucleo").val(),
		root_htl: $("#root_htl").val(),
		root_htl2: $("#root_htl2").val(),
		mkp_food: $("#mkp_food").val(),
		mkp_srv: $("#mkp_srv").val(),
		mkp_htl: $("#mkp_htl").val(),
		mkp_eco: $("#mkp_eco").val(),
		mkp_ny: $("#mkp_ny").val(),
		mkp_carn: $("#mkp_carn").val(),
		mkp_winn: $("#mkp_winn").val(),
		mkp_food2: $("#mkp_food2").val(),
		mkp_srv2: $("#mkp_srv2").val(),
		mkp_htl2: $("#mkp_htl2").val(),
		mkp_eco2: $("#mkp_eco2").val(),
		mkp_ny2: $("#mkp_ny2").val(),
		mkp_carn2: $("#mkp_carn2").val(),
		mkp_winn2: $("#mkp_winn2").val(),
		descricao_tar: $("#descricao_tar").val(),
		email: $("#email").val(),
		ativo: ativo,
		ativar_usuario_no_salesystem: ativar_usuario_no_salesystem,
		desativar_reservas_online: desativar_reservas_online,
		desativar_tarifario: desativar_tarifario,
		usa_allotment: usa_allotment,
		extranet: extranet,
		ativo_cote: ativo_cote,
		ativo_virtuoso: ativo_virtuoso,
		consome_allotment: consome_allotment,
        conteudo_riolife: conteudo_riolife,
		bco_img: bco_img,
		cliente_func_operador_blumar_1: $("#cliente_func_operador_blumar_1").val(),
		cliente_email_operador_blumar_1: $("#cliente_email_operador_blumar_1").val(),
		cliente_func_operador_blumar_2: $("#cliente_func_operador_blumar_2").val(),
		cliente_email_operador_blumar_2: $("#cliente_email_operador_blumar_2").val(),
		cliente_func_operador_blumar_3: $("#cliente_func_operador_blumar_3").val(),
		cliente_email_operador_blumar_3: $("#cliente_email_operador_blumar_3").val(),
		cliente_func_operador_blumar_4: $("#cliente_func_operador_blumar_4").val(),
		cliente_email_operador_blumar_4: $("#cliente_email_operador_blumar_4").val(),
		cliente_func_operador_blumar_5: $("#cliente_func_operador_blumar_5").val(),
		cliente_email_operador_blumar_5: $("#cliente_email_operador_blumar_5").val(),
		cliente_func_operador_blumar_6: $("#cliente_func_operador_blumar_6").val(),
		cliente_email_operador_blumar_6: $("#cliente_email_operador_blumar_6").val(),
		cliente_func_operador_blumar_7: $("#cliente_func_operador_blumar_7").val(),
		cliente_email_operador_blumar_7: $("#cliente_email_operador_blumar_7").val(),
		cliente_func_operador_blumar_8: $("#cliente_func_operador_blumar_8").val(),
		cliente_email_operador_blumar_8: $("#cliente_email_operador_blumar_8").val(),
		cliente_func_operador_blumar_9: $("#cliente_func_operador_blumar_9").val(),
		cliente_email_operador_blumar_9: $("#cliente_email_operador_blumar_9").val(),
		cliente_func_operador_blumar_10: $("#cliente_func_operador_blumar_10").val(),
		cliente_email_operador_blumar_10: $("#cliente_email_operador_blumar_10").val(),
        operation_tax: $("#operation_tax").val(),
		disponibilizar_datas_em_servicos: disponibilizar_datas_em_servicos,
		fk_usuario: $("#fk_usuario").val(),
		nome_cli: $("#nome_cli").val(),
		fk_controle_acesso_ws: $("#fk_controle_acesso_ws").val(),
		avulso: $("#avulso").val(),
		logo_placa: $("#logo_placa").val(),
		obs_guia: $("#obs_guia").val(),
		freq_pgto2: $("#freq_pgto2").val(),
		limite_cred2: $("#limite_cred2").val(),
		limite_cred_file: $("#limite_cred_file").val(),
		de_freq_pgto2: $("#de_freq_pgto2").val(),
		ate_freq_pgto2: $("#ate_freq_pgto2").val(),
        wooba: $("#wooba").val()
	   },
 
  
    beforeSend: function() {
	 

			if ($("#emp").val() == "0")
			 {
				alert("Escolha a empresa");
				return false;
			}
		  

			if ($("#cli").val() == "0")
			 {
				alert("Escolha o cliente");
				return false;
			}
		  
           if ($("#cli").val() == "-1")
			 {
				alert("É necessário definir um cliente");
				return false;
			}

          if ($("#cli").val() == "-2" && $("#nome_cli").val() == "")
			 {
				alert("É necessário preencher o nome do cliente avulso");
				return false;
			}


			if ($("#lang").val() == "0")
			 {
				alert("Escolha o idioma");
				return false;
			}
			

			if ($("#nucleo").val() == "0")
			 {
				alert("Escolha o núcleo");
				return false;
			}
			
			
			if ($("#root_htl").val() == "---------------")
			 {
				alert("Escolha o tarifário.");
				return false;
			}
			
			
			if ($("#root_htl2").val() == "---------------")
			 {
				alert("Escolha o tarifário do segundo ano.");
				return false;
			}
			

			
			
			
		  
		  
		  
			/*
			 *  if($("#logo").val() != "") {
				
				string_endereco_logo = $("#logo").val();
				extensao_arquivo = string_endereco_logo.slice(string_endereco_logo.length-3);
				if(extensao_arquivo != "jpg") {
					alert("O arquivo do logotipo deve ser de extensão JPG.");
					return false;
				}
				
				// var largura = objLogo2.width;
				// alert(largura);
				// return false;
			     
				 //if(largura > 180) {
				 //alert("O logotipo deve ter no máximo 180 pixels de largura.");
				 // return false;
				 //}
			
			}
	  
	  */
			
			
	  },
	  
	  
	  
	 error: function() {
		alert("Erro ao inserir o formulario de Clientes!");
	},
	 success: function(resposta) {
		$("#diplay_clientes").html(resposta);
	 } 
 });
}








$(document).ready(function() { 
	   
	$("body").delegate("a.editclient", "click",  function(){   
		 clientid($(this).children(".editclientvalue").val());
	  });    
				 
	    
	    
					   
                         function clientid (pk_cad_cli) {
						 
                        	   
                        	 
									   $.ajax({
										dataType: "html",  
										url: "edit_cliente.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_cad_cli:  pk_cad_cli,
											scroll:  $("#diplay_clientes").scrollTop()
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
												$("#diplay_clientes").html(resposta);
												 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});




 

function ativa_usr_salesystem () { 

				$.ajax({
				dataType: "html",  
				url: "pop_ativa_usuario_salesystem.php",  
				type: 'POST',
				data: {
					cli: $("#cli").val(),
					pk_cad_cli: $("#pk_cad_cli").val() 
				  },
				 error: function() {
					alert("Erro ao mostrar o formulario de Clientes!");
				},
				 success: function(resposta) {
					  $.ajax({
							dataType: "html",  
							url: "edit_cliente.php", 
							type: 'POST',
							cache: false,
							data: {
								pk_cad_cli: $("#pk_cad_cli").val()
							},
							 
							 
							error: function() {
								alert("Ocorreu algum erro ao retornar esta OS!");
							},
							// FUNï¿½ï¿½O SUCESSO
							 success: function(resposta) {
									$("#container_conteudo").html(resposta);
									 
							 },
							 
							    complete: function() {
								$("#loading").fadeOut("slow");
							}
							 }); 

				 
				 } 
			 });

				
 }



 

function desativacao_usr_salesystem () { 

	$.ajax({
	dataType: "html",  
	url: "pop_desativa_usuario_salesystem.php",  
	type: 'POST',
	data: {
		login: $("#login").val(),
		fk_controle_acesso_ws: $("#fk_controle_acesso_ws").val(),
		pk_cad_cli: $("#pk_cad_cli").val()
	  },
	 error: function() {
		alert("Erro ao mostrar o formulario de Clientes!");
	},
	 success: function(resposta) {
		  $.ajax({
				dataType: "html",  
				url: "edit_cliente.php", 
				type: 'POST',
				cache: false,
				data: {
					pk_cad_cli: $("#pk_cad_cli").val()
				},
				 
				 
				error: function() {
					alert("Ocorreu algum erro ao retornar esta OS!");
				},
				// FUNï¿½ï¿½O SUCESSO
				 success: function(resposta) {
						$("#container_conteudo").html(resposta);
						 
				 },
				 
				    complete: function() {
					$("#loading").fadeOut("slow");
				}
				 }); 

	 
	 } 
 });

	
}




function reativa_usr_salesystem () { 

	$.ajax({
	dataType: "html",  
	url: "pop_reativa_usuario_salesystem.php",  
	type: 'POST',
	data: {
		cli: $("#cli").val(),
		fk_controle_acesso_ws: $("#fk_controle_acesso_ws").val(),
		pk_cad_cli: $("#pk_cad_cli").val()
	  },
	 error: function() {
		alert("Erro ao mostrar o formulario de Clientes!");
	},
	 success: function(resposta) {
		 $.ajax({
				dataType: "html",  
				url: "edit_cliente.php", 
				type: 'POST',
				cache: false,
				data: {
					pk_cad_cli: $("#pk_cad_cli").val()
				},
				 
				 
				error: function() {
					alert("Ocorreu algum erro ao retornar esta OS!");
				},
				// FUNï¿½ï¿½O SUCESSO
				 success: function(resposta) {
						$("#container_conteudo").html(resposta);
						 
				 },
				 
				    complete: function() {
					$("#loading").fadeOut("slow");
				}
				 }); 
	 
	 } 
 });

	
}













function update_cliente () { 

	   if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
	   	   
	 if ($("#desativar_reservas_online").is(":checked")) {  
			 var desativar_reservas_online = "true"; 
		 } else {
			 var desativar_reservas_online = "false";
		 }
	
	   if ($("#desativar_tarifario").is(":checked")) {  
			 var desativar_tarifario = "true"; 
		 } else {
			 var desativar_tarifario = "false";
		 }
	   	   
	   if ($("#usa_allotment").is(":checked")) {  
			 var usa_allotment = "true"; 
		 } else {
			 var usa_allotment = "false";
		 }
	   
	   if ($("#extranet").is(":checked")) {  
			 var extranet = "true"; 
		 } else {
			 var extranet = "false";
		 }
	 	   
	   if ($("#ativo_cote").is(":checked")) {  
			 var ativo_cote = "true"; 
		 } else {
			 var ativo_cote = "false";
		 }
	   	   
	   
	   
	   if ($("#ativo_virtuoso").is(":checked")) {  
			 var ativo_virtuoso = "true"; 
		 } else {
			 var ativo_virtuoso = "false";
		 }
	    
	   
	   if ($("#consome_allotment").is(":checked")) {  
			 var consome_allotment = "true"; 
		 } else {
			 var consome_allotment = "false";
		 }
	   	   
	   if ($("#disponibilizar_datas_em_servicos").is(":checked")) {  
			 var disponibilizar_datas_em_servicos = "true"; 
		 } else {
			 var disponibilizar_datas_em_servicos = "false";
		 }
	   
	   var pos =  $("#scroll").val();
	     

        if ($("#conteudo_riolife").is(":checked")) {  
			 var conteudo_riolife = "true"; 
		 } else {
			 var conteudo_riolife = "false";
		 }
	   	   
		 if ($("#bco_img").is(":checked")) {  
			var bco_img = "true"; 
		} else {
			var bco_img = "false";
		}
		 



	   
	$.ajax({
	dataType: "html",  
	url: "insert_update_cliente.php",  
	type: 'POST',
	data: {
		emp: $("#emp").val(),
		cli: $("#cli").val(),
		logo: $('#logo').val(),
		lang: $("#lang").val(),
		moeda: $("#moeda").val(),
		nucleo: $("#nucleo").val(),
		root_htl: $("#root_htl").val(),
		root_htl2: $("#root_htl2").val(),
		mkp_food: $("#mkp_food").val(),
		mkp_srv: $("#mkp_srv").val(),
		mkp_htl: $("#mkp_htl").val(),
		mkp_eco: $("#mkp_eco").val(),
		mkp_ny: $("#mkp_ny").val(),
		mkp_carn: $("#mkp_carn").val(),
		mkp_winn: $("#mkp_winn").val(),
		mkp_food2: $("#mkp_food2").val(),
		mkp_srv2: $("#mkp_srv2").val(),
		mkp_htl2: $("#mkp_htl2").val(),
		mkp_eco2: $("#mkp_eco2").val(),
		mkp_ny2: $("#mkp_ny2").val(),
		mkp_carn2: $("#mkp_carn2").val(),
		mkp_winn2: $("#mkp_winn2").val(),
		descricao_tar: $("#descricao_tar").val(),
		email: $("#email").val(),
		ativo: ativo,
		ativo_virtuoso: ativo_virtuoso,
		desativar_reservas_online: desativar_reservas_online,
		desativar_tarifario: desativar_tarifario,
		usa_allotment: usa_allotment,
		extranet: extranet,
		ativo_cote: ativo_cote,
		consome_allotment: consome_allotment,
        conteudo_riolife: conteudo_riolife, 
		bco_img: bco_img,
        operation_tax: $("#operation_tax").val(),
		disponibilizar_datas_em_servicos: disponibilizar_datas_em_servicos,
		fk_usuario: $("#fk_usuario").val(),
		nome_cli: $("#nome_cli").val(),
		pk_cad_cli: $("#pk_cad_cli").val(),
		loginpg: $("#loginpg").val(),
		pass: $("#pass").val(),
		fk_controle_acesso_ws: $("#fk_controle_acesso_ws").val(),
		logo_placa: $("#logo_placa").val(),
		obs_guia: $("#obs_guia").val(),
		avulso: $("#avulso").val(),
		scroll: $("#scroll").val(),
		logoplaca: $("#logoplaca").val(),
		novologo: $("#novologo").val(),
		freq_pgto2: $("#freq_pgto2").val(),
		limite_cred2: $("#limite_cred2").val(),
		limite_cred_file: $("#limite_cred_file").val(),
		de_freq_pgto2: $("#de_freq_pgto2").val(),
		ate_freq_pgto2: $("#ate_freq_pgto2").val(),
        wooba: $("#wooba").val()
	   },
 
  
    beforeSend: function() {
	 

			if ($("#emp").val() == "0")
			 {
				alert("Escolha a empresa");
				return false;
			}
		  

			if ($("#cli").val() == "0")
			 {
				alert("Escolha o cliente");
				return false;
			}
		  

			if ($("#lang").val() == "0")
			 {
				alert("Escolha o idioma");
				return false;
			}
			

			if ($("#nucleo").val() == "0")
			 {
				alert("Escolha o núcleo");
				return false;
			}
			
			
			if ($("#root_htl").val() == "---------------")
			 {
				alert("Escolha o tarifário.");
				return false;
			}
			
  		
	  },
	  
	  
	  
	 error: function() {
		alert("Erro ao inserir o formulario de Clientes!");
	},
	 success: function(resposta) {
		$("#container_conteudo").html(resposta);
		$("#diplay_clientes").scrollTop(pos);
	 } 
 });
}





function insere_cliente_func_operador () { 

				$.ajax({
				dataType: "html",  
				url: "insere_cliente_func_operador.php",  
				type: 'POST',
				data: {
					cliente_func_operador_blumar: $("#cliente_func_operador_blumar").val(),
					cli_email_operador_blumar: $("#cli_email_operador_blumar").val(),
					pk_cad_cli: $("#pk_cad_cli").val(),
					fk_controle_acesso_ws: $("#fk_controle_acesso_ws").val(),
					cli: $("#cli").val()
				  },
				 error: function() {
					alert("Erro ao mostrar o formulario de Clientes!");
				},
				 success: function(resposta) {
					 
					     $.ajax({
							dataType: "html",  
							url: "edit_cliente.php", 
							type: 'POST',
							cache: false,
							data: {
								pk_cad_cli:   $("#pk_cad_cli").val() 
							},
							 
							 
							error: function() {
								alert("Ocorreu algum erro ao retornar esta OS!");
							},
							// FUNï¿½ï¿½O SUCESSO
							 success: function(resposta) {
									$("#container_conteudo").html(resposta);
									 
							 },
							 
							    complete: function() {
								$("#loading").fadeOut("slow");
							}
							 }); 
				 } 
			 });

				
 }






$(document).ready(function() { 
	   
	$("body").delegate("a.editblumaroperator", "click",  function(){   
		 opid($(this).children(".editblumaroperatorvalue").val());
     });    
					   
					   
                         function opid (pk_blumar_operator) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "edit_blumar_operator.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_blumar_operator:  pk_blumar_operator,
											pk_cad_cli:  $("#pk_cad_cli").val() 
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
												$("#edit_cli_op").html(resposta);
												 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});







function update_cliente_func_operador () { 

				$.ajax({
				dataType: "html",  
				url: "update_cliente_func_operador.php",  
				type: 'POST',
				data: {
					update_cliente_operador_blumar: $("#update_cliente_operador_blumar").val(),
					update_cli_email_operador_blumar: $("#update_cli_email_operador_blumar").val(),
					pk_cad_cli: $("#pk_cad_cli").val(),
					pk_blumar_operator: $("#pk_blumar_operator").val(),
					fk_controle_acesso_ws: $("#fk_controle_acesso_ws").val()
				  },
				 error: function() {
					alert("Erro ao mostrar o formulario de Clientes!");
				},
				 success: function(resposta) {
					 
					     $.ajax({
							dataType: "html",  
							url: "edit_cliente.php", 
							type: 'POST',
							cache: false,
							data: {
								pk_cad_cli:   $("#pk_cad_cli").val() 
							},
							 
							 
							error: function() {
								alert("Ocorreu algum erro ao retornar esta OS!");
							},
							// FUNï¿½ï¿½O SUCESSO
							 success: function(resposta) {
									$("#container_conteudo").html(resposta);
									 
							 },
							 
							    complete: function() {
								$("#loading").fadeOut("slow");
							}
							 }); 
				 } 
			 });

				
 }








$(document).ready(function() { 
	   
	$("body").delegate("a.delblumaroperator", "click",  function(){   
		 delopid($(this).children(".delblumaroperatorvalue").val());
     });    
					   
					   
                         function delopid (pk_blumar_operator) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "del_blumar_operator.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_blumar_operator:  pk_blumar_operator,
											pk_cad_cli:  $("#pk_cad_cli").val() 
										},
										 
										 beforeSend: function() {
											 var answer = confirm ("Tem certeza que deseja apagar este operador?")
											 if (answer) {}
												  
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {

										     $.ajax({
												dataType: "html",  
												url: "edit_cliente.php", 
												type: 'POST',
												cache: false,
												data: {
													pk_cad_cli:   $("#pk_cad_cli").val() 
												},
												 
												 
												error: function() {
													alert("Ocorreu algum erro ao retornar esta OS!");
												},
												// FUNï¿½ï¿½O SUCESSO
												 success: function(resposta) {
														$("#container_conteudo").html(resposta);
														 
												 },
												 
												    complete: function() {
													$("#loading").fadeOut("slow");
												}
												 }); 
												 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});



 



function ativar_cliente_avulso () { 

				$.ajax({
				dataType: "html",  
				url: "pega_clientes_sistema.php",  
				type: 'POST',
				data: {
					emp: $("#emp").val(),
					avulso: $("#avulso").val()
				  },
				 error: function() {
					alert("Erro ao mostrar o formulario de Clientes!");
				},
				 success: function(resposta) {
					$("#act_avulso").html(resposta);
				 
				 } 
			 });
				
				
	
				
 }










$(document).ready(function() { 
	   
	$("body").delegate("a.sobec", "click",  function(){   
		 subindo($(this).children(".sobecvalue").val());
	  });    
				 
	    
	    
					   
                         function subindo (pk_sobe) {
						 
                        	   
                        	 
									   $.ajax({
										dataType: "html",  
										url: "miolo_clientes.php", 
										type: 'POST',
										cache: false,
										data: {
											sobe:  pk_sobe 
										},
										 beforeSend: function() {   $("#loading").fadeIn("slow");  },
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
												$("#container_conteudo").html(resposta);
												 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});





$(document).ready(function() { 
	   
	$("body").delegate("a.descec", "click",  function(){   
		 descendo($(this).children(".descecvalue").val());
	  });    
				 
	    
	    
					   
                         function descendo (pk_desce) {
						 
                        	   
                        	 
									   $.ajax({
										dataType: "html",  
										url: "miolo_clientes.php", 
										type: 'POST',
										cache: false,
										data: {
											desce:  pk_desce
										},
										 
										beforeSend: function() {   $("#loading").fadeIn("slow");  }, 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
												$("#container_conteudo").html(resposta);
												 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});






//busca de cliente


var busca;

$(function() { 
	$('#busca').val("");
	$("#busca").autocomplete({
	source: "busca_clientes.php",
	minLength: 2, 
   select: function(event, ui) {
	$('#mneu_cli').val(ui.item.id);
	 
	},
	    close: 	function enviarForm() {
	        $.ajax({
	        dataType: "html",  
	        url: "monta_clientes.php",  
	        cache: false,
	        data: {
	        	mneu_cli:  $("#mneu_cli").val() 
	        },
	        beforeSend: function() {
	              $("#loading").fadeIn("slow");
	          },
	         error: function() {
	               alert("Ocorreu algum erro ao buscar o cliente!");
	              },
	         success: function(resposta) {
	                  $("#diplay_clientes").html(resposta);
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









