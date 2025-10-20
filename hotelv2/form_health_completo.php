<?php
ini_set('display_errors', 1);
error_reporting(~0);


 
require('../util/connection.php');

$cod = $_GET["cod"];
 
$pega_fornec = "select name from integration.hotel where id = '$cod' ";
$result_fornec = pg_exec($conn, $pega_fornec);
for ($row = 0; $row < pg_numrows($result_fornec) ; $row++)
		{
			$name = pg_result($result_fornec, $row, 'name');
		} 
 
$pega_htl = "select pk_htl_health, id_52_nome, id_53_email, id_54_cargo, id_55_concluido from tarifario.hotel_health_cadastro  where id_htl = '$cod' ";
$result_htl = pg_exec($conn, $pega_htl);
$htl_recordcount = pg_numrows($result_htl) ;
 if ($htl_recordcount != 0)
		{
		
			for ($row = 0; $row < pg_numrows($result_htl) ; $row++)
					{
						 $pk_htl_health = pg_result($result_htl, $row, 'pk_htl_health');
						 $id_52 = pg_result($result_htl, $row, 'id_52_nome');
						 $id_53 = pg_result($result_htl, $row, 'id_53_email');
						 $id_54 = pg_result($result_htl, $row, 'id_54_cargo');
						 $id_55 = pg_result($result_htl, $row, 'id_55_concluido');
						 
					 } 
	    }


 $pega_infosgerais="select  * from  tarifario.hotel_health_conteudo where fk_htl_health = $pk_htl_health ";
 $result_infosgerais = pg_exec($conn, $pega_infosgerais);
