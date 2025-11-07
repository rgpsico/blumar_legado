
function acao_func () { 

				$.ajax({
				dataType: "html",  
				url: "cadastro_funcionarios/miolo_cadastro_funcionarios.php",  
				 
				error: function() {
					alert("Erro ao mostrar o menu de cadastro de funcionarios!");
				},
				 
				success: function(resposta) {
					$("#container").html(resposta);
					 
				} 
				
				
			});

}



function novo_user () { 

				$.ajax({
				dataType: "html",  
				url: "cadastro_funcionarios/cadastro_usuario.php",  
				 
				error: function() {
					alert("Erro ao mostrar o menu de cadastro de funcionarios!");
				},
				 
				success: function(resposta) {
					$("#container").html(resposta);
					 
				} 
				
				
			});

}

 
function input_new_usuario () { 
	
	
	if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		} else {
			 var ativo = "false";
		}
			
	 
				$.ajax({
				dataType: "html",  
				url: "cadastro_funcionarios/insert_cadastro_usuario.php",  
				type: 'POST',
				data: {
					 
					nome: $("#nome").val(), 
					nik: $("#nik").val(), 
					data_birth: $("#data_birth").val(),
					naturalidade: $("#naturalidade").val(),
					est_civil: $("#est_civil").val(),
					sexo: $("#sexo").val(),
					end: $("#end").val(),
					end_num: $("#end_num").val(),
					end_compl: $("#end_compl").val(),
					end_uf: $("#end_uf").val(),
					bairro: $("#bairro").val(),
					cidade: $("#cidade").val(),
					cep: $("#cep").val(),
					telefone: $("#telefone").val(),
					celular: $("#celular").val(),
					email_pess: $("#email_pess").val(),
					skype: $("#skype").val(),
					email_blumar: $("#email_blumar").val(),
					linha_direta: $("#linha_direta").val(),
					ramal: $("#ramal").val(),
					ramal_grp: $("#ramal_grp").val(),
					ddg: $("#ddg").val(),
					login_sis: $("#login_sis").val(),
				    id: $("#id").val(),
					id_emiss: $("#id_emiss").val(),
					data_id: $("#data_id").val(),
					cpf: $("#cpf").val(),
					pis: $("#pis").val(),
					ctps: $("#ctps").val(),
					ctps_serie: $("#ctps_serie").val(),
					ctps_uf: $("#ctps_uf").val(),
					data_ctps: $("#data_ctps").val(),
					titulo: $("#titulo").val(),
					zona: $("#zona").val(),
					secao: $("#secao").val(),
					cert_reservista: $("#cert_reservista").val(),
					reserv_serie: $("#reserv_serie").val(),
					rm: $("#rm").val(),
					cart_mot: $("#cart_mot").val(),
					data_cnh: $("#data_cnh").val(),
					cat_mot: $("#cat_mot").val(),
					bco: $("#bco").val(),
					agencia: $("#agencia").val(),
					cc: $("#cc").val(),
					ccdig: $("#ccdig").val(),
					naturalizado: $("#naturalizado").val(),
					cart_19: $("#cart_19").val(),
					data_chegada: $("#data_chegada").val(),
					pais_extran: $("#pais_extran").val(),
					filhos_br: $("#filhos_br").val(),
					ativo: ativo, 
					observacao:  $("#observacao").val()
					 
				},
				error: function() {
					alert("Erro ao mostrar o menu de cadastro de funcionarios!");
				},
				 
				success: function(resposta) {
					$("#container").html(resposta);
					 
				} 
				
				
			});

}



function altera_cadastro_func () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/form_update_cadastro_usuario.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val()  
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}

function altera_cadastro_func_inativo () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/form_update_cadastro_usuario.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario_inativo").val()  
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}


