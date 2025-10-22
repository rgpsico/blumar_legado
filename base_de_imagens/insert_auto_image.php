 <?php
//inseção de novo cliente
 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}


require_once '../util/connection.php';


$tp_produto = pg_escape_string($_POST["tp_produto"]);
$mneu_for = pg_escape_string($_POST["mneu_for"]);
$nome_produto = pg_escape_string($_POST["nome_produto"]);
$cidade_cod = pg_escape_string($_POST["cidade_cod"]);
$autor = pg_escape_string($_POST["autor"]);
$autorizacao = pg_escape_string($_POST["autorizacao"]);
$path_img = pg_escape_string($_POST["path_img"]);
$med = pg_escape_string($_POST["med"]);
$grd = pg_escape_string($_POST["grd"]);
$orig = pg_escape_string($_POST["orig"]);
$zip = pg_escape_string($_POST["zip"]);
$ativo_cli = pg_escape_string($_POST["ativo_cli"]);



//crio a data now
$ano = date("Y");
$mes = date("m");
$dia =  date("d");
$data_now =  $ano . '-' . $mes . '-' . $dia;



$arraymneu_for = pg_escape_string($_POST["mneu_for"]);
$arraymneu = explode(",",$arraymneu_for);
$frncod = $arraymneu[1];
$mneu_for = $arraymneu[0];

//$mneu_for = str_replace(",","", $mneu_for);
if($mneu_for == '')
{
	if($frncod != '0')
	{
		$mneu_for = $frncod;
	}
	else 
	{
	    $mneu_for = 0;
	}

}
//fim do tratamento do menu for para cada caso!

// tratameno da informação para inserir um nome no produto caso nao tenham preenchido nada
if($tp_produto == '1' and strlen($nome_produto) == 0)
{
	
	$pegaumhtl="select nome_for, nome_htl
	FROM
	conteudo_internet.ci_hotel
	left outer JOIN
	sbd95.fornec
	ON
	ci_hotel.mneu_for = sbd95.fornec.mneu_for
	where ci_hotel.mneu_for = '$mneu_for'";
	$result_umhtl = pg_exec($conn, $pegaumhtl);
	
	if(pg_numrows($result_umhtl) != 0)
	{
	
	for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) {
	
		$nome_htl = pg_result($result_umhtl, $rowhtl, 'nome_htl');
		$nome_for = pg_result($result_umhtl, $rowhtl, 'nome_for');
	
	
		if  (strlen($nome_for) != '0')
		{
			$umhtl=  $nome_for;
		}
		else
		{
			$umhtl =  $nome_htl;
		}
	
	
	}
	
	$nome_produto = $umhtl;
	}
	else
	{
		//se não achar o nome do produto na tabela de fornec vejo se não é um avulso
		$select_umavulso = "select distinct nome_produto, mneu_for from banco_imagem.bco_img where mneu_for = '$mneu_for'";
		$result_umavulso = pg_exec($conn, $select_umavulso);
		if(pg_numrows($result_umavulso) != 0)
		{
			for ($rowuav = 0; $rowuav < pg_numrows($result_umavulso); $rowuav++)
			{
				 $nome_produto = pg_result($result_umavulso, $rowuav, 'nome_produto');
			 }
		}
		
		
	}
	
	
	
}

elseif ($tp_produto == '2' and $mneu_for != '0')
{
	
	$pegaumhtl="select nome_en from tarifario.descritivo_tours where pk_descritivo_tours = '$mneu_for'  ";
	$result_umhtl = pg_exec($conn, $pegaumhtl);
	for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++)
		{
			$nome_produto = pg_result($result_umhtl, $rowhtl, 'nome_for');
		 }
	
}
elseif ($tp_produto == '10' )
{
	
$pega_cid_cid="
				select
					nome_en 
				from 
					tarifario.cidade_tpo 
				where 
					cidade_cod = '$cidade_cod'";
		$result_cid_cid = pg_exec($conn, $pega_cid_cid);
		for ($rowcidd = 0; $rowcidd < pg_numrows($result_cid_cid); $rowcidd++)
		{
		    $nome_produto = pg_result($result_cid_cid, $rowcidd, 'nome_en');
			 
		}
		
 
	
}

