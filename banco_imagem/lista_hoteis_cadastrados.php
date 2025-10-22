<?php



ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

$arquivo = 'planilha_hoteis.xls';

$html = '';
$html .= '<table border="1">';


//script para hoteis
$pathhtl = "/var/www/wwwinternet/bancoimagemfotos/hotel";
$htls = scandir($pathhtl);
$numhtl = count($htls);
 
for ($rowh = 0; $rowh < $numhtl ; $rowh++) {
	if($htls[$rowh] != '.' && $htls[$rowh] != '..' && $htls[$rowh] != 'blank.gif'  && $htls[$rowh] != 'thumbs.db')
	{

		
	 
		
		$pathhtls = "/var/www/wwwinternet/bancoimagemfotos/hotel/".$htls[$rowh];
		$dirhtls = scandir($pathhtls);
		$numhtls = count($dirhtls);
		
		
		
		if($numhtls != 0)
		{
			$html .= '<tr><td><font size="1" face="arial"><b></b></font></td><td></td></tr>';
			$html .= '<tr><td><font size="1" face="arial"><b>'.strtoupper($htls[$rowh]).'</b></font></td><td></td></tr>';
			 
			
		for ($row  = 0; $row  < $numhtls ; $row++) 
		  {
			  	if($dirhtls[$row] != '.' && $dirhtls[$row] != '..' && $dirhtls[$row] != 'blank.gif'  && $dirhtls[$row] != 'thumbs.db')
			  	{ 
			  	  
			  		$pathpics = $pathhtls.'/'.$dirhtls[$row].'/';
			  		$data_modificado = date ("F d Y H:i:s.", filemtime($pathpics));
			  		
			  		$html .= '<tr><td><font size="1" face="arial">'.$dirhtls[$row].'</font></td><td>'.$data_modificado.'</td></tr>';
			  	 }
		  }
		}  
	 }
}

$html .= '</table>';

// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel; charset=utf-8");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );



// Envia o conteúdo do arquivo
echo $html;
 



