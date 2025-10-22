<?php
ini_set('display_errors', 1);
 error_reporting(~0);

$string_cidade = pg_escape_string($_POST["string_cidade"]);
$path = str_replace("/var/www/wwwinternet/","https://www.blumar.com.br/", $string_cidade);
$cidade = str_replace("/var/www/wwwinternet/bancoimagemfotos/comercial/","", $string_cidade);
$cidade = str_replace("/","", $cidade);

$dirFiles = array();
if ($handle = opendir($string_cidade)) {
    while (false !== ($file = readdir($handle))) {   
    	$crap   = array(".jpg", ".jpeg", ".JPG", ".JPEG",".zip");    
        $newstring = str_replace($crap, " ", $file );   
        if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails" && $file != "Thumbs.db") {
        	$dirFiles[] = $file;
        }
    }
    closedir($handle);
}

echo'<div id="mapa-eco" ></div><div id="cabeca_bancoimg"><b>  '.strtoupper($cidade).' PICTURES</b></div>';

sort($dirFiles);
foreach($dirFiles as $file)
{
  //puxo o que for tumb
  $arraypic = explode("_",$file);
  if($arraypic[0] == 'tbn')
    {	
        //pego o nome da imagem
    	$img = str_replace("tbn_","", $file);
	    //só monto o box se ela existir
	    if(file_exists($string_cidade.$img) == true )
	    {	
    	    //pego o zip da imagem  
	    	$zip = str_replace(".jpg",".zip", $img);
    	      echo '<div id="tumb_bancoimg"><div id="img_bancoimg"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="'.$path.$img.'"><img src="'.$path.$file.'" width="135" height="90"></a></div>';
					 //só mostro o zip se ele existir
					 if(file_exists($string_cidade.$zip) == true )
	 						{       
                  				 echo'<div class="bt_download"><a href="'.$path.$zip.'"></a></div>' ;
							 }                 
			   echo'</div>';
	    }	   
	 }
 }

?>
