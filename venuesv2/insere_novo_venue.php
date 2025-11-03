<?php 

require_once '../util/connection.php';

$mneu_for = $_GET["mneu_for"];
$nome = $_GET["nome"];
$especialidade = $_GET["especialidade"];
$citie = $_GET["citie"];
$descritivo_en = pg_escape_string($_GET["descritivo_en"]);
$descritivo_pt = pg_escape_string($_GET["descritivo_pt"]);
$descritivo_esp = pg_escape_string($_GET["descritivo_esp"]);
$foto1 = $_GET["foto1"];
$foto2 = $_GET["foto2"];
$ativo = $_GET["ativo"];

	$insere_venue ="
	   INSERT INTO 
	   		conteudo_internet.venues
				  (
				  mneu_for, 
				  fk_cod_cidade, 
				  nome, 
				  especialidade, 
				  descritivo_pt, 
				  descritivo_en, 
				  descritivo_esp, 
				  foto1, 
				  foto2, 
				  ativo
				  ) 
		  VALUES 
		  		(
		  		'$mneu_for',
		  		'$citie',
		  		'$nome',
		  		'$especialidade',
		  		'$descritivo_pt',
		  		'$descritivo_en',
		  		'$descritivo_esp',
		  		'$foto1',
		        '$foto2',
		         $ativo
		        ) 
	";
pg_query($conn, $insere_venue);





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
			'Inseriu um novo Venue  - $nome',
			'$data_now',
			'6'
			)
			";
			pg_query($conn, $query_log);




echo'VENUE INSERIDO COM SUCESSO!!!<br><br><br>';



require_once 'miolo_venues.php';






?>