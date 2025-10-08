 
 
 
<?php 

ini_set('display_errors', 1);
error_reporting(~0);

 
If (isSet($_SESSION)) {} else {session_start();} 
require('../util/connection.php');

$frncod = $_POST['frncod'];
 
		
		$insere_pdf = "
		update
			conteudo_internet.ci_hotel
		set
		    covid_19_en =''
		where 
		    frncod = $frncod ";
		 pg_query($conn, $insere_pdf); 
		
		 
		  echo'<input name="covid_19_en"  id="covid_19_en" type="text"  size="60" maxlength="150" value="">';
		 
 
		 
 





?>