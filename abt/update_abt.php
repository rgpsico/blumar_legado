<?php 

require_once '../util/connection.php';

$pk_abt = pg_escape_string($_POST["pk_abt"]);
$nome = pg_escape_string($_POST["nome"]);
$data = pg_escape_string($_POST["date"]);
$foto_topo = pg_escape_string($_POST["foto_topo"]);
$titulo = pg_escape_string($_POST["titulo"]);
$campo_livre = pg_escape_string($_POST["campo_livre"]);
$foto_campo = pg_escape_string($_POST["foto_campo"]);
$foto_topo_bpass = pg_escape_string($_POST["foto_topo_bpass"]);
$foto1 = pg_escape_string($_POST["foto1"]);
$foto2 = pg_escape_string($_POST["foto2"]);
$foto3 = pg_escape_string($_POST["foto3"]);
$foto4 = pg_escape_string($_POST["foto4"]);
$ativo = pg_escape_string($_POST["ativo"]);
$ativo_home = pg_escape_string($_POST["ativo_home"]);
$topo_brasil_pass = pg_escape_string($_POST["topo_brasil_pass"]);
$ativo_riolife = pg_escape_string($_POST["ativo_riolife"]);
$lang = pg_escape_string($_POST["lang"]);
$preco_abt = pg_escape_string($_POST["preco_abt"]);
if (strlen($preco_abt) == 0) {$preco_abt = '0';}
$cidade_cod = pg_escape_string($_POST["cidade_cod"]);
if (strlen($cidade_cod) == 0) {$cidade_cod = '0';}

$link_quotes = pg_escape_string($_POST["link_quotes"]);
$link_quotes_be = pg_escape_string($_POST["link_quotes_be"]);
$tempo_abt = pg_escape_string($_POST["tempo_abt"]);
$classic = pg_escape_string($_POST["classic"]);
$romantic = pg_escape_string($_POST["romantic"]); 
$family = pg_escape_string($_POST["family"]);
$beach = pg_escape_string($_POST["beach"]);
$boat = pg_escape_string($_POST["boat"]);
$special_interest = pg_escape_string($_POST["special_interest"]);
$adventure = pg_escape_string($_POST["adventure"]);
$cultural = pg_escape_string($_POST["cultural"]);
$active = pg_escape_string($_POST["active"]);
$nature = pg_escape_string($_POST["nature"]);
$food_drinks = pg_escape_string($_POST["food_drinks"]);
$night_out = pg_escape_string($_POST["night_out"]);
$new_mod  =  $_POST["new_mod"];




$month = substr($data,3,2);
$dia = substr($data,0,2);
$year = substr($data,6,4);
$data_abt =  $year . '-' . $month . '-' . $dia;


$update_abt = "
 UPDATE conteudo_internet.abt  SET 
   nome = '$nome',
   data = '$data_abt',
   foto_topo = '$foto_topo',
   campo_livre = '$campo_livre',
   titulo = '$titulo',
   foto_campo = '$foto_campo',
   foto_topo_bpass = '$foto_topo_bpass',
   foto1 = '$foto1',
   foto2 = '$foto2',
   foto3 = '$foto3',
   foto4 = '$foto4',
   ativo = '$ativo',
   ativo_home = '$ativo_home',
   topo_brasil_pass = '$topo_brasil_pass',
   ativo_riolife  = '$ativo_riolife',
   lang  = '$lang',
   preco_abt = '$preco_abt',
   fk_cidade_cod = '$cidade_cod',
   classic = '$classic',
	romantic = '$romantic',
	family = '$family',
	beach = '$beach',
	boat = '$boat', 
	special_interest = '$special_interest',
	adventure = '$adventure',
	cultural = '$cultural',
	active = '$active',
	nature = '$nature',
	food_drinks = '$food_drinks',
	night_out = '$night_out',
	link_quotes = '$link_quotes',
	link_quotes_be = '$link_quotes_be',
	tempo_abt = '$tempo_abt',
	new_mod = '$new_mod'
  WHERE pk_abt = $pk_abt
 
";
pg_query($conn, $update_abt);



if(isset($_POST["cod_cid_filtro_arr"]) )
{
	
$pk_cid_filtro_arr  =  $_POST["cod_cid_filtro_arr"];

$result = (is_array($pk_cid_filtro_arr) ? count($pk_cid_filtro_arr) : 0); 



for ($rowvf = 0; $rowvf <  $result ; $rowvf++) 
{


if ($pk_cid_filtro_arr[$rowvf]  != '0' )
   {  
//se for diferente de zero verifico se a cidade  existe cadastrada

					$query_selected_cid  = "
					select 
						pk_cidade_tpo, 
						nome_pt, 
						nome_en, 
					cidade_cod, 
					tpocidcod 
					from 
						tarifario.cidade_tpo
					where  
					cidade_cod = '$pk_cid_filtro_arr[$rowvf]'";

					$result_cid_escolhida = pg_exec($conn, $query_selected_cid);


             if ( pg_numrows($result_cid_escolhida) !=0)
                   {
					$insert_cidabt = "

					INSERT INTO conteudo_internet.abt_destinos
					   (
					   fk_cidade_cod,
					   fk_abt
					  )
					VALUES 
					  (
					  '$pk_cid_filtro_arr[$rowvf]',
					  '$pk_abt'
					  )
				 
					  ";
					  pg_query($conn, $insert_cidabt);
 

				   } 







   }



}

}


























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
					'Atualizou um  ABT  - $nome - $pk_abt',
					'$data_now',
					'11'
				)
			";
	pg_query($conn, $query_log);





echo '<b>ATUALIZADO COM SUCESSO</b><br><br>';

require_once 'miolo_abt.php';
?>