function insert_update_usuario () { 
	
	
	if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		} else {
			 var ativo = "false";
		}
			
	 
				$.ajax({
				dataType: "html",  
				url: "cadastro_funcionarios/insert_update_cadastro_usuario.php",  
				type: 'POST',
				data: {
					
					pk_usuario:  $("#pk_usuario").val(), 
					nome: $("#nome").val(), 
					nik: $("#nik").val(), 
					data_birth: $("#data_birth").val(),
					naturalidade: $("#naturalidade").val(),
					est_civil: $("#est_civil").val(),
					sexo: $("#sexo").val(),
					end: $("#end").val(),
					end_num: $("#end_num").val(),
					end_compl: $("#end_compl").val(),
					end_uf: $("#end_uf").val(),
					bairro: $("#bairro").val(),
					cidade: $("#cidade").val(),
					cep: $("#cep").val(),
					telefone: $("#telefone").val(),
					celular: $("#celular").val(),
					email_pess: $("#email_pess").val(),
					skype: $("#skype").val(),
					email_blumar: $("#email_blumar").val(),
					linha_direta: $("#linha_direta").val(),
					ramal: $("#ramal").val(),
					ramal_grp: $("#ramal_grp").val(),
					ddg: $("#ddg").val(),
					login_sis: $("#login_sis").val(),
				    id: $("#id").val(),
					id_emiss: $("#id_emiss").val(),
					data_id: $("#data_id").val(),
					cpf: $("#cpf").val(),
					pis: $("#pis").val(),
					ctps: $("#ctps").val(),
					ctps_serie: $("#ctps_serie").val(),
					ctps_uf: $("#ctps_uf").val(),
					data_ctps: $("#data_ctps").val(),
					titulo: $("#titulo").val(),
					zona: $("#zona").val(),
					secao: $("#secao").val(),
					cert_reservista: $("#cert_reservista").val(),
					reserv_serie: $("#reserv_serie").val(),
					rm: $("#rm").val(),
					cart_mot: $("#cart_mot").val(),
					data_cnh: $("#data_cnh").val(),
					cat_mot: $("#cat_mot").val(),
					bco: $("#bco").val(),
					agencia: $("#agencia").val(),
					cc: $("#cc").val(),
					ccdig: $("#ccdig").val(),
					naturalizado: $("#naturalizado").val(),
					cart_19: $("#cart_19").val(),
					data_chegada: $("#data_chegada").val(),
					pais_extran: $("#pais_extran").val(),
					filhos_br: $("#filhos_br").val(),
					ativo: ativo, 
					observacao:  $("#observacao").val() 
					
					 
				},
				error: function() {
					alert("Erro ao mostrar o menu de cadastro de funcionarios!");
				},
				 
				success: function(resposta) {
					$("#container").html(resposta);
					 
				} 
				
				
			});

}


function insere_contratacao () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/cadastro_contratacao.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val()  
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}

function update_contratacao () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/form_update_contratacao.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val()  
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}




function form_cargo () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/form_novo_cargo.php",  
	 
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#form_cargo").html(resposta);
		 
	} 
	
	
});

}



function insert_cargo () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_cargo.php",  
	type: 'POST',
	data: {
		novo_cargo: $("#novo_cargo").val()  
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#form_cargo").html(resposta);
		
		$.ajax({
			dataType: "html",  
			url: "cadastro_funcionarios/miolo_cargos.php",  
			error: function() {
				alert("Erro ao mostrar o menu de cadastro de funcionarios!");
			},
			success: function(resposta) {
				$("#box_cargo").html(resposta);
		    } 
		  });
	 }
});

}







function adiciona_admissao () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/adiciona_admissao.php",  
	type: 'POST',
	data: {
		
		data_contratacao: $("#data_contratacao").val()  
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#vencimentos").html(resposta);
		 
	} 
	
	
});

}












function insert_contratacao () { 

	
	
	if ($("#nova_contratacao").is(":checked")) {  
		 var nova_contratacao = "true"; 
	} else {
		 var nova_contratacao = "false";
	}
	
 
	if ($("#doc_adm_completo").is(":checked")) {  
		 var doc_adm_completo = "true"; 
	} else {
		 var doc_adm_completo = "false";
	}
	
	
	if ($("#exame_adm").is(":checked")) {  
		 var exame_adm = "true"; 
	} else {
		 var exame_adm = "false";
	}
	
	
	if ($("#assinou_software").is(":checked")) {  
		 var assinou_software = "true"; 
	} else {
		 var assinou_software = "false";
	}
	
 
	
    if ($("#exam_demiss").is(":checked")) {  
		 var exam_demiss = "true"; 
	} else {
		 var exam_demiss = "false";
	}
	
	
	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_contratacao.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val(),
		nova_contratacao: nova_contratacao,
		fonte_selecao: $("#fonte_selecao").val(),
		relacao: $("#relacao").val(),
		data_contratacao: $("#data_contratacao").val(),
        funcao: $("#funcao").val(),
		fk_depto: $("#fk_depto").val(),
		centro_custo: $("#centro_custo").val(),
		gestor_imediato: $("#gestor_imediato").val(),
		horario_de: $("#horario_de").val(),
		horario_ate: $("#horario_ate").val(),
		salario: $("#salario").val(),
		salario_3_mes: $("#salario_3_mes").val(),
		doc_adm_completo: doc_adm_completo,
		exame_adm: exame_adm,
		dt_exp_45:  $("#dt_exp_45").val(),
		dt_exp_90:  $("#dt_exp_90").val(),
	    assinou_software: assinou_software,
        exam_demiss: exam_demiss,
        dt_ini:  $("#dt_ini").val(),
		empresa: $("#empresa").val(),
		dt_saida: $("#dt_saida").val(),
		foto: $("#foto").val(),
		cod_sis: $("#cod_sis").val()
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}





