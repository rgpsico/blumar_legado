
<script type="text/javascript" src="http://www.blumar.com.br/util/jquery/ui/ui.datepicker.js"></script>
<script type="text/javascript" src="http://www.blumar.com.br/util/js/ui.datepicker-pt-BR.js"></script>
<script type="text/javascript" src="js/tar_htl.js"></script> 

<link rel="stylesheet" type="text/css" href="css/blumar.datepicker.css" /> 

<?php 
 ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$pk_abt = pg_escape_string($_POST["pk_abt"]);



$pega_abt = "
select
	  nome,
	  data,
	  foto_topo,
	  titulo,
	  campo_livre,
	  ativo,
	  ativo_home,
	  foto_campo,
	  topo_brasil_pass,
	  foto_topo_bpass,
	  novo_mapa,
	  nova_foto,
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
      link_quotes,
	  link_quotes_be,
      tempo_abt,
	  new_mod
from
	conteudo_internet.abt
where
	pk_abt = $pk_abt

";

	$result_abt = pg_exec($conn, $pega_abt);


	if ($result_abt) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_abt); $rowcid++) {
				$nome = pg_result($result_abt, $rowcid, 'nome');
				$data = pg_result($result_abt, $rowcid, 'data');
				$foto_topo = pg_result($result_abt, $rowcid, 'foto_topo');
				$titulo = pg_result($result_abt, $rowcid, 'titulo');
				$campo_livre = pg_result($result_abt, $rowcid, 'campo_livre');
				$ativo = pg_result($result_abt, $rowcid, 'ativo');
				$ativo_home = pg_result($result_abt, $rowcid, 'ativo_home');
				$foto_campo = pg_result($result_abt, $rowcid, 'foto_campo');
				$topo_brasil_pass = pg_result($result_abt, $rowcid, 'topo_brasil_pass');
				$foto_topo_bpass = pg_result($result_abt, $rowcid, 'foto_topo_bpass');
				$novo_mapa = pg_result($result_abt, $rowcid, 'novo_mapa');
				$nova_foto = pg_result($result_abt, $rowcid, 'nova_foto');
				$foto1 = pg_result($result_abt, $rowcid, 'foto1');
				$foto2 = pg_result($result_abt, $rowcid, 'foto2');
				$foto3 = pg_result($result_abt, $rowcid, 'foto3');
				$foto4 = pg_result($result_abt, $rowcid, 'foto4');
                $ativo_riolife = pg_result($result_abt, $rowcid, 'ativo_riolife');
                $lang = pg_result($result_abt, $rowcid, 'lang');
				$preco_abt = pg_result($result_abt, $rowcid, 'preco_abt');
				$cidade_cod = pg_result($result_abt, $rowcid, 'fk_cidade_cod');
				$classic = pg_result($result_abt, $rowcid, 'classic');
				$romantic = pg_result($result_abt, $rowcid, 'romantic'); 
				$family = pg_result($result_abt, $rowcid, 'family');
				$beach = pg_result($result_abt, $rowcid, 'beach');
				$boat = pg_result($result_abt, $rowcid, 'boat'); 
				$special_interest = pg_result($result_abt, $rowcid, 'special_interest');
				$adventure = pg_result($result_abt, $rowcid, 'adventure');
				$cultural = pg_result($result_abt, $rowcid, 'cultural');
				$active = pg_result($result_abt, $rowcid, 'active');
				$nature = pg_result($result_abt, $rowcid, 'nature');
				$food_drinks = pg_result($result_abt, $rowcid, 'food_drinks');
				$night_out = pg_result($result_abt, $rowcid, 'night_out');
				$link_quotes = pg_result($result_abt, $rowcid, 'link_quotes');
				$link_quotes_be = pg_result($result_abt, $rowcid, 'link_quotes_be');
				$tempo_abt = pg_result($result_abt, $rowcid, 'tempo_abt');
                $new_mod = pg_result($result_abt, $rowcid, 'new_mod');




				
		}
	}

	$month = substr($data,5,2);
	$date = substr($data,8,2);
	$year = substr($data,0,4);
	$data_abt =  $date.'/'.$month.'/'.$year;



	

		if (strlen($cidade_cod) != 0)
		{
				 $query_uma_cidade = "
				 select 
					pk_cidade_tpo, 
					nome_pt, 
					nome_en, 
					cidade_cod, 
					tpocidcod 
				 from 
					tarifario.cidade_tpo
				 order by 
					cidade_cod = $cidade_cod";
					
				$result_uma_cidade = pg_exec($conn, $query_uma_cidade);
				if (pg_numrows($result_uma_cidade) != 0) 
				{
					for ($rowcid = 0; $rowcid < pg_numrows($result_uma_cidade); $rowcid++) {
						$nome_ucid = pg_result($result_uma_cidade, $rowcid, 'nome_en');
						$cidade_ucod = pg_result($result_uma_cidade, $rowcid, 'cidade_cod');
						 
						$ucid = '<option value="'.$cidade_ucod.'" selected>'.$nome_ucid.'</option>' ;
					 
					}
				}
				else
				{
				$ucid = '<option value="0" selected>Escolha uma cidade </option>' ;
				}
		
		}
		else
		{
		$ucid = '<option value="0" selected>Escolha uma cidade </option>' ;
		}
		




