
	
	
				$("a.deletafachtl").on("click",  function(){   
					deleta_fachtl($(this).children(".deletafachtlValue").val());
			    });  	
	
		 

	
	function deleta_fachtl (codfac) {
		 
		  
		   $.ajax({
			dataType: "html", 
			url: "hotel/del_facapto.php", 
			type: 'POST',
			cache: false,
			data: {
				frncod: $("#frncod").val(),
				codfac:  codfac
			},
			beforeSend: function() {
				 var answer = confirm ("tem certeza que deseja apagar esta facilidade?")
				 if (answer) {}
					  
				 else
					return false;
					 $("#loading").fadeIn("slow");
				  },
			
			error: function() {
				alert("Ocorreu um erro ao excluir a facilidade!");
			},
			success: function(resposta) {
				$("#container").html(resposta);
				 
			 } 
	}); 

}

	