function insert_update_contratacao () { 

	
	
	if ($("#nova_contratacao").is(":checked")) {  
		 var nova_contratacao = "true"; 
	} else {
		 var nova_contratacao = "false";
	}
	
	
 
	
	
	if ($("#doc_adm_completo").is(":checked")) {  
		 var doc_adm_completo = "true"; 
	} else {
		 var doc_adm_completo = "false";
	}
	
	
	if ($("#exame_adm").is(":checked")) {  
		 var exame_adm = "true"; 
	} else {
		 var exame_adm = "false";
	}
	
	
	if ($("#assinou_software").is(":checked")) {  
		 var assinou_software = "true"; 
	} else {
		 var assinou_software = "false";
	}
	
 
	
    if ($("#exam_demiss").is(":checked")) {  
		 var exam_demiss = "true"; 
	} else {
		 var exam_demiss = "false";
	}
	
	
	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_update_contratacao.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val(),
		nova_contratacao: nova_contratacao,
		fonte_selecao: $("#fonte_selecao").val(),
		relacao: $("#relacao").val(),
		data_contratacao: $("#data_contratacao").val(),
        funcao: $("#funcao").val(),
		fk_depto: $("#fk_depto").val(),
		centro_custo: $("#centro_custo").val(),
		gestor_imediato: $("#gestor_imediato").val(),
		horario_de: $("#horario_de").val(),
		horario_ate: $("#horario_ate").val(),
		salario: $("#salario").val(),
		salario_3_mes: $("#salario_3_mes").val(),
	    doc_adm_completo: doc_adm_completo,
		exame_adm: exame_adm,
		exam_demiss: exam_demiss,
	    dt_exp_45:  $("#dt_exp_45").val(),
		dt_exp_90:  $("#dt_exp_90").val(),
        assinou_software: assinou_software,
        dt_ini:  $("#dt_ini").val(),
		empresa: $("#empresa").val(),
		dt_saida: $("#dt_saida").val(),
		foto: $("#foto").val(),
		cod_sis: $("#cod_sis").val()
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}




function insere_beneficos () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/cadastro_beneficios.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val()  
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
	 } 
	
	
});

}


function insert_beneficios () { 

	
    if ($("#tem_saude").is(":checked")) {  
		 var tem_saude = "true"; 
	} else {
		 var tem_saude = "false";
	}
	
    if ($("#dependentes_saude").is(":checked")) {  
		 var dependentes_saude = "true"; 
	} else {
		 var dependentes_saude = "false";
	}
	
    if ($("#tem_dental").is(":checked")) {  
		 var tem_dental = "true"; 
	} else {
		 var tem_dental = "false";
	}
	
    if ($("#dependente_dental").is(":checked")) {  
		 var dependente_dental = "true"; 
	} else {
		 var dependente_dental = "false";
	}
    
 
	
    
 
    
    if ($("#tem_tkt_transporte").is(":checked")) {  
		 var tem_tkt_transporte = "true"; 
	} else {
		 var tem_tkt_transporte = "false";
	}
    
    
    if ($("#tem_tkt_refeicao").is(":checked")) {  
    	 var tem_tkt_refeicao = $("input[name='tem_tkt_refeicao']:checked").val();
	} else {
		 var tem_tkt_refeicao = 0;
	}
   
    
   
    
    
	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_beneficios.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val(),
		tem_saude: tem_saude,
        dependentes_saude: dependentes_saude,
        motivo_exclusao_saude: $("#motivo_exclusao_saude").val(),
		tem_dental: tem_dental,
        dependente_dental: dependente_dental,
        motivo_exclusao_dental: $("#motivo_exclusao_dental").val(),
        tem_tkt_refeicao:  tem_tkt_refeicao,
        motivo_exclusao_tkt_refeicao: $("#motivo_exclusao_tkt_refeicao").val(),
		tem_tkt_transporte: tem_tkt_transporte,
		valor_transporte1: $("#valor_transporte1").val(),
		valor_transporte2: $("#valor_transporte2").val(),
		valor_transporte3: $("#valor_transporte3").val(),
		obs_transporte: $("#obs_transporte").val()
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
	 } 
	
	
});

}


