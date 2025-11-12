<?php 

require_once '../util/connection.php';

$pk_abt = pg_escape_string($_POST["pk_abt"]);
$dia_conteudo = pg_escape_string($_POST["dia_conteudo"]);
$titulo_conteudo = pg_escape_string($_POST["titulo_conteudo"]);
$descritivo_conteudo = pg_escape_string($_POST["descritivo_conteudo"]);
$foto1_conteudo = pg_escape_string($_POST["foto1_conteudo"]);
$lay = pg_escape_string($_POST["lay"]);

	$pega_last_tour="
	select
		pk_abt_conteudo
	from
		conteudo_internet.abt_conteudo
	where
		pk_abt_conteudo = (
				select
					max(pk_abt_conteudo)
				from
					conteudo_internet.abt_conteudo
			)";



$result_tour = pg_exec($conn, $pega_last_tour);


if ($result_tour) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_tour); $rowcid++) {
		$pk_abt_conteudo = pg_result($result_tour, $rowcid, 'pk_abt_conteudo');


	}
}

$new_pk_abt_conteudo = $pk_abt_conteudo + 1;


	$insere_tour_abt = "
	INSERT INTO conteudo_internet.abt_conteudo
	(
		pk_abt_conteudo,
		dia_conteudo,
		titulo_conteudo,
		descritivo_conteudo,
		foto1_conteudo,
		fk_abt,
		layout_conteudo
	)
	VALUES
	(
		'$new_pk_abt_conteudo',
		'$dia_conteudo',
		'$titulo_conteudo',
		'$descritivo_conteudo',
		'$foto1_conteudo',
		'$pk_abt',
		'$lay'
	) ";
	pg_query($conn, $insere_tour_abt);



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
					'Inseriu um novo Tour de ABT  - pk = $new_pk_abt_conteudo - fk = $pk_abt',
					'$data_now',
					'11'
				)
			";
pg_query($conn, $query_log);











echo'<br><b>DIA "'.$dia_conteudo.'" INSERIDO COM SUCESSO</b> -  insira um novo dia:<br><br>';

require_once 'abt_tour_form.php';



?>



