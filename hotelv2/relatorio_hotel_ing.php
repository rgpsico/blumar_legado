<?php 

require_once '../util/connection.php';

$cidcod = pg_escape_string($_POST["cidcod"]);

	$query_htl_cid ="
		SELECT
			sbd95.fornec.nome_for,
			sbd95.fornec.star,
			sbd95.fornec.cid,
			ci_hotel.frncod,
			ci_hotel.htlobsesp,
			ci_hotel.htldscesp,
			ci_hotel.htldscing,
			ci_hotel.descesp_grpfit,
			ci_hotel.htlobsing,
			fornec.mneu_for,
			ci_hotel.historico_temp		
		FROM sbd95.fornec
			inner join conteudo_internet.ci_hotel on fornec.mneu_for = conteudo_internet.ci_hotel.mneu_for
		where categ = 'Hotel'
			and cid = '$cidcod'
		ORDER BY star desc, nome_for ASC
	 ";

	
	echo '
	<div id="box16">
		<div id="box17"><b>Nome</b></div>
		<div id="box20"><b>descritivo</b></div>
	</div>
	';
	
	
	
	
	$result_cid_ing = pg_exec($conn, $query_htl_cid);
	if ($result_cid_ing) {
		for ($rowciding = 0; $rowciding < pg_numrows($result_cid_ing); $rowciding++) {
	
			$nome_for = pg_result($result_cid_ing, $rowciding, 'nome_for');
			$mneu_for = pg_result($result_cid_ing, $rowciding, 'mneu_for');
			$htldscing = pg_result($result_cid_ing, $rowciding, 'htldscing');
			
			
			echo'
			<div id="box16">
				 <div id="box17">'.$nome_for.'</div>
	             <div id="box21">'.$htldscing.'</div>
			</div>';
	
		}
	
	}

?>