$infosgerais_recordcount = pg_numrows($result_infosgerais) ;


 if ($infosgerais_recordcount != 0)
		{
		
			for ($row = 0; $row < pg_numrows($result_infosgerais) ; $row++)
					{
						 $id_01 = pg_result($result_infosgerais, $row, 'id_01');
						 $id_02 = pg_result($result_infosgerais, $row, 'id_02');
						 $id_03 = pg_result($result_infosgerais, $row, 'id_03');
						 $id_04 = pg_result($result_infosgerais, $row, 'id_04');
					     $id_06 = pg_result($result_infosgerais, $row, 'id_06');
						 $id_07 = pg_result($result_infosgerais, $row, 'id_07');
						 $id_09 = pg_result($result_infosgerais, $row, 'id_09');
						 $id_11 = pg_result($result_infosgerais, $row, 'id_11');
						 $id_12 = pg_result($result_infosgerais, $row, 'id_12');
						 $id_12ou = pg_result($result_infosgerais, $row, 'id_12ou');
						 $id_13 = pg_result($result_infosgerais, $row, 'id_13');
						 $id_14 = pg_result($result_infosgerais, $row, 'id_14');
						 $id_15 = pg_result($result_infosgerais, $row, 'id_15');
						 $id_16 = pg_result($result_infosgerais, $row, 'id_16');
						 $id_17 = pg_result($result_infosgerais, $row, 'id_17');
						 $id_18 = pg_result($result_infosgerais, $row, 'id_18');
						 $id_19 = pg_result($result_infosgerais, $row, 'id_19');
						 $id_110 = pg_result($result_infosgerais, $row, 'id_110');
						 $id_111 = pg_result($result_infosgerais, $row, 'id_111');
						 $id_112 = pg_result($result_infosgerais, $row, 'id_112');
						 $id_113 = pg_result($result_infosgerais, $row, 'id_113');
						 $id_114 = pg_result($result_infosgerais, $row, 'id_114');
						 $id_115 = pg_result($result_infosgerais, $row, 'id_115'); 
						 $id_117 = pg_result($result_infosgerais, $row, 'id_117'); 
						 $id_118 = pg_result($result_infosgerais, $row, 'id_118');
						 $id_119 = pg_result($result_infosgerais, $row, 'id_119'); 
						 $id_120 = pg_result($result_infosgerais, $row, 'id_120');  
						 $id_121 = pg_result($result_infosgerais, $row, 'id_121');
						 $id_122 = pg_result($result_infosgerais, $row, 'id_122');
						 $id_123 = pg_result($result_infosgerais, $row, 'id_123');
						 $id_124 = pg_result($result_infosgerais, $row, 'id_124');
						 $id_125 = pg_result($result_infosgerais, $row, 'id_125');
                         $id_126_2 = pg_result($result_infosgerais, $row, 'id_126_2');
						 $id_127 = pg_result($result_infosgerais, $row, 'id_127');
						 $id_128 = pg_result($result_infosgerais, $row, 'id_128');
						 $id_129 = pg_result($result_infosgerais, $row, 'id_129');
						 $id_130 = pg_result($result_infosgerais, $row, 'id_130');
						 $id_131 = pg_result($result_infosgerais, $row, 'id_131');
						 $id_132 = pg_result($result_infosgerais, $row, 'id_132'); 
						 $id_133 = pg_result($result_infosgerais, $row, 'id_133');
						 $id_134 = pg_result($result_infosgerais, $row, 'id_134');
						 $id_135 = pg_result($result_infosgerais, $row, 'id_135');
						 $id_136 = pg_result($result_infosgerais, $row, 'id_136');
						 $id_137 = pg_result($result_infosgerais, $row, 'id_137');
						 $id_138 = pg_result($result_infosgerais, $row, 'id_138');
						 $id_139 = pg_result($result_infosgerais, $row, 'id_139');
						 $id_140 = pg_result($result_infosgerais, $row, 'id_140');
						 $id_141 = pg_result($result_infosgerais, $row, 'id_141');
						 $id_142 = pg_result($result_infosgerais, $row, 'id_142'); 
						 $id_143 = pg_result($result_infosgerais, $row, 'id_143');
						 $id_144 = pg_result($result_infosgerais, $row, 'id_144');
						 $id_145 = pg_result($result_infosgerais, $row, 'id_145');
						 $id_146 = pg_result($result_infosgerais, $row, 'id_146');
						 $id_147 = pg_result($result_infosgerais, $row, 'id_147');
						 $id_148 = pg_result($result_infosgerais, $row, 'id_148');
						 $id_149 = pg_result($result_infosgerais, $row, 'id_149');
                         $id_150 = pg_result($result_infosgerais, $row, 'id_150_2');
						 $id_151 = pg_result($result_infosgerais, $row, 'id_151');
						 $id_152 = pg_result($result_infosgerais, $row, 'id_152'); 
						 $id_154 = pg_result($result_infosgerais, $row, 'id_154');
						 $id_155 = pg_result($result_infosgerais, $row, 'id_155');
						 $id_156 = pg_result($result_infosgerais, $row, 'id_156');
						 $id_157 = pg_result($result_infosgerais, $row, 'id_157');
						 $id_158 = pg_result($result_infosgerais, $row, 'id_158');
						 $id_159 = pg_result($result_infosgerais, $row, 'id_159');
						 $id_160 = pg_result($result_infosgerais, $row, 'id_160');
						 $id_161 = pg_result($result_infosgerais, $row, 'id_161');
						 $id_162 = pg_result($result_infosgerais, $row, 'id_162');
						   $id_41 = pg_result($result_infosgerais, $row, 'id_41');
					  $id_42 = pg_result($result_infosgerais, $row, 'id_42');
					  $id_43 = pg_result($result_infosgerais, $row, 'id_43');
					  $id_44 = pg_result($result_infosgerais, $row, 'id_44');
					  $id_45 = pg_result($result_infosgerais, $row, 'id_45');
					  $id_46 = pg_result($result_infosgerais, $row, 'id_46');
					  $id_47 = pg_result($result_infosgerais, $row, 'id_47');
					  $id_48 = pg_result($result_infosgerais, $row, 'id_48');
					  $id_49 = pg_result($result_infosgerais, $row, 'id_49');
					  $id_410 = pg_result($result_infosgerais, $row, 'id_410');
					  $id_411 = pg_result($result_infosgerais, $row, 'id_411');
					  $id_412 = pg_result($result_infosgerais, $row, 'id_412');
					  $id_413 = pg_result($result_infosgerais, $row, 'id_413');
					  $id_414 = pg_result($result_infosgerais, $row, 'id_414');
					  $id_415 = pg_result($result_infosgerais, $row, 'id_415');
					  $id_416 = pg_result($result_infosgerais, $row, 'id_416');
					  $id_417 = pg_result($result_infosgerais, $row, 'id_417');
					  $id_418 = pg_result($result_infosgerais, $row, 'id_418');
					  $id_419 = pg_result($result_infosgerais, $row, 'id_419');
					  $id_420 = pg_result($result_infosgerais, $row, 'id_420');
					  $id_421 = pg_result($result_infosgerais, $row, 'id_421');
					  $id_422 = pg_result($result_infosgerais, $row, 'id_422');
					  $id_423 = pg_result($result_infosgerais, $row, 'id_423');
					  $id_424 = pg_result($result_infosgerais, $row, 'id_424');
					  $id_425 = pg_result($result_infosgerais, $row, 'id_425');
					  $id_426 = pg_result($result_infosgerais, $row, 'id_426');
					  $id_427 = pg_result($result_infosgerais, $row, 'id_427');
					  $id_428 = pg_result($result_infosgerais, $row, 'id_428');
					  $id_429 = pg_result($result_infosgerais, $row, 'id_429');
					  $id_430 = pg_result($result_infosgerais, $row, 'id_430');
					  $id_431 = pg_result($result_infosgerais, $row, 'id_431');
					  $id_432 = pg_result($result_infosgerais, $row, 'id_432');
					  $id_433 = pg_result($result_infosgerais, $row, 'id_433');
                      $id_21 = pg_result($result_infosgerais, $row, 'id_21');
					  $id_22 = pg_result($result_infosgerais, $row, 'id_22');
					  $id_23 = pg_result($result_infosgerais, $row, 'id_23');
					  $id_24 = pg_result($result_infosgerais, $row, 'id_24');
					  $id_25 = pg_result($result_infosgerais, $row, 'id_25');
					  $id_26 = pg_result($result_infosgerais, $row, 'id_26');
					  $id_27 = pg_result($result_infosgerais, $row, 'id_27');
					  $id_28 = pg_result($result_infosgerais, $row, 'id_28');
					  $id_29 = pg_result($result_infosgerais, $row, 'id_29');
					  $id_210 = pg_result($result_infosgerais, $row, 'id_210');
					  $id_211 = pg_result($result_infosgerais, $row, 'id_211');
					  $id_212 = pg_result($result_infosgerais, $row, 'id_212');
					  $id_213 = pg_result($result_infosgerais, $row, 'id_213');
					  $id_214 = pg_result($result_infosgerais, $row, 'id_214');
					  $id_215 = pg_result($result_infosgerais, $row, 'id_215');
					  $id_216 = pg_result($result_infosgerais, $row, 'id_216');
					  $id_217 = pg_result($result_infosgerais, $row, 'id_217');
					  $id_218 = pg_result($result_infosgerais, $row, 'id_218');
					  $id_219 = pg_result($result_infosgerais, $row, 'id_219');
					  $id_220 = pg_result($result_infosgerais, $row, 'id_220');
					  $id_221 = pg_result($result_infosgerais, $row, 'id_221');
					  $id_222 = pg_result($result_infosgerais, $row, 'id_222');
					  $id_224 = pg_result($result_infosgerais, $row, 'id_224');
                      $id_31 = pg_result($result_infosgerais, $row, 'id_31');
					  $id_32 = pg_result($result_infosgerais, $row, 'id_32');
					  $id_33 = pg_result($result_infosgerais, $row, 'id_33');
					  $id_34 = pg_result($result_infosgerais, $row, 'id_34');
					  $id_35 = pg_result($result_infosgerais, $row, 'id_35');
					  $id_36 = pg_result($result_infosgerais, $row, 'id_36');
					  $id_37 = pg_result($result_infosgerais, $row, 'id_37');
					  $id_38 = pg_result($result_infosgerais, $row, 'id_38');
					  $id_39 = pg_result($result_infosgerais, $row, 'id_39');
					  $id_310 = pg_result($result_infosgerais, $row, 'id_310');
					  $id_311 = pg_result($result_infosgerais, $row, 'id_311');
					  $id_312 = pg_result($result_infosgerais, $row, 'id_312');
					  $id_313 = pg_result($result_infosgerais, $row, 'id_313');
					  $id_314 = pg_result($result_infosgerais, $row, 'id_314');
					  $id_315 = pg_result($result_infosgerais, $row, 'id_315');
					  $id_316 = pg_result($result_infosgerais, $row, 'id_316');
					  $id_317 = pg_result($result_infosgerais, $row, 'id_317');
					  $id_318 = pg_result($result_infosgerais, $row, 'id_318');
					  $id_319 = pg_result($result_infosgerais, $row, 'id_319');
					        
					  $id_223 =  pg_result($result_infosgerais, $row, 'id_223');
								

                       if(strlen($id_223) != 0)
								{
									$arrayData = explode("-",$id_223);
									$anoin223 = $arrayData[0];
									$mesin223 = $arrayData[1];
									$diain223 = $arrayData[2];
									$id_223d =$diain223.'/'.$mesin223.'/'.$anoin223; 
						        }
								else
								{
									$id_223d = '';
								} 
								 
							
						      
					  
 
 
						 
						      
						        $id_116 =  pg_result($result_infosgerais, $row, 'id_116');
								if(strlen($id_116) != 0)
								{
									$arrayData = explode("-",$id_116);
									$anoin116 = $arrayData[0];
									$mesin116 = $arrayData[1];
									$diain116 = $arrayData[2];
									$id_116d =$diain116.'/'.$mesin116.'/'.$anoin116; 
						        }
								 else
								{
									$id_116d = '';
								}
								 
							
						/*         $id_126 =  pg_result($result_infosgerais, $row, 'id_126');
								if(strlen($id_126) != 0)
								{
									$arrayData = explode("-",$id_126);
									$anoin126 = $arrayData[0];
									$mesin126 = $arrayData[1];
									$diain126 = $arrayData[2];
									$id_126d =$diain126.'/'.$mesin126.'/'.$anoin126; 
						        }
								 else
								{
									$id_126d = '';
								}
								 
								 	
							   $id_150 =  pg_result($result_infosgerais, $row, 'id_150');
								if(strlen($id_150) != 0)
								{
									$arrayData = explode("-",$id_150);
									$anoin150 = $arrayData[0];
									$mesin150 = $arrayData[1];
									$diain150 = $arrayData[2];
									$id_150d =$diain150.'/'.$mesin150.'/'.$anoin150; 
						        }
								else
								{
									$id_150d = '';
								}
									*/ 	
							   $id_153 =  pg_result($result_infosgerais, $row, 'id_153');
								if(strlen($id_153) != 0)
								{
									$arrayData = explode("-",$id_153);
									$anoin153 = $arrayData[0];
									$mesin153 = $arrayData[1];
									$diain153 = $arrayData[2];
									$id_153d =$diain153.'/'.$mesin153.'/'.$anoin153; 
						        } 
								else
								{
									$id_153d = '';
								}
						 
						        $id_05 =  pg_result($result_infosgerais, $row, 'id_05');
								if(strlen($id_05) != 0)
								{
									$arrayData = explode("-",$id_05);
									$anoin05 = $arrayData[0];
									$mesin05 = $arrayData[1];
									$diain05 = $arrayData[2];
									$id_05d =$diain05.'/'.$mesin05.'/'.$anoin05; 
						        }
								else
								{
									$id_05d = '';
								}
								
								 
								$id_08 = pg_result($result_infosgerais, $row, 'id_08');
								if(strlen($id_08) != 0)
								{
									$arrayData = explode("-",$id_08);
									$anoin08 = $arrayData[0];
									$mesin08 = $arrayData[1];
									$diain08 = $arrayData[2];
									$id_08d = $diain08.'/'.$mesin08.'/'.$anoin08; 
						        }
								else
								{
									$id_08d = '';
								}
								
								
								$id_10 = pg_result($result_infosgerais, $row, 'id_10');
								if(strlen($id_10) != 0)
								{
									$arrayData = explode("-",$id_10);
									$anoin10 = $arrayData[0];
									$mesin10 = $arrayData[1];
									$diain10 = $arrayData[2];
									$id_10d = $diain10.'/'.$mesin10.'/'.$anoin10;
						        }
								else
								{
									$id_10d = '';
								}
					 }
 
 
     }







