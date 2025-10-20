<?php 

// require our parent class. 
require_once('class_base.php'); 

class getlogera extends base { 
 
   
   
    var $tipo_tar = '';
    var $pk_tarifario = 0;
    var $usuario = '';
    var $pk_log_geracao_tarifario = '';
    var $data_criacao = ''; 
    
    function __construct($pk_tarifario=0) { 
        $this->SetupDB(); 
        if ($pk_tarifario > 0) { 
            $this->Load($pk_tarifario); 
        } 
    } 

   
    function getinfotar($pk_tarifario=0) { 
        $this->__construct($pk_tarifario); 
    } 

   
    
    function Load($pk_tarifario=0, $tipo_tar=0) { 
      
     
          $query = "SELECT 
							usuario, 
							to_char (log_geracao_tarifario.data_criacao, 'DD/MM/YYYY') as data_criacao, 
							pk_log_geracao_tarifario, 
							fk_tarifario
							
					   FROM 
							tarifario.log_geracao_tarifario
					   WHERE
							fk_tarifario = $pk_tarifario
							AND fk_tarifario_tipo = $tipo_tar
							AND fk_tarifario_grupo = 1
							AND data_criacao = (select max(data_criacao) 
												from tarifario.log_geracao_tarifario 
											   where fk_tarifario = $pk_tarifario
											   AND fk_tarifario_tipo = $tipo_tar
											   AND fk_tarifario_grupo = 1) ";
          $result = pg_query($query); 
          if ($result) {
               for ($row = 0; $row < pg_numrows($result); $row++) {
        
                  $this->usuario = htmlentities(pg_result($result, $row, 'usuario')); 
                  $this->data_criacao = htmlentities(pg_result($result, $row, 'data_criacao')); 
                  $this->pk_log_geracao_tarifario = htmlentities(pg_result($result, $row, 'pk_log_geracao_tarifario'));
                  
                } 

          }
 
            $this->record = pg_numrows($result); 
             return true; 
    }
    
     
} 

?> 