	function acao_ecos () { 

						$.ajax({
						dataType: "html",  
						url: "eco/miolo_eco.php",  
						  // FUN��O ERRO
						error: function() {
							alert("Error when retrieving eco content!");
						},
						 
						success: function(resposta) {
							$("#container").html(resposta);
							 
						} 
						
						
					});

	}
	
	
	
	function novo_eco () { 
		
					$.ajax({
					dataType: "html",  
					url: "eco/novo_eco.php",  
					 
					error: function() {
						alert("Error when retrieving new eco form!");
					},
					 
					success: function(resposta) {
						$("#container").html(resposta);
						 
					} 
					
					
				});

}

	
	function insere_novo_eco () { 
		
		$.ajax({
		dataType: "html",  
		url: "eco/insere_novo_eco.php",  
		data: {
			 
			fornec: $("#fornecedor").val(), 
			lodgecidade: $("#lodgecidade").val(),
			nome_pt: $("#nome_pt").val(),
			nome_en: $("#nome_en").val(),
			nome_esp: $("#nome_esp").val(),
			descricao_pt: $("#descricao_pt").val(),
			descricao_en: $("#descricao_en").val(),
			descricao_esp: $("#descricao_esp").val(),
			foto1: $("#foto1").val() 
		},
		error: function() {
			alert("Error when inserting new eco form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}

	
	
	function desceco () { 
		
					$.ajax({
					dataType: "html",  
					url: "eco/eco_sem_pacotes.php",  
					 
					error: function() {
						alert("Error when retrieving new eco form!");
					},
					 
					success: function(resposta) {
						$("#container").html(resposta);
						 
					} 
					
					
				});

}	
	
	
 
	
	
function alteralodges () { 
		
		$.ajax({
		dataType: "html",  
		url: "eco/update_eco.php",  
		data: {
			 
			pklodges: $("#lodges").val() 
		},
		error: function() {
			alert("Error when updating eco form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	function update_eco () { 
		
		$.ajax({
		dataType: "html",  
		url: "eco/insere_update_eco.php",  
		data: {
			 
			mneu_for: $("#mneu_for").val(), 
		    nome_pt: $("#nome_pt").val(),
			nome_en: $("#nome_en").val(),
			nome_esp: $("#nome_esp").val(),
			descricao_pt: $("#descricao_pt").val(),
			descricao_en: $("#descricao_en").val(),
			descricao_esp: $("#descricao_esp").val(),
			foto1: $("#foto1").val(),
			pk_descritivo_ecologico: $("#pk_descritivo_ecologico").val()
		},
		error: function() {
			alert("Error when inserting new eco form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}	
		
	
	function inserepkgteco () { 
			
			$.ajax({
			dataType: "html",  
			url: "eco/novo_pkg_eco.php",  
			data: {
				 
				pkglodges: $("#pkglodges").val() 
			},
			error: function() {
				alert("Error when updating eco form!");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});

	}	
	
		
		
	function insere_pkg_eco () { 
		
		 if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		
		
		
		
		$.ajax({
		dataType: "html",  
		url: "eco/insere_pkg_eco.php",  
		data: {
			 
			nome_pt: $("#nome_pt").val(),
			nome_en: $("#nome_en").val(),
			nome_esp: $("#nome_esp").val(),
			descricao_pt: $("#descricao_pt").val(),
			descricao_en: $("#descricao_en").val(),
			descricao_esp: $("#descricao_esp").val(),
			foto1: $("#foto1").val(),
			foto2: $("#foto2").val(),
			pk_descritivo_ecologico: $("#pk_descritivo_ecologico").val(),
			ativo: ativo
		},
		error: function() {
			alert("Error when inserting new eco form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	
	
	function listapkgeco () { 
			
			$.ajax({
			dataType: "html",  
			url: "eco/lista_pkg_eco.php",  
			data: {
				 
				pkpkgeco: $("#pkpkgeco").val() 
			},
			error: function() {
				alert("Error when updating eco form!");
			},
			 
			success: function(resposta) {
				$("#update_pkg_eco").html(resposta);
				 
			} 
			
			
		});

	}		
	
	
	
	function pegapkgeco () { 
			
			$.ajax({
			dataType: "html",  
			url: "eco/update_pkg_eco.php",  
		
			data: {
				 
				pkpacoteeco: $("#pkpacoteeco").val() 
			},
			error: function() {
				alert("Error when updating eco form!");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});

	}		
	
	
	 
	function update_pkg_eco () { 
		
		 if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		
		
		
		
		$.ajax({
		dataType: "html",  
		url: "eco/insere_update_pkg_eco.php",  
		type: 'POST',
		data: {
			 
			nome_pt: $("#nome_pt").val(),
			nome_en: $("#nome_en").val(),
			nome_esp: $("#nome_esp").val(),
			descritivo_pt: $("#descritivo_pt").val(),
			descritivo_en: $("#descritivo_en").val(),
			descritivo_esp: $("#descritivo_esp").val(),
			foto1: $("#foto1").val(),
			foto2: $("#foto2").val(),
			pk_descritivo_ecologico_pacotes: $("#pk_descritivo_ecologico_pacotes").val(),
			ativo: ativo
		},
		error: function() {
			alert("Error when inserting new eco form!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}
	
	
	
	
	
	
	
	 
	
	
	
	function consultalodges () { 
			
			$.ajax({
			dataType: "html",  
			url: "eco/ver_eco.php",  
			data: {
				 
				pklodges: $("#verlodges").val() 
			},
			error: function() {
				alert("Error when retrieving eco!");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});

	}		
	
	
	
	
	
	function listapkgeco2 () { 
			
			$.ajax({
			dataType: "html",  
			url: "eco/lista_pkg_eco2.php",  
			data: {
				 
				pkpkgeco: $("#verpkpkgeco").val() 
			},
			error: function() {
				alert("Error when updating eco form!");
			},
			 
			success: function(resposta) {
				$("#update_pkg_eco2").html(resposta);
				 
			} 
			
			
		});

	}		
	
	
	
	
	
	
	
	
	function verpkgeco () { 
			
			$.ajax({
			dataType: "html",  
			url: "eco/ver_pkg_eco.php",  
			data: {
				 
				pkpacoteeco: $("#verpkpacoteeco").val() 
			},
			error: function() {
				alert("Error when retrieving eco package!");
			},
			 
			success: function(resposta) {
				$("#container").html(resposta);
				 
			} 
			
			
		});

	}		
	
	
	
	