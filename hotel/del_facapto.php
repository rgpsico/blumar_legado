<?php 


if(session_id() == '') {
	session_start();
}

require_once '../util/connection.php';
$frncod = pg_escape_string($_POST["frncod"]);
$codfac = pg_escape_string($_POST["codfac"]);


$del_facs =
"
delete
from
conteudo_internet.ci_hotel_facilidade
where
htlfaccod = $codfac
";
pg_query($conn, $del_facs);




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
'Apagou uma facilidade de apto no hotel  - $frncod ',
'$data_now',
'2'
)
";
pg_query($conn, $query_log);







echo"Facilidade EXCLUIDA com sucesso!";

require_once 'apaga_fac_apto.php';



?>