function update_beneficos () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/form_update_beneficos.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val()  
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}




function insert_update_beneficios () { 

	
    if ($("#tem_saude").is(":checked")) {  
		 var tem_saude = "true"; 
	} else {
		 var tem_saude = "false";
	}
	
    if ($("#dependentes_saude").is(":checked")) {  
		 var dependentes_saude = "true"; 
	} else {
		 var dependentes_saude = "false";
	}
	
    if ($("#tem_dental").is(":checked")) {  
		 var tem_dental = "true"; 
	} else {
		 var tem_dental = "false";
	}
	
    if ($("#dependente_dental").is(":checked")) {  
		 var dependente_dental = "true"; 
	} else {
		 var dependente_dental = "false";
	}
    
  
    
    if ($("#tem_tkt_transporte").is(":checked")) {  
		 var tem_tkt_transporte = "true"; 
	} else {
		 var tem_tkt_transporte = "false";
	}
    
    var tem_tkt_refeicao = $("input[name='tem_tkt_refeicao']:checked").val();
    
    
	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_update_beneficios.php",  
	type: 'POST',
	data: {
		pk_beneficios: $("#pk_beneficios").val(),
		pk_usuario: $("#pk_usuario").val(),
		tem_saude: tem_saude,
        dependentes_saude: dependentes_saude,
        motivo_exclusao_saude: $("#motivo_exclusao_saude").val(),
		tem_dental: tem_dental,
        dependente_dental: dependente_dental,
        motivo_exclusao_dental: $("#motivo_exclusao_dental").val(),
		tem_tkt_refeicao: tem_tkt_refeicao,
        motivo_exclusao_tkt_refeicao: $("#motivo_exclusao_tkt_refeicao").val(),
        tem_tkt_transporte: tem_tkt_transporte,
		valor_transporte1: $("#valor_transporte1").val(),
		valor_transporte2: $("#valor_transporte2").val(),
		valor_transporte3: $("#valor_transporte3").val(),
		obs_transporte: $("#obs_transporte").val()
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
	 } 
	
	
});

}



function conteudo_dependentes () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/cadastro_dependentes.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val()  
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}




function insert_update_dependentes () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_update_dependentes.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val(),
		numero_dependentes: $("#numero_dependentes").val(),
		nome_pai: $("#nome_pai").val(),
		nome_mae: $("#nome_mae").val(),
		nome_conjuge: $("#nome_conjuge").val()
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}



function form_filhos () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/form_filhos.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val()  
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_filhos").html(resposta);
		 
	} 
	
	
});

}





function insert_filhos () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_filhos.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val(),
		nome_filho: $("#nome_filho").val() 
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_filhos").html(resposta);
		 
	} 
	
	
});

}





function conteudo_escolaridade () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/cadastro_escolaridade.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val() 
		
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}



function insert_escolaridade () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_escolaridade.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val(),
		grau_instrucao: $("#grau_instrucao").val(),
		escolaridade_curso: $("#escolaridade_curso").val(),
		escolaridade_instituicao: $("#escolaridade_instituicao").val(),
		data_inicio_curso: $("#data_inicio_curso").val(),
		data_termino_curso: $("#data_termino_curso").val() 
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_escolaridade").html(resposta);
		 
	} 
	
	
});

}


 
function insert_cursos () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_cursos.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val(),
		curso: $("#curso").val(),
		curso_instituicao: $("#curso_instituicao").val() 
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_cursos").html(resposta);
		 
	} 
	
	
});

}



 

function insert_idiomas () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_idiomas.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val(),
		idioma_ing: $("#idioma_ing").val(),
		idioma_pt: $("#idioma_pt").val(),
		idioma_esp: $("#idioma_esp").val(),
		idioma_fr: $("#idioma_fr").val(),
		idioma_alem: $("#idioma_alem").val(),
		idioma_jap: $("#idioma_jap").val(),
		idioma_it: $("#idioma_it").val(),
		idioma_out: $("#idioma_out").val(),
		idioma_out_tp: $("#idioma_out_tp").val()
	},
	
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_idiomas").html(resposta);
		 
	} 
	
	
});

}





