<?php 


require_once '../util/connection.php';


ini_set('display_errors', 1);
error_reporting(~0);

$pk_abt_destinos =  $_POST["pk_abt_destinos"];


$pk_abt =  $_POST["pk_abt"];

 //echo $pk_abt.' | '.$pk_abt_destinos;



 $apaga_cid = " delete from conteudo_internet.abt_destinos where pk_abt_destinos = $pk_abt_destinos  ";
 pg_query($conn,$apaga_cid);





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
 
 
 $selected_cities='<select id="cid_filtro"  name="cid_filtro[]"    >';
 
 $selected_cities3='<option value="0"  >Escolha uma cidade </option>';
 $selected_cities4='';
 
 $result_cid2 = pg_exec($conn, $query_cidade);
 if ($result_cid2) {
     for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_cid2); $rowcid2++) {
         $nome_cid = pg_result($result_cid2, $rowcid2, 'nome_en');
         $cidade_cod = pg_result($result_cid2, $rowcid2, 'cidade_cod');
          
         $selected_cities4=$selected_cities4.'<option value="'.$cidade_cod.'">'.$nome_cid.'</option>' ;
      
     }
 }
 
 
 
 $dump_selecionadas='';
 $dump_selecionadas2='';
 
 $query_cidades_filtro = "
 select 
    fk_cidade_cod,
    pk_abt_destinos
 from 
    conteudo_internet.abt_destinos
 where fk_abt = $pk_abt ";
 $result_cidades_filtro = pg_exec($conn, $query_cidades_filtro);
 
// echo pg_numrows($result_cidades_filtro);
 
 if (pg_numrows($result_cidades_filtro) != 0) 
                 {
 
               
 
                     for ($rowcid1 = 0; $rowcid1 < pg_numrows($result_cidades_filtro); $rowcid1++) {
 
 
                         $fk_cidade_cod = pg_result($result_cidades_filtro, $rowcid1, 'fk_cidade_cod');
                         $pk_abt_destinos = pg_result($result_cidades_filtro, $rowcid1, 'pk_abt_destinos');
 
                        // echo $fk_cidade_cod.'-';
 
                         $dump_selecionadas =  $dump_selecionadas.$selected_cities;
 
 
                         $query_uma_cidade_filtro = "
                         select 
                            pk_cidade_tpo, 
                            nome_pt, 
                            nome_en, 
                            cidade_cod, 
                            tpocidcod 
                         from 
                            tarifario.cidade_tpo
                         order by 
                            cidade_cod = $fk_cidade_cod";
 
                            $result_uma_cidade_filtro = pg_exec($conn, $query_uma_cidade_filtro);
 
                                     for ($rowcid4 = 0; $rowcid4 < pg_numrows($result_uma_cidade_filtro); $rowcid4++)
                                         {
                                         $nome_ucid1 = pg_result($result_uma_cidade_filtro, $rowcid4, 'nome_en');
                                         $cidade_ucod1 = pg_result($result_uma_cidade_filtro, $rowcid4, 'cidade_cod');
                                         
                                         $selected_cities2='<option value="'.$cidade_ucod1.'" selected>'.$nome_ucid1.'</option>' ;
                                     
                                         }
 
 
                         $selected_cities5='</select><a href="javascript:alt_filtro_cid();"><b>+ add </b></a> | <a href="##" class="pkremcid" title="remover cidade"><input type="hidden" class="pkremcidvalue" value="'.$pk_abt_destinos.'"> <b>- Remove </b></a>  <br>';
 
 
 
                         $dump_selecionadas =  $dump_selecionadas.$selected_cities2.$selected_cities3.$selected_cities4.$selected_cities5;
 
                                              
                          
                      
                     }
                 }
 
 
 
 
 
 
echo $dump_selecionadas;
 




















