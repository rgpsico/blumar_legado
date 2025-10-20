<?php
 If (isSet($_SESSION)) {} else {session_start();}
 ini_set('display_errors', 1);
error_reporting(~0);



require_once '../util/connection.php';


 

//echo '-'.$pk_htl_health.'-';

 $avanco_barra= '';
 $avanco_porcentagem = '';
 
  
 $pega_infosgerais="select *
                   from  tarifario.hotel_health_conteudo where fk_htl_health = $pk_htl_health ";
 $result_infosgerais = pg_exec($conn, $pega_infosgerais);
$infosgerais_recordcount = pg_numrows($result_infosgerais) ;
 
 if ($infosgerais_recordcount != 0)
		{
		
			for ($row = 0; $row < pg_numrows($result_infosgerais) ; $row++)
					{
						$id_01 = pg_result($result_infosgerais, $row, 'id_01');
						if(strlen($id_01) != 0  && $id_01 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 $id_02 = pg_result($result_infosgerais, $row, 'id_02');
						 if(strlen($id_02) != 0  && $id_02 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						  $id_03 = pg_result($result_infosgerais, $row, 'id_03');
						 if(strlen($id_03) != 0 )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						   $id_04 = pg_result($result_infosgerais, $row, 'id_04');
						 if(strlen($id_04) != 0  && $id_04 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						   $id_05 = pg_result($result_infosgerais, $row, 'id_05');
						 if(strlen($id_05) != 0 )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						  $id_06 = pg_result($result_infosgerais, $row, 'id_06');
						 if(strlen($id_06) != 0  && $id_06 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						   $id_07 = pg_result($result_infosgerais, $row, 'id_07');
						 if(strlen($id_07) != 0  && $id_07 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						   $id_08 = pg_result($result_infosgerais, $row, 'id_08');
						 if(strlen($id_08) != 0 )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						  $id_09 = pg_result($result_infosgerais, $row, 'id_09');
						 if(strlen($id_09) != 0  && $id_09 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						   $id_10 = pg_result($result_infosgerais, $row, 'id_10');
						 if(strlen($id_09) != 0  && $id_09 == 'No')
                         {
                           $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
                         }
                        elseif(strlen($id_09) != 0  && $id_09 == 'Yes')
                        {
									 if(strlen($id_10) != 0 )
									 {
									   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
									   $avanco_porcentagem = $avanco_porcentagem + 1;
									 }
						 }


						    $id_11 = pg_result($result_infosgerais, $row, 'id_11');
						 if(strlen($id_11) != 0  && $id_11 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						    $id_12 = pg_result($result_infosgerais, $row, 'id_12');
						 if(strlen($id_12) != 0  && $id_12 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						     $id_12ou = pg_result($result_infosgerais, $row, 'id_12ou');
						 if(strlen($id_12ou) != 0 )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						 
						    $id_13 = pg_result($result_infosgerais, $row, 'id_13');
						 if(strlen($id_13) != 0  && $id_13 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						    $id_14 = pg_result($result_infosgerais, $row, 'id_14');
						 if(strlen($id_14) != 0  && $id_14 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						    $id_15 = pg_result($result_infosgerais, $row, 'id_15');
						 if(strlen($id_15) != 0  && $id_15 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						    $id_16 = pg_result($result_infosgerais, $row, 'id_16');
						 if(strlen($id_16) != 0  && $id_16 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						    $id_17 = pg_result($result_infosgerais, $row, 'id_17');
						 if(strlen($id_17) != 0  && $id_17 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						    $id_18 = pg_result($result_infosgerais, $row, 'id_18');
						 if(strlen($id_18) != 0  && $id_18 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 //termina o form de info gerais
						 
						 
						 
						 
						 
						 
						 
						    $id_19 = pg_result($result_infosgerais, $row, 'id_19');
						 if(strlen($id_19) != 0  && $id_19 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						 
						 
						   //se a resposta for sim ele ontinua verificando caso contrario passa pelo resto do fomulario
						if(strlen($id_19) != 0  && $id_19 == 'Yes' )
						  {
						    


								 $id_110 = pg_result($result_infosgerais, $row, 'id_110');
								 if(strlen($id_110) != 0  && $id_110 != '0')
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 }
								 
								 
									  $id_111 = pg_result($result_infosgerais, $row, 'id_111');
								 if(strlen($id_111) != 0  && $id_111 != '0')
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 }
						 


                                $id_112 = pg_result($result_infosgerais, $row, 'id_112');
								 if(strlen($id_112) != 0  && $id_112 != '0')
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 }
								 
								 
									 $id_113 = pg_result($result_infosgerais, $row, 'id_113');
								 if(strlen($id_113) != 0  && $id_113 != '0')
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 } 
								 
								 
									 $id_114 = pg_result($result_infosgerais, $row, 'id_114');
								 if(strlen($id_114) != 0  && $id_114 != '0')
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 } 
								 
								
									 $id_115 = pg_result($result_infosgerais, $row, 'id_115');
								 if(strlen($id_115) != 0  && $id_115 != '0')
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 }
								
								
									 $id_116 = pg_result($result_infosgerais, $row, 'id_116');
								 if(strlen($id_116) != 0   )
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 }
						
						  
						  }
						 elseif(strlen($id_19) != 0  && $id_19 == 'No' )
                           {
						           $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
                                   
                                   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;

                                   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
							 }
						
						
						
						      $id_117 = pg_result($result_infosgerais, $row, 'id_117');
						 if(strlen($id_117) != 0  && $id_117 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						      $id_118 = pg_result($result_infosgerais, $row, 'id_118');
						 if(strlen($id_118) != 0  && $id_118 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						      $id_119 = pg_result($result_infosgerais, $row, 'id_119');
						 if(strlen($id_119) != 0  && $id_119 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						      $id_120 = pg_result($result_infosgerais, $row, 'id_120');
						 if(strlen($id_120) != 0  && $id_120 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						 
						       $id_121 = pg_result($result_infosgerais, $row, 'id_121');
						 if(strlen($id_121) != 0  && $id_121 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						       $id_122 = pg_result($result_infosgerais, $row, 'id_122');
						 if(strlen($id_122) != 0  && $id_122 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						       $id_123 = pg_result($result_infosgerais, $row, 'id_123');
						 if(strlen($id_123) != 0  && $id_123 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						  
						//================================================================= 
    
				if (strlen($id_123) != 0  && $id_123 == 'Yes')
                       {   
						  
										$id_124 = pg_result($result_infosgerais, $row, 'id_124');
								 if(strlen($id_124) != 0  && $id_124 != '0')
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 }
								 
								 
										$id_125 = pg_result($result_infosgerais, $row, 'id_125');
								 if(strlen($id_125) != 0  && $id_125 != '0')
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 }
						 
						 
						 }
                      elseif (strlen($id_123) != 0  && $id_123 == 'No')
                         {
						           $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
						  }
						 //================================================================= 
    
						 
						 
						 
						        $id_126 = pg_result($result_infosgerais, $row, 'id_126');
						 if(strlen($id_126) != 0  )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						        $id_127 = pg_result($result_infosgerais, $row, 'id_127');
						 if(strlen($id_127) != 0  && $id_127 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						 
						  //================================================================= 
						 
						 
				if (strlen($id_127) != 0  && $id_127 == 'Yes') 
                 { 
						$id_128 = pg_result($result_infosgerais, $row, 'id_128');
						 if(strlen($id_128) != 0  && $id_128 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						 $id_129 = pg_result($result_infosgerais, $row, 'id_129');
						 if(strlen($id_129) != 0  && $id_129 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
				  }
				  elseif (strlen($id_127) != 0  && $id_127 == 'No')
				  {
                           $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
				   } 
						 
				    //================================================================= 
						  
						 
						        $id_132 = pg_result($result_infosgerais, $row, 'id_132');
						 if(strlen($id_132) != 0   && $id_132 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						 
						       $id_130 = pg_result($result_infosgerais, $row, 'id_130');
						 if(strlen($id_130) != 0   && $id_130 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						 
						       $id_131 = pg_result($result_infosgerais, $row, 'id_131');
						 if(strlen($id_131) != 0   && $id_131 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						   
						   
						       $id_133 = pg_result($result_infosgerais, $row, 'id_133');
						 if(strlen($id_133) != 0   && $id_133 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						  
						       $id_134 = pg_result($result_infosgerais, $row, 'id_134');
						 if(strlen($id_134) != 0   && $id_134 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						 
						       $id_135 = pg_result($result_infosgerais, $row, 'id_135');
						 if(strlen($id_135) != 0   && $id_135 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						   
						  
						       $id_136 = pg_result($result_infosgerais, $row, 'id_136');
						 if(strlen($id_136) != 0   && $id_136 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
						       $id_137 = pg_result($result_infosgerais, $row, 'id_137');
						 if(strlen($id_137) != 0   && $id_137 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						    
						 
						       $id_138 = pg_result($result_infosgerais, $row, 'id_138');
						 if(strlen($id_138) != 0   && $id_138 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						 
						       $id_139 = pg_result($result_infosgerais, $row, 'id_139');
						 if(strlen($id_139) != 0   && $id_139 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						 
						       $id_140 = pg_result($result_infosgerais, $row, 'id_140');
						 if(strlen($id_140) != 0   && $id_140 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						  
						       $id_141 = pg_result($result_infosgerais, $row, 'id_141');
						 if(strlen($id_141) != 0   && $id_141 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_142 = pg_result($result_infosgerais, $row, 'id_142');
						 if(strlen($id_142) != 0   && $id_142 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_143 = pg_result($result_infosgerais, $row, 'id_143');
						 if(strlen($id_143) != 0   && $id_143 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_144 = pg_result($result_infosgerais, $row, 'id_144');
						 if(strlen($id_144) != 0   && $id_144 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_145 = pg_result($result_infosgerais, $row, 'id_145');
						 if(strlen($id_145) != 0   && $id_145 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_146 = pg_result($result_infosgerais, $row, 'id_146');
						 if(strlen($id_146) != 0   && $id_146 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_147 = pg_result($result_infosgerais, $row, 'id_147');
						 if(strlen($id_147) != 0   && $id_147 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_148 = pg_result($result_infosgerais, $row, 'id_148');
						 if(strlen($id_148) != 0   && $id_148 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_149 = pg_result($result_infosgerais, $row, 'id_149');
						 if(strlen($id_149) != 0   && $id_149 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_150 = pg_result($result_infosgerais, $row, 'id_150');
						 if(strlen($id_150) != 0 )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_151 = pg_result($result_infosgerais, $row, 'id_151');
						 if(strlen($id_151) != 0   && $id_151 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						 
                         $id_152 = pg_result($result_infosgerais, $row, 'id_152');
						 if(strlen($id_152) != 0  && $id_152 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						

                      if(strlen($id_152) != 0  && $id_152 == 'Never')
						 {
                           $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
                          }
                         else
                            {  
								 $id_153 = pg_result($result_infosgerais, $row, 'id_153');
								 if(strlen($id_153) != 0 )
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 }
                          }
						
						       $id_154 = pg_result($result_infosgerais, $row, 'id_154');
						 if(strlen($id_154) != 0  && $id_154 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_155 = pg_result($result_infosgerais, $row, 'id_155');
						 if(strlen($id_155) != 0  && $id_155 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_156 = pg_result($result_infosgerais, $row, 'id_156');
						 if(strlen($id_156) != 0  && $id_156 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_157 = pg_result($result_infosgerais, $row, 'id_157');
						 if(strlen($id_157) != 0  && $id_157 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_158 = pg_result($result_infosgerais, $row, 'id_158');
						 if(strlen($id_158) != 0  && $id_158 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_159 = pg_result($result_infosgerais, $row, 'id_159');
						 if(strlen($id_159) != 0  && $id_159 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_160 = pg_result($result_infosgerais, $row, 'id_160');
						 if(strlen($id_160) != 0  && $id_160 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_161 = pg_result($result_infosgerais, $row, 'id_161');
						 if(strlen($id_161) != 0  && $id_161 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_162 = pg_result($result_infosgerais, $row, 'id_162');
						 if(strlen($id_162) != 0  && $id_162 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						
						//fim do form de incendio
						
						
						
						
						
						
						//inicio do form de segurança alimentar
						
						
						
						       $id_21 = pg_result($result_infosgerais, $row, 'id_21');
						 if(strlen($id_21) != 0 && $id_21 != '0' )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						       $id_22 = pg_result($result_infosgerais, $row, 'id_22');
						 if(strlen($id_22) != 0 && $id_22 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_23 = pg_result($result_infosgerais, $row, 'id_23');
						 if(strlen($id_23) != 0 && $id_23 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_24 = pg_result($result_infosgerais, $row, 'id_24');
						 if(strlen($id_24) != 0 && $id_24 != '0' )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_25 = pg_result($result_infosgerais, $row, 'id_25');
						 if(strlen($id_25) != 0 && $id_25 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						 
						
						
						       $id_26 = pg_result($result_infosgerais, $row, 'id_26');
						 if(strlen($id_26) != 0 && $id_26 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_27 = pg_result($result_infosgerais, $row, 'id_27');
						 if(strlen($id_27) != 0 && $id_27 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_28 = pg_result($result_infosgerais, $row, 'id_28');
						 if(strlen($id_28) != 0 && $id_28 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_29 = pg_result($result_infosgerais, $row, 'id_29');
						 if(strlen($id_29) != 0 && $id_29 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						       $id_210 = pg_result($result_infosgerais, $row, 'id_210');
						 if(strlen($id_210) != 0 && $id_210 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						       $id_211 = pg_result($result_infosgerais, $row, 'id_211');
						 if(strlen($id_211) != 0 && $id_211 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						       $id_212 = pg_result($result_infosgerais, $row, 'id_212');
						 if(strlen($id_212) != 0 && $id_212 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_213 = pg_result($result_infosgerais, $row, 'id_213');
						 if(strlen($id_213) != 0 && $id_213 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						       $id_214 = pg_result($result_infosgerais, $row, 'id_214');
						 if(strlen($id_214) != 0 && $id_214 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_215 = pg_result($result_infosgerais, $row, 'id_215');
						 if(strlen($id_215) != 0 && $id_215 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_216 = pg_result($result_infosgerais, $row, 'id_216');
						 if(strlen($id_216) != 0 && $id_216 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_217 = pg_result($result_infosgerais, $row, 'id_217');
						 if(strlen($id_217) != 0 && $id_217 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_218 = pg_result($result_infosgerais, $row, 'id_218');
						 if(strlen($id_218) != 0 && $id_218 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_219 = pg_result($result_infosgerais, $row, 'id_219');
						 if(strlen($id_219) != 0 && $id_219 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						       $id_220 = pg_result($result_infosgerais, $row, 'id_220');
						 if(strlen($id_220) != 0 && $id_220 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_221 = pg_result($result_infosgerais, $row, 'id_221');
						 if(strlen($id_221) != 0 && $id_221 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_222 = pg_result($result_infosgerais, $row, 'id_222');
						 if(strlen($id_222) != 0 && $id_222 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						

                         if(strlen($id_222) != 0 && $id_222 == 'More than annual, or never')
                          {
                                   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
                           }
                           else
                          {   
							 $id_223 = pg_result($result_infosgerais, $row, 'id_223');
								 if(strlen($id_223) != 0 )
								 {
								   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
								   $avanco_porcentagem = $avanco_porcentagem + 1;
								 }
						}
						
						       $id_224 = pg_result($result_infosgerais, $row, 'id_224');
						 if(strlen($id_224) != 0 && $id_224 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						//fim do form de segurança alimentar
						
						
						
						
						
						//incio do form de segurança na piscina
						
						
						
						
						
						       $id_31 = pg_result($result_infosgerais, $row, 'id_31');
						 if(strlen($id_31) != 0  && $id_31 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
							
	 if (strlen($id_31) != 0  && $id_31 == 'Yes') 
	
	       {
						 
						
						       $id_32 = pg_result($result_infosgerais, $row, 'id_32');
						 if(strlen($id_32) != 0  && $id_32 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_33 = pg_result($result_infosgerais, $row, 'id_33');
						 if(strlen($id_33) != 0  && $id_33 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_34 = pg_result($result_infosgerais, $row, 'id_34');
						 if(strlen($id_34) != 0  && $id_34 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_35 = pg_result($result_infosgerais, $row, 'id_35');
						 if(strlen($id_35) != 0  && $id_35 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_36 = pg_result($result_infosgerais, $row, 'id_36');
						 if(strlen($id_36) != 0  && $id_36 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_37 = pg_result($result_infosgerais, $row, 'id_37');
						 if(strlen($id_37) != 0  && $id_37 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_38 = pg_result($result_infosgerais, $row, 'id_38');
						 if(strlen($id_38) != 0  && $id_38 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_39 = pg_result($result_infosgerais, $row, 'id_39');
						 if(strlen($id_39) != 0  && $id_39 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_310 = pg_result($result_infosgerais, $row, 'id_310');
						 if(strlen($id_310) != 0  && $id_310 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_311 = pg_result($result_infosgerais, $row, 'id_311');
						 if(strlen($id_311) != 0  && $id_311 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_312 = pg_result($result_infosgerais, $row, 'id_312');
						 if(strlen($id_312) != 0  && $id_312 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_313 = pg_result($result_infosgerais, $row, 'id_313');
						 if(strlen($id_313) != 0  && $id_313 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_314 = pg_result($result_infosgerais, $row, 'id_314');
						 if(strlen($id_314) != 0  && $id_314 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_315 = pg_result($result_infosgerais, $row, 'id_315');
						 if(strlen($id_315) != 0  && $id_315 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_316 = pg_result($result_infosgerais, $row, 'id_316');
						 if(strlen($id_316) != 0  && $id_316 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						       $id_317 = pg_result($result_infosgerais, $row, 'id_317');
						 if(strlen($id_317) != 0  && $id_317 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_318 = pg_result($result_infosgerais, $row, 'id_318');
						 if(strlen($id_318) != 0  && $id_318 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_319 = pg_result($result_infosgerais, $row, 'id_319');
						 if(strlen($id_319) != 0 )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						  
  }
  elseif (strlen($id_31) != 0  && $id_31 == 'No')
  {
                           $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						  
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						  
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						  
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						  
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						  
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						  
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						  
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
               }
						
						//fim do form de segurança na piscina
						
						
						
						
						
						
						
						
						//inicio do form de segurança 
						
						       $id_41 = pg_result($result_infosgerais, $row, 'id_41');
						 if(strlen($id_41) != 0  && $id_41 != '0' )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_42 = pg_result($result_infosgerais, $row, 'id_42');
						 if(strlen($id_42) != 0   && $id_42 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_43 = pg_result($result_infosgerais, $row, 'id_43');
						 if(strlen($id_43) != 0   && $id_43 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_44 = pg_result($result_infosgerais, $row, 'id_44');
						 if(strlen($id_44) != 0   && $id_44 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_45 = pg_result($result_infosgerais, $row, 'id_45');
						 if(strlen($id_45) != 0   && $id_45 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_46 = pg_result($result_infosgerais, $row, 'id_46');
						 if(strlen($id_46) != 0   && $id_46 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_47 = pg_result($result_infosgerais, $row, 'id_47');
						 if(strlen($id_47) != 0   && $id_47 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						
		if (strlen($id_47) != 0  && $id_47 == 'Yes')		
                 {
						
						       $id_48 = pg_result($result_infosgerais, $row, 'id_48');
						 if(strlen($id_48) != 0   && $id_48 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_49 = pg_result($result_infosgerais, $row, 'id_49');
						 if(strlen($id_49) != 0   && $id_49 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
			}
        elseif (strlen($id_47) != 0  && $id_47 == 'No')
             {
                     
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 
						
						 
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
			}	
						
						
						
						
						
						
						       $id_410 = pg_result($result_infosgerais, $row, 'id_410');
						 if(strlen($id_410) != 0   && $id_410 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
		if (strlen($id_410) != 0  && $id_410 == 'Yes')
          {		
						 $id_411 = pg_result($result_infosgerais, $row, 'id_411');
						 if(strlen($id_411) != 0  && $id_411 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
			}
			elseif (strlen($id_410) != 0  && $id_410 == 'No')
			{
						 $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						 $avanco_porcentagem = $avanco_porcentagem + 1;
						
			}
						
						
						
						
						
						       $id_412 = pg_result($result_infosgerais, $row, 'id_412');
						 if(strlen($id_412) != 0 && $id_412 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_413 = pg_result($result_infosgerais, $row, 'id_413');
						 if(strlen($id_413) != 0  && $id_413 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_414 = pg_result($result_infosgerais, $row, 'id_414');
						 if(strlen($id_414) != 0  && $id_414 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_415 = pg_result($result_infosgerais, $row, 'id_415');
						 if(strlen($id_415) != 0  && $id_415 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_416 = pg_result($result_infosgerais, $row, 'id_416');
						 if(strlen($id_416) != 0  && $id_416 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_417 = pg_result($result_infosgerais, $row, 'id_417');
						 if(strlen($id_417) != 0  && $id_417 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_418 = pg_result($result_infosgerais, $row, 'id_418');
						 if(strlen($id_418) != 0  && $id_418 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_419 = pg_result($result_infosgerais, $row, 'id_419');
						 if(strlen($id_419) != 0  && $id_419 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_420 = pg_result($result_infosgerais, $row, 'id_420');
						 if(strlen($id_420) != 0  && $id_420 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_421 = pg_result($result_infosgerais, $row, 'id_421');
						 if(strlen($id_421) != 0  && $id_421 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_422 = pg_result($result_infosgerais, $row, 'id_422');
						 if(strlen($id_422) != 0  && $id_422 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_423 = pg_result($result_infosgerais, $row, 'id_423');
						 if(strlen($id_423) != 0  && $id_423 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_424 = pg_result($result_infosgerais, $row, 'id_424');
						 if(strlen($id_424) != 0  && $id_424 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_425 = pg_result($result_infosgerais, $row, 'id_425');
						 if(strlen($id_425) != 0 && $id_425 != '0' )
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_426 = pg_result($result_infosgerais, $row, 'id_426');
						 if(strlen($id_426) != 0  && $id_426 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_427 = pg_result($result_infosgerais, $row, 'id_427');
						 if(strlen($id_427) != 0  && $id_427 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						       $id_428 = pg_result($result_infosgerais, $row, 'id_428');
						 if(strlen($id_428) != 0  && $id_428 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_429 = pg_result($result_infosgerais, $row, 'id_429');
						 if(strlen($id_429) != 0  && $id_429 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_430 = pg_result($result_infosgerais, $row, 'id_430');
						 if(strlen($id_430) != 0  && $id_430 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_431 = pg_result($result_infosgerais, $row, 'id_431');
						 if(strlen($id_431) != 0  && $id_431 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						       $id_432 = pg_result($result_infosgerais, $row, 'id_432');
						 if(strlen($id_432) != 0  && $id_432 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						       $id_433 = pg_result($result_infosgerais, $row, 'id_433');
						 if(strlen($id_433) != 0  && $id_433 != '0')
						 {
						   $avanco_barra = $avanco_barra.'<div id="evo">&nbsp;</div>';
						   $avanco_porcentagem = $avanco_porcentagem + 1;
						 }
						
						
						
						
						
						
						  
					 }
 
 
     }





$total = 149;
$pctm = $avanco_porcentagem;
$valor_descontado = (($avanco_porcentagem / $total) * 100) ;



		
		
		 
