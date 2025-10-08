	function acao_guias () { 
	
			$.ajax({
			dataType: "html",  
			url: "guias/miolo_guias.php",  
			 
			error: function() {
				alert("Erro ao mostrar o menu de Guias!");
			},
			 
			success: function(resposta) {
				$("#container_miolo").html(resposta);
				 
			} 
			
			
		});
	
	}
	
	
	function novo_guia () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/novo_guia.php",  
		 
		error: function() {
			alert("Erro ao mostrar o formulario de Guias!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
	

	function input_novo_guia () { 
		
		
		   if ($("#ativar").is(":checked")) {  
				 var ativar = "true"; 
			 } else {
				 var ativar = "false";
			 }
		
		 
 
							$.ajax({
							dataType: "html",  
							url: "guias/insere_novo_guia.php",  
							type: 'POST',
							data: {
								 
								nome: $("#nome").val(),
								apelido: $("#apelido").val(),
								email: $("#email").val(),
                                data_birth: $("#data_birth").val(),
								endereco: $("#endereco").val(),
								endereco_numero: $("#endereco_numero").val(),
								endereco_complemento: $("#endereco_complemento").val(),
								endereco_uf: $("#endereco_uf").val(),
								endereco_cep: $("#endereco_cep").val(),
								endereco_bairro: $("#endereco_bairro").val(),
								fk_cod_cidade: $("#fk_cod_cidade").val(),
								telefone_casa: $("#telefone_casa").val(),
								telefone_celular: $("#telefone_celular").val(),
								nextel: $("#nextel").val(),
								id_nextel: $("#id_nextel").val(),
								telefone_outro: $("#telefone_outro").val(),
								identidade: $("#identidade").val(),
								id_emissor: $("#id_emissor").val(),
								cpf: $("#cpf").val(),
								pis: $("#pis").val(),
								embratur: $("#embratur").val(),
								cnh: $("#cnh").val(),
								validade_cnh: $("#data_cnh").val(),
								categoria_cnh: $("#categoria_cnh").val(),
								data_1_cnh: $("#data_1cnh").val(),
								operadoras: $("#operadoras").val(),
								descritivo: $("#descritivo").val(),
								foto_perfil: $("#foto_perfil").val(),
								foto: $("#foto").val(),
								obs_blumar: $("#obs_blumar").val(),
								ativar: ativar,
								categ: $("#categ").val(),
								mun_nasc: $("#mun_nasc").val(),
								uf_nasc: $("#uf_nasc").val(),
								nacion: $("#nacion").val(),
								data_exp_id: $("#data_exp_id").val(),
								cnh_data_exp: $("#cnh_data_exp").val(),
								cnh_org_exp: $("#cnh_org_exp").val(),
								cnh_uf: $("#cnh_uf").val(),
								nome_mae: $("#nome_mae").val(),
								nome_pai: $("#nome_pai").val(),
								estado_civil: $("#estado_civil").val(),
								escolaridade: $("#escolaridade").val(),
								formacao: $("#formacao").val(),
								rne_num: $("#rne_num").val(),
								rne_orgao: $("#rne_orgao").val(),
								rne_data: $("#rne_data").val()
							  
							},
							 beforeSend: function() {
									
								  
								  if ($("#fk_cod_cidade").val() == "0")
									 {
										alert("Escolher uma cidade é obrigatório");
										return false;
									}
								  
								 
								  
							  }, 
							error: function() {
								alert("Error when inserting Guides content!");
							},
							 
							success: function(resposta) {
								$("#container_miolo").html(resposta);
								 
							} 
							
							
						});
	
	}
	
	
	
	
	function altera_guias () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/guias_por_cidade.php",  
		type: 'POST',
		data: {
			 
			fk_cod_cidade: $("#fk_cod_cidade").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar listagem de guias!");
		},
		 
		success: function(resposta) {
			$("#boxguias").html(resposta);
			 
		} 
		
		
	});

}
	
	function altera_id_guias () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_update_guias.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	function pega_next () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_update_guias.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#prox_guia").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	function pega_ant () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_update_guias.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#ant_guia").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	
	
	function update_guia () { 
		
		
		   if ($("#ativar").is(":checked")) {  
				 var ativar = "true"; 
			 } else {
				 var ativar = "false";
			 }
		
		    if ($("#all_vacinated").is(":checked")) {  
				 var all_vacinated = "true"; 
			 } else {
				 var all_vacinated = "false";
			 }
		

							$.ajax({
							dataType: "html",  
							url: "guias/update_guias.php",  
							type: 'POST',
							data: {
								 
								nome: $("#nome").val(),
								apelido: $("#apelido").val(),
								email: $("#email").val(),
                                data_birth: $("#data_birth").val(),
								endereco: $("#endereco").val(),
								endereco_numero: $("#endereco_numero").val(),
								endereco_complemento: $("#endereco_complemento").val(),
								endereco_uf: $("#endereco_uf").val(),
								endereco_cep: $("#endereco_cep").val(),
								endereco_bairro: $("#endereco_bairro").val(),
								fk_cod_cidade: $("#fk_cod_cidade").val(),
								telefone_casa: $("#telefone_casa").val(),
								telefone_celular: $("#telefone_celular").val(),
								nextel: $("#nextel").val(),
								id_nextel: $("#id_nextel").val(),
								telefone_outro: $("#telefone_outro").val(),
								identidade: $("#identidade").val(),
								id_emissor: $("#id_emissor").val(),
								cpf: $("#cpf").val(),
								pis: $("#pis").val(),
								embratur: $("#embratur").val(),
								cnh: $("#cnh").val(),
								validade_cnh: $("#data_cnh").val(),
								categoria_cnh: $("#categoria_cnh").val(),
								data_1_cnh: $("#data_1cnh").val(),
								operadoras: $("#operadoras").val(),
								descritivo: $("#descritivo").val(),
								foto_perfil: $("#foto_perfil").val(),
								foto: $("#foto").val(),
								obs_blumar: $("#obs_blumar").val(),
								ativar: ativar,
							    id_guias: $("#id_guias").val(),
							    categ: $("#categ").val(),
								mun_nasc: $("#mun_nasc").val(),
								uf_nasc: $("#uf_nasc").val(),
								nacion: $("#nacion").val(),
								data_exp_id: $("#data_exp_id").val(),
								cnh_data_exp: $("#cnh_data_exp").val(),
								cnh_org_exp: $("#cnh_org_exp").val(),
								cnh_uf: $("#cnh_uf").val(),
								nome_mae: $("#nome_mae").val(),
								nome_pai: $("#nome_pai").val(),
								estado_civil: $("#estado_civil").val(),
								escolaridade: $("#escolaridade").val(),
								formacao: $("#formacao").val(),
								rne_num: $("#rne_num").val(),
								rne_orgao: $("#rne_orgao").val(),
								rne_data: $("#rne_data").val(),
                                all_vacinated: all_vacinated

							},
							
							error: function() {
								alert("Error when inserting Guides content!");
							},
							 
							success: function(resposta) {
								$("#abt_left").html(resposta);
								 
							} 
							
							
						});
	
	}
	
	
	
	
	
	
	
	
	function insere_guias_banco () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_guias_banco.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	
	function insert_guia_banco () { 
		
		           	$.ajax({
							dataType: "html",  
							url: "guias/insere_guia_banco.php",  
							type: 'POST',
							data: {
								banco: $("#banco").val(),
								agencia: $("#agencia").val(),
								conta: $("#conta").val(),
								digito: $("#digito").val(),
								forma_pagamento: $("#forma_pagamento").val(),
								razao_social: $("#razao_social").val(),
								cnpj: $("#cnpj").val(),
								id_guias: $("#id_guias").val(),
								obs_financeiro: $("#obs_financeiro").val(),
								digito_banco:  $("#digito_banco").val(),
								cod_banco:  $("#cod_banco").val(),
								tipo: $("input[id='tipo']:checked").val(),
								conta_tipo: $("input[id='conta_tipo']:checked").val(),
								nome_conta_conj:  $("#nome_conta_conj").val(),
								cpf_conta_conj:  $("#cpf_conta_conj").val(),
								pix:  $("#pix").val() 
							},
							
							error: function() {
								alert("Erro ao inserir dados bancarios de guias!");
							},
							 
							success: function(resposta) {
								$("#container_miolo").html(resposta);
								 
							} 
							
							
						});
	
	}
	
	
	
	
	 
	function update_guias_banco () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_update_guias_banco.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}
	
	
	
	
	
	
	function update_guia_banco () { 
		
		           	$.ajax({
							dataType: "html",  
							url: "guias/update_guia_banco.php",  
							type: 'POST',
							data: {
								banco: $("#banco").val(),
								agencia: $("#agencia").val(),
								conta: $("#conta").val(),
								digito: $("#digito").val(),
								forma_pagamento: $("#forma_pagamento").val(),
								razao_social: $("#razao_social").val(),
								cnpj: $("#cnpj").val(),
								id_guias: $("#id_guias").val(),
								pk_guias_banco: $("#pk_guias_banco").val(),
								obs_financeiro: $("#obs_financeiro").val(),
								cod_banco: $("#cod_banco").val(),
								digito_banco: $("#digito_banco").val(),
								tipo: $("input[id='tipo']:checked").val(),
								conta_tipo: $("input[id='conta_tipo']:checked").val(),
								nome_conta_conj:  $("#nome_conta_conj").val(),
								cpf_conta_conj:  $("#cpf_conta_conj").val(),
                                pix:  $("#pix").val()
							},
							
							error: function() {
								alert("Erro ao atualizar dados bancarios de guias!");
							},
							 
							success: function(resposta) {
								$("#abt_left").html(resposta);
								 
							} 
							
							
						});
	
	}
	
	
	
	
	
	function insere_guias_idiomas () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_guias_idiomas.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	function insert_guia_idiomas () { 
		
		   if ($("#ing").is(":checked")) {  
				 var ing = "true"; 
			 } else {
				 var ing = "false";
			 }
		
		

		   if ($("#alem").is(":checked")) {  
				 var alem = "true"; 
			 } else {
				 var alem = "false";
			 }
		
		   if ($("#fr").is(":checked")) {  
				 var fr = "true"; 
			 } else {
				 var fr = "false";
			 }
		
		
		   if ($("#esp").is(":checked")) {  
				 var esp = "true"; 
			 } else {
				 var esp = "false";
			 }
		
		   if ($("#russo").is(":checked")) {  
				 var russo = "true"; 
			 } else {
				 var russo = "false";
			 }
		   
		   if ($("#it").is(":checked")) {  
				 var it = "true"; 
			 } else {
				 var it = "false";
			 }
		   
		   
		   if ($("#jap").is(":checked")) {  
				 var jap = "true"; 
			 } else {
				 var jap = "false";
			 }
		
		   
		   if ($("#chines").is(":checked")) {  
				 var chines = "true"; 
			 } else {
				 var chines = "false";
			 }
		
		   
		   if ($("#arabe").is(":checked")) {  
				 var arabe = "true"; 
			 } else {
				 var arabe = "false";
			 }
		
		   
		   if ($("#holandes").is(":checked")) {  
				 var holandes = "true"; 
			 } else {
				 var holandes = "false";
			 }
		
		   
		   if ($("#turco").is(":checked")) {  
				 var turco = "true"; 
			 } else {
				 var turco = "false";
			 }
		
		   if ($("#hebraico").is(":checked")) {  
				 var hebraico = "true"; 
			 } else {
				 var hebraico = "false";
			 }
		
		   if ($("#sueco").is(":checked")) {  
				 var sueco = "true"; 
			 } else {
				 var sueco = "false";
			 }
		
		
		$.ajax({
		dataType: "html",  
		url: "guias/insere_guias_idiomas.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val(), 
			outros_tipo: $("#outros_tipo").val(), 
			ing: ing,
			alem: alem,
			fr: fr,
			esp: esp,
			russo: russo,
			it: it,
			jap: jap,
			chines: chines,
			arabe: arabe,
			holandes: holandes,
			turco: turco,
			hebraico: hebraico,
			sueco: sueco
			
			
			
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}	
	
	
		
	
	
	function update_guias_idiomas () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_update_guia_idiomas.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}		
	
	
	
	
	

	
	function update_guia_idiomas	 () { 
		
		   if ($("#ing").is(":checked")) {  
				 var ing = "true"; 
			 } else {
				 var ing = "false";
			 }
		
		

		   if ($("#alem").is(":checked")) {  
				 var alem = "true"; 
			 } else {
				 var alem = "false";
			 }
		
		   if ($("#fr").is(":checked")) {  
				 var fr = "true"; 
			 } else {
				 var fr = "false";
			 }
		
		
		   if ($("#esp").is(":checked")) {  
				 var esp = "true"; 
			 } else {
				 var esp = "false";
			 }
		
		   if ($("#russo").is(":checked")) {  
				 var russo = "true"; 
			 } else {
				 var russo = "false";
			 }
		   
		   if ($("#it").is(":checked")) {  
				 var it = "true"; 
			 } else {
				 var it = "false";
			 }
		   
		   
		   if ($("#jap").is(":checked")) {  
				 var jap = "true"; 
			 } else {
				 var jap = "false";
			 }
		
		   
		   if ($("#chines").is(":checked")) {  
				 var chines = "true"; 
			 } else {
				 var chines = "false";
			 }
		
		   
		   if ($("#arabe").is(":checked")) {  
				 var arabe = "true"; 
			 } else {
				 var arabe = "false";
			 }
		
		   
		   if ($("#holandes").is(":checked")) {  
				 var holandes = "true"; 
			 } else {
				 var holandes = "false";
			 }
		
		   
		   if ($("#turco").is(":checked")) {  
				 var turco = "true"; 
			 } else {
				 var turco = "false";
			 }
		
		   if ($("#hebraico").is(":checked")) {  
				 var hebraico = "true"; 
			 } else {
				 var hebraico = "false";
			 }
		
		   if ($("#sueco").is(":checked")) {  
				 var sueco = "true"; 
			 } else {
				 var sueco = "false";
			 }
		
		
		$.ajax({
		dataType: "html",  
		url: "guias/update_guias_idiomas.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val(), 
			pk_guia_idoma: $("#pk_guia_idoma").val(), 
			outros_tipo: $("#outros_tipo").val(), 
			ing: ing,
			alem: alem,
			fr: fr,
			esp: esp,
			russo: russo,
			it: it,
			jap: jap,
			chines: chines,
			arabe: arabe,
			holandes: holandes,
			turco: turco,
			hebraico: hebraico,
			sueco: sueco
			
			
			
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}	
		
	
	
	
	function insere_guias_veiculo () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_guia_veiculo.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}		
		
	
	
	
 
	
	function insert_guia_veiculo	 () { 
		
		   if ($("#kit_gas").is(":checked")) {  
				 var kit_gas = "true"; 
			 } else {
				 var kit_gas = "false";
			 }
			
		   if ($("#proprio").is(":checked")) {  
				 var proprio = "true"; 
			 } else {
				 var proprio = "false";
			 }
	
		   if ($("#seguro").is(":checked")) {  
				 var seguro = "true"; 
			 } else {
				 var seguro = "false";
			 }
	
		   if ($("#terceiros").is(":checked")) {  
				 var terceiros = "true"; 
			 } else {
				 var terceiros = "false";
			 }
		   
		   
	
			$.ajax({
				dataType: "html",  
				url: "guias/insere_guia_veiculo.php",  
				type: 'POST',
				data: {
					 
					id_guias: $("#id_guias").val(), 
					modelo: $("#modelo").val(), 
					placa: $("#placa").val(), 
					ano: $("#ano").val(),
					ano_modelo: $("#ano_modelo").val(),
					cor: $("#cor").val(),
					portas: $("#portas").val(),
					combustivel: $("#combustivel").val(),
					kit_gas: kit_gas,
					proprio: proprio,
					cambio: $("#cambio").val(),
					estofado: $("#estofado").val(),
					seguro: seguro,
					terceiros: terceiros,
					seguradora: $("#seguradora").val(),
					validade_seguro: $("#validade_seguro").val(),
					obs_guia: $("#obs_guia").val(),
					vistoria: $("#vistoria").val(),
					obs_vistoria: $("#obs_vistoria").val() 
					
					 
					
				},
				error: function() {
					alert("Erro ao mostrar formulario de guias!");
				},
				 
				success: function(resposta) {
					$("#container_miolo").html(resposta);
					 
				} 
				
				
			});

		}		
			
	
	
		
	
	function update_guias_veiculo () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_update_guias_veiculo.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de guias!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}		
	
	
	
	
	

	
	function insert_update_guia_veiculo	 () { 
		
		   if ($("#kit_gas").is(":checked")) {  
				 var kit_gas = "true"; 
			 } else {
				 var kit_gas = "false";
			 }
			
		   if ($("#proprio").is(":checked")) {  
				 var proprio = "true"; 
			 } else {
				 var proprio = "false";
			 }
	
		   if ($("#seguro").is(":checked")) {  
				 var seguro = "true"; 
			 } else {
				 var seguro = "false";
			 }
	
		   if ($("#terceiros").is(":checked")) {  
				 var terceiros = "true"; 
			 } else {
				 var terceiros = "false";
			 }
		   
		   
	
			$.ajax({
				dataType: "html",  
				url: "guias/update_guias_veiculo.php",  
				type: 'POST',
				data: {
					pk_guias_veiculo: $("#pk_guias_veiculo").val(), 
					id_guias: $("#id_guias").val(), 
					modelo: $("#modelo").val(), 
					placa: $("#placa").val(), 
					ano: $("#ano").val(),
					ano_modelo: $("#ano_modelo").val(),
					cor: $("#cor").val(),
					portas: $("#portas").val(),
					combustivel: $("#combustivel").val(),
					kit_gas: kit_gas,
					proprio: proprio,
					cambio: $("#cambio").val(),
					estofado: $("#estofado").val(),
					seguro: seguro,
					terceiros: terceiros,
					seguradora: $("#seguradora").val(),
					validade_seguro: $("#validade_seguro").val(),
					obs_guia: $("#obs_guia").val(),
					vistoria: $("#vistoria").val(),
					obs_vistoria: $("#obs_vistoria").val() 
					
					 
					
				},
				error: function() {
					alert("Erro ao mostrar formulario de guias!");
				},
				 
				success: function(resposta) {
					$("#abt_left").html(resposta);
					 
				} 
				
				
			});

		}		
				
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function guias_ativos () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/miolo_guias_ativos.php",  
		 
		error: function() {
			alert("Erro ao mostrar o menu de Guias!");
		},
		 
		success: function(resposta) {
			$("#boxguiasativos").html(resposta);
			 
		} 
		
		
	});

}	
	
	function lista_guias_ativos () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/lista_guias_ativos.php",  
		type: 'POST',
		data: {
			 
			fk_cod_cidade: $("#cod_cidade").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar listagem de guias ativos!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	
	function guias_inativos () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/miolo_guias_inativos.php",  
		 
		error: function() {
			alert("Erro ao mostrar o menu de Guias!");
		},
		 
		success: function(resposta) {
			$("#boxguiasinativos").html(resposta);
			 
		} 
		
		
	});

}	
	
	
	function lista_guias_inativos () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/lista_guias_inativos.php",  
		type: 'POST',
		data: {
			 
			fk_cod_cidade: $("#cod_cidade").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar listagem de guias ativos!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}	
	
	
		


	function guias_com_deacordo () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/deacordo_ok.php",  
		type: 'POST',
		data: {
			 
			fk_cod_cidade: $("#cod_cidade").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar listagem de guias ativos!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}	
	















	
	function escolhe_miolo_pgto () { 
		
		           	$.ajax({
							dataType: "html",  
							url: "guias/miolo_forma_pagamento_guia.php",  
							type: 'POST',
							data: {
								
								id_guias: $("#id_guias").val(),
								tipo: $("input[id='tipo']:checked").val() 
							},
							
							error: function() {
								alert("Erro ao buscar formulario de forma de pagamento!");
							},
							 
							success: function(resposta) {
								$("#miolo_forma_pagamento_guia").html(resposta);
								 
							} 
							
							
						});
	
	}
	
	
		
	function escolhe_conta_tipo () { 
		
		           	$.ajax({
							dataType: "html",  
							url: "guias/miolo_conta_conj.php?v=1",  
							type: 'POST',
							data: {
								
								id_guias: $("#id_guias").val(),
								conta_tipo: $("input[id='conta_tipo']:checked").val() 
							},
							
							error: function() {
								alert("Erro ao buscar formulario de conta conjunta!");
							},
							 
							success: function(resposta) {
								$("#miolo_conjunta").html(resposta);
								 
							} 
							
							
						});
	
	}
	
		function escolhe_miolo_mei () { 
		
		           	$.ajax({
							dataType: "html",  
							url: "guias/escolhe_miolo_mei.php",  
							type: 'POST',
							data: {
								
								id_guias: $("#id_guias").val(),
								tipo_mei: $("input[id='tipo_mei']:checked").val() 
							},
							
							error: function() {
								alert("Erro ao buscar formulario de forma de pagamento!");
							},
							 
							success: function(resposta) {
								$("#miolo_mei").html(resposta);
								 
							} 
							
							
						});
	
	}
	
	
	
	
	



	function insere_guias_dependentes () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_guias_dependentes.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de dependentes!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}	






	
	function insert_guias_dependentes	 () { 
		
		  
	
			$.ajax({
				dataType: "html",  
				url: "guias/insert_guias_dependentes.php",  
				type: 'POST',
				data: {
					 
					id_guias: $("#id_guias").val(), 
					nome: $("#nome").val(), 
					sexo: $("#sexo").val(), 
					data_nasc_dep: $("#data_nasc_dep").val(),
					local_nasc: $("#local_nasc").val(),
					uf: $("#uf").val(),
					cpf: $("#cpf").val() 
				},
				error: function() {
					alert("Erro ao inserir dependente!");
				},
				 
				success: function(resposta) {
					$("#container_miolo").html(resposta);
					 
				} 
				
				
			});

		}		
			
	

 


	function update_guias_dependentes () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/form_update_guias_dependentes.php",  
		type: 'POST',
		data: {
			id_guias: $("#id_guias").val() 
			},
		error: function() {
			alert("Erro ao mostrar formulario de dependentes!");
		},
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}	


	
$(document).ready(function() { 
	   
	$("body").delegate("a.editdep", "click",  function(){   
         edit_depend($(this).children(".editdepvalue").val());
     });    
					   
					   
                         function edit_depend (pk_depend) {
						 
	                                $.ajax({
										dataType: "html",  
										url: "guias/edit_dependente.php", 
										type: 'POST',
										cache: false,
										data: {
											 pk_depend:  pk_depend,
											 id_guias: $("#id_guias").val() 
										},
										error: function() {
											alert("Ocorreu algum erro ao editar o dependente!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#update_dep").html(resposta);
									   },
										 complete: function() {
											$("#loading").fadeOut("slow");
										}
								  }); 
  
	 }
});
	






	function update_dependentes () { 
		
		$.ajax({
		dataType: "html",  
		url: "guias/update_dependentes.php",  
		type: 'POST',
		data: {
			 
			id_guias: $("#id_guias").val(),
            pk_depend: $("#pk_depend").val(),
            nome: $("#nome").val(), 
			sexo: $("#sexo").val(), 
			data_nasc_dep: $("#data_nasc_dep").val(),
			local_nasc: $("#local_nasc").val(),
			uf: $("#uf").val(),
			cpf: $("#cpf").val() 
			 
		},
		error: function() {
			alert("Erro ao mostrar formulario de dependentes!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
			 
		} 
		
		
	});

}	




	
$(document).ready(function() { 
	   
	$("body").delegate("a.deldep", "click",  function(){   
         del_depend($(this).children(".deldepvalue").val());
     });    
					   
					   
                         function del_depend (pk_del_depend) {
						 
	                                $.ajax({
										dataType: "html",  
										url: "guias/delete_dependente.php", 
										type: 'POST',
										cache: false,
										data: {
											 pk_depend:  pk_del_depend,
											 id_guias: $("#id_guias").val() 
										},
										  beforeSend: function() {
											 var answer = confirm ("Tem certeza que deseja apagar este dependente?")
											 if (answer) {}
												  
											 else
												return false;
												 
											  },
										error: function() {
											alert("Ocorreu algum erro ao deletar o dependente!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#abt_left").html(resposta);
											 
										 } 
										 
								  }); 
  
	 }
});
	



	
	
	
	function MM_openBrWindow(theURL,winName,features) 
	    {  
		  window.open(theURL,winName,features);
		}
	
	
	