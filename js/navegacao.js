$(document).ready(function() { 

	 //	script para a parte de busca corrida de A a Z
	 $("body").delegate("a.sobe", "click",  function(){   
		pega_navega($(this).children(".sobeValue").val());
     });  
	 
});
			   
                 function pega_navega (idnavega) {
				 

							   $.ajax({
								dataType: "html", 
								url: "contatos/miolo-navagacao.php", 
								cache: false,
								data: {
									 
									codnavega: idnavega
							     },
								 
								
								// FUN��O ERRO
								error: function() { 
									alert("An error occur when deleting the citie!");
								},
								// FUN��O SUCESSO
								 success: function(resposta) {
										$("#miolo-contatos").html(resposta);
										 
								 },
								  complete: function() {
									$("#loading").fadeOut("slow");
								} 
		 }); 

}

                 
                 
                 
//  script para a parte de busca por uma letra               
  $(document).ready(function() { 

                		
					 $("body").delegate("a.letra", "click",  function(){   
						 pega_letra($(this).children(".letraValue").val());
					     }); 
				  
	   
                		
                	});
                				   
                	                 function pega_letra (idletra) {
                					 

                								   $.ajax({
                									dataType: "html", 
                									url: "contatos/miolo-navagacao.php", 
                									cache: false,
                									data: {
                										 
                										codnavega: idletra
                									 },
                									 // FUN��O ERRO
                									error: function() { 
                										alert("An error occur when deleting the citie!");
                									},
                									// FUN��O SUCESSO
                									 success: function(resposta) {
                											$("#miolo-contatos").html(resposta);
                											 
                									 },
                									  complete: function() {
                										$("#loading").fadeOut("slow");
                									} 
                			 }); 

                	}
                	                 
                	                 
                	                 

                	                 function buscacontato ( ) {
                					 

                								   $.ajax({
                									dataType: "html", 
                									url: "contatos/miolo-busca-avancada.php", 
                									cache: false,
                									data: {
                										 
                										 codbuscavancada: $("#navega").val() + "," + $("#pais").val() + "," + $("#origem").val() + "," + $("#int").val() + "," + $("#inicio").val()  
                								     },
                									 
                									
                									// FUN��O ERRO
                									error: function() { 
                										alert("An error occur when deleting the citie!");
                									},
                									// FUN��O SUCESSO
                									 success: function(resposta) {
                											$("#miolo-contatos").html(resposta);
                											 
                									 },
                									  complete: function() {
                										$("#loading").fadeOut("slow");
                									} 
                			 }); 

                	}
             	               
                	                 
                	                 
                	                 
//    script para a parte de busca corrida de A a Z
      
           $(document).ready(function() {      	                 
               
       		
				 $("body").delegate("a.sobeavan", "click",  function(){   
					 pega_navegaavan($(this).children(".sobeavanValue").val());
				     }); 
        	   
        	             	
                	             });
                	             			   
                	                              function pega_navegaavan (idnavegaavan) {
                	             				 

                	             							   $.ajax({
                	             								dataType: "html", 
                	             								url: "contatos/miolo-busca-avancada.php", 
                	             								cache: false,
                	             								data: {
                	             									 
                	             									codbuscavancada: idnavegaavan
                	             							     },
                	             								 
                	             								
                	             								// FUN��O ERRO
                	             								error: function() { 
                	             									alert("An error occur when deleting the citie!");
                	             								},
                	             								// FUN��O SUCESSO
                	             								 success: function(resposta) {
                	             										$("#miolo-contatos").html(resposta);
                	             										 
                	             								 },
                	             								  complete: function() {
                	             									$("#loading").fadeOut("slow");
                	             								} 
                	             		 }); 

                	             }
          	                 
                	                 
