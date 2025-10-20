<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administra&ccedil;&atilde;o de Conteudo Blumar</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
	<script type="text/javascript" src="http://www.blumar.com.br/util/jquery/jquery-1.3.2.min.js"></script>

<script type="text/javascript" src="https://www.blumar.com.br/util/carousel/jcarousel.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/client_area/rates/js/generico.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.blumar.com.br/util/carousel/jcarousel.css" />

<link rel="stylesheet" type="text/css" href="../css/skin.css" />
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="https://www.google.com/uds/solutions/localsearch/gmlocalsearch.js"></script>	
</head>

<body>
<?php 

require_once '../util/connection.php';

$mneu_for = pg_escape_string($_GET["mneu_for"]);


$query_htl =
"
SELECT 
								trim(upper(sbd95.fornec.nome_for)) as nome_hotel,
								sbd95.fornec.mneu_for,
								conteudo_internet.ci_hotel.frncod as frncod,
								sbd95.fornec.cidade AS cidade,
								sbd95.fornec.cid,
								sbd95.cidades.nome_cid AS nome_cidade,
								conteudo_internet.ci_hotel.htldscing  as htldsc,
								trim(lower(conteudo_internet.ci_hotel.htlimgfotofachada)) as htlimgfotofachada,		
								trim(lower(conteudo_internet.ci_hotel.htlfotopiscina)) as htlfotopiscina,
								trim(conteudo_internet.ci_hotel.htlimgmapa) as htlimgmapa,
								trim(lower(conteudo_internet.ci_hotel.fotoextra)) as fotoextra,
								trim(lower(conteudo_internet.ci_hotel.ft_resort1)) as ft_resort1,
								trim(lower(conteudo_internet.ci_hotel.ft_resort2)) as ft_resort2,
								trim(lower(conteudo_internet.ci_hotel.ft_resort3)) as ft_resort3,
								trim(lower(conteudo_internet.ci_hotel.fotoextra_recep)) as fotoextra_recep,	
								conteudo_internet.ci_hotel.regime_hotel,
								conteudo_internet.ci_hotel.rec_entret,
								conteudo_internet.ci_hotel.otras_ativ,
								conteudo_internet.ci_hotel.alojamiento,
								conteudo_internet.ci_hotel.gastronomia,
								conteudo_internet.ci_hotel.servicios,
								conteudo_internet.ci_hotel.convenciones,
								conteudo_internet.ci_hotel.campo_extra,
								conteudo_internet.ci_hotel.htlestrelablumar as estrela_blumar,
								sbd95.fornec.endereco,
								sbd95.fornec.bairro,
								sbd95.fornec.star,	
								sbd95.fornec.tel1,	
								sbd95.fornec.classif,
								sbd95.fornec.tot_rooms,
								conteudo_internet.ci_hotel.htlurl,
								conteudo_internet.ci_hotel.htlobs,
								conteudo_internet.ci_hotel.url_htl_360,		
								conteudo_internet.ci_hotel.url_video,		
								conteudo_internet.ci_hotel.pg6fq7,
								conteudo_internet.ci_hotel.pg4fq5,
								conteudo_internet.ci_hotel.chdgratis,
								conteudo_internet.ci_hotel.allinclusive,	
								conteudo_internet.ci_hotel.blumarrecomenda,
								conteudo_internet.ci_hotel.blumarreveillon
							FROM 
								conteudo_internet.ci_hotel 
								INNER JOIN sbd95.fornec ON ci_hotel.mneu_for = sbd95.fornec.mneu_for
								INNER JOIN sbd95.cidades ON sbd95.cidades.cid = sbd95.fornec.cid
						 
							WHERE
								trim(lower(sbd95.fornec.mneu_for)) = trim(lower('$mneu_for'))
";

