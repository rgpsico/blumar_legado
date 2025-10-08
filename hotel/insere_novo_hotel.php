<?php 

require_once '../util/connection.php';


 
//tratamento dos valores entes de inserir na tabela

$mneu_for = pg_escape_string($_POST["mneu_for"]);
$nome_htl = $mneu_for ;
$descricao_pt = pg_escape_string($_POST["descricao_pt"]);
$descricao_en = pg_escape_string($_POST["descricao_en"]);
$descricao_esp = pg_escape_string($_POST["descricao_esp"]);
$descesp_grpfit = pg_escape_string($_POST["descesp_grpfit"]);
$regime_hotel_pt = pg_escape_string($_POST["regime_hotel_pt"]);
$regime_hotel_en = pg_escape_string($_POST["regime_hotel_en"]);
$regime_hotel_esp = pg_escape_string($_POST["regime_hotel_esp"]);
$rec_entret_pt = pg_escape_string($_POST["rec_entret_pt"]);
$rec_entret_en = pg_escape_string($_POST["rec_entret_en"]);
$rec_entret_esp = pg_escape_string($_POST["rec_entret_esp"]);
$otras_ativ_pt = pg_escape_string($_POST["otras_ativ_pt"]);
$otras_ativ_en = pg_escape_string($_POST["otras_ativ_en"]);
$otras_ativ_esp = pg_escape_string($_POST["otras_ativ_esp"]);
$alojamiento_pt = pg_escape_string($_POST["otras_ativ_esp"]);
$alojamiento_en = pg_escape_string($_POST["alojamiento_en"]);
$alojamiento_esp = pg_escape_string($_POST["alojamiento_esp"]);
$gastronomia_pt = pg_escape_string($_POST["gastronomia_pt"]);
$gastronomia_en = pg_escape_string($_POST["gastronomia_en"]);
$gastronomia_esp = pg_escape_string($_POST["gastronomia_esp"]);
$servicios_pt = pg_escape_string($_POST["servicios_pt"]);
$servicios_en = pg_escape_string($_POST["servicios_en"]);
$servicios_esp = pg_escape_string($_POST["servicios_esp"]);
$convenciones_pt = pg_escape_string($_POST["convenciones_pt"]);
$convenciones_en = pg_escape_string($_POST["convenciones_en"]);
$convenciones_esp = pg_escape_string($_POST["convenciones_esp"]);
$campo_extra_pt = pg_escape_string($_POST["campo_extra_pt"]);
$campo_extra_en = pg_escape_string($_POST["campo_extra_en"]);
$campo_extra_esp = pg_escape_string($_POST["campo_extra_esp"]);
$complemento = pg_escape_string($_POST["complemento"]);
$hotel_cham = pg_escape_string($_POST["hotel_cham"]);
$foto_fachada = pg_escape_string($_POST["foto_fachada"]);
$fotofachada_tbn = pg_escape_string($_POST["fotofachada_tbn"]);
$fotopiscina = pg_escape_string($_POST["fotopiscina"]);
$fotoextra = pg_escape_string($_POST["fotoextra"]);
$fotoextra_recep = pg_escape_string($_POST["fotoextra_recep"]);
$ft_resort1 = pg_escape_string($_POST["ft_resort1"]);
$ft_resort2 = pg_escape_string($_POST["ft_resort2"]);
$ft_resort3 = pg_escape_string($_POST["ft_resort3"]);
$htlurl = pg_escape_string($_POST["htlurl"]);
$mapa = pg_escape_string($_POST["mapa"]);
$map_eco = pg_escape_string($_POST["map_eco"]);
$url_htl_360 = pg_escape_string($_POST["url_htl_360"]);
$arq_htl_360 = pg_escape_string($_POST["arq_htl_360"]);
$url_video = pg_escape_string($_POST["url_video"]);
$arq_video = pg_escape_string($_POST["arq_video"]);
$obs_pt = pg_escape_string($_POST["obs_pt"]);
$obs_en = pg_escape_string($_POST["obs_en"]);
$obs_esp = pg_escape_string($_POST["obs_esp"]);
$historico_temp = pg_escape_string($_POST["historico_temp"]);
$flaghtl = pg_escape_string($_POST["flaghtl"]);
$ativo_latino = pg_escape_string($_POST["ativo_latino"]);
$ativo_flat = pg_escape_string($_POST["ativo_flat"]);
$resort = pg_escape_string($_POST["resort"]);
$ecologico = pg_escape_string($_POST["ecologico"]);
$validafotopiscina = pg_escape_string($_POST["validafotopiscina"]);
$bestdeal = pg_escape_string($_POST["bestdeal"]);
$inet_mapa = pg_escape_string($_POST["inet_mapa"]);
$luxury = pg_escape_string($_POST["luxury"]);
$novo = pg_escape_string($_POST["novo"]);
$favoritos = pg_escape_string($_POST["favoritos"]);
$pg6fq7 = pg_escape_string($_POST["pg6fq7"]);
$pg4fq5 = pg_escape_string($_POST["pg4fq5"]);
$chdgratis = pg_escape_string($_POST["chdgratis"]);
$blumarrecomenda = pg_escape_string($_POST["blumarrecomenda"]);
$blumarreveillon = pg_escape_string($_POST["blumarreveillon"]);
$allinclusive = pg_escape_string($_POST["allinclusive"]);
$desc_mostrp_ing = pg_escape_string($_POST["desc_mostrp_ing"]);
$ativo_mostrp = pg_escape_string($_POST["ativo_mostrp"]);
$classif_eco = pg_escape_string($_POST["classif_eco"]);
$ativo_bnuts = pg_escape_string($_POST["ativo_bnuts"]);
$virtual_tour = pg_escape_string($_POST["virtual_tour"]);