$(document).ready(function() { 
	   
	$("body").delegate("a.delescola", "click",  function(){   
         retrive_escola($(this).children(".delescolaValue").val());
     });    
					   
					   
                         function retrive_escola (pk_escolaridade) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "cadastro_funcionarios/delete_escolaridade.php", 
										type: 'POST',
										cache: false,
										data: {
											 
											pk_usuario: $("#pk_usuario").val(),
											pk_escolaridade:  pk_escolaridade
											
										},
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja apagar este registro de escolaridade?")
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
											 $("#box_escolaridade_accordion").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	


$(document).ready(function() { 
	   
	$("body").delegate("a.delescola2", "click",  function(){   
         retrive_escola($(this).children(".delescola2Value").val());
     });    
					   
					   
                         function retrive_escola (pk_escolaridade) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "cadastro_funcionarios/delete_curso.php", 
										type: 'POST',
										cache: false,
										data: {
											 
											pk_usuario: $("#pk_usuario").val(),
											pk_escolaridade:  pk_escolaridade
											
										},
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja apagar este registro de curso?")
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
											 $("#box_escolaridade_accordion2").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	


function conteudo_emprestimos () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/cadastro_emprestimos.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val() 
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}


function insert_emprestimos () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_emprestimos.php",  
	type: 'POST',
	data: {
		pk_usuario: $("#pk_usuario").val(),
		data_inicio_emprestimo: $("#data_inicio_emprestimo").val(),
		data_termino_emprestimo: $("#data_termino_emprestimo").val(),
		valor: $("#valor").val(),
		numero_prestacoes: $("#numero_prestacoes").val(),
		autorizado_por: $("#autorizado_por").val(),
		motivo: $("#motivo").val()
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_escolaridade").html(resposta);
		 
	} 
	
	
});

}




$(document).ready(function() { 
	   
	$("body").delegate("a.upemprestimo", "click",  function(){   
         retrive_emprestimo($(this).children(".upemprestimoValue").val());
     });    
					   
					   
                         function retrive_emprestimo (pk_emprestimo) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "cadastro_funcionarios/form_update_emprestimo.php", 
										type: 'POST',
										cache: false,
										data: {
											 
											pk_usuario: $("#pk_usuario").val(),
											pk_emprestimo:  pk_emprestimo
											
										},
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja alterar este emprestimo?")
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
											 $("#update_emprestimo").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	



function update_emprestimos () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_update_emprestimos.php",  
	type: 'POST',
	data: {
		pk_usuario: $("#pk_usuario").val(),
		pk_emprestimo: $("#pk_emprestimo").val(),
		data_inicio_emprestimo: $("#data_inicio_emprestimo").val(),
		data_termino_emprestimo: $("#data_termino_emprestimo").val(),
		valor: $("#valor").val(),
		numero_prestacoes: $("#numero_prestacoes").val(),
		autorizado_por: $("#autorizado_por").val(),
		motivo: $("#motivo").val()
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_escolaridade").html(resposta);
		 
	} 
	
	
});

}




function conteudo_advertencias () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/cadastro_advertencias.php",  
	type: 'POST',
	data: {
		
		pk_usuario: $("#pk_usuario").val() 
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#container").html(resposta);
		 
	} 
	
	
});

}


function insert_advertencias () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_advertencias.php",  
	type: 'POST',
	data: {
		pk_usuario: $("#pk_usuario").val(),
		data_inicio_emprestimo: $("#data_inicio_emprestimo").val(),
		tipo: $("#tipo").val(),
		motivo: $("#motivo").val()
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_escolaridade").html(resposta);
		 
	} 
	
	
});

}





$(document).ready(function() { 
	   
	$("body").delegate("a.upadvertencia", "click",  function(){   
         retrive_advertencia($(this).children(".upadvertenciaValue").val());
     });    
					   
					   
                         function retrive_advertencia (pk_advertencia) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "cadastro_funcionarios/form_update_advertencia.php", 
										type: 'POST',
										cache: false,
										data: {
											 
											pk_usuario: $("#pk_usuario").val(),
											pk_advertencia:  pk_advertencia
											
										},
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja alterar esta Advertencia?")
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
											 $("#update_emprestimo").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	


insert_update_advertencias

function insert_update_advertencias () { 

	$.ajax({
	dataType: "html",  
	url: "cadastro_funcionarios/insert_update_advertencias.php",  
	type: 'POST',
	data: {
		pk_usuario: $("#pk_usuario").val(),
		pk_advertencia: $("#pk_advertencia").val(),
		data_inicio_emprestimo: $("#data_inicio_emprestimo").val(),
		tipo: $("#tipo").val(),
		motivo: $("#motivo").val()
	},
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_escolaridade").html(resposta);
		 
	} 
	
	
});

}


 






