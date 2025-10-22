<?php
 
 ini_set('display_errors', 1);
 error_reporting(~0);
 If (isSet($_SESSION)) {} else {session_start();} 
 require('util/connection.php'); 
 
  // $lista_images_download = $_SESSION["lista_images_download"];

  $ano = date("Y");
  $mes = date("m");
  $dia =  date("d");
  $hora =  date("H");
  $min =  date("i");
  $seconds =  date("s");
  $filename =  'blumar-image-bank-download'.$ano.$mes.$dia.$hora.$min.$seconds.'.zip';

 //  $image1 = "http://cdn.screenrant.com/wp-content/uploads/Darth-Vader-voiced-by-Arnold-Schwarzenegger.jpg";
//$image2 = "http://cdn.screenrant.com/wp-content/uploads/Star-Wars-Logo-Art.jpg";

$files =  $_SESSION["lista_images_download"];

$tmpFile = tempnam('/tmp', '');

$zip = new  ZipArchive();
$zip->open($tmpFile, ZipArchive::CREATE);
foreach ($files as $file) {
    // download file
    $fileContent = file_get_contents($file);

    $zip->addFromString(basename($file), $fileContent);
    echo $file.'<br>';
}

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header("Content-Type: application/zip");
header("Content-Transfer-Encoding: binary");
header("Content-length: ".filesize($filename)."");
header ("Content-Disposition: attachment; filename=\"{$filename}\"" );
header ("Content-Description: PHP Generated Data" );
 //readfile($tmpFile);
echo 'filename='.$filename.'';
$zip->close();
unlink($tmpFile);



echo "<br>downloading";




