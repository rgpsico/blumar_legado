
 
	function acao_video () { 
	
											$.ajax({
											dataType: "html",  
											url: "video_bank/miolo_video.php",  
											  // FUN��O ERRO
											error: function() {
												alert("Error when retrieving video content!");
											},
											 
											success: function(resposta) {
												$("#container").html(resposta);
												 
											} 
											
											
										});
	
	}

 

 
	function novo_video () { 
	
											$.ajax({
											dataType: "html",  
											url: "video_bank/form_novo_video.php",  
											  // FUN��O ERRO
											error: function() {
												alert("Error when retrieving video content!");
											},
											 
											success: function(resposta) {
												$("#miolovideobank").html(resposta);
												 
											} 
											
											
										});
	
	}



	function insere_novo_video () { 
		 
       
      $.ajax({
		dataType: "html",  
		url: "video_bank/insere_novo_video.php",  
		type: 'POST',
		data: {
			 
			titulo_en: $("#titulo_en").val(),
		    titulo_pt: $("#titulo_pt").val(),
			titulo_esp: $("#titulo_esp").val(),
			url: $("#url").val(),
			cid: $("#cid").val(),
			autor: $("#autor").val(),
			description: $("#description").val(),
            thumb: $("#thumb").val()
	 
		},
		
		error: function() {
			alert("Error when inserting City content!");
		},
		 
		success: function(resposta) {
			$("#miolovideobank").html(resposta);
			 
		} 
		
		
	});

}




	function form_update_video () { 
		 
       
      $.ajax({
		dataType: "html",  
		url: "video_bank/form_update_video.php",  
		type: 'POST',
		data: {
			 
			pk_bco_video: $("#pk_bco_video").val() 
	 
		},
		
		error: function() {
			alert("Error when inserting City content!");
		},
		 
		success: function(resposta) {
			$("#miolovideobank").html(resposta);
			 
		} 
		
		
	});

}




	function update_video () { 
		 
        if ($("#ativo").is(":checked")) {  
				 var ativo = "true"; 
			 } else {
				 var ativo = "false";
			 }


       
      $.ajax({
		dataType: "html",  
		url: "video_bank/update_video.php",  
		type: 'POST',
		data: {
			pk_bco_video: $("#pk_bco_video").val(),
			titulo_en: $("#titulo_en").val(),
		    titulo_pt: $("#titulo_pt").val(),
			titulo_esp: $("#titulo_esp").val(),
			url: $("#url").val(),
			cid: $("#cid").val(),
			autor: $("#autor").val(),
			description: $("#description").val(),
            thumb: $("#thumb").val(),
            ativo: ativo
	 
		},
		
		error: function() {
			alert("Error when inserting City content!");
		},
		 
		success: function(resposta) {
			$("#miolovideobank").html(resposta);
			 
		} 
		
		
	});

}