// query do filtro de cidades


$query_cidade = "
select 
	pk_cidade_tpo, 
	nome_pt, 
	nome_en, 
   cidade_cod, 
   tpocidcod 
from 
	tarifario.cidade_tpo
order by 
	nome_en";


$selected_cities='<select id="cid_filtro"  name="cid_filtro[]"    >';

$selected_cities3='<option value="0"  >Escolha uma cidade </option>';
$selected_cities4='';

$result_cid2 = pg_exec($conn, $query_cidade);
if ($result_cid2) {
	for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_cid2); $rowcid2++) {
		$nome_cid = pg_result($result_cid2, $rowcid2, 'nome_en');
		$cidade_cod = pg_result($result_cid2, $rowcid2, 'cidade_cod');
		 
		$selected_cities4=$selected_cities4.'<option value="'.$cidade_cod.'">'.$nome_cid.'</option>' ;
	 
	}
}



$dump_selecionadas='';
$dump_selecionadas2='';
$selected_cities5='';
$query_cidades_filtro = "
select 
   fk_cidade_cod,
   pk_abt_destinos
from 
   conteudo_internet.abt_destinos
where fk_abt = $pk_abt ";
$result_cidades_filtro = pg_exec($conn, $query_cidades_filtro);

//echo pg_numrows($result_cidades_filtro);

if (pg_numrows($result_cidades_filtro) != 0) 
				{

              

					for ($rowcid1 = 0; $rowcid1 < pg_numrows($result_cidades_filtro); $rowcid1++) {


						$fk_cidade_cod = pg_result($result_cidades_filtro, $rowcid1, 'fk_cidade_cod');
						$pk_abt_destinos = pg_result($result_cidades_filtro, $rowcid1, 'pk_abt_destinos');

						//echo $fk_cidade_cod.'-';

						$dump_selecionadas =  $dump_selecionadas.$selected_cities;


						$query_uma_cidade_filtro = "
						select 
						   pk_cidade_tpo, 
						   nome_pt, 
						   nome_en, 
						   cidade_cod, 
						   tpocidcod 
						from 
						   tarifario.cidade_tpo
						order by 
						   cidade_cod = $fk_cidade_cod";

						   $result_uma_cidade_filtro = pg_exec($conn, $query_uma_cidade_filtro);

									for ($rowcid4 = 0; $rowcid4 < pg_numrows($result_uma_cidade_filtro); $rowcid4++)
										{
										$nome_ucid1 = pg_result($result_uma_cidade_filtro, $rowcid4, 'nome_en');
										$cidade_ucod1 = pg_result($result_uma_cidade_filtro, $rowcid4, 'cidade_cod');
										
										$selected_cities2='<option value="'.$cidade_ucod1.'" selected>'.$nome_ucid1.'</option>' ;
									
										}


					    $selected_cities5 = $selected_cities5.$nome_ucid1.' -  <input type="hidden" id="pk_abt_destinos" name="pk_abt_destinos[]" value="'.$cidade_ucod1.'"><a href="javascript:alt_filtro_cid();"><b>+ add </b></a> | <a href="##" class="pkremcid" title="remover cidade"><input type="hidden" class="pkremcidvalue" value="'.$pk_abt_destinos.'"> <b>- Remove </b></a>  <br>';



						$dump_selecionadas =  $dump_selecionadas.$selected_cities2.$selected_cities3.$selected_cities4.$selected_cities5;

											 
						 
					 
					}
				}














