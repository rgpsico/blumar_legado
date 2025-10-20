
 <script type="text/javascript">

function confirmComplete() {
 
	  form.submit();

	// var answer = confirm ("tem certeza que deseja anexar este Arquivo ?")
 
	//if (answer==true)
//	  {
	//	
//	  }
//	else
//	  {
//	    return false;
//	  } 
	}

</script>
 <?php

If (isSet($_SESSION)) {} else {session_start();} 
$frncod = $_SESSION['frncod']; 
 
   
		 echo'
		<form id="Form" name="form" method="post" action="insereimagem2.php" enctype="multipart/form-data">
		<input type="file" id="covid_19_enf" name="covid_19_enf"  size="40" onchange="confirmComplete();">
		<input type="hidden" name="covid_19_en_in" id="covid_19_en_in" value="">
		 </form>';
	 

 
 ?>
 
 
 
 
 
 
 