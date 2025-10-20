<?php require_once '../util/connection.php';
 

	$lista_fac = "
		SELECT * 
		FROM conteudo_internet.ci_tipo_facilidade
		ORDER BY tpofacdsc ASC
	";

	echo'
	<b>Facilidades já cadastradas</b><br>
	<div id="box16">';
	
	
	$result_fac = pg_exec($conn, $lista_fac);
	if ($result_fac) {
		for ($rowfac = 0; $rowfac < pg_numrows($result_fac); $rowfac++) {
	
			$tpofacdsc = pg_result($result_fac, $rowfac, 'tpofacdsc');
			 
	        echo'<div id="box8" >'.$tpofacdsc.'</div>';
	
		}
	
	}
	
    echo'</div>';


    echo'
    <b>CADASTRAR NOVAS FACILITIES</b><br>
    ';
    
    require_once 'new_facilities.php';
    
?>