$ano = date("Y");
$mes = date("m");
$dia =  date("d");
$data_now =  $ano . '-' . $mes . '-' . $dia;
$data_nowdisplay =  $dia . '/' . $mes . '/' .$ano ;
  
$print_form = '';
$print_form = $print_form .'
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Health & Safe Hotel form</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body text="#000000" style="font-family:Verdana, Arial, Helvetica, sans-serif ; font-size:12px;  ">
<table   border="1" cellspacing="0" style="width:700px;  font-family: "Lucida Sans Unicode", ","Lucida Grande", sans-serif; color:#787250;" >
<tr><td colspan="2" style="width:580px;" ><font size="4">Health & Safe Hotel form to '.$name.'</font></td>
<td align="right" valign="top" style="width:100px;" ><img src="http://www.blumar.com.br/images/blumar_oficial_160px.jpg"></td></tr>
<tr><td colspan="3" bgcolor="#e8e8ea" ><b>1 - General Info</b></td></tr>
<tr>
     <td style="width:30px;">1.1</td>
     <td style="width:550px;" >Type of guests</td>
     <td style="width:100px;" >';
	$form_01  =  $id_01;  
	$print_form = $print_form.$form_01;
	$print_form = $print_form .'</td>
	</tr>
 <tr>
	<td  style="width:30px;" >1.2</td>
	<td  style="width:550px;" >Board basis</td>
	<td  style="width:100px;" >';
	$form_02  =  $id_02;  
	$print_form = $print_form.$form_02;
	$print_form = $print_form .'</td></tr>
  <tr>
    <td style="width:30px;">1.3</td>
    <td style="width:550px;" >Year Built</td>
    <td style="width:100px;">';
	$form_03  =  $id_03;  
	$print_form = $print_form.$form_03;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.4</td>
    <td style="width:550px;" >Do you have a valid Operational Licence?</td>
    <td style="width:100px;">';
	$form_04  =  $id_04;  
	$print_form = $print_form.$form_04;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.5</td>
    <td style="width:550px;" >Provide the expiry date of the operating licence.</td>
    <td style="width:100px;">';
	$form_05  =  $id_05;  
	$print_form = $print_form.$form_05;
	$print_form = $print_form .'</td>
  </tr>
    <tr>
    <td style="width:30px;">1.6</td>
    <td style="width:550px;" >Do you have a valid Public Liability Insurance?</td>
    <td style="width:100px;">';
	$form_06  =  $id_06;  
	$print_form = $print_form.$form_06;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.7</td>
    <td style="width:550px;" >Does your liability insurance achieve the minimum levels required by law according to the product/services provided, i.e. in accordance with local laws and regulations?</td>
    <td style="width:100px;">';
	$form_07  =  $id_07;  
	$print_form = $print_form.$form_07;
	$print_form = $print_form .'</td>
  </tr>
