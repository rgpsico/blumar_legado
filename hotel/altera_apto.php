
                      <div id="box6">ALTERA&Ccedil;&Atilde;O de APARTAMENTOS J&Aacute; CADASTRADOS</div>
               
               
               
                        <?php
                        
                        require_once '../util/connection.php';
                        
                        $frncod = pg_escape_string($_POST["frncod"]);
                        
                        
                        //query para pegar os apartamentos cadastrados
                                 $query_aptos =
								    "
										SELECT
											frncod,
                                            aptocatcod,
                                            aptoimgfoto,
                                            aptqtd,
                                            aptoloccod,
                                            pk_aptcod
                                         FROM 
											conteudo_internet.ci_apartamento
										 where 
										     frncod = 	$frncod
										 order by     
											 pk_aptcod	
								     ";
								
									$result_aptos = pg_exec($conn, $query_aptos);
									if ($result_aptos) {
									for ($rowapto = 0; $rowapto < pg_numrows($result_aptos); $rowapto++) {
											
										     $aptocatcod = pg_result($result_aptos, $rowapto, 'aptocatcod');
										     $aptoimgfoto = pg_result($result_aptos, $rowapto, 'aptoimgfoto');
										     $aptqtd = pg_result($result_aptos, $rowapto, 'aptqtd');
										     $aptoloccod = pg_result($result_aptos, $rowapto, 'aptoloccod');
										     $pk_aptcod = pg_result($result_aptos, $rowapto, 'pk_aptcod');
										     
										     echo ' 
										     <div id="box13">
										     <div id="aptcod"><input type="hidden" name="pk_aptcod" id="pk_aptcod"  value="'.$pk_aptcod.'"  ></div>
											 <div id="box14apto">
											 
														categoria <br>
										     <select name="categ" id="categ"  > 
										     ';
										                 // query para pegar o descritivo da categoria cadastrada
														     $query_aptocateg =
														     "
														     SELECT
														      catdscing 
														     FROM
														       conteudo_internet.apto_categoria
														     WHERE aptocatcod = $aptocatcod 
														     order by catdscing
														     ";
														     
														     $result_aptocateg = pg_exec($conn, $query_aptocateg);
														     if ($result_aptocateg) {
														     	for ($rowapcateg = 0; $rowapcateg < pg_numrows($result_aptocateg); $rowapcateg++) {
														     			
														     		$catdscing = pg_result($result_aptocateg, $rowapcateg, 'catdscing');
														     		
														     		// output da categoria cadastrada
														     		 
														     		echo '<option value="'.$aptocatcod.'" selected>'.$catdscing.'</option>';
														     	 	
														     	}
														     }
										     
										     
										     
														     // query para pegar todas as categorias disponiveis para altera��o
															    $query_aptocategfull =
															    "
															    SELECT
																    aptocatcod,
																    catdsc,
																    catdscesp,
																    catdscing
															    FROM
															    	conteudo_internet.apto_categoria
															    where 
															        aptocatcod	not in ('$aptocatcod')
																	order by catdscing
															    ";
															    
															    $result_aptocategfull = pg_exec($conn, $query_aptocategfull);
															    if ($result_aptocategfull) {
															    	for ($rowcatfull = 0; $rowcatfull < pg_numrows($result_aptocategfull); $rowcatfull++) {
															    			
															    		$catdscingfull = pg_result($result_aptocategfull, $rowcatfull, 'catdscing');
															    		$aptocatcodfull = pg_result($result_aptocategfull, $rowcatfull, 'aptocatcod');
															    
															    		// output das categorias disponiveis para altera��o
															    		   echo '<option value="'.$aptocatcodfull.'">'.$catdscingfull.'</option>';
															    			
															    	}
															    } 
										          
													    
										     
										      echo '
										      </select>
										     </div>
										     <div id="box15apto">
										      localizacao <br>
										      <select name="loc" id="loc"  >';
													      // query para pegar o descritivo da localiza��o do apto cadastrado
													     $query_aptoloc =
													     "
													     SELECT
													        aptolocdscing
													     FROM
													        conteudo_internet.apto_localizacao
													     WHERE  aptoloccod  =    $aptoloccod
													     ";
													     
													     $result_aptoloc = pg_exec($conn, $query_aptoloc);
													     if ($result_aptoloc) {
													     	for ($rowaploc = 0; $rowaploc < pg_numrows($result_aptoloc); $rowaploc++) {
													     		
													     		//output da localiza��o cadastrada	
													     		$aptolocdscing = pg_result($result_aptoloc, $rowaploc, 'aptolocdscing');
													     	   		echo '<option value="'.$aptoloccod.'">'.$aptolocdscing.'</option>';
													     	 		
													     	}
													     }
													     
										     
										                  // query para pegar todas as localiza��es disponiveis para altera��o
													     
													     $query_aptoloc =
													     "
													     SELECT
														     aptoloccod,
														     aptolocdsc,
														     aptolocdscesp,
														     aptolocdscing
													     FROM
													     	conteudo_internet.apto_localizacao
													     where 	aptoloccod not in ('$aptoloccod')
														 order by aptolocdscing
													     ";
													     
													     $result_aptoloc = pg_exec($conn, $query_aptoloc);
													     if ($result_aptoloc) {
													     	for ($rowcid = 0; $rowcid < pg_numrows($result_aptoloc); $rowcid++) {
													     			
													     		$aptolocdscing = pg_result($result_aptoloc, $rowcid, 'aptolocdscing');
													     		$aptoloccod = pg_result($result_aptoloc, $rowcid, 'aptoloccod');
													     
													     			
													     		echo '<option value="'.$aptoloccod.'">'.$aptolocdscing.'</option>';
													     			
													     	}
													     }
													     
										     
										     
										     
										     
										     
										     
										     
										     ECHO '</select>
											     </div>
											     <div id="box16apto">
													     Qtd.<br>
													     <input name="qtd" id="qtd"  type="text"   size="2" maxlength="20"  value="'.$aptqtd.'">
											     </div>
											     <div id="box17apto">
													     foto<br>
													     <input type="text" name="foto" id="foto" maxlength="100"   value="'.$aptoimgfoto.'" size="30">
											     </div>
										     </div>
										     ';
										     
										 
											
									       }
										}
										
											echo '<div id="box6"><input type="button"  name="Go" value="Alterar" onclick="javascript:update_apto ();" ></div>
											
											<div id="box13">
										<input type="hidden" name="frncod" id="frncod" value="'.$frncod.'">
										<br><a href="javascript:altera_hotel();"><< Voltar para altera&ccedil;&atilde;o do Hotel</a>
										</div>
									   <div id="box13"></div>';
										
										
									
                                       
                 ?>