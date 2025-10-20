<script type="text/javascript" src="js/del_fachtl.js"></script>
<?php 
require_once '../util/connection.php';


                        if(!isset($frncod) )
                        {
                        	$frncod = pg_escape_string($_POST["frncod"]);
                        }
                        



	echo'
		<div id="box6">FACILIDADES DO HOTEL J&Aacute; CADASTRADAS</div>
		<div id="box6">escolha uma para apagar.</div>
		<div id="box16">
	'; 

	$query_fachtl1 =
	"
		select
			conteudo_internet.ci_hotel_facilidade.tpofaccod,
			tpofacdsc,
			htlfaccod
		FROM
			conteudo_internet.ci_hotel_facilidade
		inner join
			conteudo_internet.ci_tipo_facilidade
		on
			conteudo_internet.ci_hotel_facilidade.tpofaccod =  conteudo_internet.ci_tipo_facilidade.tpofaccod
		where
			tipo = 1
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
		$htlfaccod = pg_result($result_fachtl1, $rowfac1, 'htlfaccod');
			
		echo '
			<div id="box17">
			'.$tpofacdsc1.'
			<a href="#" class="deletafachtl" title="excluir esta facilidade"><input type="hidden" class="deletafachtlValue" value="'.$htlfaccod.'" ><img src="util/images/x.jpg"></a>
			</div>
			';
				
	}
	} 
	echo'
	</div>
	<div id="box13">
	<input type="hidden" name="frncod" id="frncod" value="'.$frncod.'">
	<br><a href="javascript:altera_hotel();"><< Voltar para altera&ccedil;&atilde;o do Hotel</a>
	</div>
    <div id="box13"></div>
	';
?>
				
				
 