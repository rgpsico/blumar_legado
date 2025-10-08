function modulo_financeiro () { 

				$.ajax({
				dataType: "html",  
				url: "financeiro_miolo.php",  
				 
				error: function() {
					alert("Erro ao mostrar o menu de cadastro de OS!");
				},
				 
				success: function(resposta) {
					$("#dashboard_os").html(resposta);
					 
				} 
				
				
			});

}


function financeiro_guias () { 

	$.ajax({
	dataType: "html",  
	url: "financeiro_por_guias.php",  
	 
	error: function() {
		alert("Erro ao mostrar o menu de cadastro de OS!");
	},
	 
	success: function(resposta) {
		$("#dashboard_os").html(resposta);
		 
	} 
	
	
});

}





$(document).ready(function() { 
	   
	$("body").delegate("a.verprestfin", "click",  function(){   
         retrive_prestfin($(this).children(".verprestfinvalue").val());
     });    
					   
					   
                         function retrive_prestfin (pk_osfilefin) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "miolo_cont_prestacao_fin.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_osnumero:  pk_osfilefin
											
										},
										 
										 
										error: function() {
											alert("Ocorreu algum erro ao retornar esta OS!");
										},
										 
										 success: function(resposta) {
											 $("#dashboard_fin").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	



function muda_status_financeiro () { 

	$.ajax({
	dataType: "html",  
	url: "muda_status_financeiro.php",  
	type: 'POST',
	data: {
		os_status_financeiro: $("#os_status_financeiro").val(),
		pk_osnumero: $("#pk_osnumero").val(),
		pk_osfile: $("#pk_osfile").val()
		
	  },
	  

	 error: function() {
		alert("Erro ao mudar o Status da Os!");
	},
	 success: function(resposta) {
		$("#os_linha_status").html(resposta);
	 
	 } 
 });
}




function insert_nf_num_os () { 

	$.ajax({
	dataType: "html",  
	url: "insert_nf_num_os.php",  
	type: 'POST',
	data: {
		nf_num: $("#nf_num").val(),
		pk_osnumero: $("#pk_osnumero").val(),
		pk_osfile: $("#pk_osfile").val()
		
	  },
	  

	 error: function() {
		alert("Erro ao inserir dados de Nota Fiscal da Os!");
	},
	 success: function(resposta) {
		$("#obs_nf_os").html(resposta);
	 
	 } 
 });
}



function update_cambio () { 

	$.ajax({
	dataType: "html",  
	url: "update_cambio.php",  
	type: 'POST',
	data: {
		 pk_osnumero: $("#pk_osnumero").val() 
		
	  },
	  

	 error: function() {
		alert("Erro ao mudar o cambio!");
	},
	 success: function(resposta) {
		$("#os_linha_cambio").html(resposta);
	 
	 } 
 });
}


function insert_update_cambio () { 

	$.ajax({
	dataType: "html",  
	url: "insert_update_cambio.php",  
	type: 'POST',
	data: {
		 pk_osnumero: $("#pk_osnumero").val(),
		 cambio_os: $("#cambio_os").val()
		
	  },
	  

	 error: function() {
		alert("Erro ao mudar o cambio!");
	},
	 success: function(resposta) {
		$("#dashboard_fin").html(resposta);
	 
	 } 
 });
}

 
