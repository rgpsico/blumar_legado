<?php 

require_once '../util/connection.php';

if(session_id() == '') {
	session_start();
}


$pk_aptcod = pg_escape_string($_POST["delapto"]);
$frncod = pg_escape_string($_POST["frncod"]);
 
 $del_aptos =
"
 delete 
 from 
 	conteudo_internet.ci_apartamento
 where 
	pk_aptcod = $pk_aptcod
";
 pg_query($conn, $del_aptos);

 
 
 
 $pk_acesso = $_SESSION['user'];
 
 //crio a data now
 $ano = date("Y");
 $mes = date("m");
 $dia =  date("d");
 $data_now =  $ano . '-' . $mes . '-' . $dia;
 
 
 
 $query_log =
		 "
			 INSERT INTO
			 conteudo_internet.log_adm_conteudo
					 (
					 usuario,
					 acao,
					 data,
					 fk_conteudo
					 )
					 values
					 (
					 '$pk_acesso',
					 'Apagou um apartamento do hotel - $frncod ',
					 '$data_now',
					 '2'
					 )
			 ";
 pg_query($conn, $query_log);
 
  
echo"Apartamento EXCLUIDO com sucesso!";

 require_once 'apaga_apto.php';
 
 
?>