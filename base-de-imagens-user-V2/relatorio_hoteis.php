<?php


If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';



$pega_cidadestp= "select distinct fk_cidcod,
upper((select nome_en from tarifario.cidade_tpo where cidade_cod = fk_cidcod)) as nome_en
from
banco_imagem.bco_img
where
tp_produto = 1";
$result_cidadestp = pg_exec($conn, $pega_cidadestp);



$arquivo = 'planilha.xls';

$html = '';
$html .= '<table border="1">';





for ($rowcid = 0; $rowcid < pg_numrows($result_cidadestp); $rowcid++)
{
	$fk_cidcod = pg_result($result_cidadestp, $rowcid, 'fk_cidcod');
	$nome_en = pg_result($result_cidadestp, $rowcid, 'nome_en');
	
	$html .= '<tr><td><font size="1" face="arial"><b></b></font></td><td></td></tr>';
	$html .= '<tr><td><font size="1" face="arial"><b>'.$nome_en.'</b></font></td><td></td></tr>';
	$html .= '<tr><td><font size="1" face="arial"><b></b></font></td><td></td></tr>';
	
	$pegahtls="select distinct mneu_for,
			(select nome_for from sbd95.fornec where mneu_for = banco_imagem.bco_img.mneu_for ) as nome_for,
			split_part(mneu_for, 'avulso',1) as mneu_for2,
			nome_produto
			from
			banco_imagem.bco_img
			where
			tp_produto = 1
			and fk_cidcod = $fk_cidcod
			order by nome_for";
	$result_pegahtls = pg_exec($conn, $pegahtls);
	
  for ($row= 0; $row < pg_numrows($result_pegahtls); $row++)
	{
		$nome_for = pg_result($result_pegahtls, $row, 'nome_for');
		if(strlen($nome_for) != 0)
		{
		 $html .= '<tr><td><font size="1" face="arial"><b>'.$nome_for.'</b></font></td><td></td></tr>';
	     }
	 }	
 }

$html .= '</table>';

// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel; charset=utf-8");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );



// Envia o conteúdo do arquivo
echo $html;




