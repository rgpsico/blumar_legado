	function acao_deluxe () { 

						$.ajax({
						dataType: "html",  
						url: "deluxe/miolo_deluxe.php",  
						
						error: function() {
							alert("Error ao mostrar a página principal de deluxe collection!");
						},
						 
						success: function(resposta) {
							$("#container_miolo").html(resposta);
							 
						} 
						
						
					});

	}
	
	
	
	
	function novo_deluxe () { 

		$.ajax({
		dataType: "html",  
		url: "deluxe/form_novo_deluxe.php",  
		
		error: function() {
			alert("Error ao mostrar o formulario de cadastro de Deluxe Collection!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
	
	
	 
	function insert_deluxe () { 
		
		
		if ($("#ativo_blumar").is(":checked")) {  
				 var ativo_blumar = "true"; 
			} else {
				 var ativo_blumar = "false";
			}
				
		 
		if ($("#ativo_nacional").is(":checked")) {  
			 var ativo_nacional = "true"; 
		} else {
			 var ativo_nacional = "false";
		}
		
		if ($("#ativo_latino").is(":checked")) {  
			 var ativo_latino = "true"; 
		} else {
			 var ativo_latino = "false";
		}

		if ($("#ativo_resort").is(":checked")) {  
			 var ativo_resort = "true"; 
		} else {
			 var ativo_resort = "false";
		}
		
		if ($("#ativo_deluxe").is(":checked")) {  
			 var ativo_deluxe = "true"; 
		} else {
			 var ativo_deluxe = "false";
		}
		
		if ($("#ativo_lua_de_mel").is(":checked")) {  
			 var ativo_lua_de_mel = "true"; 
		} else {
			 var ativo_lua_de_mel = "false";
		}
		
		if ($("#ativo_riolife").is(":checked")) {  
			 var ativo_riolife = "true"; 
		} else {
			 var ativo_riolife = "false";
		}
		
		
	    var layout = $("input[name='layout']:checked").val();
		
					$.ajax({
					dataType: "html",  
					url: "deluxe/insert_deluxe.php",  
					type: 'POST',
					data: {
						 
						nome: $("#nome").val(), 
						mneu_for: $("#mneu_for").val(), 
						localiz: $("#localiz").val(),  
						regiao: $("#regiao").val(),
						cidade: $("#cidade").val(),
						estado: $("#estado").val(),
						foto1: $("#foto1").val(),
						foto2: $("#foto2").val(),
						foto3: $("#foto3").val(),
					    mapa: $("#mapa").val(),
						txt1_pt: $("#txt1_pt").val(),
						txt1_esp: $("#txt1_esp").val(),
						txt1_ing: $("#txt1_ing").val(),
						txt2_pt: $("#txt2_pt").val(),
						txt2_esp: $("#txt2_esp").val(),
						txt2_ing: $("#txt2_ing").val(),
						txt3_pt: $("#txt3_pt").val(),
						txt3_esp: $("#txt3_esp").val(),
						txt3_ing: $("#txt3_ing").val(),
						campo_extra_pt: $("#campo_extra_pt").val(),
						campo_extra_esp: $("#campo_extra_esp").val(),
						campo_extra_ing: $("#campo_extra_ing").val(),
						layout: layout,
						ativo_blumar: ativo_blumar,
						ativo_nacional: ativo_nacional,
						ativo_latino: ativo_latino,
						ativo_resort: ativo_resort,
						ativo_deluxe: ativo_deluxe,
						ativo_lua_de_mel: ativo_lua_de_mel,
						ativo_riolife: ativo_riolife
				   },
					error: function() {
						alert("Erro ao mostrar o menu de cadastro de funcionarios!");
					},
					 
					success: function(resposta) {
						$("#container_miolo").html(resposta);
						 
					} 
					
					
				});

	}

	
function altera_deluxe () { 
		
		
	 
		
					$.ajax({
					dataType: "html",  
					url: "deluxe/form_update_deluxe.php",  
					type: 'POST',
					data: {
						 
						pk_deluxe: $("#pk_deluxe").val() 
				   },
					error: function() {
						alert("Erro ao mostrar o menu de cadastro de funcionarios!");
					},
					 
					success: function(resposta) {
						$("#container_miolo").html(resposta);
						 
					} 
					
					
				});

	}

	
	

function insert_update_deluxe () { 
	
	
	if ($("#ativo_blumar").is(":checked")) {  
			 var ativo_blumar = "true"; 
		} else {
			 var ativo_blumar = "false";
		}
			
	 
	if ($("#ativo_nacional").is(":checked")) {  
		 var ativo_nacional = "true"; 
	} else {
		 var ativo_nacional = "false";
	}
	
	if ($("#ativo_latino").is(":checked")) {  
		 var ativo_latino = "true"; 
	} else {
		 var ativo_latino = "false";
	}

	if ($("#ativo_resort").is(":checked")) {  
		 var ativo_resort = "true"; 
	} else {
		 var ativo_resort = "false";
	}
	
	if ($("#ativo_deluxe").is(":checked")) {  
		 var ativo_deluxe = "true"; 
	} else {
		 var ativo_deluxe = "false";
	}
	
	if ($("#ativo_lua_de_mel").is(":checked")) {  
		 var ativo_lua_de_mel = "true"; 
	} else {
		 var ativo_lua_de_mel = "false";
	}
	
	if ($("#ativo_riolife").is(":checked")) {  
		 var ativo_riolife = "true"; 
	} else {
		 var ativo_riolife = "false";
	}
	
    var layout = $("input[name='layout']:checked").val();
	
	
				$.ajax({
				dataType: "html",  
				url: "deluxe/insert_update_deluxe.php",  
				type: 'POST',
				data: {
					pk_deluxe: $("#pk_deluxe").val(),  
					nome: $("#nome").val(), 
					mneu_for: $("#mneu_for").val(), 
					localiz: $("#localiz").val(),  
					regiao: $("#regiao").val(),
					cidade: $("#cidade").val(),
					estado: $("#estado").val(),
					foto1: $("#foto1").val(),
					foto2: $("#foto2").val(),
					foto3: $("#foto3").val(),
				    mapa: $("#mapa").val(),
					txt1_pt: $("#txt1_pt").val(),
					txt1_esp: $("#txt1_esp").val(),
					txt1_ing: $("#txt1_ing").val(),
					txt2_pt: $("#txt2_pt").val(),
					txt2_esp: $("#txt2_esp").val(),
					txt2_ing: $("#txt2_ing").val(),
					txt3_pt: $("#txt3_pt").val(),
					txt3_esp: $("#txt3_esp").val(),
					txt3_ing: $("#txt3_ing").val(),
					campo_extra_pt: $("#campo_extra_pt").val(),
					campo_extra_esp: $("#campo_extra_esp").val(),
					campo_extra_ing: $("#campo_extra_ing").val(),
					layout: layout,
					ativo_blumar: ativo_blumar,
					ativo_nacional: ativo_nacional,
					ativo_latino: ativo_latino,
					ativo_resort: ativo_resort,
					ativo_deluxe: ativo_deluxe,
					ativo_lua_de_mel: ativo_lua_de_mel,
					ativo_riolife: ativo_riolife
			   },
				error: function() {
					alert("Erro ao mostrar o menu de cadastro de funcionarios!");
				},
				 
				success: function(resposta) {
					$("#container_miolo").html(resposta);
					 
				} 
				
				
			});

}	
	
	

function template_deluxe () { 
	
	
	 
	
	$.ajax({
	dataType: "html",  
	url: "deluxe/template_deluxe.php",  
	type: 'POST',
	data: {
		 
		pk_deluxe: $("#pk_template_deluxe").val() 
   },
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de funcionarios!");
	},
	 
	success: function(resposta) {
		$("#box_deluxe").html(resposta);
		 
	} 
	
	
});

}






















	