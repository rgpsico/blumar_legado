
<script type="text/javascript" src="http://www.blumar.com.br/util/jquery/ui/ui.datepicker.js"></script>
 
<script type="text/javascript" src="js/tar_htl.js"></script> 

<link rel="stylesheet" type="text/css" href="css/blumar.datepicker.css" /> 
<?php 
require_once '../util/connection.php';
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
 
echo'
<b>CADASTRO DE UM NOVO AROUND BRAZIL TOUR</b>
<br>
Nome:<br>
<input type="text" id="nome" name="nome" size="40"> <font color="red"><b>N</b></font><br>
<br>
Data: <input type="text" maxlength="20" size="10" id="date" name="date"    readonly><br>
<br>
Cidade base<br>
<select name="cidade_cod"    id="cidade_cod"   >
<option value="0" selected>Escolha uma cidade </option>
';

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
Mapa ABT: <input name="foto_topo" type="text" id="foto_topo" size="40" maxlength="500"> <br>
Título: <input name="titulo" type="text" id="titulo" size="40" maxlength="500"> <font color="red"><b>N</b></font><br>
<br>
Campo Livre <font color="red"><b>N</b></font><br>
<textarea name="campo_livre" id="campo_livre" rows="10" cols="40"></textarea><br>
<br>
Foto ABT Client Area:<br>
<input name="foto_campo" type="text" id="foto_campo" size="40"> <font color="red"><b>N</b></font><br>
<br>
Foto ABT Main Site:<br>
<input name="foto_topo_bpass" id="foto_topo_bpass" type="text"   size="40"><br>
<br>
Fotos Off the beaten track<br>
Foto 1 <input name="foto1" type="text"  id="foto1"  size="40"><br>
Foto 2 <input name="foto2" type="text"  id="foto2"  size="40"><br>
Foto 3 <input name="foto3" type="text"  id="foto3"  size="40"><br>
Foto 4 <input name="foto4" type="text"  id="foto4" size="40"><br>
<br>
Preço ABT (a partir de:)<br>
<input name="preco_abt" id="preco_abt" type="text"   size="20"><br>
<br>
<input type="checkbox" name="ativo" id="ativo"> Ativo na Internet<br>
<input type="checkbox" name="ativo_riolife" id="ativo_riolife"> Ativo na Riolife<br>
<input type="checkbox" name="ativo_home" id="ativo_home"> Aparecer na Home<br>
<input type="checkbox" name="topo_brasil_pass" id="topo_brasil_pass" > É Off the beaten track<br>
<input type="checkbox" name="newmod" id="newmod" > É novo modelo <font color="red"><b>N</b></font><br>
<br>
Idioma<br>
<SELECT name="lang" id="lang"> 
	<option value="1" selected>Ingles</option>
	<option value="2"  >Portugues</option>
	<option value="3"  >Espanhol</option>
</select>
<br><br>
<hr><br>
Modulo filtros <font color="red"><b>N</b></font><br>
<br>
<div id="">
Cidades do filtro <font color="red"><b>N</b></font>

<div id="cid_filtro_miolo">
<select id="cid_filtro"  name="cid_filtro[]"    >
<option value="0" selected>Escolha uma cidade </option>
';

$result_cid = pg_exec($conn, $query_cidade);
if ($result_cid) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++) {
		$nome_cid = pg_result($result_cid, $rowcid, 'nome_en');
		$cidade_cod = pg_result($result_cid, $rowcid, 'cidade_cod');
		 
		echo '<option value="'.$cidade_cod.'">'.$nome_cid.'</option>' ;
	 
	}
}

echo'

</select>  <a href="javascript:add_filtro_cid();"><b>+ add >></b></a>
</div>
<div id="cid_filtro_miolo2"></div>
</div>
<br>
<input type="checkbox" name="classic" id="classic"> Classic<br>
<input type="checkbox" name="romantic" id="romantic"> Romantic<br>
<input type="checkbox" name="family" id="family"> Family<br>
<input type="checkbox" name="beach" id="beach"> Beach<br>
<input type="checkbox" name="boat" id="boat"> Boat<br>
<input type="checkbox" name="special_interest" id="special_interest"> Special Interest<br>
<input type="checkbox" name="adventure" id="adventure"> Adventure<br>
<input type="checkbox" name="cultural" id="cultural"> Cultural<br>
<input type="checkbox" name="active" id="active"> Active<br>
<input type="checkbox" name="nature" id="nature"> Nature<br>
<input type="checkbox" name="night_out" id="night_out"> Night out<br>
<input type="checkbox" name="food_drinks" id="food_drinks"> Food & Drinks<br>
<br>
Link quotes  <input name="link_quotes" type="text"  id="link_quotes" size="55"> <font color="red"><b>N</b></font><br>
Link quotes BE <input name="link_quotes_be" type="text"  id="link_quotes_be" size="55"> <font color="red"><b>N</b></font><br>
Tempo abt  <input name="tempo_abt" type="text"  id="tempo_abt" size="10"> <font color="red"><b>N</b></font><br>
<br>
<hr>
<br><br>
<input type="submit" name="Submit" value="Cadastrar"   onClick="javascript:input_novo_abt();"  >
<br><br>
';




?>