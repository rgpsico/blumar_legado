<?php 


require_once '../util/connection.php';

$pk_abt = pg_escape_string($_POST["pk_abt"]);
$dia_conteudo = pg_escape_string($_POST["dia_conteudo"]);
$titulo_conteudo = pg_escape_string($_POST["titulo_conteudo"]);
$descritivo_conteudo = pg_escape_string($_POST["descritivo_conteudo"]);
$foto1_conteudo = pg_escape_string($_POST["foto1_conteudo"]);
$lay = pg_escape_string($_POST["lay"]);
$pk_abt_conteudo = pg_escape_string($_POST["pk_abt_conteudo"]);


$update_tour_abt = "
  UPDATE conteudo_internet.abt_conteudo  SET 
      dia_conteudo = '$dia_conteudo', 
	  titulo_conteudo = '$titulo_conteudo', 
	  descritivo_conteudo = '$descritivo_conteudo', 
	  foto1_conteudo = '$foto1_conteudo', 
	  layout_conteudo = '$lay'
  where 
  pk_abt_conteudo = $pk_abt_conteudo
 ";
pg_query($conn, $update_tour_abt);
 

session_start();

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
			'Atualizou um  Tour de ABT  - pk = $pk_abt_conteudo - fk = $pk_abt',
			'$data_now',
			'11'
			)
	";
pg_query($conn, $query_log);



 
	$pega_abt = "
		select
			nome
		from
			conteudo_internet.abt
		where
			pk_abt = $pk_abt
	
	";
 

	
	$result_abt = pg_exec($conn, $pega_abt);
	
	
	if ($result_abt) {
		for ($rowcid = 0; $rowcid < pg_numrows($result_abt); $rowcid++) {
			$nome = pg_result($result_abt, $rowcid, 'nome');
	
	
		}
	}
	
	

echo'<b>Cadastro de descritivo Arounds Brazil Tours</b><br>
<br>
Inclusão de Dias referentes ao Tour:<b>'.$nome.'</b><br>';

echo'<div id="tour_abt">';
require_once 'abt_tour_form.php';
echo'</div>';





?>