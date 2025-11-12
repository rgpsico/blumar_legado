<?php 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';

$nome = pg_escape_string($_POST["nome"]);
$date = pg_escape_string($_POST["date"]);
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
$cidade_cod = pg_escape_string($_POST["cidade_cod"]);
$link_quotes_be = pg_escape_string($_POST["link_quotes_be"]);
$link_quotes = pg_escape_string($_POST["link_quotes"]);
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


$new_mod = pg_escape_string($_POST["new_mod"]);
$pk_cid_filtro_arr = $_POST["cod_cid_filtro_arr"] ;











if (strlen($preco_abt) == 0) {$preco_abt = '0';}
if (strlen($cidade_cod) == 0) {$cidade_cod = '0';}

                       
							$arraydtin = explode("/",$date);
							$anodtin = $arraydtin[2];
							$mesdtin = $arraydtin[1];
							$diadtin = $arraydtin[0];
							$data_abt = $anodtin.'-'.$mesdtin.'-'.$diadtin;


/*
$month = substr($date,3,2);
$date = substr($date,0,2);
$year = substr($date,6,4);
$data_abt =  $year . '-' . $month . '-' . $date;
*/

$insert_abt = "

INSERT INTO conteudo_internet.abt
	  (
	  nome,
	  data,
	  foto_topo,
	  titulo,
	  campo_livre,
	  ativo,
	  ativo_home,
	  topo_brasil_pass,
	  foto_campo,
	  foto_topo_bpass,
	  foto1,
	  foto2,
	  foto3,
	  foto4,
      ativo_riolife,
      lang,
	  preco_abt,
	  fk_cidade_cod,
	  classic,
	  romantic, 
      family,
      beach,
      boat, 
      special_interest,
      adventure,
      cultural,
      active,
      nature,
      food_drinks,
      night_out,
      link_quotes_be,
	  link_quotes,
      tempo_abt,
	  new_mod
	  )
	VALUES 
	  (
	  '$nome',
	  '$data_abt',
	  '$foto_topo',
	  '$titulo',
	  '$campo_livre',
	   $ativo, 
	   $ativo_home,
	   $topo_brasil_pass,
	  '$foto_campo',
	  '$foto_topo_bpass',
	  '$foto1',
	  '$foto2',
	  '$foto3',
	  '$foto4',
      '$ativo_riolife',
      '$lang',
	  '$preco_abt',
	  '$cidade_cod',
	  '$classic',
	  '$romantic', 
      '$family',
      '$beach',
      '$boat', 
      '$special_interest',
      '$adventure',
      '$cultural',
      '$active',
      '$nature',
      '$food_drinks',
      '$night_out',
	  '$link_quotes_be',
      '$link_quotes',
      '$tempo_abt',
	  '$new_mod'






	  )

";
pg_query($conn, $insert_abt);


$pega_abt = "
select
     pk_abt
from
	conteudo_internet.abt
where
	 pk_abt = (select max(pk_abt) from conteudo_internet.abt)";


$result_abt = pg_exec($conn, $pega_abt);
if ($result_abt) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_abt); $rowcid++) {
		$pk_abt = pg_result($result_abt, $rowcid, 'pk_abt');
		 

	}
}


$result = (is_array($pk_cid_filtro_arr) ? count($pk_cid_filtro_arr) : 0); 




for ($rowvf = 0; $rowvf <  $result ; $rowvf++) 
{


if ($pk_cid_filtro_arr[$rowvf]  != '0' )
   {  

	$pk_cid = $pk_cid_filtro_arr[$rowvf];
	  

$insert_cidabt = "

   INSERT INTO conteudo_internet.abt_destinos
	  (
	  fk_cidade_cod,
	  fk_abt
	 )
   VALUES 
	 (
	 '$pk_cid',
     '$pk_abt'
     )

	 ";
	 pg_query($conn, $insert_cidabt);



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
				'Inseriu um novo ABT  - $nome - $pk_abt',
				'$data_now',
				'11'
			)
		";
	pg_query($conn, $query_log);


echo'<br>';
echo '<div id="tour_abt"><br><br>
<b>INSIRA OS ESTILOS</b><br>
<SELECT name="estilo" id="estilo"  onChange="javascript:insere_estilo();"> 
    <option value="0"  selected >Selecione</option>
	<option value="1"   >Ecologico</option>
	<option value="2"   >Familia</option>
	<option value="3"   >Praia</option>
	<option value="4"   >Spa</option>
	<option value="5"   >Lua de mel</option>
	<option value="6"   >Safari</option>
	<option value="7"   >Cruzeiros</option>
	<option value="8"   >Tudo incluido</option>
	<option value="9"   >Gastronomia</option>
	<option value="10"   >Aventura</option>
	<option value="11"   >Cultural</option>
</select>
<br>
 
<div id="estilos_do_abt">';



$pega_estilos="
	select
		cod_estilo, pk_estilo
	from
		conteudo_internet.abt_estilos
	where
		fk_abt = $pk_abt";


$result_tour = pg_exec($conn, $pega_estilos);


if ($result_tour) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_tour); $rowcid++) {
		$cod_estilo = pg_result($result_tour, $rowcid, 'cod_estilo');
        $pk_estilo = pg_result($result_tour, $rowcid, 'pk_estilo');
		
		
		if($cod_estilo == 1) {echo'-Ecologico | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 2) {echo'-Familia  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 3) {echo'-Praia  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 4) {echo'-Spa  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 5) {echo'-Lua de mel  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 6) {echo'-Safari  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 7) {echo'-Cruzeiros  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 8) {echo'-Tudo incluido  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 9) {echo'-Gastronomia  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 10) {echo'-Aventura  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 11) {echo'-Cultural  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}

 

	}
}



echo'</div>
<br><br>';
require_once 'abt_tour_form.php';
echo'</div>';

?>