<tr>
    <td style="width:30px;">1.8</td>
    <td style="width:550px;" >Please, write the expiry date for the liability insurance.</td>
    <td style="width:100px;">';
	$form_08  =  $id_08;  
	$print_form = $print_form.$form_08;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.9</td>
    <td style="width:550px;" >Do you have a valid Fire Certificate?</td>
    <td style="width:100px;">';
	 $form_09  =  $id_09;  
	 $print_form = $print_form.$form_09;
	 $print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.10</td>
    <td style="width:550px;" >Please, write the expiry date for the fire certificate.</td>
    <td style="width:100px;">';
	$form_10  =  $id_10;  
	$print_form = $print_form.$form_10;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>General</b></td>
  </tr>
  <tr>
    <td style="width:30px;">1.11</td>
    <td style="width:550px;" >What is the type of the hotels´ building?</td>
    <td style="width:100px;">';
	$form_11  = $id_11; 
	/*wordwrap($str,15,"<br>\n");
	print_form = $print_form. substr($form_11, 0, 26).'<br>';
	print_form = $print_form.substr($form_11, 27, 53).'<br>';
	print_form = $print_form.substr($form_11, 54, 80).'<br>'; 
	print_form = $print_form.substr($form_11, 81, 107).'<br>'; */
	$print_form = $print_form.$form_11;
	$print_form = $print_form.'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.12</td>
    <td style="width:550px;" >What is the main building structure?</td>
    <td style="width:100px;">';
	$form_12  =  $id_12;  
	$print_form = $print_form.$form_12;
	$form_12ou  =  $id_12ou; 
	$print_form = $print_form.$form_12ou;
	$print_form = $print_form.'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.13</td>
    <td style="width:550px;">How many separate accommodation blocks does the hotel have?  (Please complete this questionnaire for the accommodation our clients will use)</td>
    <td style="width:100px;">';
	$form_13  =  $id_13;  
	$print_form = $print_form.$form_13;
	$print_form = $print_form .'</td>
  </tr>
   <tr>
    <td style="width:30px;">1.14</td>
    <td style="width:550px;">Does the accommodation utilize the entire building area of the building structure? <br>(examples: some accommodation units have only some floors of the entire building area, or some blocks in a complex building etc.)</td>
    <td style="width:100px;">';
	$form_14  =  $id_14;  
	$print_form = $print_form.$form_14;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">1.15</td>
    <td style="width:550px;" >How many guestrooms are there?</td>
    <td style="width:100px;">';
	$form_15  =  $id_15;  
	$print_form = $print_form.$form_15;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.16</td>
    <td style="width:550px;" >How many floors are there including the ground floor?</td>
    <td style="width:100px;">';
	$form_16  =  $id_16;  
	$print_form = $print_form.$form_16;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.17</td>
    <td style="width:550px;" >Is there a basement or floor(s) below the ground floor?</td>
    <td style="width:100px;">';
	$form_17  =  $id_17;  
	$print_form = $print_form.$form_17;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">1.18</td>
    <td style="width:550px;" >Are all floors below ground level separated from upper floors with fire doors?</td>
    <td style="width:100px;">';
	$form_18  =  $id_18;  
	$print_form = $print_form.$form_18;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>2 - Fire Warning System</b></td>
  </tr>
  <tr>
    <td style="width:30px;">2.1</td>
    <td style="width:550px;" >Does the hotel have an automatic or manual fire alarm system?<br>
       (In case the hotel doesn´t have an automatic alarm system due to the type of building, manual fire alarm system is acceptable),</td>
    <td style="width:100px;">';
	$form_19  =  $id_19;  
	$print_form = $print_form.$form_19;
	$print_form = $print_form .'</td>
  </tr>
   <tr>
    <td style="width:30px;">2.2</td>
    <td style="width:550px;" >Please explain the type of fire alarm system</td>
    <td style="width:100px;">';
	$form_110  =  $id_110;  
	$print_form = $print_form.$form_110;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.3</td>
    <td style="width:550px;" >Are there alarm buttons/call points that can be activated in all parts of the building?</td>
    <td style="width:100px;">';
	$form_111  = $id_111;  
	$print_form = $print_form.$form_111;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.4</td>
    <td style="width:550px;" >Can the alarm when activated be heard throughout the whole building?</td>
    <td style="width:100px;">';
	$form_112  = $id_112; 
    $print_form = $print_form.$form_112;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.5</td>
    <td style="width:550px;" >How often is the fire alarm tested?</td>
    <td style="width:100px;">';
	$form_113  =  $id_113;  
	$print_form = $print_form.$form_113;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.6</td>
    <td style="width:550px;" >Is there an emergency power supply for the fire alarm system?</td>
    <td style="width:100px;">';
	$form_114  =  $id_114;  
	$print_form = $print_form.$form_114;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.7</td>
    <td style="width:550px;">Has the fire alarm system been inspected and passed by a competent engineer or an external company in the last 12 months?</td>
    <td style="width:100px;">';
	$form_115  =  $id_115;  
	$print_form = $print_form.$form_115;
	$print_form = $print_form .'</td>
  </tr>