echo'
<div id="abt_left">
<b>ALTERAÇÃO DE AROUND BRAZIL TOUR</b>
<br>ID = '.$pk_abt.'<br><br>
Nome:<br>
<input type="text" id="nome" name="nome" value="'.$nome.'" size="40"> <font color="red"><b>N</b></font><br>
<br>
Data: <input type="text" maxlength="20" size="10" id="date" name="date" value="'.$data_abt.'"   readonly><br> 
<br>
Cidade base<br>
<select name="cidade_cod"    id="cidade_cod"   >';
echo $ucid;


$result_cid = pg_exec($conn, $query_cidade);
if ($result_cid) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++) {
		$nome_cid = pg_result($result_cid, $rowcid, 'nome_en');
		$cidade_cod = pg_result($result_cid, $rowcid, 'cidade_cod');
		 
		echo '<option value="'.$cidade_cod.'">'.$nome_cid.'</option>' ;
	 
	}
}

echo'</select><br>
<br>
Mapa ABT: <input name="foto_topo" type="text" id="foto_topo" size="40" maxlength="500"  value="'.$foto_topo.'"><br>
Título: <input name="titulo" type="text" id="titulo" size="40" maxlength="500"  value="'.$titulo.'">  <font color="red"><b>N</b></font><br>
<br>
Campo Livre  <font color="red"><b>N</b></font><br>
<textarea name="campo_livre" id="campo_livre" rows="10" cols="40">'.$campo_livre.'</textarea><br>
<br>
Foto ABT Client Area:<br>
<input name="foto_campo" type="text" id="foto_campo" size="40" value="'.$foto_campo.'">  <font color="red"><b>N</b></font><br>
<br>
Foto ABT Main Site:<br>
<input name="foto_topo_bpass" id="foto_topo_bpass" type="text"   size="40" value="'.$foto_topo_bpass.'"><br>
<br>
Fotos Off the beaten track<br>
Foto 1 <input name="foto1" type="text"  id="foto1"  size="40" value="'.$foto1.'"><br>
Foto 2 <input name="foto2" type="text"  id="foto2"  size="40" value="'.$foto2.'"><br>
Foto 3 <input name="foto3" type="text"  id="foto3"  size="40" value="'.$foto3.'"><br>
Foto 4 <input name="foto4" type="text"  id="foto4" size="40" value="'.$foto4.'"><br>
<br>
Preço ABT (a partir de:)<br>
<input name="preco_abt" id="preco_abt" type="text" value="'.$preco_abt.'"  size="20"><br>
<br>
<input type="checkbox" name="ativo" id="ativo"';  if ( $ativo == 't' ){ echo "checked"; } echo ' > Ativo na Internet<br>
<input type="checkbox" name="ativo_riolife" id="ativo_riolife"';  if ( $ativo_riolife == 't' ){ echo "checked"; } echo '> Ativo na Riolife<br>
<input type="checkbox" name="ativo_home" id="ativo_home" ';  if ( $ativo_home == 't' ){ echo "checked"; } echo '> Aparecer na Home<br>
<input type="checkbox" name="topo_brasil_pass" id="topo_brasil_pass"';  if ( $topo_brasil_pass == 't' ){ echo "checked"; } echo ' > É Off the beaten track<br>
<input type="checkbox" name="newmod" id="newmod"';  if ( $new_mod == 't' ){ echo "checked"; } echo ' > É novo modelo  <font color="red"><b>N</b></font><br>
<br>
<br>
<hr><br>
Modulo filtros  <font color="red"><b>N</b></font>
<br>
<br>
 Cidades do filtro

<div id="cid_filtro_miolo">';





echo $selected_cities5;

echo'<br><br><a href="javascript:alt_filtro_cid();"><b>+ add </b></a> ';

