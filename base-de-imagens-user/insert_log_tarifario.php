<?php

$ano = date("Y");
$mes = date("m");
$dia =  date("d");
$hora =  date("H");
$min =  date("i");
$seg =  date("s");
$data_now =  $ano.'-'.$mes.'-'.$dia.' '.$hora.':'.$min.':'.$seg;

$browser =   $_SERVER['HTTP_USER_AGENT'];
$ip =   $_SERVER['REMOTE_ADDR'];
$origem = $_SERVER["HTTP_REFERER"];
$server_name = $_SERVER['SERVER_NAME'];
$remote_host = $_SERVER['REMOTE_ADDR'];



$insere_log_acesso=" INSERT INTO  tarifario.log_acesso_tarifario
                  (
                    fk_cad_cli,
				    dt_acesso,
				    area,
				    ip,
				    origem,
				    browser,
				    server_name,
				    remote_host,
				    addcont
                  )
                  VALUES 
                  (
                   '$user',
				   '$data_now',
				   '$area',
				   '$ip',
				   '$origem',
				   '$browser',
				   '$server_name',
				   '$remote_host',
				   '$complemento'
                  )  ";
                  
     	 pg_query($conn, $insere_log_acesso);              
                  ?>