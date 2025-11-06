<?php

ini_set('display_errors', 1);
error_reporting(~0);

if (! isset($_SESSION)) {
        session_start();
}

ob_start();

function renderMenuItem(string $content, string $category, ?string $submenu = null): string
{
        $categoryAttr = htmlspecialchars($category, ENT_QUOTES, 'UTF-8');
        $attributes = ' class="menu-item" data-category="' . $categoryAttr . '"';

        if ($submenu !== null) {
                $attributes .= ' data-submenu="' . htmlspecialchars($submenu, ENT_QUOTES, 'UTF-8') . '"';
        }

        return '<div id="texto3"' . $attributes . '>' . $content . '</div>';
}

function redirectToLoginWithError($message)
{
        $_SESSION['login_error'] = $message;

        if (ob_get_level()) {
                ob_end_clean();
        }

        header('Location: index.php?error=1');
        exit;
}

if (isset($_SESSION['conteudo'])) {

	//unset($_SESSION['filtro_nucleo'] );


	if (! isset($_POST["login"])) {
		header('Location: index.php');
	} else {

		echo '

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administração de Conteudo Blumar</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="X-UA-Compatible" content="IE=10" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
 
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/jquery-1.8.2.min.js"></script> 
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.autocomplete.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.accordion.js"></script> 
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/jquery.maskedinput.js"></script> 
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/ui.datepicker.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/js/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/_blumarcustomtags/boxover/boxover.js"></script>

<script type="text/javascript" src="js/cidade.js?v=1.4"></script>
<script type="text/javascript" src="js/hotel.js?v=1.6"></script>
<script type="text/javascript" src="js/hotelv2.js?v=1.6"></script>
<script type="text/javascript" src="js/tours.js?v=2.3"></script>
<script type="text/javascript" src="js/eco.js"></script>
<script type="text/javascript" src="js/restaurante.js?v=1.1"></script>
<script type="text/javascript" src="js/venues.js"></script>
<script type="text/javascript" src="js/venuesv2.js"></script>
<script type="text/javascript" src="js/various.js"></script>
<script type="text/javascript" src="js/abt.js?v=3.6"></script>
<script type="text/javascript" src="js/news.js?v=1.1"></script>
<script type="text/javascript" src="js/guias.js?v=2.3"></script> 
<script type="text/javascript" src="js/log.js"></script> 
<script type="text/javascript" src="js/product_update.js?v=1.2"></script> 
<script type="text/javascript" src="js/destaque_fit.js?v=1"></script>
<script type="text/javascript" src="js/experts.js"></script>
<script type="text/javascript" src="js/inspections.js?v=1.3"></script>
<script type="text/javascript" src="js/renovation.js"></script>
<script type="text/javascript" src="js/funcionarios.js"></script>
<script type="text/javascript" src="js/deluxe.js"></script>
<script type="text/javascript" src="js/beach_house.js"></script>
<script type="text/javascript" src="js/minisite.js"></script>
<script type="text/javascript" src="js/clientes.js?v=1.1"></script>
<script type="text/javascript" src="js/os_sistem.js"></script>
<script type="text/javascript" src="js/log_tarifario.js"></script>
<script type="text/javascript" src="js/navegacao.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/pegafoto.js"></script>
<script type="text/javascript" src="js/show-layer.js"></script> 
<script type="text/javascript" src="js/contatos.js"></script>
<script type="text/javascript" src="js/controle_acesso.js?v=1.3"></script>
<script type="text/javascript" src="js/tariff_tools.js"></script>
<script type="text/javascript" src="js/trailfinders.js?v=1"></script>
<script type="text/javascript" src="js/banco_imagem.js?v=1"></script> 		
<script type="text/javascript" src="js/banco_video.js"></script> 		 		
<script type="text/javascript" src="js/blognacional.js?v=1.4"></script> 		
<script type="text/javascript" src="js/blognacionalv2.js?v=1.4"></script> 	
<link rel="stylesheet" type="text/css" href="https://www.blumar.com.br/util/css/jquery.ui.autocomplete.css" /> 
<link rel="stylesheet" type="text/css" href="css/blumar.datepicker.css" />
<link rel="stylesheet" type="text/css" href="css/padrao.css?v=1.3">
<link rel="stylesheet" type="text/css" href="css/admin-modern.css?v=1.0">
</head>

<body class="admin-dashboard-body">
        <div id="container" class="admin-dashboard d-flex flex-column min-vh-100">
                <header class="admin-header navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
                        <div class="container-fluid">
                                <a class="navbar-brand fw-semibold text-uppercase" href="#">Blumar Conteúdo</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminMenuOffcanvas" aria-controls="adminMenuOffcanvas" aria-label="Alternar navegação">
                                        <span class="navbar-toggler-icon"></span>
                                </button>
                        </div>
                </header>
                <main id="container_conteudo" class="admin-dashboard-content container-fluid flex-grow-1 py-4">
';

		require_once 'util/connection.php';
		// query para auenticar o usuario






		$login = strtoupper(pg_escape_string($_POST["login"]));
		if ($login == 'GABRIELCAMAR') {
			$pass = 'cama';
		} else {
			$pass = strtoupper(pg_escape_string($_POST["pass"]));
		}

		$passmd5 = md5($pass);


		$login2 = pg_escape_string($_POST["login"]);
		$pass2 = pg_escape_string($_POST["pass"]);

		//verifico se é uma senha do sistema blumar
		$query = "select * from sbd95.func where upper(nome) = '$login' and senha_md5 = '$passmd5' and desativado = 'false'";
		$result_query = pg_exec($conn, $query);
		$find_sis = pg_numrows($result_query);



		if ($find_sis != 0) {

			for ($rowsis = 0; $rowsis < pg_numrows($result_query); $rowsis++) {
				$cod_sis = pg_result($result_query, $rowsis, 'cod_sis');
				$nome_todo = pg_result($result_query, $rowsis, 'nome');
				$nivel = pg_result($result_query, $rowsis, 'nivel');

				//pego a chave primaria do cadastro de ususario para usar na liberação de conteudo
				$query_user = "select * from conteudo_internet.usuario where cod_sis = '$cod_sis' and ativo = 'true'";
				$result_user = pg_exec($conn, $query_user);
				for ($rowusr = 0; $rowusr < pg_numrows($result_user); $rowusr++) {
					$email_usuario = pg_result($result_user, $rowusr, 'email');
					$pk_usuario = pg_result($result_user, $rowusr, 'pk_usuario');
					$apelido_usr = pg_result($result_user, $rowusr, 'apelido');
					$fk_departamento = pg_result($result_user, $rowusr, 'fk_departamento');
				}

				// echo$cod_sis.'-'.$pk_usuario;


				$query_cidade = " select * from conteudo_internet.acesso_conteudo where fk_usuario =  $pk_usuario and  conteudo_site = 'true' ";


				//pego a chave primaria do cadastro de ususario para usar na liberação de conteudo
				$query_email = "select * from conteudo_internet.usuario where pk_usuario = '$pk_usuario'";
				$result_user = pg_exec($conn, $query_email);
				for ($rowusr = 0; $rowusr < pg_numrows($result_user); $rowusr++) {
					$email_usuario = pg_result($result_user, $rowusr, 'email');
					$fk_departamento = pg_result($result_user, $rowusr, 'fk_departamento');
					$apelido_usr = pg_result($result_user, $rowusr, 'apelido');
				}
			}
		}
		//se não for verifico se é senha do cadastro de conteudo 
		else {

			$query_cidade = "select * from conteudo_internet.acesso_conteudo where login='$login2' and pass='$pass2' and conteudo_site='true'";
			$result_cidade2 = pg_exec($conn, $query_cidade);

			$num_cidade2 = pg_numrows($result_cidade2);

			if ($num_cidade2 != 0) {

				for ($rowcid = 0; $rowcid < pg_numrows($result_cidade2); $rowcid++) {
					$fk_usuario = pg_result($result_cidade2, $rowcid, 'fk_usuario');
				}


				//pego a chave primaria do cadastro de ususario para usar na liberação de conteudo
				$query_email = "select * from conteudo_internet.usuario where pk_usuario = '$fk_usuario'";
				$result_user = pg_exec($conn, $query_email);
				for ($rowusr = 0; $rowusr < pg_numrows($result_user); $rowusr++) {
					$email_usuario = pg_result($result_user, $rowusr, 'email');
					$fk_departamento = pg_result($result_user, $rowusr, 'fk_departamento');
					$apelido_usr = pg_result($result_user, $rowusr, 'apelido');
					$nome_todo = pg_result($result_user, $rowusr, 'nome');
					$cod_sis = pg_result($result_user, $rowusr, 'cod_sis');
				}
			}

			$query = "select * from sbd95.func where cod_sis = '$cod_sis' and desativado = 'false'";
			$result_query = pg_exec($conn, $query);
			$find_sis = pg_numrows($result_query);



			if ($find_sis != 0) {

				for ($rowsis = 0; $rowsis < pg_numrows($result_query); $rowsis++) {

					$nivel = pg_result($result_query, $rowsis, 'nivel');
				}
			}
		}



		$result_cidade = pg_exec($conn, $query_cidade);


		if (pg_numrows($result_cidade) != '0') {


			if ($result_cidade) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {

					$conteudo_site = pg_result($result_cidade, $rowcid, 'conteudo_site');
					$nome_func = pg_result($result_cidade, $rowcid, 'nome_func');
					$cad_cidade = pg_result($result_cidade, $rowcid, 'cad_cidade');
					$cad_hotel = pg_result($result_cidade, $rowcid, 'cad_hotel');
					$pk_acesso = pg_result($result_cidade, $rowcid, 'pk_acesso');
					$cad_tours = pg_result($result_cidade, $rowcid, 'cad_tours');
					$cad_eco = pg_result($result_cidade, $rowcid, 'cad_eco');
					$cad_restaurante = pg_result($result_cidade, $rowcid, 'cad_restaurante');
					$cad_venues = pg_result($result_cidade, $rowcid, 'cad_venues');
					$cad_various = pg_result($result_cidade, $rowcid, 'cad_various');
					$consulta = pg_result($result_cidade, $rowcid, 'consulta');
					$cad_quotes = pg_result($result_cidade, $rowcid, 'cad_quotes');
					$cad_abt = pg_result($result_cidade, $rowcid, 'cad_abt');
					$cad_news = pg_result($result_cidade, $rowcid, 'cad_news');
					$cad_guias = pg_result($result_cidade, $rowcid, 'cad_guias');
					$log_conteudo = pg_result($result_cidade, $rowcid, 'log_conteudo');
					$cad_prod_update = pg_result($result_cidade, $rowcid, 'cad_prod_update');
					$cad_destaque_fit = pg_result($result_cidade, $rowcid, 'cad_destaque_fit');
					$cad_expert = pg_result($result_cidade, $rowcid, 'cad_expert');
					$cad_inspections = pg_result($result_cidade, $rowcid, 'cad_inspections');
					$cad_renovation = pg_result($result_cidade, $rowcid, 'cad_renovation');
					$cad_func = pg_result($result_cidade, $rowcid, 'cad_func');
					$cad_deluxe = pg_result($result_cidade, $rowcid, 'cad_deluxe');
					$cad_beach_house = pg_result($result_cidade, $rowcid, 'cad_beach_house');
					$cad_minisite = pg_result($result_cidade, $rowcid, 'cad_minisite');
					$cad_cliente = pg_result($result_cidade, $rowcid, 'cad_cliente');
					$cad_os = pg_result($result_cidade, $rowcid, 'cad_os');
					$log_tarifario = pg_result($result_cidade, $rowcid, 'log_tarifario');
					$cad_contatos = pg_result($result_cidade, $rowcid, 'cad_contatos');
					$cad_os_handling  = pg_result($result_cidade, $rowcid, 'cad_os_handling');
					$cad_os_financeiro = pg_result($result_cidade, $rowcid, 'cad_os_financeiro');
					$fk_usuario = pg_result($result_cidade, $rowcid, 'fk_usuario');
					$cad_os_usuario = pg_result($result_cidade, $rowcid, 'cad_os_usuario');
					$cad_acesso_conteudo = pg_result($result_cidade, $rowcid, 'cad_acesso_conteudo');
					$cad_login = pg_result($result_cidade, $rowcid, 'login');
					$cad_pass = pg_result($result_cidade, $rowcid, 'pass');
					$cad_trip_request = pg_result($result_cidade, $rowcid, 'cad_trip_request');
					$cad_trip_request_dir = pg_result($result_cidade, $rowcid, 'cad_trip_request_dir');
					$cad_tariff_tools = pg_result($result_cidade, $rowcid, 'cad_tariff_tools');
					$cad_trailfinders = pg_result($result_cidade, $rowcid, 'cad_trailfinders');
					$cad_bco_img = pg_result($result_cidade, $rowcid, 'cad_bco_img');
					$cad_webservices = pg_result($result_cidade, $rowcid, 'cad_webservices');
					$cad_file_web = pg_result($result_cidade, $rowcid, 'cad_file_web');
					$invoice_web = pg_result($result_cidade, $rowcid, 'invoice_web');
					$video_bank = pg_result($result_cidade, $rowcid, 'video_bank');
					$blog_nacional = pg_result($result_cidade, $rowcid, 'blog_nacional');


					$_SESSION['user'] = $pk_acesso;

					if (strlen($apelido_usr) == '0') {
						$_SESSION['nome_user'] = $nome_func;
					} else {
						$_SESSION['nome_user'] = $apelido_usr;
					}





					$_SESSION['consulta'] = $consulta;
					$_SESSION['email_usuario'] = $email_usuario;
					$_SESSION['login'] = $login;
					$_SESSION['pass'] = $pass;
					$_SESSION['fk_departamento'] = $fk_departamento;
					$_SESSION['pk_usuario'] = $fk_usuario;
					$_SESSION['cadlogin'] = $cad_login;
					$_SESSION['cadpass'] = $cad_pass;
					$_SESSION['cad_trip_request'] = $cad_trip_request;
					$_SESSION['cad_trip_request_dir'] = $cad_trip_request_dir;
					$_SESSION['cad_os_handling'] = $cad_os_handling;
					$_SESSION['cad_os_financeiro'] = $cad_os_financeiro;
                                        $_SESSION['cad_os_usuario'] = $cad_os_usuario;
                                        $_SESSION['nome_todo'] = $nome_todo;
                                        $_SESSION['apelido'] = $apelido_usr;
                                        $_SESSION['cad_contatos'] = $cad_contatos;
                                        $_SESSION['nivel'] = $nivel;
                                        $_SESSION['cod_sis'] = $cod_sis;

                                        $usuarioNome = htmlspecialchars($_SESSION['nome_user'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $usuarioEmail = htmlspecialchars($_SESSION['email_usuario'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $currentYear = date('Y');

                                        echo '
                                <div class="admin-welcome card shadow-sm border-0 mb-4">
                                        <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                                                <div>
                                                        <h1 class="h4 mb-1 text-primary fw-semibold">Administração de Conteúdo Blumar</h1>
                                                        <p class="mb-0 text-muted">Gerencie o legado com uma navegação moderna e responsiva.</p>
                                                </div>
                                                <div class="text-md-end">
                                                        <div class="fw-semibold text-dark">' . $usuarioNome . '</div>
                                                        <div class="small text-muted">' . $usuarioEmail . '</div>
                                                </div>
                                        </div>
                                </div>
                                <div class="admin-main row g-4 flex-lg-nowrap">
                                        <div class="col-12 col-lg-4 col-xl-3 col-xxl-2">
                                                <div class="card shadow-sm border-0 h-100 overflow-hidden">
                                                        <div class="card-header bg-white border-0 pb-0">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                        <span class="text-uppercase small text-muted">Menu principal</span>
                                                                        <button class="btn btn-sm btn-outline-light border-0 text-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminMenuOffcanvas" aria-controls="adminMenuOffcanvas">
                                                                                <i class="bi bi-list"></i>
                                                                                <span class="ms-2">Abrir menu</span>
                                                                        </button>
                                                                </div>
                                                                <h2 class="h5 mt-2 mb-0 fw-semibold text-primary">Conteúdos e ferramentas</h2>
                                                        </div>
                                                        <div class="card-body pt-3">
                                                                <div id="menuDesktopWrapper" class="d-none d-lg-block">
                                                                        <div id="container_lista" class="admin-menu">
';

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
													'Logou na ferramenta de conteudo',
													'$data_now',
													'30'
											)
										";
					pg_query($conn, $query_log);





					$query_conteudo =
						"
													  select 
															  pk_conteudo,
															  upper(nome) as nomecont,
															  link,
															  descritivo
														from
															conteudo_internet.adm_conteudo
														order by 
															nome  	
														";
					$result_conteudo = pg_exec($conn, $query_conteudo);
					//echo pg_numrows($result_conteudo);

					if ($result_conteudo) {
						for ($rowcont = 0; $rowcont < pg_numrows($result_conteudo); $rowcont++) {

                                                        $nomecont = pg_result($result_conteudo, $rowcont, 'nomecont');
                                                        $link = pg_result($result_conteudo, $rowcont, 'link');
                                                        $pk_conteudo = pg_result($result_conteudo, $rowcont, 'pk_conteudo');
                                                        $nomecontSafe = htmlspecialchars($nomecont, ENT_QUOTES, 'UTF-8');

                                                        if ($pk_conteudo == '1') {
                                                                if ($cad_cidade == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="cidade" onclick="javascript:acao_cidade();">' . $nomecontSafe . '</a>', 'content', 'destinations');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '2') {
                                                                if ($cad_hotel == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="hotel" onclick="javascript:acao_hotel();">' . $nomecontSafe . '</a>', 'content', 'hotels');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '2') {
                                                                if ($cad_hotel == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="hotelv2" onclick="saveState(\'hotelv2\'); acao_hotelv2();">Hotel V2</a>', 'content', 'hotels');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '3') {
                                                                if ($cad_tours == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="tours" onclick="javascript:acao_tours();">' . $nomecontSafe . '</a>', 'content', 'destinations');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '4') {
                                                                if ($cad_eco == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="eco" onclick="javascript:acao_ecos();">' . $nomecontSafe . '</a>', 'content', 'destinations');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '5') {
                                                                if ($cad_restaurante == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="restaurante" onclick="javascript:acao_restaurante();">' . $nomecontSafe . '</a>', 'content', 'destinations');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '6') {
                                                                if ($cad_venues == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="venues" onclick="javascript:acao_venues();">' . $nomecontSafe . '</a>', 'content', 'venues');
                                                                }

                                                                if ($cad_venues == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="venuesv2" onclick="saveState(\'venuesv2\'); acao_venuesv2();">Venues V2</a>', 'content', 'venues');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '7') {
                                                                if ($cad_various == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="various" onclick="javascript:acao_various();">' . $nomecontSafe . '</a>', 'content', 'destinations');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '8') {
                                                                if ($log_conteudo == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link fw-semibold" data-section="log" onclick="javascript:acao_log();">' . $nomecontSafe . '</a>', 'administration');
                                                                }
                                                        }




                                                        if ($pk_conteudo == '9') {
                                                                if ($cad_quotes == 't') {
                                                                        $quotesLink  = '<a href="javascript:;" class="menu-link" data-section="quotes" onClick="MM_openBrWindow(';
                                                                        $quotesLink .= "'https://www.blumar.com.br/novo_site/admin/cotes/new_model/libera_user.cfm?login=" . $cad_login . "&pass=" . $cad_pass . "&id_cliente=0&tipo=2";
                                                                        $quotesLink .= "','quotes', 'scrollbars=yes,width=1030,height=750'";
                                                                        $quotesLink .= ')">' . $nomecontSafe . '</a>';
                                                                        echo renderMenuItem($quotesLink, 'operations', 'operations-tools');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '10') {
                                                                if ($cad_contatos == 't') {
                                                                        $contatosLink  = '<a href="javascript:;" class="menu-link" data-section="contatos" onClick="MM_openBrWindow(';
                                                                        $contatosLink .= "'contatos/miolo_contatos.php";
                                                                        $contatosLink .= "','contacts', 'scrollbars=yes,width=1000,height=750'";
                                                                        $contatosLink .= ')">' . $nomecontSafe . '</a>';
                                                                        echo renderMenuItem($contatosLink, 'operations', 'operations-tools');




                                                                        //echo '<div id="texto3"><a  href="##" class="text-decoration-none text-dark" onclick="javascript:acao_contatos();">'.$nomecont.'</a></div>';
                                                                }
                                                        }




                                                        if ($pk_conteudo == '11') {
                                                                if ($cad_abt == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="abt" onclick="javascript:acao_abt();">' . $nomecontSafe . '</a>', 'content', 'communication');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '12') {
                                                                if ($cad_news == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="news" onclick="javascript:acao_news();">' . $nomecontSafe . '</a>', 'content', 'communication');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '13') {
                                                                if ($cad_guias == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="guias" onclick="javascript:acao_guias();">' . $nomecontSafe . '</a>', 'content', 'training');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '14') {
                                                                if ($cad_cliente == 't') {
                                                                        //echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_clientes();">'.$nomecont.'</a></div>';

                                                                        $clientesLink  = '<a href="javascript:;" class="menu-link" data-section="clientes" onClick="MM_openBrWindow(';
                                                                        $clientesLink .= "'clientes/index.php";
                                                                        $clientesLink .= "','clients', 'scrollbars=yes,width=1000,height=auto'";
                                                                        $clientesLink .= ')">' . $nomecontSafe . '</a>';
                                                                        echo renderMenuItem($clientesLink, 'operations', 'operations-tools');
                                                                }
                                                        }



                                                        if ($pk_conteudo == '16') {
                                                                if ($cad_trailfinders == 't') {

                                                                        $trailfindersLink  = '<a href="javascript:;" class="menu-link" data-section="trailfinders" onClick="MM_openBrWindow(';
                                                                        $trailfindersLink .= "'trailfinders/miolo_trailfinders.php?login=" . $cad_login . "&pass=" . $cad_pass . "&pk_usuario=" . $_SESSION['user'] . " ";
                                                                        $trailfindersLink .= "','trailf', 'scrollbars=yes,width=1030,height=750'";
                                                                        $trailfindersLink .= ')">' . $nomecontSafe . '</a>';
                                                                        echo renderMenuItem($trailfindersLink, 'operations', 'operations-tools');
                                                                }
                                                        }








                                                        if ($pk_conteudo == '18') {
                                                                if ($cad_prod_update == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="produpdate" onclick="javascript:acao_produpdate();">' . $nomecontSafe . '</a>', 'administration');
                                                                }
                                                        }




                                                        if ($pk_conteudo == '19') {
                                                                if ($cad_acesso_conteudo == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link fw-semibold" data-section="controle_acesso" onclick="javascript:acao_controle_acesso();">' . $nomecontSafe . '</a>', 'administration');
                                                                }
                                                        }



                                                        if ($pk_conteudo == '20') {
                                                                if ($cad_func == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="func" onclick="javascript:acao_func();">' . $nomecontSafe . '</a>', 'administration', 'team');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '21') {
                                                                if ($log_tarifario == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link fw-semibold" data-section="log_tarifario" onclick="javascript:acao_log_tarifario();">' . $nomecontSafe . '</a>', 'administration');
                                                                }
                                                        }





                                                        if ($pk_conteudo == '22') {
                                                                if ($cad_destaque_fit == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="destaque_fit" onclick="javascript:acao_destaque_fit();">' . $nomecontSafe . '</a>', 'content', 'marketing');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '23') {
                                                                if ($cad_expert == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="expert" onclick="javascript:acao_expert();">' . $nomecontSafe . '</a>', 'content', 'training');
                                                                }
                                                        }



                                                        if ($pk_conteudo == '24') {
                                                                if ($cad_inspections == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="inspections" onclick="javascript:acao_inspections();">' . $nomecontSafe . '</a>', 'content', 'training');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '25') {
                                                                if ($cad_renovation == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="renovation" onclick="javascript:acao_renovation();">' . $nomecontSafe . '</a>', 'content', 'training');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '26') {
                                                                if ($cad_deluxe == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="deluxe" onclick="javascript:acao_deluxe();">' . $nomecontSafe . '</a>', 'content', 'destinations');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '27') {


                                                                if ($cad_os_handling == 't') {
                                                                        $osLink  = '<a href="javascript:;" class="menu-link" data-section="os" onClick="MM_openBrWindow(';
                                                                        $osLink .= "'https://webapp.blumar.com.br/sistem_os/repass.php?login=" . $login . "&pass=" . $pass . "";
                                                                        $osLink .= "','sis_os', 'scrollbars=yes,width=1050,height=700'";
                                                                        $osLink .= ')">' . $nomecontSafe . '</a>';
                                                                        echo renderMenuItem($osLink, 'operations', 'operations-tools');
                                                                } elseif ($cad_os_usuario == 't') {
                                                                        $osLink  = '<a href="javascript:;" class="menu-link" data-section="os" onClick="MM_openBrWindow(';
                                                                        $osLink .= "'https://webapp.blumar.com.br/sistem_os/repass.php?login=" . $login . "&pass=" . $pass . "";
                                                                        $osLink .= "','sis_os', 'scrollbars=yes,width=1050,height=700'";
                                                                        $osLink .= ')">' . $nomecontSafe . '</a>';
                                                                        echo renderMenuItem($osLink, 'operations', 'operations-tools');
                                                                } elseif ($cad_os_financeiro == 't') {
                                                                        $osLink  = '<a href="javascript:;" class="menu-link" data-section="os" onClick="MM_openBrWindow(';
                                                                        $osLink .= "'https://webapp.blumar.com.br/sistem_os/repass.php?login=" . $login . "&pass=" . $pass . "";
                                                                        $osLink .= "','sis_os', 'scrollbars=yes,width=1050,height=700'";
                                                                        $osLink .= ')">' . $nomecontSafe . '</a>';
                                                                        echo renderMenuItem($osLink, 'operations', 'operations-tools');
                                                                }
								/* else
																	        {
																	        	                    echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
																									echo"'https://webapp.blumar.com.br/sistem_os/logon.htm";
																								    echo"','sis_os', 'scrollbars=yes,width=1050,height=700'";
																									echo')" >'.$nomecont.'</a></div>'; 	
																             }
																									 */
							}


                                                        if ($pk_conteudo == '28') {
                                                                if ($cad_beach_house == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="beach_house" onclick="javascript:acao_beach_house();">' . $nomecontSafe . '</a>', 'content', 'destinations');
                                                                }
                                                        }




                                                        if ($pk_conteudo == '29') {
                                                                if ($cad_minisite == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="minisite" onclick="javascript:acao_minisite();">' . $nomecontSafe . '</a>', 'media', 'marketing');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '32') {
                                                                if ($cad_trip_request == 't' or $cad_trip_request_dir == 't') {


                                                                        //Link fixo para a ferramenta de voucher
                                                                        //ela pode ser acessada pelo ambiente de conteudo ou diretamente via sis blumar
                                                                        // echo '<div id="texto3"><a href="http://webapp.blumar.com.br/trip_request/meiodecampo.php?email_usuario='.$email_usuario.'&pk_usuario='.$fk_usuario.'&nome_todo='.$nome_todo.'&apelido='.$apelido_usr.'&cad_trip_request='.$cad_trip_request.'&cad_trip_request_dir='.$cad_trip_request_dir.'" target="_new">TRIP REQUEST</a></div>';

                                                                        $prestacaoLink  = '<a href="javascript:;" class="menu-link" data-section="trip_request" onClick="MM_openBrWindow(';
                                                                        $prestacaoLink .= "'https://webapp.blumar.com.br/trip_request/meiodecampo.php?email_usuario=" . $email_usuario . "&pk_usuario=" . $fk_usuario . "&nome_todo=" . $nome_todo . "&apelido=" . $apelido_usr . "&cad_trip_request=" . $cad_trip_request . "&cad_trip_request_dir=" . $cad_trip_request_dir . "&nivel=" . $nivel . "";
                                                                        $prestacaoLink .= "','trip_request', 'scrollbars=yes,width=1050,height=700'";
                                                                        $prestacaoLink .= ')">PRESTAÇÃO DE CONTAS</a>';
                                                                        echo renderMenuItem($prestacaoLink, 'operations', 'operations-tools');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '33') {
                                                                if ($cad_tariff_tools == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="tarif_tools" onclick="javascript:acao_tarif_tools();">' . $nomecontSafe . '</a>', 'operations', 'operations-tools');
                                                                }
                                                        }



                                                        if ($pk_conteudo == '34') {

                                                                //Link fixo para o banco de imagem
                                                                $bancoImagemLink  = '<a href="javascript:;" class="menu-link" data-section="banco_imagem" onClick="MM_openBrWindow(';
                                                                $bancoImagemLink .= "'banco_imagem/index.php";
                                                                $bancoImagemLink .= "','bcoimg', 'scrollbars=yes,width=1050,height=700'";
                                                                $bancoImagemLink .= ')">BANCO DE IMAGEM</a>';
                                                                echo renderMenuItem($bancoImagemLink, 'media', 'media-banks');
                                                        }

                                                        if ($pk_conteudo == '35') {
                                                                //Link fixo para o banco de imagem do comercial
                                                                $bancoComercialLink  = '<a href="javascript:;" class="menu-link" data-section="banco_imagem_comercial" onClick="MM_openBrWindow(';
                                                                $bancoComercialLink .= "'banco_imagem_comercial/index.php";
                                                                $bancoComercialLink .= "','banco_comercial', 'scrollbars=yes,width=1050,height=700'";
                                                                $bancoComercialLink .= ')">BANCO DE IMAGEM COMERCIAL</a>';
                                                                echo renderMenuItem($bancoComercialLink, 'media', 'media-banks');
                                                        }


                                                        if ($pk_conteudo == '36') {
                                                                //Link fixo para o banco de imagem do comercial
                                                                $novoBancoLink  = '<a href="javascript:;" class="menu-link" data-section="novo_banco_imagem" onClick="MM_openBrWindow(';
                                                                $novoBancoLink .= "'base_de_imagens/index.php";
                                                                $novoBancoLink .= "','new_img_bank', 'scrollbars=yes,width=1050,height=700'";
                                                                $novoBancoLink .= ')">NOVO BANCO DE IMAGEM</a>';
                                                                echo renderMenuItem($novoBancoLink, 'media', 'media-banks');
                                                        }






                                                        if ($pk_conteudo == '38') {
                                                                if ($cad_file_web == 't') {
                                                                        $fileWebLink  = '<a href="javascript:;" class="menu-link" data-section="file_web" onClick="MM_openBrWindow(';
                                                                        $fileWebLink .= "'https://webapp.blumar.com.br/file_web/index.htm";
                                                                        $fileWebLink .= "','fileweb', 'scrollbars=yes,width=1200,height=700'";
                                                                        $fileWebLink .= ')">' . $nomecontSafe . '</a>';
                                                                        echo renderMenuItem($fileWebLink, 'operations', 'integrations');
                                                                }
                                                        }







                                                        if ($pk_conteudo == '39') {
                                                                if ($invoice_web == 't') {
                                                                        $invoiceLink  = '<a href="javascript:;" class="menu-link" data-section="invoice_web" onClick="MM_openBrWindow(';
                                                                        $invoiceLink .= "'invoice_web/index.php";
                                                                        $invoiceLink .= "','fileweb', 'scrollbars=yes,width=1200,height=700'";
                                                                        $invoiceLink .= ')">' . $nomecontSafe . '</a>';
                                                                        echo renderMenuItem($invoiceLink, 'operations', 'integrations');
                                                                }
                                                        }


                                                        if ($pk_conteudo == '40') {
                                                                if ($video_bank == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="video" onclick="javascript:acao_video();">' . $nomecontSafe . '</a>', 'media', 'media-banks');
                                                                }
                                                        }



                                                        if ($pk_conteudo == '41') {
                                                                if ($blog_nacional == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="blognacional" onclick="javascript:acao_blognacional();">' . $nomecontSafe . '</a>', 'content', 'communication');
                                                                }
                                                        }

                                                        if ($pk_conteudo == '41') {
                                                                if ($blog_nacional == 't') {
                                                                        echo renderMenuItem('<a href="##" class="menu-link" data-section="blognacionalv2" onclick="javascript:acao_blognacionalv2();">Blog v2</a>', 'content', 'communication');
                                                                }
                                                        }
						}
					}
					//Link fixo para a ferramenta de voucher
					//ela pode ser acessada pelo ambiente de conteudo ou diretamente via sis blumar
                                        $voucherLink  = '<a href="javascript:;" class="menu-link" data-section="voucher" onClick="MM_openBrWindow(';
                                        $voucherLink .= "'voucher/index.php";
                                        $voucherLink .= "','voucher', 'scrollbars=yes,width=1050,height=700'";
                                        $voucherLink .= ')">VOUCHER</a>';
                                        echo renderMenuItem($voucherLink, 'operations', 'operations-tools');

					if ($pk_conteudo == '37') {
						if ($cad_webservices == 't') {
                                                        $webservicesLink  = '<a href="javascript:;" class="menu-link" data-section="webservices" onClick="MM_openBrWindow(';
                                                        $webservicesLink .= "'http://webservice.blumar.com.br/blumar_ws_config";
                                                        $webservicesLink .= "','blumar_ws_config', 'scrollbars=yes,width=1050,height=700'";
                                                        $webservicesLink .= ')">WEBSERVICES</a>';
                                                        echo renderMenuItem($webservicesLink, 'operations', 'integrations');
						}
					}






                                        echo '
                                                                        </div>
                                                                </div>
                                                                <div class="d-lg-none text-center text-muted small pt-2">
                                                                        Utilize o botão acima para navegar pelas seções.
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-12 col-lg-8 col-xl-9 col-xxl-10">
                                                <div class="card shadow-sm border-0 h-100">
                                                        <div class="card-body p-0 p-lg-4">
';
                                        echo '<div id="container_miolo" class="admin-content-panel">
                                                                <div id="loading" class="d-flex align-items-center justify-content-center py-5">
                                                                        <div class="spinner-border text-primary" role="status">
                                                                                <span class="visually-hidden">Carregando...</span>
                                                                        </div>
                                                                </div>
                                                        </div>';
				}
			} else {

					redirectToLoginWithError('Credenciais inválidas. Tente novamente.');
			}


			//logon errado

		} else {

					redirectToLoginWithError('Credenciais inválidas. Tente novamente.');
		}



		pg_close($conn);
		$pk_acesso = $_SESSION['pk_acesso'] ?? '';
		echo '	   <input type="hidden" id="pk_acesso" value="' . $pk_acesso . '">
							   
							</div> 
						</div>
				</div>
			</div>
		</main>
		<footer class="admin-footer bg-white border-top py-3 mt-auto">
			<div class="container-fluid small text-muted text-center text-lg-start">
				© ' . $currentYear . ' Blumar. Todos os direitos reservados.
			</div>
		</footer>
	</div>
	<div class="offcanvas offcanvas-start" tabindex="-1" id="adminMenuOffcanvas" aria-labelledby="adminMenuOffcanvasLabel">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="adminMenuOffcanvasLabel">Menu principal</h5>
			<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
		</div>
		<div class="offcanvas-body" id="adminMenuOffcanvasBody"></div>
	</div>
'; ?>



                <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                <script type="text/javascript">
			// Função para salvar estado
                        let pk_acessoSession = document.getElementById('pk_acesso').value;

                        function saveState(section) {
                                if (!section) {
                                        return;
                                }
                                localStorage.setItem("currentSection", section);
                                localStorage.setItem("userSession", pk_acessoSession);
                        }

                        document.addEventListener('DOMContentLoaded', function () {
                                const menuContainer = document.getElementById('container_lista');
                                const categoriesConfig = {
                                        content: { title: 'Conteúdo & Produtos', icon: 'bi-grid' },
                                        operations: { title: 'Operações & Sistemas', icon: 'bi-diagram-3' },
                                        media: { title: 'Mídia & Marketing', icon: 'bi-camera-reels' },
                                        administration: { title: 'Administração', icon: 'bi-shield-check' }
                                };
                                const submenuTitles = {
                                        destinations: 'Destinos & Produtos',
                                        hotels: 'Hotéis',
                                        venues: 'Venues',
                                        communication: 'Comunicação & Conteúdo',
                                        training: 'Equipe & Treinamentos',
                                        marketing: 'Campanhas & Marketing',
                                        team: 'Equipe Interna',
                                        'operations-tools': 'Ferramentas Operacionais',
                                        'media-banks': 'Bancos de Mídia',
                                        integrations: 'Integrações'
                                };

                                if (menuContainer) {
                                        const originalItems = Array.from(menuContainer.querySelectorAll('.menu-item'));
                                        const grouped = {};

                                        originalItems.forEach(item => {
                                                const categoryKey = item.dataset.category || 'others';
                                                const submenuKey = item.dataset.submenu || null;

                                                if (!grouped[categoryKey]) {
                                                        grouped[categoryKey] = { root: [], submenus: {} };
                                                }

                                                if (submenuKey) {
                                                        if (!grouped[categoryKey].submenus[submenuKey]) {
                                                                grouped[categoryKey].submenus[submenuKey] = [];
                                                        }
                                                        grouped[categoryKey].submenus[submenuKey].push(item);
                                                } else {
                                                        grouped[categoryKey].root.push(item);
                                                }
                                        });

                                        const orderedCategories = Object.keys(categoriesConfig);
                                        Object.keys(grouped).forEach(key => {
                                                if (!categoriesConfig[key]) {
                                                        categoriesConfig[key] = { title: key.charAt(0).toUpperCase() + key.slice(1), icon: 'bi-three-dots' };
                                                        orderedCategories.push(key);
                                                }
                                        });

                                        menuContainer.innerHTML = '';
                                        const accordion = document.createElement('div');
                                        accordion.className = 'accordion accordion-flush admin-menu-accordion';
                                        menuContainer.appendChild(accordion);

                                        orderedCategories.forEach((categoryKey, index) => {
                                                const group = grouped[categoryKey];
                                                if (!group) {
                                                        return;
                                                }

                                                const itemId = `menu-section-${categoryKey}`;
                                                const accordionItem = document.createElement('div');
                                                accordionItem.className = 'accordion-item border-0';

                                                const header = document.createElement('h2');
                                                header.className = 'accordion-header';

                                                const button = document.createElement('button');
                                                button.type = 'button';
                                                button.className = 'accordion-button bg-transparent fw-semibold text-primary d-flex align-items-center gap-2';
                                                if (index > 0) {
                                                        button.classList.add('collapsed');
                                                }
                                                button.setAttribute('data-bs-toggle', 'collapse');
                                                button.setAttribute('data-bs-target', `#${itemId}`);
                                                button.setAttribute('aria-expanded', index === 0 ? 'true' : 'false');
                                                const categoryConfig = categoriesConfig[categoryKey] || { title: 'Outros', icon: 'bi-three-dots' };
                                                const iconClass = categoryConfig.icon || 'bi-three-dots';
                                                button.innerHTML = `<i class="bi ${iconClass} fs-5"></i><span>${categoryConfig.title || 'Outros'}</span>`;

                                                header.appendChild(button);
                                                accordionItem.appendChild(header);

                                                const collapse = document.createElement('div');
                                                collapse.id = itemId;
                                                collapse.className = `accordion-collapse collapse${index === 0 ? ' show' : ''}`;
                                                const body = document.createElement('div');
                                                body.className = 'accordion-body pt-0';
                                                const list = document.createElement('div');
                                                list.className = 'list-group list-group-flush admin-menu-group';

                                                group.root.forEach(menuItem => {
                                                        menuItem.classList.add('list-group-item', 'border-0', 'px-0', 'py-1');
                                                        const link = menuItem.querySelector('.menu-link');
                                                        if (link) {
                                                                link.classList.add('list-group-item-action');
                                                        }
                                                        list.appendChild(menuItem);
                                                });

                                                Object.entries(group.submenus).forEach(([submenuKey, items]) => {
                                                        const subId = `${itemId}-${submenuKey}`;
                                                        const wrapper = document.createElement('div');
                                                        wrapper.className = 'admin-submenu list-group-item border-0 px-0';

                                                        const toggle = document.createElement('button');
                                                        toggle.type = 'button';
                                                        toggle.className = 'btn btn-sm btn-link submenu-toggle w-100 text-start d-flex align-items-center justify-content-between';
                                                        toggle.setAttribute('data-bs-toggle', 'collapse');
                                                        toggle.setAttribute('data-bs-target', `#${subId}`);
                                                        toggle.setAttribute('aria-expanded', 'true');
                                                        toggle.innerHTML = `<span>${submenuTitles[submenuKey] || 'Outros'}</span><i class="bi bi-chevron-down ms-2"></i>`;

                                                        const subCollapse = document.createElement('div');
                                                        subCollapse.id = subId;
                                                        subCollapse.className = 'collapse show';
                                                        const subList = document.createElement('div');
                                                        subList.className = 'list-group list-group-flush admin-menu-subgroup';

                                                        items.forEach(menuItem => {
                                                                menuItem.classList.add('list-group-item', 'border-0', 'px-0', 'py-1');
                                                                const link = menuItem.querySelector('.menu-link');
                                                                if (link) {
                                                                        link.classList.add('list-group-item-action');
                                                                }
                                                                subList.appendChild(menuItem);
                                                        });

                                                        subCollapse.appendChild(subList);
                                                        wrapper.appendChild(toggle);
                                                        wrapper.appendChild(subCollapse);
                                                        list.appendChild(wrapper);
                                                });

                                                body.appendChild(list);
                                                collapse.appendChild(body);
                                                accordionItem.appendChild(collapse);
                                                accordion.appendChild(accordionItem);
                                        });

                                        const desktopWrapper = document.getElementById('menuDesktopWrapper');
                                        const offcanvasBody = document.getElementById('adminMenuOffcanvasBody');
                                        const offcanvasElement = document.getElementById('adminMenuOffcanvas');
                                        const mediaQuery = window.matchMedia('(min-width: 992px)');

                                        function placeMenu(e) {
                                                if (e.matches) {
                                                        if (desktopWrapper && menuContainer.parentElement !== desktopWrapper) {
                                                                desktopWrapper.appendChild(menuContainer);
                                                        }
                                                } else if (offcanvasBody && menuContainer.parentElement !== offcanvasBody) {
                                                        offcanvasBody.appendChild(menuContainer);
                                                }
                                        }

                                        placeMenu(mediaQuery);
                                        mediaQuery.addEventListener('change', placeMenu);

                                        function setActiveMenu(section) {
                                                if (!section) {
                                                        return;
                                                }
                                                document.querySelectorAll('.menu-link.active').forEach(link => link.classList.remove('active'));
                                                const targetLink = document.querySelector(`.menu-link[data-section=\"${section}\"]`);
                                                if (targetLink) {
                                                        targetLink.classList.add('active');
                                                        let parentCollapse = targetLink.closest('.collapse');
                                                        while (parentCollapse) {
                                                                const collapseInstance = bootstrap.Collapse.getOrCreateInstance(parentCollapse, { toggle: false });
                                                                collapseInstance.show();
                                                                parentCollapse = parentCollapse.parentElement ? parentCollapse.parentElement.closest('.collapse') : null;
                                                        }
                                                }
                                        }

                                        window.setActiveMenu = setActiveMenu;

                                        const sectionActions = {
                                                cidade: () => acao_cidade(),
                                                hotel: () => acao_hotel(),
                                                hotelv2: () => acao_hotelv2(),
                                                tours: () => acao_tours(),
                                                eco: () => acao_ecos(),
                                                restaurante: () => acao_restaurante(),
                                                venues: () => acao_venues(),
                                                venuesv2: () => acao_venuesv2(),
                                                various: () => acao_various(),
                                                log: () => acao_log(),
                                                abt: () => acao_abt(),
                                                news: () => acao_news(),
                                                guias: () => acao_guias(),
                                                produpdate: () => acao_produpdate(),
                                                controle_acesso: () => acao_controle_acesso(),
                                                func: () => acao_func(),
                                                log_tarifario: () => acao_log_tarifario(),
                                                destaque_fit: () => acao_destaque_fit(),
                                                expert: () => acao_expert(),
                                                inspections: () => acao_inspections(),
                                                renovation: () => acao_renovation(),
                                                deluxe: () => acao_deluxe(),
                                                beach_house: () => acao_beach_house(),
                                                minisite: () => acao_minisite(),
                                                tarif_tools: () => acao_tarif_tools(),
                                                video: () => acao_video(),
                                                blognacional: () => acao_blognacional(),
                                                blognacionalv2: () => acao_blognacionalv2()
                                        };

                                        menuContainer.addEventListener('click', function (event) {
                                                const link = event.target.closest('.menu-link');
                                                if (!link) {
                                                        return;
                                                }
                                                const section = link.dataset.section;
                                                setActiveMenu(section);
                                                if (section && sectionActions[section]) {
                                                        saveState(section);
                                                }
                                                if (offcanvasElement && !mediaQuery.matches) {
                                                        const offcanvasInstance = bootstrap.Offcanvas.getOrCreateInstance(offcanvasElement);
                                                        offcanvasInstance.hide();
                                                }
                                        });

                                        const savedSection = localStorage.getItem('currentSection');
                                        const savedSession = localStorage.getItem('userSession');
                                        if (savedSection && savedSession === pk_acessoSession && sectionActions[savedSection]) {
                                                sectionActions[savedSection]();
                                                setActiveMenu(savedSection);
                                        } else {
                                                const firstLink = menuContainer.querySelector('.menu-link[data-section]');
                                                if (firstLink) {
                                                        setActiveMenu(firstLink.dataset.section);
                                                }
                                        }

                                        if (window.gsap) {
                                                gsap.from('.admin-header', { y: -20, opacity: 0, duration: 0.6, ease: 'power2.out' });
                                                gsap.from('.admin-welcome', { y: 20, opacity: 0, duration: 0.6, ease: 'power2.out', delay: 0.1 });
                                                gsap.from('.admin-main .card', { y: 30, opacity: 0, duration: 0.6, ease: 'power2.out', delay: 0.2, stagger: 0.1 });
                                        }
                                }
                        });
                </script>
		</body>

		</html>

<?php
	}
} else {

	header('Location: index.php');
}