echo'</div>
<br>
<input type="checkbox" name="classic" id="classic"';  if ( $classic == 't' ){ echo "checked"; } echo '> Classic<br>
<input type="checkbox" name="romantic" id="romantic"';  if ( $romantic == 't' ){ echo "checked"; } echo '> Romantic<br>
<input type="checkbox" name="family" id="family"';  if ( $family == 't' ){ echo "checked"; } echo '> Family<br>
<input type="checkbox" name="beach" id="beach"';  if ( $beach == 't' ){ echo "checked"; } echo '> Beach<br>
<input type="checkbox" name="boat" id="boat"';  if ( $boat == 't' ){ echo "checked"; } echo '> Boat<br>
<input type="checkbox" name="special_interest" id="special_interest"';  if ( $special_interest == 't' ){ echo "checked"; } echo '> Special Interest<br>
<input type="checkbox" name="adventure" id="adventure"';  if ( $adventure == 't' ){ echo "checked"; } echo '> Adventure<br>
<input type="checkbox" name="cultural" id="cultural"';  if ( $cultural == 't' ){ echo "checked"; } echo '> Cultural<br>
<input type="checkbox" name="active" id="active"';  if ( $active == 't' ){ echo "checked"; } echo '> Active<br>
<input type="checkbox" name="nature" id="nature"';  if ( $nature == 't' ){ echo "checked"; } echo '> Nature<br>
<input type="checkbox" name="night_out" id="night_out"';  if ( $night_out == 't' ){ echo "checked"; } echo '> Night out<br>
<input type="checkbox" name="food_drinks" id="food_drinks"';  if ( $food_drinks == 't' ){ echo "checked"; } echo '> Food & Drinks<br><br>
Link quotes  <input name="link_quotes" type="text"  id="link_quotes" size="65" value="'.$link_quotes.'">  <font color="red"><b>N</b></font><br>
Link quotes BE <input name="link_quotes" type="text"  id="link_quotes_be" size="65" value="'.$link_quotes_be.'">  <font color="red"><b>N</b></font><br>
Tempo abt  <input name="tempo_abt" type="text"  id="tempo_abt" size="10" value="'.$tempo_abt.'">  <font color="red"><b>N</b></font><br>
<br>
<hr>
<br> 
Idioma<br>
<SELECT name="lang" id="lang"> 
	<option value="1" ';  if ( $lang == 1 ){ echo "selected"; } echo ' >Ingles</option>
	<option value="2" ';  if ( $lang == 2 ){ echo "selected"; } echo ' >Portugues</option>
	<option value="3" ';  if ( $lang == 3 ){ echo "selected"; } echo ' >Espanhol</option>
</select>
<br><br>
Insira um estilo<br>
<SELECT name="estilo" id="estilo"  onChange="javascript:insere_estilo();"> 
    <option value="0"  selected >Selecione</option>
	<option value="1"   >Ecologico</option>
	<option value="2"   >Familia</option>
	<option value="3"   >Praia</option>
	<option value="4"   >Resorts</option>
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
<br><br>
<input type="hidden" name="pk_abt" id="pk_abt" value="'.$pk_abt.'">
<input type="submit" name="Submit" value="Cadastrar"   onClick="javascript:update_abt();"  >
<br><br>
</div>

';
	
	$pega_tour_abt = "
		select
			pk_abt_conteudo,
			dia_conteudo
		from
			conteudo_internet.abt_conteudo
		where
			fk_abt = $pk_abt
		order by dia_conteudo
	";

$result_abt = pg_exec($conn, $pega_tour_abt);


echo'
<div id="abt_right">
<b>ALTERAÇÃO DE TOUR</b><br><br>
<a href="#" onClick="javascript:update_cad_bt();""><b>ALTERAR CADASTRO >></b></a>
<br><br>
';


if ($result_abt) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_abt); $rowcid++) {
		$pk_abt_conteudo = pg_result($result_abt, $rowcid, 'pk_abt_conteudo');
		$dia_conteudo = pg_result($result_abt, $rowcid, 'dia_conteudo');

		echo '<a href="#" class="pkabtconteudo">Dia '.$dia_conteudo.' <b>>></b><input type="hidden"  class="pkabtconteudoValue" value="'.$pk_abt_conteudo.'"></a>
		      -------
              <a href="#" class="delpkabt"><input type="hidden"  class="delpkabtValue" value="'.$pk_abt_conteudo.'"><img src="images/del.png" title="Apagar Dia '.$dia_conteudo.'"></a>
			  <br>--------------<br>';


	}
}

echo'

<br><br>
<a href="##" onclick="javascript: novo_tour_abt();">+ adicionar dia <b> >></b></a>

</div>';

?>