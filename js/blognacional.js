 
	function acao_blognacional () { 
	
        $.ajax({
        dataType: "html",  
        url: "blog/miolo_blognacional.php",  
          // FUN��O ERRO
        error: function() {
            alert("Error when inserting City content!");
        },
         
        success: function(resposta) {
            $("#container_miolo").html(resposta);
             
        } 
        
        
    });

}

	 
function novo_post () { 
	
    $.ajax({
    dataType: "html",  
    url: "blog/form_novo_post.php",  
      // FUN��O ERRO
    error: function() {
        alert("Error when inserting City content!");
    },
     
    success: function(resposta) {
        $("#container_miolo").html(resposta);
         
    } 
    
    
});

}


 
function insere_novo_post () { 
	
		
		
    if ($("#ativo").is(":checked")) {  
          var ativo = "true"; 
      } else {
          var ativo = "false";
      }
 
 
 
                                     $.ajax({
                                     dataType: "html",  
                                     url: "blog/insere_novo_post.php",  
                                     type: 'POST',
                                     data: {
                                          
                                        classif: $("#classif").val(),
                                        data_post: $("#data_post").val(),
                                        titulo: $("#titulo").val(),
                                        descritivo_blumar: $("#descritivo_blumar").val(),
                                        descritivo_be: $("#descritivo_be").val(),
                                        foto_capa: $("#foto_capa").val(), 
                                        foto_topo: $("#foto_topo").val(),
                                        url_video: $("#url_video").val(), 
                                        meta_description: $("#meta_description").val(), 
                                        citie: $("#citie").val(), 
                                        regiao: $("#regiao").val(), 
                                        ativo: ativo 
                                         
                                         
                                     
                                         
                                     },
                                     
                                     error: function() {
                                         alert("Error when inserting City content!");
                                     },
                                      
                                     success: function(resposta) {
                                         $("#container_miolo").html(resposta);
                                          
                                     } 
                                     
                                     
                                 });

}



	 
function altera_post () { 
	
    $.ajax({
    dataType: "html",  
    url: "blog/form_altera_post.php",  
    type: 'POST',
    data:
    {
      pk_blognacional: $("#pk_blognacional").val()  
    },
    error: function() {
        alert("Error when inserting City content!");
    },
     
    success: function(resposta) {
        $("#container_miolo").html(resposta);
         
    } 
    
    
});

}



 
function alteracao_post () { 
	
		
		
    if ($("#ativo").is(":checked")) {  
          var ativo = "true"; 
      } else {
          var ativo = "false";
      }
 
 
 
                                     $.ajax({
                                     dataType: "html",  
                                     url: "blog/update_post.php",  
                                     type: 'POST',
                                     data: {
                                          
                                        classif: $("#classif").val(),
                                        data_post: $("#data_post").val(),
                                        titulo: $("#titulo").val(),
                                        descritivo_blumar: $("#descritivo_blumar").val(),
                                        descritivo_be: $("#descritivo_be").val(),
                                        foto_capa: $("#foto_capa").val(), 
                                        foto_topo: $("#foto_topo").val(),
                                        url_video: $("#url_video").val(), 
                                        meta_description: $("#meta_description").val(),  
                                        pk_blognacional: $("#pk_blognacional").val(),  
                                        citie: $("#citie").val(), 
                                        regiao: $("#regiao").val(),                         
                                        ativo: ativo 
                                                                                 
                                     
                                         
                                     },
                                     
                                     error: function() {
                                         alert("Error when inserting City content!");
                                     },
                                      
                                     success: function(resposta) {
                                         $("#container_miolo").html(resposta);
                                          
                                     } 
                                     
                                     
                                 });

}



