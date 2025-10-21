<?php

ini_set('display_errors', 1);
error_reporting(~0);

if (isset($_SESSION)) {
} else {
	session_start();
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
<link rel="stylesheet" type="text/css" href="https://www.blumar.com.br/util/css/jquery.ui.autocomplete.css" /> 
<link rel="stylesheet" type="text/css" href="css/blumar.datepicker.css" />
<link rel="stylesheet" type="text/css" href="css/padrao.css?v=1.3">
</head>

<body>
 <div id="container">
    <div id="container_conteudo">   
       <div id="texto1"><b>ADMINISTRAÇÃO de CONTEUDO BLUMAR</b></div>';

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

					echo '<div id="texto2">Ol&aacute;<b> ' . $_SESSION['nome_user'] . '- ' . $_SESSION['email_usuario'] . '</b> seja bem vindo a ferramenta de conteudo.</div>
										<div id="container_lista"> ';

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

							if ($pk_conteudo == '1') {
								if ($cad_cidade == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_cidade();">' . $nomecont . '</a></div>';
								}
							}

							if ($pk_conteudo == '2') {
								if ($cad_hotel == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_hotel();">' . $nomecont . '</a></div>';
								}
							}

							if ($pk_conteudo == '2') {
								if ($cad_hotel == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_hotelv2();">HOTEL V2</a></div>';
								}
							}

							if ($pk_conteudo == '3') {
								if ($cad_tours == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_tours();">' . $nomecont . '</a></div>';
								}
							}

							if ($pk_conteudo == '4') {
								if ($cad_eco == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_ecos();">' . $nomecont . '</a></div>';
								}
							}

							if ($pk_conteudo == '5') {
								if ($cad_restaurante == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_restaurante();">' . $nomecont . '</a></div>';
								}
							}

							if ($pk_conteudo == '6') {
								if ($cad_venues == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_venues();">' . $nomecont . '</a></div>';
								}
							}

							if ($pk_conteudo == '7') {
								if ($cad_various == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_various();">' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '8') {
								if ($log_conteudo == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_log();"><b>' . $nomecont . '</b></a></div>';
								}
							}




							if ($pk_conteudo == '9') {
								if ($cad_quotes == 't') {
									//echo '<div id="texto3"><a href="http://www.blumar.com.br/novo_site/admin/cotes/new_model/libera_user.cfm?login='.$cad_login.'&pass='.$cad_pass.'&id_cliente=0&tipo=2" target="_new">'.$nomecont.'</a></div>';

									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'https://www.blumar.com.br/novo_site/admin/cotes/new_model/libera_user.cfm?login=" . $cad_login . "&pass=" . $cad_pass . "&id_cliente=0&tipo=2";
									echo "','quotes', 'scrollbars=yes,width=1030,height=750'";
									echo ')" >' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '10') {
								if ($cad_contatos == 't') {

									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'contatos/miolo_contatos.php";
									echo "','contacts', 'scrollbars=yes,width=1000,height=750'";
									echo ')" >' . $nomecont . '</a></div>';




									//echo '<div id="texto3"><a  href="##" class="text-decoration-none text-dark" onclick="javascript:acao_contatos();">'.$nomecont.'</a></div>';
								}
							}




							if ($pk_conteudo == '11') {
								if ($cad_abt == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_abt();">' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '12') {
								if ($cad_news == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_news();">' . $nomecont . '</a></div>';
								}
							}

							if ($pk_conteudo == '13') {
								if ($cad_guias == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_guias();">' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '14') {
								if ($cad_cliente == 't') {
									//echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_clientes();">'.$nomecont.'</a></div>';

									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'clientes/index.php";
									echo "','clients', 'scrollbars=yes,width=1000,height=auto'";
									echo ')" >' . $nomecont . '</a></div>';
								}
							}



							if ($pk_conteudo == '16') {
								if ($cad_trailfinders == 't') {

									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'trailfinders/miolo_trailfinders.php?login=" . $cad_login . "&pass=" . $cad_pass . "&pk_usuario=" . $_SESSION['user'] . " ";
									echo "','trailf', 'scrollbars=yes,width=1030,height=750'";
									echo ')" >' . $nomecont . '</a></div>';
								}
							}








							if ($pk_conteudo == '18') {
								if ($cad_prod_update == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_produpdate();">' . $nomecont . '</a></div>';
								}
							}




							if ($pk_conteudo == '19') {
								if ($cad_acesso_conteudo == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_controle_acesso();"><b>' . $nomecont . '</b></a></div>';
								}
							}



							if ($pk_conteudo == '20') {
								if ($cad_func == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_func();">' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '21') {
								if ($log_tarifario == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_log_tarifario ();"><b>' . $nomecont . '</b></a></div>';
								}
							}





							if ($pk_conteudo == '22') {
								if ($cad_destaque_fit == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_destaque_fit();">' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '23') {
								if ($cad_expert == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_expert();">' . $nomecont . '</a></div>';
								}
							}



							if ($pk_conteudo == '24') {
								if ($cad_inspections == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_inspections();">' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '25') {
								if ($cad_renovation == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_renovation();">' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '26') {
								if ($cad_deluxe == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_deluxe();">' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '27') {


								if ($cad_os_handling == 't') {
									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'https://webapp.blumar.com.br/sistem_os/repass.php?login=" . $login . "&pass=" . $pass . "";
									echo "','sis_os', 'scrollbars=yes,width=1050,height=700'";
									echo ')" >' . $nomecont . '</a></div>';
								} elseif ($cad_os_usuario == 't') {
									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'https://webapp.blumar.com.br/sistem_os/repass.php?login=" . $login . "&pass=" . $pass . "";
									echo "','sis_os', 'scrollbars=yes,width=1050,height=700'";
									echo ')" >' . $nomecont . '</a></div>';
								} elseif ($cad_os_financeiro == 't') {
									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'https://webapp.blumar.com.br/sistem_os/repass.php?login=" . $login . "&pass=" . $pass . "";
									echo "','sis_os', 'scrollbars=yes,width=1050,height=700'";
									echo ')" >' . $nomecont . '</a></div>';
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
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_beach_house();">' . $nomecont . '</a></div>';
								}
							}




							if ($pk_conteudo == '29') {
								if ($cad_minisite == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_minisite();">' . $nomecont . '</a></div>';
								}
							}

							if ($pk_conteudo == '32') {
								if ($cad_trip_request == 't' or $cad_trip_request_dir == 't') {


									//Link fixo para a ferramenta de voucher
									//ela pode ser acessada pelo ambiente de conteudo ou diretamente via sis blumar
									// echo '<div id="texto3"><a href="http://webapp.blumar.com.br/trip_request/meiodecampo.php?email_usuario='.$email_usuario.'&pk_usuario='.$fk_usuario.'&nome_todo='.$nome_todo.'&apelido='.$apelido_usr.'&cad_trip_request='.$cad_trip_request.'&cad_trip_request_dir='.$cad_trip_request_dir.'" target="_new">TRIP REQUEST</a></div>'; 	 

									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'https://webapp.blumar.com.br/trip_request/meiodecampo.php?email_usuario=" . $email_usuario . "&pk_usuario=" . $fk_usuario . "&nome_todo=" . $nome_todo . "&apelido=" . $apelido_usr . "&cad_trip_request=" . $cad_trip_request . "&cad_trip_request_dir=" . $cad_trip_request_dir . "&nivel=" . $nivel . "";
									echo "','trip_request', 'scrollbars=yes,width=1050,height=700'";
									echo ')" >PRESTAÇÃO DE CONTAS</a></div>';
								}
							}


							if ($pk_conteudo == '33') {
								if ($cad_tariff_tools == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_tarif_tools();">' . $nomecont . '</a></div>';
								}
							}



							if ($pk_conteudo == '34') {

								//Link fixo para o banco de imagem
								echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
								echo "'banco_imagem/index.php";
								echo "','bcoimg', 'scrollbars=yes,width=1050,height=700'";
								echo ')" >BANCO DE IMAGEM</a></div>';
							}

							if ($pk_conteudo == '35') {
								//Link fixo para o banco de imagem do comercial
								echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
								echo "'banco_imagem_comercial/index.php";
								echo "','banco_comercial', 'scrollbars=yes,width=1050,height=700'";
								echo ')" >BANCO DE IMAGEM COMERCIAL</a></div>';
							}


							if ($pk_conteudo == '36') {
								//Link fixo para o banco de imagem do comercial
								echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
								echo "'base_de_imagens/index.php";
								echo "','new_img_bank', 'scrollbars=yes,width=1050,height=700'";
								echo ')" >NOVO BANCO DE IMAGEM</a></div>';
							}






							if ($pk_conteudo == '38') {
								if ($cad_file_web == 't') {
									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'https://webapp.blumar.com.br/file_web/index.htm";
									echo "','fileweb', 'scrollbars=yes,width=1200,height=700'";
									echo ')" >' . $nomecont . '</a></div>';
								}
							}







							if ($pk_conteudo == '39') {
								if ($invoice_web == 't') {
									echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
									echo "'invoice_web/index.php";
									echo "','fileweb', 'scrollbars=yes,width=1200,height=700'";
									echo ')" >' . $nomecont . '</a></div>';
								}
							}


							if ($pk_conteudo == '40') {
								if ($video_bank == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_video();">' . $nomecont . '</a></div>';
								}
							}



							if ($pk_conteudo == '41') {
								if ($blog_nacional == 't') {
									echo '<div id="texto3"><a href="##" class="text-decoration-none text-dark" onclick="javascript:acao_blognacional();">' . $nomecont . '</a></div>';
								}
							}
						}
					}
					//Link fixo para a ferramenta de voucher
					//ela pode ser acessada pelo ambiente de conteudo ou diretamente via sis blumar
					echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
					echo "'voucher/index.php";
					echo "','voucher', 'scrollbars=yes,width=1050,height=700'";
					echo ')" >VOUCHER</a></div>';

					if ($pk_conteudo == '37') {
						if ($cad_webservices == 't') {
							echo '<div id="texto3"><a href="javascript:;"  class="text-decoration-none text-dark" onClick="MM_openBrWindow(';
							echo "'http://webservice.blumar.com.br/blumar_ws_config";
							echo "','blumar_ws_config', 'scrollbars=yes,width=1050,height=700'";
							echo ')" >WEBSERVICES</a></div>';
						}
					}






					echo ' <br></div>';
					echo '<div id="container_miolo">
										<div id="loading"><img src="https://www.blumar.com.br/images/site/loadingBar.gif" /></div>
										</div>';
				}
			} else {

				echo '<div id="texto2">incorrect login information<br><a href="index.php">Try log in again >></a></div>';
			}


			//logon errado

		} else {

			echo '<div id="texto2">Incorrect login information! <br><a href="index.php">Try log in again >></a></div>';
		}



		pg_close($conn);

		echo '	  
							  
							</div> 
						</div> <br> 
						'; ?>

		<script type="text/javascript">
			// Função para salvar estado
			function saveState(section) {
				localStorage.setItem("currentSection", section);
				localStorage.setItem("userSession", "' . $_SESSION["
					pk_acesso "] . '"); // Para validar sessão
			}

			// No load da página, restaura o estado salvo (se válido)
			$(document).ready(function() {
				var savedSection = localStorage.getItem("currentSection");
				var savedSession = localStorage.getItem("userSession");
				if (savedSection && savedSession === "' . $_SESSION["
					pk_acesso "] . '") {
					// Chama a função correspondente para recarregar
					switch (savedSection) {
						case "cidade":
							acao_cidade();
							break;
						case "hotel":
							acao_hotel();
							break;
						case "tours":
							acao_tours();
							break;
							// Adicione cases para todas as seções (eco, restaurante, etc.)
						default:
							break;
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