$result_htl = pg_exec($conn, $query_htl);
if ($result_htl) {
	for ($rowhtl = 0; $rowhtl < pg_numrows($result_htl); $rowhtl++) {

		$nome_hotel = pg_result($result_htl, $rowhtl, 'nome_hotel');
		$star = pg_result($result_htl, $rowhtl, 'star');
		$classif = pg_result($result_htl, $rowhtl, 'classif');
		$endereco = pg_result($result_htl, $rowhtl, 'endereco');
		$bairro = pg_result($result_htl, $rowhtl, 'bairro');
		$tel1 = pg_result($result_htl, $rowhtl, 'tel1');
		$tot_rooms = pg_result($result_htl, $rowhtl, 'tot_rooms');
		$estrela_blumar = pg_result($result_htl, $rowhtl, 'estrela_blumar');
		
		$htlimgfotofachada = pg_result($result_htl, $rowhtl, 'htlimgfotofachada');
		$fotofachada =  str_replace(html_entity_decode('&#92;'), html_entity_decode('&#47;'), $htlimgfotofachada);
		 
		$htlfotopiscina = pg_result($result_htl, $rowhtl, 'htlfotopiscina');
		$fotopiscina =  str_replace(html_entity_decode('&#92;'), html_entity_decode('&#47;'), $htlfotopiscina);
		
		$ft_resort11 = pg_result($result_htl, $rowhtl, 'ft_resort1');
		$ft_resort1 =  str_replace(html_entity_decode('&#92;'), html_entity_decode('&#47;'), $ft_resort11);
				
		$ft_resort22 = pg_result($result_htl, $rowhtl, 'ft_resort2');
		$ft_resort2 =  str_replace(html_entity_decode('&#92;'), html_entity_decode('&#47;'), $ft_resort22);
				
		$ft_resort33 = pg_result($result_htl, $rowhtl, 'ft_resort3');
		$ft_resort3 =  str_replace(html_entity_decode('&#92;'), html_entity_decode('&#47;'), $ft_resort33);
				
		$fotoextra1 = pg_result($result_htl, $rowhtl, 'fotoextra');
		$fotoextra =  str_replace(html_entity_decode('&#92;'), html_entity_decode('&#47;'), $fotoextra1);
				
		$fotoextra_recep1 = pg_result($result_htl, $rowhtl, 'fotoextra_recep');
		$fotoextra_recep =  str_replace(html_entity_decode('&#92;'), html_entity_decode('&#47;'), $fotoextra_recep1);
		
		$frncod = pg_result($result_htl, $rowhtl, 'frncod');
        $htldsc = pg_result($result_htl, $rowhtl, 'htldsc');
        $nome_cidade = pg_result($result_htl, $rowhtl, 'nome_cidade'); 
        $endereco = pg_result($result_htl, $rowhtl, 'endereco');
        $nome_hotel = pg_result($result_htl, $rowhtl, 'nome_hotel');
        
	}
}


$pega_foto_apto = "	
                SELECT
					LOWER(aptoimgfoto) as fotoapto
				FROM 
					conteudo_internet.ci_apartamento
					INNER JOIN conteudo_internet.ci_tipo_apartamento ON conteudo_internet.ci_apartamento.tpoaptocod = conteudo_internet.ci_tipo_apartamento.tpoaptocod
				WHERE 
					frncod = $frncod
				AND
					aptoimgfoto != '.'
				AND
					aptoimgfoto != ''
                ";



$result_apto = pg_exec($conn, $pega_foto_apto);



$pega_fac_htl = "
                SELECT
					ci_hotel_facilidade.tpofaccod,
					mneu_for,
					tpofacdsc,
					tpofacdscesp,
					tpofacdscing
				FROM
					conteudo_internet.ci_hotel_facilidade INNER JOIN conteudo_internet.ci_tipo_facilidade
					ON ci_hotel_facilidade.tpofaccod = ci_tipo_facilidade.tpofaccod
				WHERE
					trim(lower(mneu_for)) = trim(lower('$frncod'))
					AND flagfacinet = 'true'
					AND tipo = '1'
";
$result_fac_htl = pg_exec($conn, $pega_fac_htl);


$pega_fac_room = "
				SELECT
					ci_hotel_facilidade.tpofaccod,
					mneu_for,
					tpofacdsc,
					tpofacdscesp,
					tpofacdscing AS quarto
				FROM
					conteudo_internet.ci_hotel_facilidade INNER JOIN conteudo_internet.ci_tipo_facilidade
					ON ci_hotel_facilidade.tpofaccod = ci_tipo_facilidade.tpofaccod
				WHERE
					trim(lower(mneu_for)) = trim(lower('$frncod'))
					AND flagfacinet = 'true'
					AND	tipo = '2'
";
$result_fac_room = pg_exec($conn, $pega_fac_room);



echo'
<div id="container">

	<div id="topohtl">
		  <div id="titulohtl">hotel<span>information</span></div>
   </div>
 
   	       <div id="HotelInfohtl">
					<div class="NomeHotel">'.$nome_hotel.'</div>
					<div class="detailstop"><span>oficial classification: </span>';
					if ($star == '5' or $star == '4' or $star == '3') { echo''.$star.' stars';}
					else {echo'.$classif.';}
					
					echo'</div>
					<div class="detailstop"><span>location</span> '.$endereco.' - '.$bairro.'</div>
					<div class="detailstop"><span>phone</span> 55 '.$tel1.'</div>';
                     if ($tot_rooms != '0') {echo'<div class="detailstop"><span>Rooms</span> '.$tot_rooms.'</div>';}
                     if (strlen($estrela_blumar) != '0') { echo'<div class="detailstop"><span>We suggest:</span> <font size="3">'.$estrela_blumar.'</font></div>'; }
		echo'</div>';