// tratamento do campo estrela blumar para nao dar erro na aplicação do desenvolvimento
$htlestrelablumar = pg_escape_string($_POST["htlestrelablumar"]);

	if (strlen($htlestrelablumar) == '0')
	{
		 $estrelablumar = null;
	 }
	else 
	{
		 $estrelablumar =$htlestrelablumar;
	 }


// inser��o dos valores do cadastro de hotel


 $query_inserhotel = "
INSERT INTO
		conteudo_internet.ci_hotel
				(
					 mneu_for,
					 htldsc,
					 htldscing,
					 htldscesp,
					 descesp_grpfit,
					 regime_hotel_pt,
  					 regime_hotel_en,
					 regime_hotel,
					 rec_entret_pt,
                     rec_entret_en, 
					 rec_entret,
					 otras_ativ_pt,
  					 otras_ativ_en,
					 otras_ativ, 
					 alojamiento_pt,
  					 alojamiento_en,
					 alojamiento,
					 gastronomia_pt,
  					 gastronomia_en,
					 gastronomia,
					 servicios_pt,
 					 servicios_en,
 					 servicios,
 					 convenciones_pt,
  					 convenciones_en,
 					 convenciones,
 					 campo_extra_pt,
  					 campo_extra_en,
 					 campo_extra,
 					 complemento,
 					 hotel_cham,
 					 htlimgfotofachada,
 					 fotofachada_tbn,
 					 htlfotopiscina,
 					 fotoextra,
 					 fotoextra_recep,
 					 ft_resort1,
					 ft_resort2,
					 ft_resort3,
					 htlurl,
 					 htlimgmapa,
 					 map_eco,
 					 url_htl_360,
					 arq_htl_360,
					 url_video,
  					 arq_video,
					 htlobs,
					 htlobsing,
					 htlobsesp,
					 historico_temp,
					 htlestrelablumar, 
  					 desc_mostrp_ing,
  					 classif_eco,
  					 flaghtl,
					 flaglatino,
					 flat,
					 resort,
 					 ecologico,
 					 flagfotopiscina,
 					 bestdeal,
 					 flaghtlimgmapa,
 					 luxury,
                     novo,
 					 favoritos,
 					 pg6fq7,
					 pg4fq5,
					 chdgratis,
 					 blumarrecomenda,
  					 blumarreveillon,
 					 allinclusive,
  					 ativo_mostrp,
  					 ativo_bnuts,
			         virtual_tour
  				)
			VALUES
				(
					'$mneu_for',
					'$descricao_pt',
					'$descricao_en',
					'$descricao_esp',
					'$descesp_grpfit',
					'$regime_hotel_pt',
					'$regime_hotel_en',
					'$regime_hotel_esp',
					'$rec_entret_pt',
					'$rec_entret_en',
					'$rec_entret_esp',
					'$otras_ativ_pt',
					'$otras_ativ_en',
					'$otras_ativ_esp',
					'$alojamiento_pt',
					'$alojamiento_en',
					'$alojamiento_esp',
					'$gastronomia_pt',
					'$gastronomia_en',
					'$gastronomia_esp',
					'$servicios_pt',
					'$servicios_en',
					'$servicios_esp',
					'$convenciones_pt',
					'$convenciones_en',
					'$convenciones_esp',
					'$campo_extra_pt',
					'$campo_extra_en',
					'$campo_extra_esp',
					'$complemento',
					'$hotel_cham',
					'$foto_fachada',
					'$fotofachada_tbn',
					'$fotopiscina',
					'$fotoextra',
					'$fotoextra_recep',
					'$ft_resort1',
					'$ft_resort2',
					'$ft_resort3',
					'$htlurl',
					'$mapa',
					'$map_eco',
					'$url_htl_360',
					'$arq_htl_360',
					'$url_video',
					'$arq_video',
					'$obs_pt',
					'$obs_en',
					'$obs_esp',
					'$historico_temp',
					'$estrelablumar',
					'$desc_mostrp_ing',
					'$classif_eco',
					'$flaghtl',
					'$ativo_latino',
					'$ativo_flat',
					'$resort',
					'$ecologico',
					'$validafotopiscina',
					'$bestdeal',
					'$inet_mapa',
					'$luxury',
					'$novo',
					'$favoritos',
					'$pg6fq7',
					'$pg4fq5',
					'$chdgratis',
					'$blumarrecomenda',
					'$blumarreveillon',
					'$allinclusive',
					'$ativo_mostrp',
					'$ativo_bnuts',
			        '$virtual_tour' 
				)";
