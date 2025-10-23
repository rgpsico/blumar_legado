<?php 

ini_set('display_errors', 1);
error_reporting(~0);
require_once '../util/connection.php';





$query_cidade =
"
        select 
            pk_cidade_tpo, 
            nome_pt, 
            nome_en, 
            descritivo_pt, 
            descritivo_en, 
            foto1, 
            foto2,
            tpocidcod,
            cidade_cod 
        from 
            tarifario.cidade_tpo
        order by 
            nome_en
    
";






echo'
<b>CADASTRO DE NOVO POST</b><br> 

<div id="box2">
<div id="box1">
    Tipo<br> 
    <select name="classif" id="classif">
        <option value="0">-----------------</option>  
        <option value="1">Hotels</option> 
        <option value="2">Tours</option>
        <option value="3">Boats</option>
        <option value="4">Flights</option>
        <option value="5">Destinations</option>
        <option value="6">Festivals</option>
    </select> 
</div>
<div id="box1">
Data publicação<br>
     <input type="text" name="data_post" id="data_post" maxlength="10"  size="10">
 </div>
</div>

<div id="box2">
<div id="box1">
<select name="citie" id="citie"  > 
	    <option value="0" selected>Escolha uma cidade para o post</option>



';
$result_cidade = pg_exec($conn, $query_cidade);
if ($result_cidade) {
for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
        
         $nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
         $cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
         

        echo '<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';


    }
    }






ECHO'	</select></div>

</div>


<div id="box2">

<div id="box1">
Regi&atilde;o Geografica<br>
			<select name="regiao" id="regiao">
				<option value="0">-----------------</option>  
				<option value="1">Norte</option> 
				<option value="2">Nordeste</option>
				<option value="3">Sudeste</option>
				<option value="4">Centro-Oeste</option>
				<option value="5">Sul</option>
			</select> 
</div>
</div>





 <div id="box2">
    <div id="box1">
		Titulo<br>
		<input type="text" name="titulo" id="titulo" maxlength="200"  size="100">
	</div>
  </div>
  <div id="box7"> 
     Descritivo Blumar<br> 
     <br>
     <textarea name="descritivo_blumar" id="descritivo_blumar" rows="15" cols="100"></textarea>
</div>
 <div id="box7"> 
      Descritivo BeBrazil<br><br>
 <textarea name="descritivo_be" id="descritivo_be" rows="15" cols="100"></textarea>
</div>
 
<div id="box2">
<div id="box1">
Foto capa<br>
        <input type="text" name="foto_capa" id="foto_capa" maxlength="200"  size="100">
    </div>
</div>

<div id="box2">
<div id="box1">
Foto topo<br>
        <input type="text" name="foto_topo" id="foto_topo" maxlength="200"  size="100">
    </div>
</div>



<div id="box2">
<div id="box1">
URL Video<br>
        <input type="text" name="url_video" id="url_video" maxlength="200"  size="100">
    </div>
</div>

<div id="box2">
<div id="box1">
Meta description<br>
        <input type="text" name="meta_description" id="meta_description" maxlength="200"  size="100">
    </div>
</div>
<div id="box5"><input name="ativo" type="checkbox"  id="ativo"   checked> Ativo<br><br>
	<input type="button"  name="Go" value="Inserir" onclick="javascript:insere_novo_post();"  ></div>
	<div id="box6"></div>
';




