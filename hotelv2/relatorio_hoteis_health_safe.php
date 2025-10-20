<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Relatorio de hoteis com selo NEW</title>
<meta http-equiv="Content-Type"  content="text/html; charset=utf-8" />
</head>

<body>
<font face="Arial, Helvetica, sans-serif" size="3"><b>Relatorio de hoteis com o Formulario "Health & safe"</b></font><br><br>
 <table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="" style="color:#FFFFFF; ">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


<?php   

require_once '../util/connection.php';

$pega_hoteis_concluidos="select *, 
                        (select nome_for from sbd95.fornec where mneu_for = tarifario.hotel_health_cadastro.id_htl ) as nome_hotel,
                        to_char(data_conclusao, 'DD/MM/YYYY') as dt_conclusao 
                         from tarifario.hotel_health_cadastro 
                         where id_55_concluido = 'true' 
                         order by nome_hotel";
$result_hoteis_concluidos = pg_exec($conn, $pega_hoteis_concluidos);
$num_concluidos = pg_numrows($result_hoteis_concluidos); 


$pega_hoteis_nconcluidos="select *, 
                        (select nome_for from sbd95.fornec where mneu_for = tarifario.hotel_health_cadastro.id_htl ) as nome_hotel 
                         from tarifario.hotel_health_cadastro 
                         where id_55_concluido = 'false' 
                         order by nome_hotel";
$result_hoteis_nconcluidos = pg_exec($conn, $pega_hoteis_nconcluidos);
$num_nconcluidos = pg_numrows($result_hoteis_nconcluidos); 








echo 'Hoteis com formulario concluido: <strong>'.$num_concluidos.'</strong><br>
      Hoteis com o formulario não concluido: <strong>'.$num_nconcluidos.'</strong><br>
<hr>
Listagem de Hotéis com o formulario concluido<br>
<table width="660" border="1" cellspacing="1" cellpadding="2"  align="center">
  <tr  bgcolor="#7c7b7b"  style="color:#FFFFFF; ">
    <td width="200" align="center"><strong>Hotel</strong></td>
    <td width="200" align="center"><strong>Responsável</strong></td>
    <td width="140" align="center"><strong>Cargo</strong></td>
    <td width="60" align="center">concl.</td>
    <td width="60" align="center">&nbsp;</td>
   <td width="60" align="center">&nbsp;</td>
  </tr>'; 

for ($row = 0; $row < pg_numrows($result_hoteis_concluidos); $row++) 
        {
              $pk_htl_health = pg_result($result_hoteis_concluidos, $row, 'pk_htl_health');
              $id_htl = pg_result($result_hoteis_concluidos, $row, 'id_htl');
              $nome_hotel = pg_result($result_hoteis_concluidos, $row, 'nome_hotel');
              $id_52_nome = pg_result($result_hoteis_concluidos, $row, 'id_52_nome');
              $id_54_cargo = pg_result($result_hoteis_concluidos, $row, 'id_54_cargo');
              $dt_conclusao = pg_result($result_hoteis_concluidos, $row, 'dt_conclusao');

echo'<tr bgcolor="#fff">
    <td>'.$nome_hotel.'</td>
    <td>'.$id_52_nome.'</td>
    <td>'.$id_54_cargo.'</td>
    <td>'.$dt_conclusao.'</td>
    <td align="center"><a href="https://webapp.blumar.com.br/health_form/?cod='.$id_htl.'" target="_new">ver form</a></td>
    <td width="60" align="center"><a href="hotel/form_health_completo.php?cod='.$id_htl.'" target="_new">relatorio</a></td>
  </tr>';
 }

echo'</table>
<hr>
Listagem de Hotéis com o formulário <strong>NÃO</strong> concluido.<br>
<table width="660" border="1" cellspacing="1" cellpadding="2"  align="center">
  <tr  bgcolor="#7c7b7b"  style="color:#FFFFFF; ">
    <td width="200" align="center"><strong>Hotel</strong></td>
    <td width="170" align="center"><strong>Responsável</strong></td>
    <td width="120" align="center"><strong>Cargo</strong></td>
    <td width="50" align="center">&nbsp;</td>
    <td width="60" align="center">&nbsp;</td>
    <td width="60" align="center">&nbsp;</td>
  </tr>'; 

for ($rown = 0; $rown < pg_numrows($result_hoteis_nconcluidos); $rown++) 
        {
              $pk_htl_health = pg_result($result_hoteis_nconcluidos, $rown, 'pk_htl_health');
              $id_htl = pg_result($result_hoteis_nconcluidos, $rown, 'id_htl');
              $nome_hotel = pg_result($result_hoteis_nconcluidos, $rown, 'nome_hotel');
              $id_52_nome = pg_result($result_hoteis_nconcluidos, $rown, 'id_52_nome');
              $id_54_cargo = pg_result($result_hoteis_nconcluidos, $rown, 'id_54_cargo');


require('barra_andamento.php');

echo'<tr bgcolor="#fff">
    <td>'.$nome_hotel.'</td>
    <td>'.$id_52_nome.'</td>
    <td>'.$id_54_cargo.'</td>
    <td style="font-size:10px; "><b>'.number_format($valor_descontado, 2, ',', ' ').' %</b></td>
	<td align="center"><a href="https://webapp.blumar.com.br/health_form/?cod='.$id_htl.'" target="_new">ver form</a></td>
    <td width="60" align="center"><a href="hotel/form_health_completo.php?cod='.$id_htl.'" target="_new">relatorio</a></td>
</tr>';
 }

echo'</table>';


?>

  <br><br>
 


</body>
</html>
