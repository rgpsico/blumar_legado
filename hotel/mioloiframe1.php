
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
		<form id="Form" name="form" method="post" action="insereimagem1.php" enctype="multipart/form-data">
		<input type="file" id="covid_19_ptf" name="covid_19_ptf"  size="40" onchange="confirmComplete();">
		<input type="hidden" name="covid_19_pt_in" id="covid_19_pt_in" value="">
		 </form>
		 ';
	 

 
 
 ?>
 
 
 
 
 
 
 