<!--  <tr>
    <td style="width:30px;">2.8</td>
    <td style="width:550px;" >Write the date when the last inspection was performed.</td>
    <td style="width:100px;">';
	$form_116  =  $id_116;  
	$print_form = $print_form.$form_116;
	$print_form = $print_form .'</td>
  </tr> -->
  <tr>
    <td style="width:30px;">2.9</td>
    <td style="width:550px;" >What type of smoke detectors are fitted in all guestrooms:</td>
    <td style="width:100px;">';
	$form_117  =  $id_117;  
	$print_form = $print_form.$form_117;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.10</td>
    <td style="width:550px;" >What type of smoke detectors are fitted in all internal corridors:</td>
    <td style="width:100px;">';
	$form_118  =  $id_118;  
	$print_form = $print_form.$form_118;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.11</td>
    <td style="width:550px;" >What type of smoke detectors are fitted in all internal staircases:</td>
    <td style="width:100px;">';
	$form_119  =  $id_119;  
	$print_form = $print_form.$form_119;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.12</td>
    <td style="width:550px;" >What type of smoke detectors are fitted in internal public areas:</td>
    <td style="width:100px;">';
	$form_120  =  $id_120;  
	$print_form = $print_form.$form_120;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.13</td>
    <td style="width:550px;" >Are heat or smoke detectors fitted in high risk rooms (Kitchen, Laundry, Boiler and Generator Room)?</td>
    <td style="width:100px;">';
	$form_121  =  $id_121;  
	$print_form = $print_form.$form_121;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.14</td>
    <td style="width:550px;">Has the smoke detection system been inspected and passed by a competent engineer or an external company in the last 12 months?</td>
    <td style="width:100px;">';
	$form_122  =  $id_122;  
	$print_form = $print_form.$form_122;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Emergency Evacuation</b></td>
  </tr>
    <tr>
    <td style="width:30px;">2.15</td>
    <td style="width:550px;" >Is there emergency lighting in all parts of the building?</td>
    <td style="width:100px;">';
	$form_123  =  $id_123;  
	$print_form = $print_form.$form_123;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.16</td>
    <td style="width:550px;" >Is there an emergency power supply for the emergency lighting system?</td>
    <td style="width:100px;">';
	$form_124  =  $id_124;  
	$print_form = $print_form.$form_124;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.17</td>
    <td style="width:550px;">Has the emergency lighting system been inspected and passed by  a competent engineer or an external company in the last 12 months?</td>
    <td style="width:100px;">';
	$form_125  =  $id_125;  
	$print_form = $print_form.$form_125;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.18</td>
    <td style="width:550px;" >Indicate how often the lighting is tested.</td>
    <td style="width:100px;">';
	$form_126  =  $id_126_2;  
	$print_form = $print_form.$form_126;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.19</td>
    <td style="width:550px;" >Does the property have an atrium where there are guest rooms or the corridors to guest rooms come off?</td>
    <td style="width:100px;">';
	$form_127  =  $id_127;  
	$print_form = $print_form.$form_127;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.20</td>
    <td style="width:550px;" >Is there a smoke control system in place? (If there is no atrium, select N/A)</td>
    <td style="width:100px;">';
	$form_128  =  $id_128;  
	$print_form = $print_form.$form_128;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.21</td>
    <td style="width:550px;" >What type of ventilation does the atrium have? (If there is no atrium, select N/A)</td>
    <td style="width:100px;">';
	$form_129  =  $id_129;  
	$print_form = $print_form.$form_129;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">2.22</td>
    <td style="width:550px;" >In case the property has more than 1 floor, as specified in question 1.16, what is the total number of emergency staircases that can be used in an emergency situation?</td>
    <td style="width:100px;">';
	$form_132  =  $id_132;  
	$print_form = $print_form.$form_132;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.23</td>
    <td style="width:550px;" >How many exit / staircases available in the accommodation?</td>
    <td style="width:100px;">';
	$form_130  =  $id_130;  
	$print_form = $print_form.$form_130;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.24</td>
    <td style="width:550px;" >What are the type of staircase available?</td>
    <td style="width:100px;">';
	$form_131  =  $id_131;  
	$print_form = $print_form.$form_131;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.25</td>
    <td style="width:550px;" >Does the main staircase lead through reception?</td>
    <td style="width:100px;">';
	$form_133  =  $id_133;  
	$print_form = $print_form.$form_133;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.26</td>
    <td style="width:550px;" >Are all internal staircases protected by fire doors on all floors including the ground floor?</td>
    <td style="width:100px;">';
	$form_134  =  $id_134;  
	$print_form = $print_form.$form_134;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.27</td>
    <td style="width:550px;" >Are accommodation corridors external (open to the air)?</td>
    <td style="width:100px;">';
	$form_135  =  $id_135;  
	$print_form = $print_form.$form_135;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.28</td>
    <td style="width:550px;" >Are any internal accommodation corridors longer than 30m (100´-0´ )?</td>
    <td style="width:100px;">';
	$form_136  =  $id_136;  
	$print_form = $print_form.$form_136;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.29</td>
    <td style="width:550px;">For internal accommodation corridors longer than 30m (100´-0´), are there any fire doors dividing the corridors? <br>(in case there are no corridors longer than 30m, select N/A)</td>
    <td style="width:100px;">';
	$form_137  =  $id_137;  
	$print_form = $print_form.$form_137;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.30</td>
    <td style="width:550px;">From any guestroom is the distance to an emergency staircase or exit more than 30m (100´-0´)?  (in case there are no corridors longer than 30m, select N/A)</td>
    <td style="width:100px;">';
	$form_138  =  $id_138;  
	$print_form = $print_form.$form_138;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.31</td>
    <td style="width:550px;" >Do any corridors have dead ends longer than 10m?  (A dead end is any area where escape in an emergency is only possible in one direction)</td>
    <td style="width:100px;">';
	$form_139  =  $id_139;  
	$print_form = $print_form.$form_139;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.32</td>
    <td style="width:550px;" >Are all emergency routes and exits free of obstruction at all times?</td>
    <td style="width:100px;">';
	$form_140  =  $id_140;  
	$print_form = $print_form.$form_140;
	$print_form = $print_form .'</td>
  </tr>
   <tr>
    <td style="width:30px;">2.33</td>
    <td style="width:550px;" >Are all emergency routes and emergency exit doors clearly signed?</td>
    <td style="width:100px;">';
	$form_141  =  $id_141;  
	$print_form = $print_form.$form_141;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.34</td>
    <td style="width:550px;" >Do all emergency exit doors open in the direction of travel/escape?</td>
    <td style="width:100px;">';
	$form_142  =  $id_142;  
	$print_form = $print_form.$form_142;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.35</td>
    <td style="width:550px;" >Are all exits unlocked at all times and can be opened easily without a key?</td>
    <td style="width:100px;">';
	$form_143  =  $id_143;  
	$print_form = $print_form.$form_143;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.36</td>
    <td style="width:550px;" >Are all fire doors kept closed or fitted with self-closing devices?</td>
    <td style="width:100px;">';
	$form_144  =  $id_144;  
	$print_form = $print_form.$form_144;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.37</td>
    <td style="width:550px;" >Are all guestroom doors fitted with self-closing devices?</td>
    <td style="width:100px;">';
	$form_145  =  $id_145;  
	$print_form = $print_form.$form_145;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.38</td>
    <td style="width:550px;" >Do all guestroom doors resist fire and smoke for a minimum of 30 minutes?</td>
    <td style="width:100px;">';
	$form_146  =  $id_146;  
	$print_form = $print_form.$form_146;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.39</td>
    <td style="width:550px;" >Is there an emergency evacuation plan or route (which include an Assembly Point) displayed in every guestroom?</td>
    <td style="width:100px;">';
	$form_147 =  $id_147;  
	$print_form = $print_form.$form_147;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Fire Equipment</b></td>
 </tr>
 <tr>
    <td style="width:30px;">2.40</td>
    <td style="width:550px;">Are there sufficient working fire extinguishers & hoses throughout the building including corridors, public areas, kitchens, laundries and boiler rooms?</td>
    <td style="width:100px;">';
	$form_148  =  $id_148;  
	$print_form = $print_form.$form_148;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.41</td>
    <td style="width:550px;" >Have all extinguishers & hoses been inspected and passed by a competent engineer or an external company in the last 12 months?</td>
    <td style="width:100px;">';
	$form_149  =  $id_149;  
	$print_form = $print_form.$form_149;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.42</td>
    <td style="width:550px;" >How often the equipment is inspected?</td>
    <td style="width:100px;">';
	$form_150  =  $id_150;  
	$print_form = $print_form.$form_150;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Fire Procedures</b></td>
 </tr>
 <tr>
    <td style="width:30px;">2.43</td>
    <td style="width:550px;" >Have staff had fire safety and evacuation procedures training in the last 12 months?</td>
    <td style="width:100px;">';
	$form_151  =  $id_151;  
	$print_form = $print_form.$form_151;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">2.44</td>
    <td style="width:550px;" >How often do you carry out an evacuation drill?</td>
    <td style="width:100px;">';
	$form_152  =  $id_152;  
	$print_form = $print_form.$form_152;
	$print_form = $print_form .'</td>
  </tr>
  <!-- <tr>
    <td style="width:30px;">2.45</td>
    <td style="width:550px;" >Write the date of Fire Evacuation Drill. (or writte "NEVER")</td>
    <td style="width:100px;">';
	$form_153  =  $id_153;  
	$print_form = $print_form.$form_153;
	$print_form = $print_form .'</td>
  </tr> -->
  <tr>
    <td style="width:30px;">2.46</td>
    <td style="width:550px;" >Is there a member of staff on duty at reception 24 hours a day?</td>
    <td style="width:100px;">';
	$form_154  =  $id_154;  
	$print_form = $print_form.$form_154;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.47</td>
    <td style="width:550px;" >Are there ‘do not use in case of fire’ signs outside the lifts on all floors?</td>
    <td style="width:100px;">';
	$form_155  =  $id_155;  
	$print_form = $print_form.$form_155;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.48</td>
    <td style="width:550px;" >Are there any parts of the building not under the control of the hotel (Shops, Offices or other Businesses)?</td>
    <td style="width:100px;">';
	$form_156  =  $id_156;  
	$print_form = $print_form.$form_156;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.49</td>
    <td style="width:550px;">If there are parts of the building not under the control of the hotel, these parts are connected to the hotel fire alarm system? (if the whole building is under control of the hotel, select N/A).</td>
    <td style="width:100px;">';
	$form_157  =  $id_157;  
	$print_form = $print_form.$form_157;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.50</td>
    <td style="width:550px;" >Is there an entertainment area within the building (Disco, Nightclub, Casino, Ballroom)?</td>
    <td style="width:100px;">';
	$form_158  =  $id_158;  
	$print_form = $print_form.$form_158;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.51</td>
    <td style="width:550px;" >If there is an entertainment area, are there suitable and sufficient emergency exits from these areas if the room is full? (if there is no entertainment area, select N/A)</td>
    <td style="width:100px;">';
	$form_159  =  $id_159;  
	$print_form = $print_form.$form_159;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.52</td>
    <td style="width:550px;" >If there is an entertainment area is it:</td>
    <td style="width:100px;">';
	$form_160  =  $id_160;  
	$print_form = $print_form.$form_160;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.53</td>
    <td style="width:550px;">In case there´s an entertainment area, is this area connected to the fire alarm system? (if there is no entertainment area, select N/A)</td>
    <td style="width:100px;">';
	$form_161  =  $id_161;  
	$print_form = $print_form.$form_161;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">2.54</td>
    <td style="width:550px;" >Is there any clarification or further information you would like to provide?</td>
    <td style="width:100px;">';
	$form_162  =  $id_162;  
	$print_form = $print_form.$form_162;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>3 - Health Procedures</b></td>
 </tr>
 <tr>
    <td style="width:30px;">3.1</td>
    <td style="width:550px;" >Does the hotel have a kitchen/ a restaurant?</td>
    <td style="width:100px;">';
	$form_21  =  $id_21;  
	$print_form = $print_form.$form_21;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.2</td>
    <td style="width:550px;" >Do you have food safety management programme in place HACCP or similar?</td>
    <td style="width:100px;">';
	$form_22  =  $id_22;  
	$print_form = $print_form.$form_22;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.3</td>
    <td style="width:550px;">Who is responsible for food safety management procedures (HACCP or FDA approved procedures or similar based system)?</td>
    <td style="width:100px;">';
	$form_23  =  $id_23;  
	$print_form = $print_form.$form_23;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.4</td>
    <td style="width:550px;" >Do you carry out and record annual training on hygiene for your staff?</td>
    <td style="width:100px;">';
	$form_24  =  $id_24;  
	$print_form = $print_form.$form_24;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.5</td>
    <td style="width:550px;" >Do you keep records of temperatures for the storage, cooking and service of foods?</td>
    <td style="width:100px;">';
	$form_25  =  $id_25;  
	$print_form = $print_form.$form_25;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.6</td>
    <td style="width:550px;" >For buffet/self-service food is it left on display for:</td>
    <td style="width:100px;">';
	$form_26  =  $id_26;  
	$print_form = $print_form.$form_26;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Food safety procedures</b></td>
 </tr>
 <tr>
    <td style="width:30px;">3.7</td>
    <td style="width:550px;" >Do you have a written cleaning programme?</td>
    <td style="width:100px;">';
	$form_27  =  $id_27;  
	$print_form = $print_form.$form_27;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.8</td>
    <td style="width:550px;" >In all food preparation areas are there separate hand washing basins with hot and cold water, soap and hand drying facilities?</td>
    <td style="width:100px;">';
	$form_28  =  $id_28;  
	$print_form = $print_form.$form_28;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.9</td>
    <td style="width:550px;" >Is separate storage and refrigeration used for raw & cooked foods?</td>
    <td style="width:100px;">';
	$form_29  =  $id_29;  
	$print_form = $print_form.$form_29;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.10</td>
    <td style="width:550px;" >Are separate utensils and cutting surfaces used for raw & cooked foods?</td>
    <td style="width:100px;">';
	$form_210  =  $id_210;  
	$print_form = $print_form.$form_210;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.11</td>
    <td style="width:550px;" >Are there separate washing facilities for food utensils & equipment?</td>
    <td style="width:100px;">';
	$form_211  =  $id_211;  
	$print_form = $print_form.$form_211;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.12</td>
    <td style="width:550px;" >Is waste removed from the kitchen regularly and collected daily?</td>
    <td style="width:100px;">';
	$form_212  =  $id_212;  
	$print_form = $print_form.$form_212;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.13</td>
    <td style="width:550px;" >Are there separate changing rooms, toilets and hand washing facilities for staff?</td>
    <td style="width:100px;">';
	$form_213  =  $id_213;  
	$print_form = $print_form.$form_213;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.14</td>
    <td style="width:550px;" >Do you have reporting procedures for staff illnesses?</td>
    <td style="width:100px;">';
	$form_214  =  $id_214;  
	$print_form = $print_form.$form_214;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.15</td>
    <td style="width:550px;" >Do you use the services of an independent pest control company?</td>
    <td style="width:100px;">';
	$form_215  =  $id_215;  
	$print_form = $print_form.$form_215;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Illness Management</b></td>
 </tr>
 <tr>
    <td style="width:30px;">3.16</td>
    <td style="width:550px;" >Do you have a written programme for the management of gastrointestinal illness in your property?</td>
    <td style="width:100px;">';
	$form_216  =  $id_216;  
	$print_form = $print_form.$form_216;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.17</td>
    <td style="width:550px;" >Are all relevant staff trained in the procedures for the control of gastrointestinal illness in your property</td>
    <td style="width:100px;">';
	$form_217  =  $id_217;  
	$print_form = $print_form.$form_217;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Water Hygiene</b></td>
 </tr>
 <tr>
    <td style="width:30px;">3.18</td>
    <td style="width:550px;" >Do you have a designated person ensuring the safety of your water systems in your property?</td>
    <td style="width:100px;">';
	$form_218  =  $id_218;  
	$print_form = $print_form.$form_218;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.19</td>
    <td style="width:550px;" >Do you carry out and record regular water testing and treatment of the water in your property?</td>
    <td style="width:100px;">';
	$form_219  =  $id_219;  
	$print_form = $print_form.$form_219;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.20</td>
    <td style="width:550px;" >Do you carry out programmed controls for Legionella in your property?</td>
    <td style="width:100px;">';
	$form_220  =  $id_220;  
	$print_form = $print_form.$form_220;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.21</td>
    <td style="width:550px;" >Do you keep records for the control of Legionella in the property?</td>
    <td style="width:100px;">';
	$form_221  =  $id_221;  
	$print_form = $print_form.$form_221;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3.22</td>
    <td style="width:550px;" >When do you take lab samples for Legionella testing?</td>
    <td style="width:100px;">';
	$form_222  =  $id_222;  
	$print_form = $print_form.$form_222;
	$print_form = $print_form .'</td>
  </tr>
