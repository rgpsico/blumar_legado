<?php

if(session_id() == '') {
	session_start();
}


	require_once '../util/connection.php';
	
	
	
	$frncod = pg_escape_string($_POST["frncod"]);
	$categ1 = pg_escape_string($_POST["categ1"]);
	$loc1 = pg_escape_string($_POST["loc1"]);
	$qtd1 = pg_escape_string($_POST["qtd1"]);
	$foto1 = pg_escape_string($_POST["foto1"]);
	 
	if (strlen($foto1) != '0')
	
	{
			
		if (!pg_connection_busy($conn)) {
			pg_send_query($conn, "
					INSERT INTO
					conteudo_internet.ci_apartamento
					(
					aptocatcod,
					aptoloccod,
					aptqtd,
					aptoimgfoto,
					frncod
			)
					values
					(
					'$categ1',
					'$loc1',
					'$qtd1',
					'$foto1',
					'$frncod'
			)
					");
		}
		pg_query($conn);
			
		$retornoapto1 = pg_get_result($conn);
		$resultapto1 = pg_exec($conn);
		if ($resultpto1) {
			
		echo " - inseriu ok -";
			
		}
		else {
		echo "Apartamento inserido com sucesso!<br>";
		echo pg_result_error_field( $retornoapto1, PGSQL_DIAG_SQLSTATE);
		echo pg_result_error($retornoapto1);
			
		}
			
		}
	
	 
		
		
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
		'Inseriu um novo apartamento no hotel - $frncod - $categ1 ',
		'$data_now',
		'2'
		)
		";
		pg_query($conn, $query_log);
		
		
		
		
		
		
	
		require_once 'novo_apto.php';
	
	
	?>