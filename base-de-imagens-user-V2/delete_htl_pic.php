<?php

//nao reconhece

ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';


$pk_bco_img =   pg_escape_string($_POST["pk_bco_img"]);
$mneu_for =   pg_escape_string($_POST["mneu_for"]);
$tp_produto =   pg_escape_string($_POST["tp_produto"]);
$fk_cidcod =   pg_escape_string($_POST["fk_cidcod"]);
$cidade_cod = $fk_cidcod;

$delete_foto="delete from banco_imagem.bco_img where pk_bco_img = $pk_bco_img";
pg_query($conn, $delete_foto);


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
'Excluiu uma imagem - pk = $pk_bco_img do fornecedor - $mneu_for',
'$data_now',
'36'
)
";
pg_query($conn, $query_log);

 



echo'<b>FOTO EXCLUIDA COM SUCESSO!!</b><br>';

if($tp_produto==1)
{
require_once 'pega_htl.php';
}
elseif($tp_produto==10)
{
require_once 'pega_cid_tp10.php';
}
else
{
require_once 'pega_htl.php';
} 
 

 