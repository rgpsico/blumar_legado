<?php 
require_once '../util/connection.php';


ini_set('display_errors', 1);
error_reporting(~0);

$pk_cid_filtro_arr  =  $_POST["cod_cid_filtro_arr"];


//echo is_array($pk_cid_filtro_arr) ? 'Array' : 'not an Array';

//echo count($pk_cid_filtro_arr);
 
 $result = (is_array($pk_cid_filtro_arr) ? count($pk_cid_filtro_arr) : 0); 

//echo $result;


 for ($rowvf = 0; $rowvf <  $result ; $rowvf++) 
 {


if ($pk_cid_filtro_arr[$rowvf]  != '0' )
    {  


        $query_selected_cid  = "
        select 
            pk_cidade_tpo, 
            nome_pt, 
            nome_en, 
           cidade_cod, 
           tpocidcod 
        from 
            tarifario.cidade_tpo
        where  
          cidade_cod = '$pk_cid_filtro_arr[$rowvf]'";

          $result_cid_escolhida = pg_exec($conn, $query_selected_cid);

        for ($rowcid1 = 0; $rowcid1 < pg_numrows($result_cid_escolhida); $rowcid1++) {
            $nome_cid = pg_result($result_cid_escolhida, $rowcid1, 'nome_en');
            $cidade_cod = pg_result($result_cid_escolhida, $rowcid1, 'cidade_cod');
             
            $cidade_escolhida = '<option value="'.$cidade_cod.'" selected>'.$nome_cid.'</option>' ;
         
        }




        $query_cidade = "
        select 
            pk_cidade_tpo, 
            nome_pt, 
            nome_en, 
           cidade_cod, 
           tpocidcod 
        from 
            tarifario.cidade_tpo
        order by 
            nome_en";
       
            echo'
       
            <select id="cid_filtro"  name="cid_filtro[]"    >
            <option value="0"  >Escolha uma cidade </option>
            ';
            echo $cidade_escolhida;


            $result_cid = pg_exec($conn, $query_cidade);
            if ($result_cid) {
                for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++) {
                    $nome_cid = pg_result($result_cid, $rowcid, 'nome_en');
                    $cidade_cod = pg_result($result_cid, $rowcid, 'cidade_cod');
                     
                    echo '<option value="'.$cidade_cod.'">'.$nome_cid.'</option>' ;
                 
                }
            }
            
            echo'
            
            </select>  <a href="javascript:add_filtro_cid();"><b>+ add >></b></a><br> ';


      }







 //echo   $pk_cid_filtro_arr[$rowvf];

  
 }



  














 $query_cidade = "
 select 
 	pk_cidade_tpo, 
 	nome_pt, 
 	nome_en, 
	cidade_cod, 
	tpocidcod 
 from 
 	tarifario.cidade_tpo
 order by 
 	nome_en";

     echo'

     <select id="cid_filtro"  name="cid_filtro[]"    >
     <option value="0" selected>Escolha uma cidade </option>
     ';
     
     $result_cid = pg_exec($conn, $query_cidade);
     if ($result_cid) {
         for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++) {
             $nome_cid = pg_result($result_cid, $rowcid, 'nome_en');
             $cidade_cod = pg_result($result_cid, $rowcid, 'cidade_cod');
              
             echo '<option value="'.$cidade_cod.'">'.$nome_cid.'</option>' ;
          
         }
     }
     
     echo'
     
     </select>  <a href="javascript:add_filtro_cid();"><b>+ add >></b></a> ';