<!--   <tr>
    <td style="width:30px;">3.23</td>
    <td style="width:550px;" >Write the last date when you took water samples for Legionella testing. (or write "NEVER")</td>
    <td style="width:100px;">';
	$form_223  =  $id_223;  
	$print_form = $print_form.$form_223;
	$print_form = $print_form .'</td>
  </tr> -->
  <tr>
    <td style="width:30px;">3.24</td>
    <td style="width:550px;" >Is there any clarification or further information you would like to provide?</td>
    <td style="width:100px;">';
	$form_224  =  $id_224;  
	$print_form = $print_form.$form_224;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>4 - Pool safety design</b></td>
 </tr>
 <tr>
    <td style="width:30px;">4.1</td>
    <td style="width:550px;" >Does the hotel have a swimming pool? (if you answer "no", select N/A in all other questions of this section)</td>
    <td style="width:100px;">';
	$form_31  =  $id_31;  
	$print_form = $print_form.$form_31;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.2</td>
    <td style="width:550px;" >How many pools are there?</td>
    <td style="width:100px;">';
	$form_32  =  $id_32;  
	$print_form = $print_form.$form_32;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.3</td>
    <td style="width:550px;" >Does your property have a waterpark or area with slides and flumes etc.?</td>
    <td style="width:100px;">';
	$form_33 =  $id_33;  
	$print_form = $print_form.$form_33;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.4</td>
    <td style="width:550px;" >Is there a designated children’s pool?</td>
    <td style="width:100px;">';
	$form_34 =  $id_34;  
	$print_form = $print_form.$form_34;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.5</td>
    <td style="width:550px;">Is there at least a 3m (10´-0´) separation from any other adult pool or a fixed barrier between the children’s and adult pool of at least 80cm (30´) in height?</td>
    <td style="width:100px;">';
	$form_35 =  $id_35;  
	$print_form = $print_form.$form_35;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.6</td>
    <td style="width:550px;">Is there a prominently displayed sign by the pool stating the opening times, emergency procedures, children must be supervised and no night swimming?</td>
    <td style="width:100px;">';
	$form_36 =  $id_36;  
	$print_form = $print_form.$form_36;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.7</td>
    <td style="width:550px;" >Are there sufficient visible and accurate depth markings at 3m (10´-0´) intervals?</td>
    <td style="width:100px;">';
	$form_37 =  $id_37;  
	$print_form = $print_form.$form_37;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.8</td>
    <td style="width:550px;" >Are there sufficient prominently displayed "No Diving" signs visible from any point around the pool?</td>
    <td style="width:100px;">';
	$form_38 =  $id_38;  
	$print_form = $print_form.$form_38;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.9</td>
    <td style="width:550px;" >Is there a sign prominently displayed if a lifeguard is on duty or not?</td>
    <td style="width:100px;">';
	$form_39 =  $id_39;  
	$print_form = $print_form.$form_39;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.10</td>
    <td style="width:550px;" >Does your pool have any sudden changes of depth?</td>
    <td style="width:100px;">';
	$form_310 =  $id_310;  
	$print_form = $print_form.$form_310;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.11</td>
    <td style="width:550px;" >Does your pool have any underwater walls or ledges below the surface?</td>
    <td style="width:100px;">';
	$form_311 =  $id_311;  
	$print_form = $print_form.$form_311;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.12</td>
    <td style="width:550px;" >Does your pool have any decorative rocks islands or other raised features?</td>
    <td style="width:100px;">';
	$form_312 =  $id_312;  
	$print_form = $print_form.$form_312;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.13</td>
    <td style="width:550px;" >Regarding drainages, all whirlpools / spa pools / swimming pools in the property have, at least:</td>
    <td style="width:100px;">';
	$form_313 =  $id_313;  
	$print_form = $print_form.$form_313;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Pool safety procedures</b></td>
 </tr>
 <tr>
    <td style="width:30px;">4.14</td>
    <td style="width:550px;" >Is there sufficient lifesaving equipment by the pool?</td>
    <td style="width:100px;">';
	$form_314 =  $id_314;  
	$print_form = $print_form.$form_314;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.15</td>
    <td style="width:550px;" >Is there a member of staff trained in First Aid & Resuscitation?</td>
    <td style="width:100px;">';
	$form_315 =  $id_315;  
	$print_form = $print_form.$form_315;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.16</td>
    <td style="width:550px;" >Do you carry out and record the levels of chlorine and pH every day?</td>
    <td style="width:100px;">';
	$form_316 =  $id_316;  
	$print_form = $print_form.$form_316;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.17</td>
    <td style="width:550px;" >Do you inspect your pool daily for any cracked or broken tiles damaged surround etc. that could cause trips and falls?</td>
    <td style="width:100px;">';
	$form_317 =  $id_317;  
	$print_form = $print_form.$form_317;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4.18</td>
    <td style="width:550px;" >Do you have procedures in place for pool contamination (Blood, Vomit & Faecal Matter)?</td>
    <td style="width:100px;">';
	$form_318 =  $id_318;  
	$print_form = $print_form.$form_318;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>More information</b></td>
 </tr>
 <tr>
    <td style="width:30px;">4.19</td>
    <td style="width:550px;" >Is there any clarification or further information you would like to provide?</td>
    <td style="width:100px;">';
	$form_319 =  $id_319;  
	$print_form = $print_form.$form_319;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>5 - General safety</b></td>
 </tr>
 <tr>
    <td style="width:30px;">5.1</td>
    <td style="width:550px;" >Do you carry out any internal inspection or have external health and safety checks of the hotel and are these recorded?</td>
    <td style="width:100px;">';
	$form_41 =  $id_41;  
	$print_form = $print_form.$form_41;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5.2</td>
    <td style="width:550px;" >Are there visible stickers at adult and child height on any full height glass and terrace doors?</td>
    <td style="width:100px;">';
	$form_42 =  $id_42;  
	$print_form = $print_form.$form_42;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.3</td>
    <td style="width:550px;" >Do you have Murphy beds in the accommodation?</td>
    <td style="width:100px;">';
	$form_43 =  $id_43;  
	$print_form = $print_form.$form_43;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5.4</td>
    <td style="width:550px;" >Do all stairs with more than 4 steps have a suitable handrail?</td>
    <td style="width:100px;">';
	$form_44 =  $id_44;  
	$print_form = $print_form.$form_44;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.5</td>
    <td style="width:550px;">Does the bathroom include a warning signal for the slippery surfaces and not to use any electrical appliances near water?</td>
    <td style="width:100px;">';
	$form_45 =  $id_45;  
	$print_form = $print_form.$form_45;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5.6</td>
    <td style="width:550px;" >Are all lifts fitted with internal closing doors?</td>
    <td style="width:100px;">';
	$form_46 =  $id_46;  
	$print_form = $print_form.$form_46;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Balconies</b></td>
 </tr>
 <tr>
    <td style="width:30px;">5.7</td>
    <td style="width:550px;" >Do guestrooms have balconies? (If the guestrooms do not have balconies, select N/A in questions 4.8 and 4.9)</td>
    <td style="width:100px;">';
	$form_47 =  $id_47;  
	$print_form = $print_form.$form_47;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.8</td>
    <td style="width:550px;" >What is the height of the balcony guardrails?</td>
    <td style="width:100px;">';
	$form_48 =  $id_48;  
	$print_form = $print_form.$form_48;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5.9</td>
    <td style="width:550px;">Are there any gaps more than 10 cm (4´) wide in the balcony guardrails that could allow a child to pass through or climb up?</td>
    <td style="width:100px;">';
	$form_49 =  $id_49;  
	$print_form = $print_form.$form_49;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Gas safety</b></td>
 </tr>
 <tr>
    <td style="width:30px;">5.10</td>
    <td style="width:550px;" >Is there a single gas water heater / boiler located within the guest room or villas or adjacent to the guest room?</td>
    <td style="width:100px;">';
	$form_410 =  $id_410;  
	$print_form = $print_form.$form_410;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5.11</td>
    <td style="width:550px;" >In case you have answered YES in the previous question 5.10, What type of gas water heaters do you have?</td>
    <td style="width:100px;">';
	$form_411 =  $id_411;  
	$print_form = $print_form.$form_411;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.12</td>
    <td style="width:550px;">Is there any guest rooms or apartments directly or indirectly connected with GAS water heaters/boilers located within the main building OUTSIDE the main building?</td>
    <td style="width:100px;">';
	$form_412 =  $id_412;  
	$print_form = $print_form.$form_412;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.13</td>
    <td style="width:550px;">(In case you answered "Yes" in previous question 5.12) Are both the gas water heater/boiler and the flue termination point 1.5 metres or further away from the nearest door, window, vent, hole or other opening into the accommodation?</td>
    <td style="width:100px;">';
	$form_413 =  $id_413;  
	$print_form = $print_form.$form_413;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.14</td>
    <td style="width:550px;" >Please provide details about the location and safety measures in place. In case you don´t have gas appliances, write "No gas appliances available".</td>
    <td style="width:100px;">';
	$form_414 =  $id_414;  
	$print_form = $print_form.$form_414;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.15</td>
    <td style="width:550px;">For any gas appliance are they inspected and maintained at least annually by a competent engineer (if there are no gas appliances, select N/A)</td>
    <td style="width:100px;">';
	$form_415 =  $id_415;  
	$print_form = $print_form.$form_415;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5.16</td>
    <td style="width:550px;" >For all gas appliances do you have current maintenance and safety certificates for the equipment (if there are no gas appliances, select N/A)</td>
    <td style="width:100px;">';
	$form_416 =  $id_416;  
	$print_form = $print_form.$form_416;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.17</td>
    <td style="width:550px;" >Are Carbon Monoxide detectors fitted in all Gas water heater / boiler rooms?</td>
    <td style="width:100px;">';
	$form_417 =  $id_417;  
	$print_form = $print_form.$form_417;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Electrical Safety</b></td>
 </tr>
 <tr>
    <td style="width:30px;">5.18</td>
    <td style="width:550px;" >Are all electrical fittings maintained on a regular basis?</td>
    <td style="width:100px;">';
    $form_418 =  $id_418;  
	$print_form = $print_form.$form_418;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.19</td>
    <td style="width:550px;" >Does the property have safety plug protectors available for guests?</td>
    <td style="width:100px;">';
	$form_419 =  $id_419;  
	$print_form = $print_form.$form_419;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Kid’s Club</b></td>
 </tr>
 <tr>
    <td style="width:30px;">5.20</td>
    <td style="width:550px;" >Does the property have a designated children´s club?</td>
    <td style="width:100px;">';
	$form_420 =  $id_420;  
	$print_form = $print_form.$form_420;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.21</td>
    <td style="width:550px;" >Does the property have a designated play area and play equipment for children?</td>
    <td style="width:100px;">';
	$form_421 =  $id_421;  
	$print_form = $print_form.$form_421;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.22</td>
    <td style="width:550px;" >Are all children´s play areas and equipment inspected regularly for safety and security?</td>
    <td style="width:100px;">';
	$form_422 =  $id_422;  
	$print_form = $print_form.$form_422;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Beach Safety</b></td>
 </tr>
 <tr>
    <td style="width:30px;">5.23</td>
    <td style="width:550px;" >Does you property have direct access to the beach?</td>
    <td style="width:100px;">';
	$form_423 =  $id_423;  
	$print_form = $print_form.$form_423;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5.24</td>
    <td style="width:550px;" >Does the beach have a "Flag" Warning System?</td>
    <td style="width:100px;">';
	$form_424 =  $id_424;  
	$print_form = $print_form.$form_424;
	$print_form = $print_form .'</td>
  </tr>
