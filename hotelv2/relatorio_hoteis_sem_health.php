<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php   

require_once '../util/connection.php';
$pk_tarifario = '172';
$tipo_tar = 2;

//Pega o ultimo tarifario gerado para o tarifario em uso
require('classes/logeracao.php');
$pegalogera = new getlogera();
$load_pklog = $pegalogera->Load($pk_tarifario, $tipo_tar);
$pk_log_geracao_tarifario = $pegalogera->Get('pk_log_geracao_tarifario');
$data_criacao = $pegalogera->Get('data_criacao');

$busca_tarifas= "Select distinct
					tarif_htl.mneu_for,
 trim(upper(tarif_htl.nome_for)) as lHotel,
trim(upper(nome_cid)) as cidade 
 From tarifario.tarif_htl
left outer join conteudo_internet.ci_hotel on tarif_htl.mneu_for = conteudo_internet.ci_hotel.mneu_for
inner join tarifario.log_geracao_tarifario on tarif_htl.fk_log_geracao_tarifario = tarifario.log_geracao_tarifario.pk_log_geracao_tarifario
inner join sbd95.fornec on tarif_htl.mneu_for = sbd95.fornec.mneu_for
inner join sbd95.classif on sbd95.fornec.id_classif = sbd95.classif.id_classif
left outer join sbd95.apto_htl on tarifario.tarif_htl.cod_apto = sbd95.apto_htl.cod_apto
WHERE pk_tarifario = $pk_tarifario
and pk_log_geracao_tarifario = '$pk_log_geracao_tarifario'
AND LOWER(nao_aparece) <> 's'
AND LOWER(coalesce(fornec.nao_web,'')) <> 's' 
and  tarif_htl.mneu_for  not in (select id_htl from tarifario.hotel_health_cadastro )
order by   lHotel  ";
$result_busca_tarifas = pg_exec($conn, $busca_tarifas);


echo'<b>LISTAGEM DE HOTEIS DO TARIFÁRIO SEM FORMULÁRIO HEALTH & SAFE</b><br><br>';

echo'Log de geração '.$pk_log_geracao_tarifario.' em '.$data_criacao.'<br>';

echo'Numero de hotéis sem relatorio:'.pg_numrows($result_busca_tarifas).'<br><br>'; 

for ($rowt = 0; $rowt < pg_numrows($result_busca_tarifas) ; $rowt++)
{
	 
	$lhotel = trim(pg_result($result_busca_tarifas, $rowt, 'lhotel'));

echo $lhotel.'<br>';
}





?>
</body>
</html>
