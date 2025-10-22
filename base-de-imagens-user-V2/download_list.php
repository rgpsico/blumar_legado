<?php
 
 ini_set('display_errors', 1);
 error_reporting(~0);
 If (isSet($_SESSION)) {} else {session_start();} 
 require('util/connection.php'); 

 if(isset( $_SESSION["lista_download"]))
 {
 
   $array_lista_download = $_SESSION["lista_download"];
   
 }
 
 //apago o servi�o do array
 if(isset( $_POST["pk_img_del"]))
 {
     $del_img = pg_escape_string($_POST["pk_img_del"]);
    
     if (in_array($del_img, $array_lista_download)) 
     { 
 
       $pos_img = array_search($del_img, $array_lista_download);
        unset($array_lista_download[$pos_img]);
       //   array_splice($array_tour_cart, 0 ,$pos_serv );
       $array_lista_download = array_values($array_lista_download);
  
     }  
 
  
 }
 
  
 
 //adiciono o servi�o no array
 if(isset( $_POST["pg_pk_bco_img"]))
 {
     $pg_pk_bco_img = pg_escape_string($_POST["pg_pk_bco_img"]);
    
     if (in_array($pg_pk_bco_img , $array_lista_download)) { } else {  array_push($array_lista_download, $pg_pk_bco_img );  }
 
  
 }
  
 
  $num_img = (is_array($array_lista_download) ? count($array_lista_download) : 0);
  
  
//apago a variavel 

unset($array_lista_lista_images_download);  

//seto ela novamente

$array_lista_lista_images_download = array();  


 
 echo'
 <div id="shopping04"><a href="#!" onclick="hideDiv()">close &otimes;</a></div>
 <div id="shopping01">IMAGE BANK DOWNLOAD</div>
 <div id="shopping03">selected images - max 20</div>
 <div id="shopping02">';
 
 
  
  for ($rog = 0; $rog < $num_img; $rog++) 
     { 
 
  
               $busca_img="SELECT tam_1, tam_5, legenda ,mneu_for,
                                                  (select nome_for from sbd95.fornec where mneu_for = banco_imagem.bco_img.mneu_for ) as nome_for 
                                                 FROM banco_imagem.bco_img
                                                WHERE  pk_bco_img = '$array_lista_download[$rog]'";
                                      $result_busca_img = pg_exec($conn, $busca_img);
                                      
                                        for ($rowbt1 = 0; $rowbt1 < pg_numrows($result_busca_img); $rowbt1++) 
                                            {
                                                $tam_1 = pg_result($result_busca_img, $rowbt1, 'tam_1');
                                                $tam_5 = pg_result($result_busca_img, $rowbt1, 'tam_5');
                                                $legenda = pg_result($result_busca_img, $rowbt1, 'legenda');
                                              }
                  // preencho ela com o fullpath das imagens
                  $full_path_img = 'https://www.blumar.com.br/'.$tam_5;

                  if (in_array($full_path_img , $array_lista_lista_images_download)) { } else {  array_push($array_lista_lista_images_download, $full_path_img );  }


 
  echo '<div id="shopping05"><img src="https://www.blumar.com.br/'.$tam_1.'"> <p> - <b>'.$legenda.'</b></p> <a href="#!" class="delimg"   title="Remove from list"><input type="hidden" class="delimgvalue" value="'.$array_lista_download[$rog].'">
  <!-- <img src="images/delete_minimal.png"> --> X
  </a></div>';
       
 
 }
  
 
 echo'</div>
 <a href="#" onclick="javascript: process_download();"><div id="shopping01" class="downloadimg">DOWNLOAD IMAGES</div></a>
 ';
 
 
 //seto a variavel de sessão com ela
$_SESSION["lista_images_download"] = $array_lista_lista_images_download;
 $_SESSION["lista_download"] = $array_lista_download;
 
 

 
 
 
 