<tr>
    <td style="width:30px;">5.25</td>
    <td style="width:550px;" >Are there sufficient prominently displayed signs detailing beach/water safety?</td>
    <td style="width:100px;">';
	$form_425 =  $id_425;  
	$print_form = $print_form.$form_425;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Security</b></td>
 </tr>
 <tr>
    <td style="width:30px;">5.26</td>
    <td style="width:550px;" >Are all security incidents reported logged and investigated?</td>
    <td style="width:100px;">';
	$form_426 =  $id_426;  
	$print_form = $print_form.$form_426;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5.27</td>
    <td style="width:550px;" >Do you have an incident / crisis response plan and procedures in place?</td>
    <td style="width:100px;">';
	$form_427 =  $id_427;  
	$print_form = $print_form.$form_427;
	$print_form = $print_form .'</td>
  </tr>
<tr>
    <td style="width:30px;">5.28</td>
    <td style="width:550px;" >Are there arrangements in place to ensure the security of guests i.e. CCTV, safe boxes in rooms, control access to customer room keys, etc.?</td>
    <td style="width:100px;">';
	$form_428 =  $id_428;  
	$print_form = $print_form.$form_428;
	$print_form = $print_form .'</td>
  </tr>
<tr>
    <td style="width:30px;">5.29</td>
    <td style="width:550px;" >Are guards / security personnel or 24 hour staffing provided?</td>
    <td style="width:100px;">';
	$form_429 =  $id_429;  
	$print_form = $print_form.$form_429;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Transport</b></td>
 </tr>