pg_query($conn, $query_inserhotel);
 
		echo ' - inseriu hotel ok -';
	 
 
 
 

// pego a chave primaria do ultimo hotel inserido
		$sql_htlcod =
		"
		select
			max(frncod::int) as frncod
		from
			conteudo_internet.ci_hotel
		";
		$result_htlcod = pg_exec($conn, $sql_htlcod);
		if ($result_htlcod) {
			for ($rowcid = 0; $rowcid < pg_numrows($result_htlcod); $rowcid++) {
					
				$frncod = pg_result($result_htlcod, $rowcid, 'frncod');
				 
			}
		}

 
//come�o a inser��o dos valores do cadastro de apartamentos do hotel

$categ1 = pg_escape_string($_POST["categ1"]);
$loc1 = pg_escape_string($_POST["loc1"]);
$qtd1 = pg_escape_string($_POST["qtd1"]);
$foto1 = pg_escape_string($_POST["foto1"]);

if (strlen($foto1) != '0')

		{
			
			if (!pg_connection_busy($conn)) {
				pg_send_query($conn, " 
			INSERT INTO
			conteudo_internet.ci_apartamento
					(
					 aptocatcod,
					 aptoloccod,
					 aptqtd,
					 aptoimgfoto,
					 frncod
					)
			values
					(
					'$categ1',
					'$loc1',
					'$qtd1',
					'$foto1',
					'$frncod'
					)
			");
}		
			pg_query($conn);
			
			$retornoapto1 = pg_get_result($conn);
			$resultapto1 = pg_exec($conn);
			if ($resultpto1) {
			
				echo ' - inseriu ok -';
			
			}
			else {
				echo "Apartamento inserido com sucesso!<br>";
				echo pg_result_error_field( $retornoapto1, PGSQL_DIAG_SQLSTATE);
				echo pg_result_error($retornoapto1);
				 
			}
			
		}

 

$categ2 = pg_escape_string($_POST["categ2"]);
$loc2 = pg_escape_string($_POST["loc2"]);
$qtd2 = pg_escape_string($_POST["qtd2"]);
$foto2 = pg_escape_string($_POST["foto2"]);

if (strlen($foto2) != '0')

{
	if (!pg_connection_busy($conn)) {
				pg_send_query($conn, "
	INSERT INTO
	conteudo_internet.ci_apartamento
	(
	aptocatcod,
	aptoloccod,
	aptqtd,
	aptoimgfoto,
	frncod
	)
	values
	(
	'$categ2',
	'$loc2',
	'$qtd2',
	'$foto2',
	'$frncod'
	)
	");
}		
			pg_query($conn);
			
			$retornoapto2 = pg_get_result($conn);
			$resultapto2 = pg_exec($conn);
			if ($resultpto2) {
			
				echo " - inseriu ok -";
			
			}
			else {
				echo " - inseriu ok apto2 -<br>";
				echo pg_result_error_field( $retornoapto2, PGSQL_DIAG_SQLSTATE);
				echo pg_result_error($retornoapto2);
				 
			}
			
		}
						





$categ3 = pg_escape_string($_POST["categ3"]);
$loc3 = pg_escape_string($_POST["loc3"]);
$qtd3 = pg_escape_string($_POST["qtd3"]);
$foto3 = pg_escape_string($_POST["foto3"]);

if (strlen($foto3) != '0')

{
	if (!pg_connection_busy($conn)) {
				pg_send_query($conn, "
	INSERT INTO
	conteudo_internet.ci_apartamento
	(
	aptocatcod,
	aptoloccod,
	aptqtd,
	aptoimgfoto,
	frncod
	)
	values
	(
	'$categ3',
	'$loc3',
	'$qtd3',
	'$foto3',
	'$frncod'
	)
	");
}		
			pg_query($conn);
			
			$retornoapto3 = pg_get_result($conn);
			$resultapto3 = pg_exec($conn);
			if ($resultpto3) {
			
				echo " - inseriu ok -";
			
			}
			else {
				echo " - inseriu ok apto3 -<br>";
				echo pg_result_error_field( $retornoapto3, PGSQL_DIAG_SQLSTATE);
				echo pg_result_error($retornoapto3);
				 
			}
			
		}
					

 

$categ4 = pg_escape_string($_POST["categ4"]);
$loc4 = pg_escape_string($_POST["loc4"]);
$qtd4 = pg_escape_string($_POST["qtd4"]);
$foto4 = pg_escape_string($_POST["foto4"]);

if (strlen($foto4) != '0')

{
	if (!pg_connection_busy($conn)) {
				pg_send_query($conn, "
	INSERT INTO
	conteudo_internet.ci_apartamento
	(
	aptocatcod,
	aptoloccod,
	aptqtd,
	aptoimgfoto,
	frncod
	)
	values
	(
	'$categ4',
	'$loc4',
	'$qtd4',
	'$foto4',
	'$frncod'
	)
	");
}		
			pg_query($conn);
			
			$retornoapto4 = pg_get_result($conn);
			$resultapto4 = pg_exec($conn);
			if ($resultpto4) {
			
				echo " - inseriu ok -";
			
			}
			else {
				echo " - inseriu ok apto4 -<br>";
				echo pg_result_error_field( $retornoapto4, PGSQL_DIAG_SQLSTATE);
				echo pg_result_error($retornoapto4);
				 
			}
			
		}
					

// fim do cadastro de apartamentos do hotel


		
		
	// modulo para inser��o das facilidades do hotel	
		
$facilities = pg_escape_string($_POST["facilities"]);
		 	
if (strlen($facilities) != '0')
			
{
		$array = explode(',', $facilities);
		 foreach ($array as  $tag )
				  {
		
					if (!pg_connection_busy($conn))
								 {
									pg_send_query($conn,
									 "
											INSERT INTO
											conteudo_internet.ci_hotel_facilidade
											(
											mneu_for,
											flagfacinet,
											tpofaccod
									)
											values
											(
											'$frncod',
											'true',
											'$tag' 
									)
											");
							     }
					pg_query($conn);
						
					$retornfac = pg_get_result($conn);
					$resultfac = pg_exec($conn);
							if ($resultfac) 
							{
							echo " - inseriu ok -";
							}
							else 
							{
							echo pg_result_error_field( $retornofac, PGSQL_DIAG_SQLSTATE);
							echo pg_result_error($retornofac);
						    }
		           }
    }
 
    
    session_start();
    
    $pk_acesso = $_SESSION['user'];
    
    //crio a data now
    $ano = date("Y");
    $mes = date("m");
    $dia =  date("d");
    $data_now =  $ano . '-' . $mes . '-' . $dia;
    
    
    $query_log =
    "
    INSERT INTO
    conteudo_internet.log_adm_conteudo
    (
    usuario,
    acao,
    data,
    fk_conteudo
    )
    values
    (
    '$pk_acesso',
    'Inseriu o hotel  - $mneu_for-$nome_htl',
    '$data_now',
    '2'
    )
    ";
    pg_query($conn, $query_log);
    
    
    
    

echo '<br><br>Hotel inserido com sucesso !!' ;

?>