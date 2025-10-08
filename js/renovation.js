



function acao_renovation () { 

		$.ajax({
		dataType: "html",  
		url: "renovation_schedule/miolo_renovation.php",  
		 
		error: function() {
			alert("Erro ao mostrar o menu de Renovation Schedule!");
		},
		 
		success: function(resposta) {
			$("#container_miolo").html(resposta);
			 
		} 
		
		
	});

}




function novo_renovation () { 

			$.ajax({
			dataType: "html",  
			url: "renovation_schedule/form_novo_renovation.php",  
			 
			error: function() {
				alert("Erro ao mostrar o form de Renovation Schedule!");
			},
			 
			success: function(resposta) {
				$("#container_miolo").html(resposta);
				 
			} 
			
			
		});

}





function hotel_renovation () { 
	
	$.ajax({
	dataType: "html",  
	url: "renovation_schedule/hotel_renovation.php",  
	type: 'POST',
	data: {
		 
		cid: $("#cid").val() 
		 
	},
	error: function() {
		alert("Erro ao lista hoteis de Renovation Schedule!");
	},
	 
	success: function(resposta) {
		$("#htl_renovation").html(resposta);
		 
	} 
	
	
});

}



function input_new_renovation () { 
	
	   if ($("#ativo_fit").is(":checked")) {  
			 var ativo_fit = "true"; 
		 } else {
			 var ativo_fit = "false";
		 }
	
	   if ($("#ativo_riolife").is(":checked")) {  
			 var ativo_riolife = "true"; 
		 } else {
			 var ativo_riolife = "false";
		 }
	
	 
	
			$.ajax({
			dataType: "html",  
			url: "renovation_schedule/insert_renovation.php",  
			type: 'POST',
			data: {
				 
				cid: $("#cid").val(),
				hotel: $("#hotel").val(),
				ativo_riolife: ativo_riolife, 
				ativo_fit: ativo_fit,
				data_news: $("#data_news").val(),
				data_news2: $("#data_news2").val(),
				descritivo: $("#descritivo").val(),
				descritivo_esp: $("#descritivo_esp").val()
				
			},
			error: function() {
				alert("Erro ao inserir o conteudo de Renovation Schedule!");
			},
			 
			success: function(resposta) {
				$("#container_miolo").html(resposta);
				 
			} 
	
	
});

}

 
function update_renovation () { 
	
	$.ajax({
	dataType: "html",  
	url: "renovation_schedule/form_update_renovation.php",  
	type: 'POST',
	data: {
		 
		pk_renovation: $("#pk_renovation").val() 
		 
	},
	error: function() {
		alert("Erro ao retornar o formulario de atualização de Renovation Schedule!");
	},
	 
	success: function(resposta) {
		$("#container_miolo").html(resposta);
		 
	} 
	
	
});

}

function update_renovation_passado () { 
	
	$.ajax({
	dataType: "html",  
	url: "renovation_schedule/form_update_renovation.php",  
	type: 'POST',
	data: {
		 
		pk_renovation: $("#pk_renovation2").val() 
		 
	},
	error: function() {
		alert("Erro ao retornar o formulario de atualização de Renovation Schedule!");
	},
	 
	success: function(resposta) {
		$("#container_miolo").html(resposta);
		 
	} 
	
	
});

}

function insert_update_renovation () { 
	
	   if ($("#ativo_fit").is(":checked")) {  
			 var ativo_fit = "true"; 
		 } else {
			 var ativo_fit = "false";
		 }
	
	   if ($("#ativo_riolife").is(":checked")) {  
			 var ativo_riolife = "true"; 
		 } else {
			 var ativo_riolife = "false";
		 }
	
	 
	
			$.ajax({
			dataType: "html",  
			url: "renovation_schedule/insert_update_renovation.php",  
			type: 'POST',
			data: {
				 
				pk_renovation_schedule_forhotel: $("#pk_renovation_schedule_forhotel").val(),  
				ativo_riolife: ativo_riolife, 
				ativo_fit: ativo_fit,
				data_news: $("#data_news").val(),
				data_news2: $("#data_news2").val(),
				descritivo: $("#descritivo").val(),
				descritivo_esp: $("#descritivo_esp").val()
				
			},
			error: function() {
				alert("Erro ao atualizar o conteudo de Renovation Schedule!");
			},
			 
			success: function(resposta) {
				$("#container_miolo").html(resposta);
				 
			} 
	
	
});

}



function ver_renovation_schedule () { 
	
	$.ajax({
	dataType: "html",  
	url: "renovation_schedule/template_renovation.php",  
	type: 'POST',
	data: {
		 
		pk_ver_renovation: $("#pk_ver_renovation").val() 
		 
	},
	error: function() {
		alert("Erro ao retornar o formulario de atualização de Renovation Schedule!");
	},
	 
	success: function(resposta) {
		$("#template_renovation").html(resposta);
		 
	} 
	
	
});

}


 