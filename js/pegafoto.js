
		
		
	function pegafotos () { 
	
											$.ajax({
											dataType: "html",  
											url: "cadastro_funcionarios/pega_foto.php",  
											  // FUNÇÃO ERRO
											error: function() {
												alert("Error when retrieving hotel content!");
											},
											 
											success: function(resposta) {
												$("#basic-modal-content").html(resposta);
												$("#basic-modal-content").modal(
														{
														overlayClose:true, 
														containerCss:{
															 height:600,
															 width:700 
															  
															 }
														
														 }
												
												);
												 
											} 
											
											
										});
	
	}

	
	
	
	$("body").delegate("a.fotomini", "click",  function(){   
        nome_foto($(this).children(".fotominiValue").val());
    });    
					   
					   
                        function nome_foto (nomefoto) {
						 
	  
									   $.ajax({
										dataType: "html", 
										url: "cadastro_funcionarios/completa_foto.php", 
										cache: false,
										type: 'POST',
										data: {
											nomefotos:  nomefoto
										},
										 
										 success: function(resposta) {
											 $("#busca_foto").html(resposta);
											 $("#basic-modal-content").fadeOut("slow");
											 $("#simplemodal-container").fadeOut("fast");
										 
										 } 
										   
										 }); 
 
	 }
	
	
	
                		
                		

                		
                		
                    	function pegafotosmini () { 
                    	
                    											$.ajax({
                    											dataType: "html",  
                    											url: "minisite/pega_foto.php",  
                    											  // FUNÇÃO ERRO
                    											error: function() {
                    												alert("Error when retrieving hotel content!");
                    											},
                    											 
                    											success: function(resposta) {
                    												$("#basic-modal-content").html(resposta);
                    												$("#basic-modal-content").modal(
                    														{
                    														overlayClose:true, 
                    														containerCss:{
                    															 height:600,
                    															 width:700 
                    															  
                    															 }
                    														
                    														 }
                    												
                    												);
                    												 
                    											} 
                    											
                    											
                    										});
                    	
                    	}

                    	
                    	
                    	
                    	$("body").delegate("a.fotominisite", "click",  function(){   
                            nome_fotomini($(this).children(".fotominisiteValue").val());
                        });    
                    					   
                    					   
                                            function nome_fotomini (nomefotomini) {
                    						 
                    	  
                    									   $.ajax({
                    										dataType: "html", 
                    										url: "minisite/completa_foto.php", 
                    										cache: false,
                    										data: {
                    											nomefotos:  nomefotomini
                    										},
                    										 
                    										 success: function(resposta) {
                    											 $("#boxfoto").html(resposta);
                    											 $("#basic-modal-content").fadeOut("slow");
                    											 $("#simplemodal-container").fadeOut("fast");
                    										 
                    										 } 
                    										   
                    										 }); 
                     
                    	 }
                    	
	
	
                       
	
	
	
	
	
	
	
	