echo'
<div id="gallery">
				   <div id="fotosg">
						<div class="galeria-hotel-foto">
							<div class="blur">
								    <div class="content">';
										if (strlen($fotofachada) != '0') {
											echo'<img src="https://www.blumar.com.br/'.$fotofachada.'"   id="Imagexy"  border="0" />';
										}

									echo'</div>
							</div>			
						</div>					
						
						
						<div id="wrap">
                            <ul id="mycarousel" class="jcarousel jcarousel-skin-tango">';
									if (strlen($fotofachada) != '0') {
										echo'<li><a href="#" onMouseOver="MM_swapImage(';
										echo"'Imagexy','','https://www.blumar.com.br/$fotofachada'";
										echo',2)"><img src="https://www.blumar.com.br/'.$fotofachada.'"    width="71" height="48"   border="0" /></a></li>';
									}
                                    if (strlen($fotopiscina) != '0') {
										echo'<li><a href="#" onMouseOver="MM_swapImage(';
										echo"'Imagexy','','https://www.blumar.com.br/$fotopiscina'";
										echo',2)"><img src="https://www.blumar.com.br/'.$fotopiscina.'"    width="71" height="48"   border="0" /></a></li>';
									}
									if (strlen($ft_resort1) != '0') {
										echo'<li><a href="#" onMouseOver="MM_swapImage(';
										echo"'Imagexy','','https://www.blumar.com.br/$ft_resort1'";
										echo',2)"><img src="https://www.blumar.com.br/'.$ft_resort1.'"   width="71" height="48"   border="0" /></a></li>';
									}
									if (strlen($ft_resort2) != '0') {
										echo'<li><a href="#" onMouseOver="MM_swapImage(';
										echo"'Imagexy','','https://www.blumar.com.br/$ft_resort2'";
										echo',2)"><img src="https://www.blumar.com.br/'.$ft_resort2.'"   width="71" height="48"    border="0" /></a></li>';
									}
									if (strlen($ft_resort3) != '0') {
										echo'<li><a href="#" onMouseOver="MM_swapImage(';
										echo"'Imagexy','','https://www.blumar.com.br/$ft_resort3'";
										echo',2)"><img src="https://www.blumar.com.br/'.$ft_resort3.'"    width="71" height="48"   border="0" /></a></li>';
									}
									if (strlen($fotoextra) != '0') {
										echo'<li><a href="#" onMouseOver="MM_swapImage(';
										echo"'Imagexy','','https://www.blumar.com.br/$fotoextra'";
										echo',2)"><img src="https://www.blumar.com.br/'.$fotoextra.'"    width="71" height="48"    border="0" /></a></li>';
									}
									if (strlen($fotoextra_recep) != '0') {
										echo'<li><a href="#" onMouseOver="MM_swapImage(';
										echo"'Imagexy','','https://www.blumar.com.br/$fotoextra_recep'";
										echo',2)"><img src="https://www.blumar.com.br/'.$fotoextra_recep.'"    width="71" height="48"   border="0" /></a></li>';
									}

									if ($result_apto) {
										for ($rowapto = 0; $rowapto < pg_numrows($result_apto); $rowapto++) {
									
											$fotoapto1 = pg_result($result_apto, $rowapto, 'fotoapto');
											$fotoapto =  str_replace(html_entity_decode('&#92;'), html_entity_decode('&#47;'), $fotoapto1);
											echo'<li><a href="#" onMouseOver="MM_swapImage(';
											echo"'Imagexy','','https://www.blumar.com.br/$fotoapto'";
											echo',2)"><img src="https://www.blumar.com.br/'.$fotoapto.'"    width="71" height="48"   border="0" /></a></li>';
									
										}
									}
									
									
									
									
                            echo' </ul>
						</div>

						
					</div>
							 
								
</div>

            <div class="MoreInfo">
				<div class="TituloInfo">DESCRIPTION</div>
			    <div class="TextoCorrido">'.$htldsc.'</div>
			</div>
			
			
			<div class="MoreInfo">
				<div class="TituloInfo">HOTEL FACILITIES</div>
				<div class="TextoCorrido">';
                            
				if ($result_fac_htl) {
										for ($rowfachtl = 0; $rowfachtl < pg_numrows($result_fac_htl); $rowfachtl++) {
									
											$tpofacdscing = pg_result($result_fac_htl, $rowfachtl, 'tpofacdscing');
											echo''.$tpofacdscing.' |';
											 
									
										}
									}
				 echo'</div>
			</div>
			
			
			
			
				<div class="MoreInfo">
				<div class="TituloInfo">ROOM FACILITIES</div>
				<div class="TextoCorrido">';
                            
				if ($result_fac_room) {
										for ($rowfacroom = 0; $rowfacroom < pg_numrows($result_fac_room); $rowfacroom++) {
									     $quarto = pg_result($result_fac_room, $rowfacroom, 'quarto');
											echo''.$quarto.' |';
										}
									}
				 echo'</div>
			</div>
			
			
			
			
			
			<div class="MoreInfo">
				<div class="TituloInfo">LOCATION MAP</div>
					 <div class="mapalocalizacao">
						            <input type="hidden" name="cidadeGoogle" id="cidadeGoogle" value="'.$nome_cidade.'">
									<input type="hidden" name="enderecoGoogle" id="enderecoGoogle" value="'.$endereco.'">
									<input type="hidden" name="nomeHotelGoogle" id="nomeHotelGoogle" value="'.$nome_hotel.'">
									<input type="hidden" name="mneuForGoogle" id="mneuForGoogle" value="'.$mneu_for.'">					
									<div id="map_'.$mneu_for.'" style="width: 570px; height: 303px"></div>
					</div>
			</div>
			
</div>			
';


 
?>
 

	</body>
						</html>







