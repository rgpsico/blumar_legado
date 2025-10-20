                        <?php
                        
                        
                        if(session_id() == '') {
                        	session_start();
                        }
                        
                        
                        require_once '../util/connection.php';
                        
                        $update_apto = 0;
                        
                        $frncod = pg_escape_string($_POST["frncod"]);
                        $pk_aptcod = pg_escape_string($_POST["pk_aptcod"]);
                        $categ = pg_escape_string($_POST["categ"]);
                        $loc = pg_escape_string($_POST["loc"]);
                        $qtd = pg_escape_string($_POST["qtd"]);
                        $foto = pg_escape_string($_POST["foto"]);
                        
                        
                        $array_pk_aptcod = explode(',', $pk_aptcod);
                        $array_pk_categ = explode(',', $categ);
                        $array_pk_loc = explode(',', $loc);
                        $array_pk_qtd = explode(',', $qtd);
                        $array_pk_foto = explode(',', $foto);
                        
                         
                        
                        for($i = 0; $i < count($array_pk_aptcod); $i++) {
                        	
                        	if (strlen($array_pk_categ[$i]) != '0')
                        	{
                        		$sql = "
                        		update
                        			conteudo_internet.ci_apartamento
                        		set
                        		    aptocatcod =  '$array_pk_categ[$i]',
                        		    aptoloccod =  '$array_pk_loc[$i]',
                        		    aptqtd =  '$array_pk_qtd[$i]',
                        		    aptoimgfoto =  '$array_pk_foto[$i]'
                        		where
		    	                	pk_aptcod = '$array_pk_aptcod[$i]'
								 ";
								pg_query($conn, $sql);	
                        	 
                        	}
                        }
                        
                        
                        
                        
                        $pk_acesso = $_SESSION['user'];
                        
                        //crio a data now
                        $ano = date("Y");
                        $mes = date("m");
                        $dia =  date("d");
                        $data_now =  $ano . '-' . $mes . '-' . $dia;
                        
                        
                        
                        $query_log =
                        "
                        INSERT INTO
                        conteudo_internet.log_adm_conteudo
                        (
                        usuario,
                        acao,
                        data,
                        fk_conteudo
                        )
                        values
                        (
                        '$pk_acesso',
                        'Atualizou apartamentos do hotel - $frncod ',
                        '$data_now',
                        '2'
                        )
                        ";
                        pg_query($conn, $query_log);
                        
                        
                        
                        
                        
                        
                        echo "<hr>" ;
                        echo "APARTAMENTOS ATUALIZADOS COM SUCESSO!!" ;
                        echo "<hr>" ;
                        
                        require_once 'altera_hotel.php';
                         
                        
                        ?>