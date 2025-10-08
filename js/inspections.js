	function acao_inspections () { 
	
			$.ajax({
			dataType: "html",  
			url: "inspections/miolo_inspections.php",  
			 
			error: function() {
				alert("Erro ao mostrar o menu de Inspections Reports!");
			},
			 
			success: function(resposta) {
				$("#container_miolo").html(resposta);
				 
			} 
			
			
		});
	
	}
	
	//na sabe que alterou muito burro!
	
	
	
	
	function cad_inspection () { 
		
		$.ajax({
		dataType: "html",  
		url: "inspections/form_novo_inspection.php",  
 
		error: function() {
			alert("Erro ao mostrar o menu de Inspections Reports!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
	
 
	
function input_new_inspection () { 
		
	   if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		
	   if ($("#ativo_riolife").is(":checked")) {  
			 var ativo_riolife = "true"; 
		 } else {
			 var ativo_riolife = "false";
		 }
		
	   if ($("#ativo_bebrazil").is(":checked")) {  
			 var ativo_bebrazil = "true"; 
		 } else {
			 var ativo_bebrazil = "false";
		 }
		
			   if ($("#ativo_nacional").is(":checked")) {  
			 var ativo_nacional = "true"; 
		 } else {
			 var ativo_nacional = "false";
		 }
		
		
	
	
		$.ajax({
		dataType: "html",  
		url: "inspections/insert_new_inspection.php",  
		type: 'POST',
		data: {
			pk_br_experts: $("#pk_br_experts").val(),
			data_news: $("#data_news").val(),
			destinos: $("#destinos").val(),
			descricao: $("#descricao").val(),
			ativo: ativo,
            ativo_riolife: ativo_riolife,
			ativo_bebrazil: ativo_bebrazil,
			ativo_nacional: ativo_nacional,
			foto: $("#foto").val(),
			preco: $("#preco").val(),
			intro: $("#intro").val()
		 },
		error: function() {
			alert("Erro ao mostrar o menu de Inspections Reports!");
		},
		 success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
		
	


function input_new_estab () { 
		
		$.ajax({
		dataType: "html",  
		url: "inspections/insert_estab.php",  
		type: 'POST',
		data: {
			pk_ireport_destinations: $("#pk_ireport_destinations").val(),
			categoria: $("#categoria").val(),
			descricao_estabelecimento: $("#descricao_estabelecimento").val(),
			foto1: $("#foto1").val(),
			foto2: $("#foto2").val(),
			mneu_for: $("#mneu_for").val(),
			ordem: $("#ordem").val()
			
		},
		error: function() {
			alert("Erro ao mostrar o menu de Inspections Reports!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
					 $.ajax({
						dataType: "html",  
						url: "inspections/insert_menu_lateral.php",  
						type: 'POST',
						data: {
							pk_ireport_destinations: $("#pk_ireport_destinations").val()
						},
						error: function() {
							alert("Erro ao mostrar o menu de Lateral!");
						},
						success: function(resposta) {
							$("#abt_right").html(resposta);
						}	
					 });	
		} 
		
		
	});

}	



function altera_inspections () { 
		
		$.ajax({
		dataType: "html",  
		url: "inspections/miolo_update_inspection.php",  
		type: 'POST',
		data: {
			 
			pk_ireport_destinations: $("#pk_ireport_destinations").val() 
		},
		error: function() {
			alert("Erro ao mostrar o menu de Inspections Reports!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
		
	
	
function update_inspection () { 
	   if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		
	   if ($("#ativo_riolife").is(":checked")) {  
			 var ativo_riolife = "true"; 
		 } else {
			 var ativo_riolife = "false";
		 }
		
		   if ($("#ativo_bebrazil").is(":checked")) {  
			 var ativo_bebrazil = "true"; 
		 } else {
			 var ativo_bebrazil = "false";
		 }
		
			   if ($("#ativo_nacional").is(":checked")) {  
			 var ativo_nacional = "true"; 
		 } else {
			 var ativo_nacional = "false";
		 }
		 
		 
	$.ajax({
	dataType: "html",  
	url: "inspections/update_inspection.php",  
	type: 'POST',
	data: {
		 
		pk_br_experts: $("#pk_br_experts").val(),
		data_news: $("#data_news").val(),
		destinos: $("#destinos").val(),
		descricao: $("#descricao").val(),
		pk_ireport_destinations: $("#pk_ireport_destinations").val(),
		foto: $("#foto").val(),
		ativo: ativo,
        ativo_riolife: ativo_riolife,
		ativo_bebrazil: ativo_bebrazil,
		ativo_nacional: ativo_nacional,
			preco: $("#preco").val(),
			intro: $("#intro").val()
	},
	error: function() {
		alert("Erro ao mostrar o menu de Inspections Reports!");
	},
	 
	success: function(resposta) {
		$("#abt_left").html(resposta);
		 
	} 
	
	
});

}
	
	
	
	

function template_inspections () { 
		
		$.ajax({
		dataType: "html",  
		url: "inspections/template_inspections.php",  
		type: 'POST',
		data: {
			 
			pk_ireport_destinations: $("#pk_template_inpections").val() 
		},
		error: function() {
			alert("Erro ao mostrar o menu de Inspections Reports!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}
		
	


function pega_estab () { 
		
		$.ajax({
		dataType: "html",  
		url: "inspections/pega_estab.php",  
		type: 'POST',
		data: {
			 
			categoria: $("#categoria").val() 
		},
		error: function() {
			alert("Erro ao mostrar listagem de estabelecimentos!");
		},
		 
		success: function(resposta) {
			$("#htlrest").html(resposta);
			 
		} 
		
		
	});

}
	
function altera_cadastro_insp () { 
	
	$.ajax({
	dataType: "html",  
	url: "inspections/form_update_inspection.php",  
	type: 'POST',
	data: {
		 
		pk_ireport_destinations: $("#pk_ireport_destinations").val()
	},
	error: function() {
		alert("Erro ao retorna formulario de atualização!");
	},
	 
	success: function(resposta) {
		$("#abt_left").html(resposta);
		 
	} 
	
	
});

}



function novo_cadastro_estab () { 
	
	$.ajax({
	dataType: "html",  
	url: "inspections/form_estab.php",  
	type: 'POST',
	data: {
		 
		pk_ireport_destinations: $("#pk_ireport_destinations").val()
	},
	error: function() {
		alert("Erro ao retorna formulario de atualização!");
	},
	 
	success: function(resposta) {
		$("#abt_left").html(resposta);
		 
	} 
	
	
});

}

$(document).ready(function() { 
	   
	$("body").delegate("a.updateestab", "click",  function(){   
         retrive_pk($(this).children(".updateestabvalue").val());
     });    
					   
					   
                         function retrive_pk (pk_ireport_estab) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "inspections/form_update_estab.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_ireport_estabelicimento:  pk_ireport_estab
											
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar o estabelecimento!");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#abt_left").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	



$(document).ready(function() { 
	   
	$("body").delegate("a.deletestab", "click",  function(){   
         retrive_pk_del($(this).children(".deletestabvalue").val());
     });    
					   
					   
                         function retrive_pk_del (pk_ireport_estab_del) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "inspections/delete_estab.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_ireport_estabelicimento:  pk_ireport_estab_del
											
										},
										 	 beforeSend: function() {
											 var answer = confirm ("Tem certeza que deseja apagar este report?")
											 if (answer) {}
												  
											 else
												return false;
												 
											  },
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar o estabelecimento!");
										},
										
									// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											
											 $("#abt_left").html(resposta);
											 $.ajax({
													dataType: "html",  
													url: "inspections/insert_menu_lateral.php",  
													type: 'POST',
													data: {
														pk_ireport_destinations: $("#pk_ireport_destinations").val()
													},
													error: function() {
														alert("Erro ao mostrar o menu de Lateral!");
													},
													success: function(resposta) {
														$("#abt_right").html(resposta);
													}	
												 });	
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	





function update_estab () { 
		
		$.ajax({
		dataType: "html",  
		url: "inspections/update_estab.php",  
		type: 'POST',
		data: {
			pk_ireport_destinations: $("#pk_ireport_destinations").val(),
			categoria: $("#categoria").val(),
			descricao_estabelecimento: $("#descricao_estabelecimento").val(),
			foto1: $("#foto1").val(),
			foto2: $("#foto2").val(),
			mneu_for: $("#mneu_for").val(), 
			pk_ireport_estabelicimento: $("#pk_ireport_estabelicimento").val(),
			ordem: $("#ordem").val()
		},
		error: function() {
			alert("Erro ao atualizar Reports!");
		},
		 
		success: function(resposta) {
			$("#abt_left").html(resposta);
					 $.ajax({
						dataType: "html",  
						url: "inspections/insert_menu_lateral.php",  
						type: 'POST',
						data: {
							pk_ireport_destinations: $("#pk_ireport_destinations").val()
						},
						error: function() {
							alert("Erro ao mostrar o menu de Lateral!");
						},
						success: function(resposta) {
							$("#abt_right").html(resposta);
						}	
					 });	
		} 
		
		
	});

}	





























	