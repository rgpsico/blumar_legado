 
//modulo do historico de alterações
	function acao_tarif_tools () { 
	
											$.ajax({
											dataType: "html",  
											url: "tarifario/tools/miolo_tools.php",  
											  // FUN��O ERRO
											error: function() {
												alert("Erro ao inserir o Miolo de Ferramentas do tarifario!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}
	
	
	//
	
	function pega_historico_tar () { 
		
		$.ajax({
		dataType: "html",  
		url: "tarifario/tools/miolo_historico_tar.php",  
		  // FUN��O ERRO
		error: function() {
			alert("Erro ao inserir o Miolo de Historico do tarifario!");
		},
		 
		success: function(resposta) {
			$("#miolo_tartools").html(resposta);
			 
		} 
		
		
	});

}

	
		
	
	function tar_ativos () { 
		
		$.ajax({
		dataType: "html",  
		url: "tarifario/tools/ativos.php",  
		  // FUN��O ERRO
		error: function() {
			alert("Erro ao inserir o Miolo de tarifarios ativos!");
		},
		 
		success: function(resposta) {
			$("#miolo_tartools").html(resposta);
			 
		} 
		
		
	});

}

	
	
 
	
	function tar_inativos () { 
		
		$.ajax({
		dataType: "html",  
		url: "tarifario/tools/inativos.php",  
		  // FUN��O ERRO
		error: function() {
			alert("Erro ao inserir o Miolo de tarifarios ativos!");
		},
		 
		success: function(resposta) {
			$("#miolo_tartools").html(resposta);
			 
		} 
		
		
	});

}
	
	
	
	
	
	
	
	

	
	function cria_tar () { 
		
		$.ajax({
		dataType: "html",  
		url: "tarifario/tools/form_novo_tar.php",  
		  // FUN��O ERRO
		error: function() {
			alert("Erro ao inserir o formulario do tarifario!");
		},
		 
		success: function(resposta) {
			$("#miolo_tartools").html(resposta);
			 
		} 
		
		
	});

}
	
	
		
//area de criação	
	
	function insere_tarifario  () { 


		   if ($("#custo").is(":checked")) {  
				 var custo = "t"; 
			 } else {
				 var custo = "f";
			 }
  

		   if ($("#ativo").is(":checked")) {  
				 var ativo = "t"; 
			 } else {
				 var ativo = "f";
			 }

		   if ($("#ativo_intra").is(":checked")) {  
				 var ativo_intra = "t"; 
			 } else {
				 var ativo_intra = "f";
			 }
  
		
		
		$.ajax({
		dataType: "html",  
		url: "tarifario/tools/insere_tarifario.php",  
		type: 'POST',
		data: {
			nome: $("#nome").val(),
			emp: $("#emp").val(),
			comp: $("#comp").val(),
			custo: custo,
			ativo_intra:ativo_intra,
			ativo: ativo
		  },
	 error: function() {
			alert("Erro ao inserir o tarifario!");
		},
		 success: function(resposta) {
			$("#container").html(resposta);
		 
		 } 
	 });
	}
	
		
	
	function update_tarifario  () { 
		
		   if ($("#custo").is(":checked")) {  
				 var custo = "t"; 
			 } else {
				 var custo = "f";
			 }


		   if ($("#ativo").is(":checked")) {  
				 var ativo = "t"; 
			 } else {
				 var ativo = "f";
			 }

		   if ($("#ativo_intra").is(":checked")) {  
				 var ativo_intra = "t"; 
			 } else {
				 var ativo_intra = "f";
			 }

		$.ajax({
		dataType: "html",  
		url: "tarifario/tools/update_tarifario.php",  
		type: 'POST',
		data: {
			nome: $("#nome").val(),
			emp: $("#emp").val(),
			pk_tarifario: $("#pk_tarifario").val(),
			comp: $("#comp").val(),
			custo: custo,
			ativo_intra:ativo_intra,
			ativo: ativo
		  },
	 error: function() {
			alert("Erro ao atualizar o tarifario!");
		},
		 success: function(resposta) {
			$("#container").html(resposta);
		 
		 } 
	 });
	}	
	
	
	
	
	
		
	
	function pega_fk_tarifario  () { 

		$.ajax({
		dataType: "html",  
		url: "tarifario/tools/miolo_historico_tar.php",  
		type: 'POST',
		data: {
			 
			fk_tarifario: $("#fk_tarifario").val(),
			date_out: $("#date_out").val(),
			date_in: $("#date_in").val(),
			pk_tarifario_grupo: $("#pk_tarifario_grupo").val(),
			fk_tarifario_tipo: $("#fk_tarifario_tipo").val(),
			user: $("#user").val()
		  },
		  

		 error: function() {
			alert("Erro ao gerar Voucher!");
		},
		 success: function(resposta) {
			$("#miolo_tartools").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	function sobe_tarifario  () { 

		$.ajax({
		dataType: "html",  
		url: "tarifario/tools/miolo_historico_tar.php",  
		type: 'POST',
		data: {
			 navega: 1
		  },
		  

		 error: function() {
			alert("Erro ao gerar Voucher!");
		},
		 success: function(resposta) {
			$("#miolo_tartools").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
	function desce_tarifario  () { 

		$.ajax({
		dataType: "html",  
		url: "tarifario/tools/miolo_historico_tar.php",  
		type: 'POST',
		data: {
			 navega: 2
		  },
		  

		 error: function() {
			alert("Erro ao gerar Voucher!");
		},
		 success: function(resposta) {
			$("#miolo_tartools").html(resposta);
		 
		 } 
	 });
	}
	
	
	
	
 
	 
	//modulo de promoção de tarifarios
		function promove_tar () { 
		
												$.ajax({
												dataType: "html",  
												url: "tarifario/tools/miolo_promocao.php",  
												  // FUN��O ERRO
												error: function() {
													alert("Erro ao inserir o Miolo de Promoção!");
												},
												 
												success: function(resposta) {
													$("#miolo_tartools").html(resposta);
													 
												} 
												
												
											});
		
		}
			
	
	
	
		$(document).ready(function() { 
			   
			$("body").delegate("a.pro", "click",  function(){   
		         promove_tar($(this).children(".provalue").val());
		     });    
							   
							   
		                         function promove_tar (pk_log_geracao_tarifario) {
								 
			  
											   $.ajax({
												dataType: "html",  
												url: "tarifario/tools/promove_tarifario.php", 
												type: 'POST',
												cache: false,
												data: {
													pk_log_geracao_tarifario:  pk_log_geracao_tarifario
													
												},
												 
												 beforeSend: function() {
													    
													 var answer = confirm ("ATENÇÃO!\n" +
													 		"Tem certeza que deseja promover este tarifario?\n" +
													 		"ESSE PROCESSO NÃO PODERÁ SER REVERTIDO!!\n")
													 		
													 if (answer) {}
														  
													 else
														return false;
														 
													  
												        
												 
												 }, 
												error: function() {
													alert("Ocorreu algum erro ao promover o tarifario!");
												},
												// FUNï¿½ï¿½O SUCESSO
												 success: function(resposta) {
													 $("#miolo_tartools").html(resposta);
													 
												 },
												 
												    complete: function() {
													$("#loading").fadeOut("slow");
												}
												 }); 
		  
			 }
		});

	
	
	
	
	
		$(document).ready(function() { 
			   
			$("body").delegate("a.editar", "click",  function(){   
				edit_tar($(this).children(".editarvalue").val());
		     });    
							   
							   
		                         function edit_tar (pk_tarifario) {
								 
			  
											   $.ajax({
												dataType: "html",  
												url: "tarifario/tools/edit_tarifario.php", 
												type: 'POST',
												cache: false,
												data: {
													pk_tarifario: pk_tarifario
													
												},
												 
												error: function() {
													alert("Ocorreu algum erro ao editar o tarifario!");
												},
												// FUNï¿½ï¿½O SUCESSO
												 success: function(resposta) {
													 $("#miolo_tartools").html(resposta);
													 
												 },
												 
												    complete: function() {
													$("#loading").fadeOut("slow");
												}
												 }); 
		  
			 }
		});

	
	
	
	
	
	