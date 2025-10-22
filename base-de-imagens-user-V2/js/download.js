
function showDiv() {
    document.getElementById('shopping_cart').style.display = "block";
 }
 
 
 function hideDiv() {
    document.getElementById('shopping_cart').style.display = "none";
 }



 $(document).ready(function() { 
	   
	$("body").delegate("a.add_download", "click",  function(){   
         retrive_add_download($(this).children(".add_downloadvalue").val());
     });    
					   
					   
                         function retrive_add_download (pk_bco_img) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "download_list.php", 
										type: 'POST',
										cache: false,
										data: {
											 pg_pk_bco_img:  pk_bco_img
											
										},
										 
										 
										error: function() {
											alert("error on showing this tour  !");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#shopping_cart").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});




$(document).ready(function() { 
	   
	$("body").delegate("a.delimg", "click",  function(){   
         del_img($(this).children(".delimgvalue").val());
     });    
					   
					   
                         function del_img (pk_img) {
						 
	  
									   $.ajax({
										dataType: "html",  
										url: "download_list.php", 
										type: 'POST',
										cache: false,
										data: {
											 pk_img_del:  pk_img
											
										},
										 
										 
										error: function() {
											alert("error on erasing this tour  !");
										},
										// FUNï¿½ï¿½O SUCESSO
										 success: function(resposta) {
											 $("#shopping_cart").html(resposta);
											 
										 },
										 
										    complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	


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




















