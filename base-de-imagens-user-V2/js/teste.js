function process_download() { 

	$.ajax({
	dataType: "html",  
	url: "process_download.php",  
	 beforeSend: function() {   $("#loading").fadeIn("slow");  },
	error: function() {
		alert("Download Error!");
	},
	 success: function(resposta) {
		$("#shopping_cart").html(resposta);
	 },
	   complete: function() { $("#loading").fadeOut("slow"); } 
 });
}