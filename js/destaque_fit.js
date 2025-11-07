 
function acao_destaque_fit () { 

		$.ajax({
		dataType: "html",  
		url: "destaque_fit/miolo_destaque_fit.php",  
		 
		error: function() {
			alert("Erro ao mostrar o menu de Destaques FIT!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}

 

function novo_destaque_fit () { 

		$.ajax({
		dataType: "html",  
		url: "destaque_fit/form_novo_destaque_fit.php",  
		 
		error: function() {
			alert("Erro ao mostrar o formulario de Destaques FIT!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}

 

function input_new_destaque_fit () { 
	
	   if ($("#ativo_tar").is(":checked")) {  
			 var ativo_tar = "true"; 
		 } else {
			 var ativo_tar = "false";
		 }
		
	   if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		
	   if ($("#ativo_home").is(":checked")) {  
			 var ativo_home = "true"; 
		 } else {
			 var ativo_home = "false";
		 }
	
	   if ($("#ativo_riolife").is(":checked")) {  
			 var ativo_riolife = "true"; 
		 } else {
			 var ativo_riolife = "false";
		 }
	   
	   if ($("#home_riolife").is(":checked")) {  
			 var home_riolife = "true"; 
		 } else {
			 var home_riolife = "false";
		 }
	   
	   if ($("#principal_home_riolife").is(":checked")) {  
			 var principal_home_riolife = "true"; 
		 } else {
			 var principal_home_riolife = "false";
		 }
	   
	   if ($("#ativo_last_minute").is(":checked")) {  
			 var ativo_last_minute = "true"; 
		 } else {
			 var ativo_last_minute = "false";
		 }
	   
	   
	
	$.ajax({
		dataType: "html",  
		url: "destaque_fit/input_new_destaque_fit.php",  
		type: 'POST',
		data: {
			 
			mneu_for: $("#mneu_for").val(), 
			titulo_ing: $("#titulo_ing").val(), 
			texto_destaque_ing: $("#texto_destaque_ing").val(), 
			foto_destaque: $("#foto_destaque").val(), 
		    data_news: $("#data_news").val(),
			ativo_tar: ativo_tar,
			ativo: ativo,
			ativo_home: ativo_home,
			ativo_riolife: ativo_riolife,
			home_riolife: home_riolife,
			principal_home_riolife: principal_home_riolife,
			ativo_last_minute: ativo_last_minute,
			cod_lastminute: $("#cod_lastminute").val(),
	        mneu_cli: $("#mneu_cli").val()
			
		},
		error: function() {
			alert("Erro ao inserir o conteudo de destaque fit!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}



$(document).ready(function() { 
	   
	$("body").delegate("a.destaquefit", "click",  function(){   
         destaque_fit ($(this).children(".destaquefitValue").val());
     });    
					   
					   
                         function destaque_fit (pkdesfit) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "destaque_fit/retrieve_destaque_fit.php", 
										type: 'POST',
										cache: false,
										data: {
										 
											pk_destaque_tarifario:  pkdesfit
											
										},
										// FUN��O ANTES DE ENVIAR
										 beforeSend: function() {
											 $("#loading").fadeIn("slow");
										 },
										
										
										// FUN��O ERRO
										error: function() {
											alert("Ocorreu algum erro ao retornar o destaque fit!");
										},
										// FUN��O SUCESSO
										 success: function(resposta) {
											 $("#container").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});






function update_destaque_fit () { 
	
	   if ($("#ativo_tar").is(":checked")) {  
			 var ativo_tar = "true"; 
		 } else {
			 var ativo_tar = "false";
		 }
		
	   if ($("#ativo").is(":checked")) {  
			 var ativo = "true"; 
		 } else {
			 var ativo = "false";
		 }
		
	   if ($("#ativo_home").is(":checked")) {  
			 var ativo_home = "true"; 
		 } else {
			 var ativo_home = "false";
		 }
	
	   if ($("#ativo_riolife").is(":checked")) {  
			 var ativo_riolife = "true"; 
		 } else {
			 var ativo_riolife = "false";
		 }
	   
	   if ($("#home_riolife").is(":checked")) {  
			 var home_riolife = "true"; 
		 } else {
			 var home_riolife = "false";
		 }
	   
	   if ($("#principal_home_riolife").is(":checked")) {  
			 var principal_home_riolife = "true"; 
		 } else {
			 var principal_home_riolife = "false";
		 }
	   
	   if ($("#ativo_last_minute").is(":checked")) {  
			 var ativo_last_minute = "true"; 
		 } else {
			 var ativo_last_minute = "false";
		 }
	   
	   
	
	$.ajax({
		dataType: "html",  
		url: "destaque_fit/update_destaque_fit.php",  
		type: 'POST',
		data: {
		//nao aceitou a alteração	 
			mneu_for: $("#mneu_for").val(), 
			titulo_ing: $("#titulo_ing").val(), 
			texto_destaque_ing: $("#texto_destaque_ing").val(), 
			foto_destaque: $("#foto_destaque").val(), 
		    data_news: $("#data_news").val(),
			ativo_tar: ativo_tar,
			ativo: ativo,
			ativo_home: ativo_home,
			ativo_riolife: ativo_riolife,
			home_riolife: home_riolife,
			principal_home_riolife: principal_home_riolife,
			ativo_last_minute: ativo_last_minute,
			cod_lastminute: $("#cod_lastminute").val(),
			pk_destaque_tarifario: $("#pk_destaque_tarifario").val(),
	        mneu_cli: $("#mneu_cli").val()
	
		},
		error: function() {
			alert("Erro ao atualizar o conteudo de destaque_fit!");
		},
		 
		success: function(resposta) {
			$("#container").html(resposta);
			 
		} 
		
		
	});

}





$(document).ready(function() { 
	   
	$("body").delegate("a.deldestaquefit", "click",  function(){   
         deldestaque_fit ($(this).children(".deldestaquefitValue").val());
     });    
					   
					   
                         function deldestaque_fit (delpkdesfit) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "destaque_fit/delete_destaque_fit.php", 
										type: 'POST',
										cache: false,
										data: {
										 
											pk_destaque_tarifario:  delpkdesfit
											
										},
										 beforeSend: function() {
											 var answer = confirm ("Tem certeza que deseja apagar este destaque?")
											 if (answer) {}
												  
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										
										 
										error: function() {
											alert("Ocorreu algum erro ao apagar  o destaque fit!");
										},
										 
										 success: function(resposta) {
											 $("#container").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});









