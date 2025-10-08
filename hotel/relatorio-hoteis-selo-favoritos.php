<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Relatorio de hoteis com selo NEW</title>
<meta http-equiv="Content-Type"  content="text/html; charset=utf-8" />
</head>

<body>
<font face="Arial, Helvetica, sans-serif" size="3"><b>Relatorio de hoteis com o selo "FAVORITOS"</b></font><br><br>

<?php   

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
											favoritos = 'true'
										order by 
												nome_cid, nome_for	
										";
								
								$result = pg_exec($conn, $query);
								if ($result) {
								for ($row = 0; $row < pg_numrows($result); $row++) {
									$star = pg_result($result, $row, 'star');
									$nome_for  = pg_result($result, $row, 'nome_for');
									$nome_cid  = pg_result($result, $row, 'nome_cid');
									echo "<font face=arial size=2><b>$nome_for</b> - stars $star - </font><font face=arial size=1><i>$nome_cid</i></font><br>";
									
								}
								}
								else {         
								echo "The query failed with the following error:<br>\n";         
								       
								}
								
				
				
				} else {
					echo 'Connection attempt failed.';
				}
				
				pg_close($conn);
		


?>

  <br><br>
 


</body>
</html>
