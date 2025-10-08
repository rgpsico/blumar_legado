
	
	
				$("a.deletaapto").on("click",  function(){   
			       retrive_pco($(this).children(".deletaaptoValue").val());
			    });  	
	
		 

	
	function retrive_pco (codpco) {
		 
		  
		   $.ajax({
			dataType: "html", 
			url: "hotel/del_apto.php", 
			type: 'POST',
			cache: false,
			data: {
				frncod: $("#frncod").val(),
				delapto:  codpco
			},
			beforeSend: function() {
				 var answer = confirm ("tem certeza que deseja apagar este apartamento?")
				 if (answer) {}
					  
				 else
					return false;
					 $("#loading").fadeIn("slow");
				  },
			
			error: function() {
				alert("Ocorreu um erro ao excluir o apartamento!");
			},
			success: function(resposta) {
				$("#miolo-alteracao").html(resposta);
				 
			 } 
	}); 

}

	
	
	