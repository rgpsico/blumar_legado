<?php 


require_once '../util/connection.php';

$pk_abt = pg_escape_string($_GET["pkabt"]);



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
foto4
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
	}
}

$month = substr($data,5,2);
$date = substr($data,8,2);
$year = substr($data,0,4);
$data_abt =  $date.'/'.$month.'/'.$year;


echo '
<br><b>DESCRITIVO DE AROUND BRAZIL TOURS</b><br><br> 
'.$titulo.'<br>
 <img src="http://www.blumar.com.br/bancoimagemfotos/arounds/client_area/'.$foto_campo.'"><br> 
<img src="http://www.blumar.com.br/bancoimagemfotos/arounds/mapas/'.$foto_topo.'">
'.$campo_livre.'<br>

';




	$pega_tour_abt = "
		select
			pk_abt_conteudo,
			dia_conteudo,
			titulo_conteudo,
			descritivo_conteudo,
			foto1_conteudo,
			fk_abt,
			layout_conteudo
		from
			conteudo_internet.abt_conteudo
		where
			fk_abt = $pk_abt
		order by 
			dia_conteudo
	";

$result_abt = pg_exec($conn, $pega_tour_abt);


 


if ($result_abt) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_abt); $rowcid++) {
		$pk_abt_conteudo = pg_result($result_abt, $rowcid, 'pk_abt_conteudo');
		$dia_conteudo = pg_result($result_abt, $rowcid, 'dia_conteudo');
		$titulo_conteudo = pg_result($result_abt, $rowcid, 'titulo_conteudo');
		$foto1_conteudo = pg_result($result_abt, $rowcid, 'foto1_conteudo');
		$descritivo_conteudo = pg_result($result_abt, $rowcid, 'descritivo_conteudo');
		

		echo '
		<br>
		<b> '.$titulo_conteudo.'</b><br>
        '.$descritivo_conteudo.'<br><br>
		';


	}
}














?>