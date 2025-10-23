<?php 

ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$pk_blognacional = pg_escape_string($_POST["pk_blognacional"]);


$sql_posts = 
"
SELECT * FROM conteudo_internet.blog_nacional
where  pk_blognacional = $pk_blognacional
";
$result_posts = pg_exec($conn, $sql_posts);


if ($result_posts) {
    for ($rowcid = 0; $rowcid < pg_numrows($result_posts); $rowcid++) {
        $pk_blognacional  = pg_result($result_posts, $rowcid, 'pk_blognacional');   
        $titulo = pg_result($result_posts, $rowcid, 'titulo');
        $data_post = pg_result($result_posts, $rowcid, 'data_post');
        $foto_capa = pg_result($result_posts, $rowcid, 'foto_capa');
        $foto_topo = pg_result($result_posts, $rowcid, 'foto_topo');
        $descritivo_blumar = pg_result($result_posts, $rowcid, 'descritivo_blumar');
        $descritivo_be = pg_result($result_posts, $rowcid, 'descritivo_be');
        $classif = pg_result($result_posts, $rowcid, 'classif');
        $url_video = pg_result($result_posts, $rowcid, 'url_video');
        $meta_description = pg_result($result_posts, $rowcid, 'meta_description');
        $citie = pg_result($result_posts, $rowcid, 'citie');
        $regiao = pg_result($result_posts, $rowcid, 'regiao');
        $ativo = pg_result($result_posts, $rowcid, 'ativo');
     }
}




$arrayData = explode("-",$data_post);
$diain = $arrayData[2];
$mesin = $arrayData[1];
$anoin = $arrayData[0];
$inseredata_post = $diain.'/'.$mesin.'/'.$anoin;


if(strlen($citie) != 0)
{

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
   cidade_cod = $citie";

   $result_uma_cidade_filtro = pg_exec($conn, $query_uma_cidade_filtro);

            for ($rowcid4 = 0; $rowcid4 < pg_numrows($result_uma_cidade_filtro); $rowcid4++)
                {
                $nome_ucid1 = pg_result($result_uma_cidade_filtro, $rowcid4, 'nome_en');
                $cidade_ucod1 = pg_result($result_uma_cidade_filtro, $rowcid4, 'cidade_cod');
                
                     $selected_cities2='<option value="'.$cidade_ucod1.'" selected>'.$nome_ucid1.'</option>' ;
            
                }

}
else
{





}




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
    <select name="classif" id="classif">';

    if ($classif == '1')
    {
        echo '<option value="1" selected>Hotels</option>';
    }
elseif ($classif == '2')
    {
        echo '<option value="2" selected>Tours</option>';
    }
elseif ($classif == '3')
    {
        echo '<option value="3" selected>Boats</option>';
    }
elseif ($classif == '4')
    {
        echo '<option value="4" selected>Flights</option>';
    }
elseif ($classif == '5')
    {
        echo '<option value="5" selected>Destinations</option>';
    }
elseif ($classif == '6')
    {
        echo '<option value="6" selected>Festivals</option>';
    }




    echo'
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
     <input type="text" name="data_post" id="data_post" maxlength="10"  size="10" value="'.$inseredata_post.'">
 </div>
</div>




<div id="box2">
<div id="box1">
<select name="citie" id="citie"  >';

if(strlen($citie) == 0)
{
echo'<option value="0" selected>Escolha uma cidade para o post</option>';
}
else
{
echo $selected_cities2;
echo'<option value="0"  >Escolha uma cidade para o post</option>';
}





$result_cidade = pg_exec($conn, $query_cidade);
if ($result_cidade) {
for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
        
         $nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
         $cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
         

        echo '<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';


    }
    }






ECHO'	</select>
</div>
</div>

<div id="box2">
		<div id="box1">
			Regi&atilde;o Geografica<br> 
			<select name="regiao" id="regiao">';
			   
			    
			    if ($regiao == '1')
				    {
				    	echo '<option value="1" selected>Norte</option>';
				    }
			    elseif ($regiao == '2')
				    {
				    	echo '<option value="2" selected>Nordeste</option>';
				    }
			    elseif ($regiao == '3')
				    {
				    	echo '<option value="3" selected>Sudeste</option>';
				    }
			    elseif ($regiao == '4')
				    {
				    	echo '<option value="4" selected>Centro-Oeste</option>';
				    }
			    elseif ($regiao == '5')
				    {
				    	echo '<option value="5" selected>Sul</option>';
				    }
			    
			 echo'
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
		<input type="text" name="titulo" id="titulo" maxlength="200"  size="100"  value="'.$titulo.'">
	</div>
  </div>
  <div id="box7"> 
     Descritivo Blumar<br> 
     <br>
     <textarea name="descritivo_blumar" id="descritivo_blumar" rows="15" cols="100">'.$descritivo_blumar.'</textarea>
</div>
 <div id="box7"> 
      Descritivo BeBrazil<br><br>
 <textarea name="descritivo_be" id="descritivo_be" rows="15" cols="100">'.$descritivo_be.'</textarea>
</div>
 
<div id="box2">
<div id="box1">
Foto capa<br>
        <input type="text" name="foto_capa" id="foto_capa" maxlength="200"  size="100" value="'.$foto_capa.'">
    </div>
</div>

<div id="box2">
<div id="box1">
Foto topo<br>
        <input type="text" name="foto_topo" id="foto_topo" maxlength="200"  size="100" value="'.$foto_topo.'">
    </div>
</div>
<div id="box2">
<div id="box1">
URL Video<br>
        <input type="text" name="url_video" id="url_video" maxlength="200"  size="100" value="'.$url_video.'">
    </div>
</div>

<div id="box2">
<div id="box1">
Meta description<br>
        <input type="text" name="meta_description" id="meta_description" maxlength="200"  size="100" value="'.$meta_description.'">
    </div>
</div>
<div id="box5"><input name="ativo" type="checkbox"  id="ativo"  '; if($ativo == 't'){echo'checked';} echo'> Ativo<br><br>
<input type="hidden" name="pk_blognacional" id="pk_blognacional"  value="'.$pk_blognacional.'">
<input type="button"  name="Go" value="Inserir" onclick="javascript:alteracao_post();"  ></div>
	<div id="box6"></div>
';





