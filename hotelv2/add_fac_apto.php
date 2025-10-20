<?php 

require_once '../util/connection.php';

$frncod = pg_escape_string($_POST["frncod"]);

echo '<div id="box6">FACILIDADES DO APARTAMENTO<br>Selecione as facilidades que deseja cadastrar</div>
      <div id="box6"></div>';




	$query_fachtl =
	"
		select
			tpofaccod,
			tpofacdsc
		FROM
			conteudo_internet.ci_tipo_facilidade
		where
			tipo = 2
		and
			ativo = true
		ORDER BY
			tpofacdsc ASC
	";

	$result_fachtl = pg_exec($conn, $query_fachtl);
	if ($result_fachtl) {
		for ($rowcid = 0; $rowcid < pg_numrows($result_fachtl); $rowcid++) {
				
			$tpofaccod = pg_result($result_fachtl, $rowcid, 'tpofaccod');
			$tpofacdsc = pg_result($result_fachtl, $rowcid, 'tpofacdsc');
	
				
			echo '
			<div id="box17">
			<input type="checkbox"  name="facilities"   id="facilities"  value="'.$tpofaccod.'">'.$tpofacdsc.'
			</div>
			';
				
		}
	}

	
	echo'
	<input type="hidden" name="frncod" id="frncod" value="'.$frncod.'">
	<div id="box6"><input type="button"  name="Go" value="Inserir" onclick="javascript:insert_add_fac_apto();"  ></div>
	<div id="box6"></div>
	';
	
	
	
   echo'<div id="box6">FACILIDADES DO APARTAMENTO J&Aacute; CADASTRADAS</div>';


		$query_fachtl1 =
		"
			select
				conteudo_internet.ci_hotel_facilidade.tpofaccod,
				tpofacdsc
			FROM
				conteudo_internet.ci_hotel_facilidade
			inner join
				conteudo_internet.ci_tipo_facilidade
			on
				conteudo_internet.ci_hotel_facilidade.tpofaccod =  conteudo_internet.ci_tipo_facilidade.tpofaccod
			where
				tipo = 2
			and
				ativo = true
			and
				mneu_for = '$frncod'
			ORDER BY
				conteudo_internet.ci_hotel_facilidade.tpofaccod ASC
		";
	
	 
				$result_fachtl1 = pg_exec($conn, $query_fachtl1);
				if ($result_fachtl1) {
				for ($rowfac1 = 0; $rowfac1 < pg_numrows($result_fachtl1); $rowfac1++) {
					
				$tpofaccod1 = pg_result($result_fachtl1, $rowfac1, 'tpofaccod');
				$tpofacdsc1 = pg_result($result_fachtl1, $rowfac1, 'tpofacdsc');
	
			
		echo '
			<div id="box19">
			'.$tpofacdsc1.'
			</div>
			';
				
	}
	}

			echo '
				 <div id="box6"></div>
			    ';

?>