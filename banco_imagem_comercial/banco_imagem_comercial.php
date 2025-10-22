<?php

 ini_set('display_errors', 1);
 error_reporting(~0);




$xmlstr = '
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
  
 //script para hoteis
$pathhtl = "/var/www/wwwinternet/bancoimagemfotos/comercial/"; 
$htls = scandir($pathhtl);
$numhtl = count($htls);
 

for ($rowh = 0; $rowh < $numhtl ; $rowh++) {
   if($htls[$rowh] != '.' && $htls[$rowh] != '..' && $htls[$rowh] != 'blank.gif'  && $htls[$rowh] != 'thumbs.db')
	  {
	    $xmlstr = $xmlstr.'<tipo>';
      
        $xmlstr = $xmlstr.'<nome_tipo>'.$htls[$rowh].'</nome_tipo>';
       
        $xmlstr = $xmlstr.'<cidades>';
 
 

        $pathhtl2 = '/var/www/wwwinternet/bancoimagemfotos/comercial/'.$htls[$rowh].'/'; 
        $htls2 = scandir($pathhtl2);
        $numhtl2 = count($htls2);

               

         for ($rowh2 = 0; $rowh2 < $numhtl2 ; $rowh2++) {
		   if($htls2[$rowh2] != '.' && $htls2[$rowh2] != '..' && $htls2[$rowh2] != 'blank.gif'  && $htls2[$rowh2] != 'thumbs.db')
			  {
		         
            
                  $xmlstr = $xmlstr.'<cidade>'.$htls2[$rowh2].'</cidade>';

           
		          $xmlstr = $xmlstr .'<produtos>';
                  

                 $pathhtl3 = '/var/www/wwwinternet/bancoimagemfotos/comercial/'.$htls[$rowh].'/'.$htls2[$rowh2].'/'; 
                 $htls3 = scandir($pathhtl3);
                 $numhtl3 = count($htls3);
                    for ($rowh3 = 0; $rowh3 < $numhtl3 ; $rowh3++) {
		                if($htls3[$rowh3] != '.' && $htls3[$rowh3] != '..' && $htls3[$rowh3] != 'blank.gif'  && $htls3[$rowh3] != 'thumbs.db')
			                {
                                   $xmlstr = $xmlstr .'<produto>'.$htls3[$rowh3].'</produto>';

							 

                                   $pathhtl4 = '/var/www/wwwinternet/bancoimagemfotos/comercial/'.$htls[$rowh].'/'.$htls2[$rowh2].'/'.$htls3[$rowh3].'/'; 
                                

									$dirFiles = array();
									if ($handle = opendir($pathhtl4)) {
										while (false !== ($file = readdir($handle))) {   
											$crap   = array(".jpg", ".jpeg", ".JPG", ".JPEG",".zip");    
											$newstring = str_replace($crap, " ", $file );   
											if ($file != "." && $file != ".." && $file != "index.php" && $file != "Thumbnails" && $file != "Thumbs.db") {
												$dirFiles[] = $file;
											}
										}
										closedir($handle);
									}


 


                                    $path_rel = str_replace("/var/www/wwwinternet/bancoimagemfotos/","https://www.blumar.com.br/bancoimagemfotos/", $pathhtl4);
									
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
											if(file_exists($pathhtl4.$img) == true )
											{	
												//pego o zip da imagem  
												 

                                                $xmlstr = $xmlstr.'<image>'.$path_rel.$img.'</image>';
                                         
    
											}	   
										 }
									 }

                              


							   }
						}

                   $xmlstr = $xmlstr.'</produtos>';

			   }
		   }	
          
         $xmlstr = $xmlstr.'</cidades>';
         $xmlstr = $xmlstr.'</tipo>';
	  }
 }	


//echo $xmlstr;
$xml->formatOutput=true;
 $xml=simplexml_load_file($xmlstr);
 print_r($xml);