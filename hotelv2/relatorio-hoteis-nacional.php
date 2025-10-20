<?php 

$arquivo = 'relatorio-hoteis-nacional.xls';
$html = '';
$html .= ' <table width="1000" border="1"    cellspacing="0" cellpadding="0">';
$html .= '<tr >
		   <td colspan="3"  ><font face="Arial, Helvetica, sans-serif" size="3"><b>Relatorio de hoteis com a MARCACAO PARA O SITE NACIONAL "Blumar Recomenda"</b></font></td>
		  </tr>';
$html .= '<tr >
		   <td   ><font face=arial size=2><strong>hotel</strong></font></td>
		   <td width="70"  ><font face=arial size=2><strong>estrelas</strong></font></td>
		   <td width="310"  ><font face=arial size=2><strong>cidade</strong></font></td>
		   </tr>';

 

  

require_once '../util/connection.php';
				if ($conn) {
				   
			
				               $query = 
										"
										select 
											sbd95.fornec.mneu_for,
											initcap(sbd95.fornec.nome_for) as nome_for,
											star,
											nome_cid
										from 
											conteudo_internet.ci_hotel
										inner join 
											sbd95.fornec 
										on 
											conteudo_internet.ci_hotel.mneu_for = sbd95.fornec.mneu_for
										inner join 
											sbd95.cidades
										on 
											sbd95.fornec.cid = sbd95.cidades.cid	
										where
											blumarrecomenda = 'true'
										order by 
												nome_cid, nome_for	
										";
								
								$result = pg_exec($conn, $query);
								if ($result) {
								for ($row = 0; $row < pg_numrows($result); $row++) {
									$star = pg_result($result, $row, 'star');
									$nome_for  = pg_result($result, $row, 'nome_for');
									$nome_cid  = pg_result($result, $row, 'nome_cid');
									$html .= '<tr  >
									           <td width="310"  ><font face=arial size=2>'.$nome_for.'</font></td>
											   <td width="70"  ><font face=arial size=2>'.$star.'</font></td>
											   <td width="310"  ><font face=arial size=2>'.$nome_cid.'</font></td>
											   </tr>';
									
								}
								}
								else {         
								echo "The query failed with the following error:<br>\n";         
								       
								}
								
				
				
				} else {
					echo 'Connection attempt failed.';
				}
				
				pg_close($conn);
		

$html .= '</table>';


// ConfiguraÃ§Ãµes header para forÃ§ar o download
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/x-msexcel; charset=utf-8");
	header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
	header ("Content-Description: PHP Generated Data" );
	
	
	
	// Envia o conteÃºdo do arquivo
	echo $html;	
	
?>

 
 


 
