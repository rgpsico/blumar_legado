<?php 

if(session_id() == '') {
	session_start();
}



require_once '../util/connection.php';

$frncod = pg_escape_string($_POST["frncod"]);
$facilities = pg_escape_string($_POST["facilities"]);



if (strlen($facilities) != '0')
		
{
	$array = explode(',', $facilities);
	foreach ($array as  $tag )
	{
		if (strlen($tag) != '0')
		{
		 $insert_fac = 
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
					";
		 
		pg_query($conn, $insert_fac);
		}
		 
	}	 
	

	
	

}
 

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
							'Inseriu uma nova facilidade de hotel no hotel  - $frncod ',
							'$data_now',
							'2'
							)
							";
		pg_query($conn, $query_log);


	echo "<hr>" ;
	echo "FACILIDADES DO HOTEL INSERIDAS COM SUCESSO!!" ;
	echo "<hr>" ;
	
	 
	require_once 'altera_hotel.php';
	 






?>