elseif ($tp_produto == '3' and $mneu_for != '0')
{ 

	$pegaumhtl="select  nome from conteudo_internet.venues where cod_venues =  '$mneu_for'";
	$result_umhtl = pg_exec($conn, $pegaumhtl);
	for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++)
		{
			$nome_produto = pg_result($result_umhtl, $rowhtl, 'nome');
		 }


}

 



$path = str_replace("\\usvaws01.blumar.com.br\www\wwwinternet","/var/www/wwwinternet", $path_img);
$path1 = str_replace("\\","/", $path);
$path2 = str_replace("//var/www/wwwinternet/","", $path1);
$av = 'false';
 
 

$dirFiles = array();
if ($handle = opendir($path1)) {
    while (false !== ($file = readdir($handle))) {   
    	$crap   = array(".jpg", ".jpeg", ".JPG", ".JPEG",".zip");    
        $newstring = str_replace($crap, " ", $file );   
        if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails" && $file != "Thumbs.db") {
        	$dirFiles[] = $file;
        }
    }
    closedir($handle);
}

 echo $med.'<br>'.$tp_produto.'<br>'.$mneu_for.'<br>'.$cidade_cod.'<br>'.$nome_produto.'<br><br>';

sort($dirFiles);
foreach($dirFiles as $file)
{
  //puxo o que for tumb
  $arraypic = explode("_",$file);
  if($arraypic[0] == 'tbn')
    {	
        //pego o nome da imagem
    	$img = str_replace("tbn_","", $file);
        $img2 = str_replace(".jpg","", $img);
        $legenda = str_replace("_"," ", $img2);
       // echo $path2.$img.'<br>';

	    //só monto o box se ela existir
	    if(file_exists($path1.$img) == true )
	    {	
    	  
    	      $tumbnail = $path2.$file;
              $normal = $path2.$img2.'.jpg';
              $medio = $path2.$img2.'_med.jpg';
              $grande = $path2.$img2.'_grd.jpg';
              $original = $path2.$img2.'_orig.jpg';
              $zipado = $path2.$img2.'.zip';
					
             if($med == 'false')  {$medio = '';}
             if($grd == 'false')  {$grande = '';}
             if($orig == 'false') {$original = '';}
             if($zip == 'false')  {$zipado = '';}






/*
             echo 'Legenda da imagem: '.$legenda.'<br>';
             echo $tumbnail.'<br>';
			 echo $normal.'<br>';         
			 echo $medio.'<br>';
             echo $grande.'<br>';
             echo $original.'<br>';
             echo $zipado.'<br>';
             echo '<br><br>';

*/


 
 

				$insert_imagem="
						insert into  banco_imagem.bco_img
						(
						  mneu_for,
						  fk_cidcod,
						  tam_1,
						  tam_2,
						  tam_3,
						  tam_4,
						  tam_5, 
						  zip,
						  legenda,
						  legenda_esp,
						  legenda_pt,
						  autor,
						  autorizacao,
						  data_cadastro,
						  tp_produto,
						  ativo_cli,
						  nome_produto,
						  av 
						 )
						values
						(
						'$mneu_for',	
						'$cidade_cod',	
						'$tumbnail',	
						'$normal',	
						'$medio',	
						'$grande',	
						'$original',	
						'$zipado',	
						'$legenda',	
						'$legenda',	
						'$legenda',	
						'$autor',	
						'$autorizacao',	
						'$data_now',	
						'$tp_produto',	
						'$ativo_cli',	
						'$nome_produto',
						'$av' 
						) ";
				pg_query($conn, $insert_imagem);

 



	    }	   
	 }
 }




$pk_acesso = $_SESSION['user'];



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
'Inseriu uma nova imagem  - $nome_produto',
'$data_now',
'36'
)
";
pg_query($conn, $query_log);


 


echo'<b>CADASTRO AUTOMÁTICO DE IMAGEM REALIZADO COM SUCESSO!</b><br><br>';





