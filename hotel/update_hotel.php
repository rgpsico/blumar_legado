  <?php require_once '../util/connection.php'; 

//tratamento dos valores entes de fazer o update na tabela 
   
	    $mneu_for = pg_escape_string($_POST["mneu_for"]);
	    $frncod = pg_escape_string($_POST["frncod"]);
		$nome_htl = pg_escape_string($_POST["nome_htl"] ?? 'Update_hotel');
/*
	    $nome_htl = pg_escape_string($_POST["nome_htl"]);
	    $estrelas_htl = pg_escape_string($_POST["estrelas_htl"]);
	    $cidade_htl = pg_escape_string($_POST["cidade_htl"]);
	    $htlendrua = pg_escape_string($_POST["htlendrua"]);
*/
	    $htldsc = pg_escape_string($_POST["htldsc"]);
	    $htldscing = pg_escape_string($_POST["htldscing"]);
	    $htldscesp = pg_escape_string($_POST["htldscesp"]);
	    $descesp_grpfit = pg_escape_string($_POST["descesp_grpfit"]);
	    $regime_hotel_pt = pg_escape_string($_POST["regime_hotel_pt"]);
	    $regime_hotel_en = pg_escape_string($_POST["regime_hotel_en"]);
	    $regime_hotel = pg_escape_string($_POST["regime_hotel"]);
        $rec_entret_pt = pg_escape_string($_POST["rec_entret_pt"]);
		$rec_entret_en = pg_escape_string($_POST["rec_entret_en"]);
		$rec_entret = pg_escape_string($_POST["rec_entret"]);
	    $otras_ativ_pt = pg_escape_string($_POST["otras_ativ_pt"]);
		$otras_ativ_en = pg_escape_string($_POST["otras_ativ_en"]);
		$otras_ativ = pg_escape_string($_POST["otras_ativ"]);
		$alojamiento_pt = pg_escape_string($_POST["alojamiento_pt"]);
		$alojamiento_en = pg_escape_string($_POST["alojamiento_en"]);
		$alojamiento = pg_escape_string($_POST["alojamiento"]);
		$gastronomia_pt = pg_escape_string($_POST["gastronomia_pt"]);
		$gastronomia_en = pg_escape_string($_POST["gastronomia_en"]);
		$gastronomia = pg_escape_string($_POST["gastronomia"]);
		$servicios_pt = pg_escape_string($_POST["servicios_pt"]);
		$servicios_en = pg_escape_string($_POST["servicios_en"]);
		$servicios = pg_escape_string($_POST["servicios"]);
		$convenciones_pt = pg_escape_string($_POST["convenciones_pt"]);
		$convenciones_en = pg_escape_string($_POST["convenciones_en"]);
		$convenciones = pg_escape_string($_POST["convenciones"]);
		$campo_extra_pt = pg_escape_string($_POST["campo_extra_pt"]);
		$campo_extra_en = pg_escape_string($_POST["campo_extra_en"]);
		$campo_extra = pg_escape_string($_POST["campo_extra"]);
		$complemento = pg_escape_string($_POST["complemento"]);
		$hotel_cham = pg_escape_string($_POST["hotel_cham"]);
	    $htlimgfotofachada = pg_escape_string($_POST["htlimgfotofachada"]);
		$fotofachada_tbn = pg_escape_string($_POST["fotofachada_tbn"]);
		$htlfotopiscina = pg_escape_string($_POST["htlfotopiscina"]);
		$fotoextra = pg_escape_string($_POST["fotoextra"]);
		$fotoextra_recep = pg_escape_string($_POST["fotoextra_recep"]);
		$ft_resort1 = pg_escape_string($_POST["ft_resort1"]);
		$ft_resort2 = pg_escape_string($_POST["ft_resort2"]);
		$ft_resort3 = pg_escape_string($_POST["ft_resort3"]);
		$htlurl = pg_escape_string($_POST["htlurl"]);
		$htlimgmapa = pg_escape_string($_POST["htlimgmapa"]);
		$map_eco = pg_escape_string($_POST["map_eco"]);
	    $url_htl_360 = pg_escape_string($_POST["url_htl_360"]);
		$arq_htl_360 = pg_escape_string($_POST["arq_htl_360"]);
		$url_video = pg_escape_string($_POST["url_video"]);
		$arq_video = pg_escape_string($_POST["arq_video"]);
		$virtual_tour = pg_escape_string($_POST["virtual_tour"]);
		$htlobs = pg_escape_string($_POST["htlobs"]);
		$htlobsing = pg_escape_string($_POST["htlobsing"]);
		$htlobsesp = pg_escape_string($_POST["htlobsesp"]);
		$historico_temp = pg_escape_string($_POST["historico_temp"]);
		 
		$classif_eco = pg_escape_string($_POST["classif_eco"]);
		$desc_mostrp_ing = pg_escape_string($_POST["desc_mostrp_ing"]);
		$flaghtl = pg_escape_string($_POST["flaghtl"]);
		$flaglatino = pg_escape_string($_POST["flaglatino"]);
		$flat = pg_escape_string($_POST["flat"]);
		$resort = pg_escape_string($_POST["resort"]);
		$ecologico = pg_escape_string($_POST["ecologico"]);
		$flagfotopiscina = pg_escape_string($_POST["flagfotopiscina"]);
		$bestdeal = pg_escape_string($_POST["bestdeal"]);
		$ativo_bnuts = pg_escape_string($_POST["ativo_bnuts"]);
		$flaghtlimgmapa = pg_escape_string($_POST["flaghtlimgmapa"]);
		$luxury = pg_escape_string($_POST["luxury"]);
		$novo = pg_escape_string($_POST["novo"]);
		$favoritos = pg_escape_string($_POST["favoritos"]);
		$pg6fq7 = pg_escape_string($_POST["pg6fq7"]);
		$pg4fq5 = pg_escape_string($_POST["pg4fq5"]);
		$chdgratis = pg_escape_string($_POST["chdgratis"]);
		$blumarrecomenda = pg_escape_string($_POST["blumarrecomenda"]);
		$blumarreveillon = pg_escape_string($_POST["blumarreveillon"]);
		$allinclusive = pg_escape_string($_POST["allinclusive"]);
		$ativo_mostrp = pg_escape_string($_POST["ativo_mostrp"]); 
		
		$covid_19_pt_url = pg_escape_string($_POST["covid_19_pt_url"]); 
        $covid_19_en_url = pg_escape_string($_POST["covid_19_en_url"] ?? ''); 
		$htl_num_quartos = pg_escape_string($_POST["htl_num_quartos"] ?? 0); 
		
		// tratamento do campo estrela blumar para nao dar erro na aplicação do desenvolvimento
		$htlestrelablumar = pg_escape_string($_POST["htlestrelablumar"]);
		$htlestrelablumar = pg_escape_string($_POST["htlestrelablumar"]);
		if (strlen($htlestrelablumar) == '0')
		{
			$estrelablumar = null;
		}
		else
		{
			$estrelablumar = $htlestrelablumar;
		}
		
		
		/*
		
		  mneu_for =  '$mneu_for',
		       nome_htl =  '$nome_htl',
			    estrelas_htl =  '$estrelas_htl',
			    cidade_htl =  '$cidade_htl',
			    htlendrua =  '$htlendrua',
		*/
		
		$sql = "
		update
			conteudo_internet.ci_hotel
		set
			    htldsc =  '$htldsc',
			    htldscing =  '$htldscing',
			    htldscesp =  '$htldscesp',
			    descesp_grpfit =  '$descesp_grpfit',
			    regime_hotel_pt =  '$regime_hotel_pt',
			    regime_hotel_en =  '$regime_hotel_en',
			    regime_hotel =  '$regime_hotel',
		        rec_entret_pt =  '$rec_entret_pt',
				rec_entret_en =  '$rec_entret_en',
				rec_entret =  '$rec_entret',
			    otras_ativ_pt =  '$otras_ativ_pt',
				otras_ativ_en =  '$otras_ativ_en',
				otras_ativ =  '$otras_ativ',
				alojamiento_pt =  '$alojamiento_pt',
				alojamiento_en =  '$alojamiento_en',
				alojamiento =  '$alojamiento',
				gastronomia_pt =  '$gastronomia_pt',
				gastronomia_en =  '$gastronomia_en',
				gastronomia =  '$gastronomia',
				servicios_pt =  '$servicios_pt',
				servicios_en =  '$servicios_en',
				servicios =  '$servicios',
				convenciones_pt =  '$convenciones_pt',
				convenciones_en =  '$convenciones_en',
				convenciones =  '$convenciones',
				campo_extra_pt =  '$campo_extra_pt',
				campo_extra_en =  '$campo_extra_en',
				campo_extra =  '$campo_extra',
				complemento =  '$complemento',
				hotel_cham =  '$hotel_cham',
			    htlimgfotofachada =  '$htlimgfotofachada',
				fotofachada_tbn =  '$fotofachada_tbn',
				htlfotopiscina =  '$htlfotopiscina',
				fotoextra =  '$fotoextra',
				fotoextra_recep =  '$fotoextra_recep',
				ft_resort1 =  '$ft_resort1',
				ft_resort2 =  '$ft_resort2',
				ft_resort3 =  '$ft_resort3',
				htlurl =  '$htlurl',
				htlimgmapa =  '$htlimgmapa',
				map_eco =  '$map_eco',
			    url_htl_360 =  '$url_htl_360',
				arq_htl_360 =  '$arq_htl_360',
				url_video =  '$url_video',
				arq_video =  '$arq_video',
				virtual_tour =  '$virtual_tour',
				htlobs =  '$htlobs',
				htlobsing =  '$htlobsing',
				htlobsesp =  '$htlobsesp',
				historico_temp =  '$historico_temp',
				htlestrelablumar =   '$estrelablumar',
				classif_eco =  '$classif_eco',
				desc_mostrp_ing =  '$desc_mostrp_ing',
				flaghtl =  '$flaghtl',
				flaglatino =  '$flaglatino',
				flat =  '$flat',
				resort =  '$resort',
				ecologico =  '$ecologico',
				flagfotopiscina =  '$flagfotopiscina',
				bestdeal =  '$bestdeal',
				ativo_bnuts =  '$ativo_bnuts',
				flaghtlimgmapa =  '$flaghtlimgmapa',
				luxury =  '$luxury',
				novo =  '$novo',
				favoritos =  '$favoritos',
				pg6fq7 =  '$pg6fq7',
				pg4fq5 =  '$pg4fq5',
				chdgratis =  '$chdgratis',
				blumarrecomenda =  '$blumarrecomenda',
				blumarreveillon =  '$blumarreveillon',
				allinclusive =  '$allinclusive',
				ativo_mostrp =  '$ativo_mostrp',
                covid_19_en_url = '$covid_19_en_url',
                covid_19_pt_url = '$covid_19_pt_url',
				htl_num_quartos = '$htl_num_quartos'
		where
		    	frncod = '$frncod'
		 ";
		pg_query($conn, $sql);
		 
		 
		
		
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
		'Atualizou o hotel  - $mneu_for-$nome_htl',
		'$data_now',
		'2'
		)
		";
		pg_query($conn, $query_log);
		
		
		
		
		
		
		
		
		
	echo 'HOTEL ATUALIZADO COM SUCESSO!';	
	echo "<hr>";
     $update_apto = 0;
		
	require_once 'miolo_hotel.php';
    
	
	
		?>
		