<tr>
    <td style="width:30px;">5.30</td>
    <td style="width:550px;" >Do you offer a transport service to customers? Airport transfer/shuttle bus etc.</td>
    <td style="width:100px;">';
	$form_430 =  $id_430;  
	$print_form = $print_form.$form_430;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5.31</td>
    <td style="width:550px;" >Are all vehicles regularly maintained and have all relevant licences and insurances?</td>
    <td style="width:100px;">';
	$form_431 =  $id_431;  
	$print_form = $print_form.$form_431;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.32</td>
    <td style="width:550px;" >Do all drivers of company vehicles hold up to date licences and insurances for the vehicles they drive</td>
    <td style="width:100px;">';
	$form_432 =  $id_432;  
	$print_form = $print_form.$form_432;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">5.33</td>
    <td style="width:550px;" >Is there any clarification or further information you would like to provide?</td>
    <td style="width:100px;">';
	$form_433 =  $id_433;  
	$print_form = $print_form.$form_433;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Commitment</b></td>
 </tr>
 <tr>
    <td style="width:30px;"> 1</td>
    <td style="width:550px;" >I declare that I have read and understood all questions and that I am authorised to complete the questionnaire on behalf of the organisation.</td>
    <td style="width:100px;"></td>
 </tr>
 <tr>
    <td colspan="3" bgcolor="#e8e8ea" ><b>Signature</b></td>
 </tr>
 <tr>
    <td style="width:30px;"> 2</td>
    <td style="width:550px;" >Completed by (write your name)</td>
    <td style="width:100px;">';
	$form_52 =  $id_52;  
	$print_form = $print_form.$form_52;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">3</td>
    <td style="width:550px;" >Write your email</td>
    <td style="width:100px;">';
	$form_53 =  $id_53;  
	$print_form = $print_form.$form_53;
	$print_form = $print_form .'</td>
  </tr>
  <tr>
    <td style="width:30px;">4</td>
    <td style="width:550px;" >Position (specify your job)</td>
    <td style="width:100px;">';
	$form_54 =  $id_54;  
	$print_form = $print_form.$form_54;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">5</td>
    <td style="width:550px;" >Date (today´s date)</td>
    <td style="width:100px;">';
	$form_55 =  $id_55;  
	$print_form = $print_form.$form_55;
	$print_form = $print_form .'</td>
  </tr>
 <tr>
    <td style="width:30px;">&nbsp;</td>
    <td style="width:550px;" >&nbsp;</td>
    <td style="width:100px;"></td>
  </tr>	 
</table>
 </body>
</html>';

 
  
  
 echo $print_form;





