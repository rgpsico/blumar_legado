 <script type="text/javascript">

function confirmComplete() {
 
	 form.submit();
	 } 

</script>
<!--  var answer = confirm ("tem certeza que deseja anexar este arquivo ?")
 
	if (answer==true)
	  {
		 form.submit();
	  }
	else
	  {
	    return false;
	  }
	} -->
 
 
 
<?php 

ini_set('display_errors', 1);
error_reporting(~0);

 
If (isSet($_SESSION)) {} else {session_start();} 
require('../util/connection.php');

$frncod = $_SESSION['frncod'];

if (isset($_FILES['covid_19_ptf']))
{
	$nomefrom = $_FILES['covid_19_ptf']['name'];
	$temp = $_FILES['covid_19_ptf']['tmp_name'];

 $arraydtin = explode(".",$nomefrom);
 $extension = $arraydtin[1];	
 
$ano = date("Y");
$mes = date("m");
$dia =  date("d");
$hora =  date("G");
$min =  date("i");
$segundo =  date("s");
$mili =  date("B");
$data_now =  $ano . '-' . $mes . '-' . $dia;

$nome = $frncod.$dia.$mes.$ano.$hora.'_pt.'.$extension;

	//$destination = '/var/www/wwwinternet/novo_site/admin/voucher/images/';
	$destination = '/var/www/wwwwebapp/tools/covid_19/';
 
	//echo$temp.'-'.$destination.$nome;
	
	if (move_uploaded_file( $temp, $destination.$nome)) {
		//echo 'imagem inserida com sucesso!!<br>'.$nome.' ';
		
		$insere_pdf = "
		update
			conteudo_internet.ci_hotel
		set
		    covid_19_pt ='$nome'
		where 
		    frncod = $frncod ";
		 pg_query($conn, $insere_pdf); 
		
		 
		  echo'Documento inserido com sucesso!!<br>
		   <input name="covid_19_pt"  id="covid_19_pt" type="text"  size="60" maxlength="150" value="'.$nome.'">
		   <input type="hidden" name="covid_19_pt_in" id="covid_19_pt_in" value="'.$nome.'">';
		 
 
		 
		 
		 
		
	}
	else {echo'imagem nao inserida<br>';
	}
}
else {echo'imagem nao passada<br>';
}






?>