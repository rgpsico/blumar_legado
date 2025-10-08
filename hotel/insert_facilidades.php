<?php 

if(session_id() == '') {
	session_start();
}

require_once '../util/connection.php';

$categ = pg_escape_string($_POST["categ"]);
$facilidade = pg_escape_string($_POST["facilidade"]);
$facilidadeingles = pg_escape_string($_POST["facilidadeingles"]);
$facilidadeespanhol = pg_escape_string($_POST["facilidadeespanhol"]);


//pego o ultimo pk e adiciono 1
$query_pktours = "SELECT COUNT(*) AS registros, MAX(tpofaccod) AS ultimo
FROM conteudo_internet.ci_tipo_facilidade";

$result_pktours = pg_exec($conn, $query_pktours);

if ($result_pktours) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_pktours); $rowcid++) {
		$ultimo = pg_result($result_pktours, $rowcid, 'ultimo');

		$tpofaccod = $ultimo + 1;
			
	}
}






$insert_fac = "
       INSERT INTO conteudo_internet.ci_tipo_facilidade
			  (
		     tpofaccod,
		     tpofacdsc,
		     tpofacdscesp,
		     tpofacdscing,
		     tipo
		     
		     ) 
			VALUES 
			  (
		     '$tpofaccod',
		     '$facilidade',
		     '$facilidadeespanhol',
		     '$facilidadeingles',
		     '$categ'
		     ) 
        ";
pg_query($conn, $insert_fac);



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
'Inseriu uma nova facilidade  - $facilidade ',
'$data_now',
'2'
)
";
pg_query($conn, $query_log);





echo'INSERIDO COM SUCESSO!!<br><br>';

   require_once 'cadastro_facilidades.php';

   echo'INSERIDO COM SUCESSO!!<br><br>';
?>