<?php 


require_once '../util/connection.php';

$cod_venues = $_GET["cod_venues"];


$pega_venue = "
select *
from
conteudo_internet.venues
where
cod_venues = $cod_venues
";

$result_venue = pg_exec($conn, $pega_venue);
if ($result_venue) {
	for ($rowrest = 0; $rowrest < pg_numrows($result_venue); $rowrest++) {
			
		$cod_venues = pg_result($result_venue, $rowrest, 'cod_venues');
		$nome = pg_result($result_venue, $rowrest, 'nome');
		$mneu_for = pg_result($result_venue, $rowrest, 'mneu_for');
		$fk_cod_cidade  = pg_result($result_venue, $rowrest, 'fk_cod_cidade');
		$especialidade = pg_result($result_venue, $rowrest, 'especialidade');
		$descritivo_en = pg_result($result_venue, $rowrest, 'descritivo_en');
		$descritivo_pt = pg_result($result_venue, $rowrest, 'descritivo_pt');
		$descritivo_esp = pg_result($result_venue, $rowrest, 'descritivo_esp');
		$foto1 = pg_result($result_venue, $rowrest, 'foto1');
		$foto2 = pg_result($result_venue, $rowrest, 'foto2');
		$ativo = pg_result($result_venue, $rowrest, 'ativo');
	}

}


$cidade_rest = "
SELECT *
FROM
tarifario.cidade_tpo
where
cidade_cod = $fk_cod_cidade
";


$result_cidade_rest = pg_exec($conn, $cidade_rest);
if ($result_cidade_rest) {
	for ($rowcidrest = 0; $rowcidrest < pg_numrows($result_cidade_rest); $rowcidrest++) {
		$nome_en = pg_result($result_cidade_rest, $rowcidrest, 'nome_en');
		$cidade_cod = pg_result($result_cidade_rest, $rowcidrest, 'cidade_cod');



	}
}


echo
'
<div id="inner_template_restaurantes">
<p class="texto1">'.$nome_en.'</p>
<p class="texto2">'.$nome.'</p>
<p class="texto3">'.$descritivo_en.'</p>
<div id="foto"><img src="http://www.blumar.com.br/'.$foto1.'"></div>
<div id="foto"><img src="http://www.blumar.com.br/'.$foto2.'"></div>
</div>


';




?>