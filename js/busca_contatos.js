 
 var busca;

 $(function() { 
 	$('#busca').val("");
    $("#busca").autocomplete({
         source: "busca_contato.php",
 		 minLength: 1, 
 		 select: function(event, ui) {
       $('#codcont').val(ui.item.id);
       $('#codtipo').val(ui.item.tipo);
       
       },
 	   close: 	function enviarForm() {
 		                                   $.ajax({
 											dataType: "html",  
 											url: "miolo-navagacao.php",  
 											cache: false,
 											data: {
 												codnavega:  $("#codnavega").val() + "," + $("#codtipo").val() + "," + $("#codcont").val() + "," + $("#codinicio").val() 
 											},
 											 
 											 beforeSend: function() {
 												 $("#loading").fadeIn("slow");
 											 },
 										 
 											error: function() {
 												alert("Ocorreu algum erro ao buscar o contato!");
 											},
 										 
 											success: function(resposta) {
 												$("#miolo-contatos").html(resposta);
 												//$("#showvalorbusca").$("#codcont").val();
 											},
 											 
 											complete: function() {
 												$("#loading").fadeOut("slow");
 											}
 										});
 					
 			}
	 
 	});
 });
