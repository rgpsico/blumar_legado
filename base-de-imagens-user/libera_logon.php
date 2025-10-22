<?php


ini_set('display_errors', 1);
error_reporting(~0);
 If (isSet($_SESSION)) {} else {session_start();} 
 require('util/connection.php'); 
	
	
$login = trim(pg_escape_string(strtolower($_POST["login"])));
$pass = trim(pg_escape_string(strtolower($_POST["pass"])));



$endereco = "";



 

$result_tar_client = pg_prepare($conn, "tar_client", "SELECT
			cod_agrup,
			mneu_cli,
			nome_cli,
			root_srv,
			mkp_htl,
			mkp_srv,
			mkp_food,
			login,
			pass,
			ativo,
			ativo_virtuoso,
			descricao_tar,
			lang,
			emp,
			pk_cad_cli,
			extranet,
			root_htl,
			ativo2tar,
			root_htl2,
			mkp_htl2,
			mkp_srv2,
			mkp_food2,
			fk_depto,
			mkp_eco,
			mkp_eco2,
			mkp_ny,
			mkp_ny2,
			mkp_carn,
			mkp_carn2,
			mkp_winn,
			mkp_winn2,
			fk_controle_acesso_ws,
			ativo_cote,
			bco_img
		FROM
			tarifario.cadastro_clientes
		WHERE
			login = $1
			AND pass = $2
			AND ativo = true
			and (fk_depto = '2' or fk_depto = '5' or fk_depto = '6' or fk_depto = '7')
			AND desativar_tarifario = false ");
$result_tar_client = pg_execute($conn, "tar_client", array("$login","$pass"));

for ($row  = 0; $row  < pg_numrows($result_tar_client); $row ++) 
	 {
		 $lang = pg_result($result_tar_client, $row, 'lang');
	 }

$tar_client_recordcount = pg_numrows($result_tar_client);

//se não achar nada no cadastro de clientes verifica no sub-clientes
if($tar_client_recordcount == 0)
	{
	
 

$result_client_operadores = pg_prepare($conn, "tar_client_operadores", "SELECT
								fk_cad_cli
							FROM
								tarifario.cliente_operadores
							INNER JOIN tarifario.cadastro_clientes on tarifario.cliente_operadores.fk_cad_cli = tarifario.cadastro_clientes.pk_cad_cli
                            WHERE
								 operador_id = $1
							and
							     senha = $2
							and
                                tarifario.cadastro_clientes.ativo = 'true' ");
$result_client_operadores = pg_execute($conn, "tar_client_operadores", array("$login","$pass"));
$client_operadores_recordcount = pg_numrows($result_client_operadores);
		
		
		
		IF($client_operadores_recordcount != 0)
		{
			
			for ($row1  = 0; $row1  < pg_numrows($result_client_operadores); $row1 ++) 
				 {
					 $pk_cad_cli = pg_result($result_client_operadores, $row1, 'fk_cad_cli');
				 }
			
				
				$tar_client ="SELECT
						cod_agrup,
						mneu_cli,
						nome_cli,
						root_srv,
						mkp_htl,
						mkp_srv,
						mkp_food,
						login,
						pass,
						ativo,
						ativo_virtuoso,
						descricao_tar,
						lang,
						emp,
						pk_cad_cli,
						extranet,
						root_htl,
						ativo2tar,
						root_htl2,
						mkp_htl2,
						mkp_srv2,
						mkp_food2,
						fk_depto,
						mkp_eco,
						mkp_eco2,
						mkp_ny,
						mkp_ny2,
						mkp_carn,
						mkp_carn2,
						mkp_winn,
						mkp_winn2,
						fk_controle_acesso_ws,
						ativo_cote,
						bco_img
					FROM
						tarifario.cadastro_clientes
					WHERE
				         pk_cad_cli = '$pk_cad_cli'";
			  
				 
			$result_tar_client = pg_exec($conn, $tar_client);
			for ($row  = 0; $row  < pg_numrows($result_tar_client); $row ++) 
			 {
				 $lang = pg_result($result_tar_client, $row, 'lang');
			     $_SESSION['sub_cli'] = 0;
				 $_SESSION['user'] = pg_result($result_tar_client, $row, 'pk_cad_cli');
				 $user = pg_result($result_tar_client, $row, 'pk_cad_cli');
				 $pk_cad_cli = pg_result($result_tar_client, $row, 'pk_cad_cli');
				 $_SESSION['tarifario'] = pg_result($result_tar_client, $row, 'root_htl');
				 $_SESSION['mkp_htl'] = pg_result($result_tar_client, $row, 'mkp_htl');
				 $_SESSION['mkp_srv'] = pg_result($result_tar_client, $row, 'mkp_srv');
				 $_SESSION['mkp_food'] = pg_result($result_tar_client, $row, 'mkp_htl');
				 $_SESSION['tarifario2'] = pg_result($result_tar_client, $row, 'root_htl2');
				 $_SESSION['mkp_htl2'] = pg_result($result_tar_client, $row, 'mkp_htl2');
				 $_SESSION['mkp_srv2'] = pg_result($result_tar_client, $row, 'mkp_srv2');
				 $_SESSION['mkp_food2'] = pg_result($result_tar_client, $row, 'mkp_htl2');
				 $_SESSION['mkp_eco'] = pg_result($result_tar_client, $row, 'mkp_eco');
				 $_SESSION['mkp_eco2'] = pg_result($result_tar_client, $row, 'mkp_eco2');
				 $_SESSION['mkp_ny'] = pg_result($result_tar_client, $row, 'mkp_ny');
				 $_SESSION['mkp_ny2'] = pg_result($result_tar_client, $row, 'mkp_ny2');
				 $_SESSION['mkp_carn'] = pg_result($result_tar_client, $row, 'mkp_carn');
				 $_SESSION['mkp_carn2'] = pg_result($result_tar_client, $row, 'mkp_carn2');
				 $_SESSION['mkp_winn'] = pg_result($result_tar_client, $row, 'mkp_winn');
				 $_SESSION['mkp_winn2'] = pg_result($result_tar_client, $row, 'mkp_winn2');
				 $_SESSION['lang'] = pg_result($result_tar_client, $row, 'lang');
				 $_SESSION['emp'] = pg_result($result_tar_client, $row, 'emp');
				 $_SESSION['mkp_htl_sub'] = 0;
				 $_SESSION['mkp_srv_sub'] = 0;
				 $_SESSION['mkp_fd_sub'] = 0;
				 $_SESSION['filtro_data_in'] = 0;
				 $_SESSION['filtro_data_out'] = 0;
				 $_SESSION['add_percent'] = 0;
				 $_SESSION['price_from'] = 0;
				 $_SESSION['price_to'] = 0;
				 $_SESSION['filtro_estrela'] = 0;
				 $_SESSION['mneufor'] = 0;
				 $_SESSION['cid'] = 0;
				 $_SESSION['eco'] = 0;
				 //essa info vem da tabela  conteudo_internet.chat_deptos
				 $_SESSION['depto'] = pg_result($result_tar_client, $row, 'fk_depto');
				 $_SESSION['pass'] = $pass;
				 $_SESSION['login'] = $login;
				 $_SESSION['bco_img']  = pg_result($result_tar_client, $row, 'bco_img');
				 $_SESSION['mneu_cli']  = pg_result($result_tar_client, $row, 'mneu_cli');
				 $mneu_cli  = pg_result($result_tar_client, $row, 'mneu_cli');
				 $_SESSION['ativo_virtuoso']  = pg_result($result_tar_client, $row, 'ativo_virtuoso');
				 $ativo_virtuoso = pg_result($result_tar_client, $row, 'ativo_virtuoso');
				 $_SESSION['ativo_cote']  = pg_result($result_tar_client, $row, 'ativo_cote');
				 
				 
			 
			 
			 }
				
				 

		
	  
			     
		    //registro no log do tarifario
			$area = 8;     
			$complemento = 'Banco de Imagens';
            require('insert_log_tarifario.php'); 	
		 
		 //verificar esta parte para fazer o log de banco em uma base independente
		 
		
if ($_SESSION['bco_img'] == 't')
{


		  //faço o redirecionamento para o banco de imagens 
		  header( 'Location: index.php' ) ; 

}
else
		{
				
		     echo"<script>
				 alert('incorrect login information');
				 location = 'login.php';
				 </script>";
		}

			
		 
			
		}
		else
		{
				
		     echo"<script>
				 alert('incorrect login information1');
				 location = 'login.php';
				 </script>";
		}
		
		
		 
	
	 }
	 else
	 {
	 	
	 

	//se achar as informações de logon no cadastro de clientes continua		 
	 for ($row  = 0; $row  < pg_numrows($result_tar_client); $row ++) 
	 {
		 $_SESSION['sub_cli'] = 0;
		 $_SESSION['user'] = pg_result($result_tar_client, $row, 'pk_cad_cli');
		 $user = pg_result($result_tar_client, $row, 'pk_cad_cli');
		 $pk_cad_cli = pg_result($result_tar_client, $row, 'pk_cad_cli');
		 $_SESSION['tarifario'] = pg_result($result_tar_client, $row, 'root_htl');
		 $_SESSION['mkp_htl'] = pg_result($result_tar_client, $row, 'mkp_htl');
		 $_SESSION['mkp_srv'] = pg_result($result_tar_client, $row, 'mkp_srv');
		 $_SESSION['mkp_food'] = pg_result($result_tar_client, $row, 'mkp_htl');
		 $_SESSION['tarifario2'] = pg_result($result_tar_client, $row, 'root_htl2');
		 $_SESSION['mkp_htl2'] = pg_result($result_tar_client, $row, 'mkp_htl2');
		 $_SESSION['mkp_srv2'] = pg_result($result_tar_client, $row, 'mkp_srv2');
		 $_SESSION['mkp_food2'] = pg_result($result_tar_client, $row, 'mkp_htl2');
		 $_SESSION['mkp_eco'] = pg_result($result_tar_client, $row, 'mkp_eco');
		 $_SESSION['mkp_eco2'] = pg_result($result_tar_client, $row, 'mkp_eco2');
		 $_SESSION['mkp_ny'] = pg_result($result_tar_client, $row, 'mkp_ny');
		 $_SESSION['mkp_ny2'] = pg_result($result_tar_client, $row, 'mkp_ny2');
		 $_SESSION['mkp_carn'] = pg_result($result_tar_client, $row, 'mkp_carn');
		 $_SESSION['mkp_carn2'] = pg_result($result_tar_client, $row, 'mkp_carn2');
		 $_SESSION['mkp_winn'] = pg_result($result_tar_client, $row, 'mkp_winn');
		 $_SESSION['mkp_winn2'] = pg_result($result_tar_client, $row, 'mkp_winn2');
		 $_SESSION['lang'] = pg_result($result_tar_client, $row, 'lang');
		 $_SESSION['emp'] = pg_result($result_tar_client, $row, 'emp');
		 $_SESSION['mkp_htl_sub'] = 0;
		 $_SESSION['mkp_srv_sub'] = 0;
		 $_SESSION['mkp_fd_sub'] = 0;
		 $_SESSION['filtro_data_in'] = 0;
		 $_SESSION['filtro_data_out'] = 0;
		 $_SESSION['add_percent'] = 0;
		 $_SESSION['price_from'] = 0;
		 $_SESSION['price_to'] = 0;
		 $_SESSION['filtro_estrela'] = 0;
		 $_SESSION['mneufor'] = 0;
		 $_SESSION['cid'] = 0;
		 $_SESSION['eco'] = 0;
		 //essa info vem da tabela  conteudo_internet.chat_deptos
		 $_SESSION['depto'] = pg_result($result_tar_client, $row, 'fk_depto');
		 $_SESSION['pass'] = pg_result($result_tar_client, $row, 'pass');
		 $_SESSION['login'] = pg_result($result_tar_client, $row, 'login');
		 $_SESSION['bco_img']  = pg_result($result_tar_client, $row, 'bco_img');
		 $_SESSION['mneu_cli']  = pg_result($result_tar_client, $row, 'mneu_cli');
		 $mneu_cli  = pg_result($result_tar_client, $row, 'mneu_cli');
		 $_SESSION['ativo_virtuoso']  = pg_result($result_tar_client, $row, 'ativo_virtuoso');
		 $ativo_virtuoso = pg_result($result_tar_client, $row, 'ativo_virtuoso');
		 $_SESSION['ativo_cote']  = pg_result($result_tar_client, $row, 'ativo_cote');
		 
		  
		 
	 } 

	 
		     
		 
			     
			     
		    //registro no log do tarifario
			$area = 8;     
			$complemento = 'Banco de Imagens';
            require('insert_log_tarifario.php'); 	
	 
		 
			 
 		
if ($_SESSION['bco_img'] == 't')
{


		  //faço o redirecionamento para o banco de imagens 
		  header( 'Location: index.php' ) ; 

}
else
		{
				
		     echo"<script>
				 alert('incorrect login information2');
				 location = 'login.php';
				 </script>";
		}

			
	 
		
		
	 }
	 
	 






?>