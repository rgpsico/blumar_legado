 

<?php


	require_once '../util/connection.php';
	
	
	
                      if(!isset($frncod) )
                        {
                        	$frncod = pg_escape_string($_POST["frncod"]);
                        }
		echo '
		<b>CADASTRO DE NOVO APARTAMENTO</b><br> 
		<div id="box13">
		<div id="box14">
		categoria <br>
		<select name="categ1" id="categ1"  >
		<option value="0" selected>Apto categ</option>
		';

		$query_aptocateg =
		"
		SELECT
			aptocatcod,
			catdsc,
			catdscesp,
			catdscing
		FROM
			conteudo_internet.apto_categoria
			order by catdscing
		";

				$result_aptocateg = pg_exec($conn, $query_aptocateg);
				if ($result_aptocateg) {
					for ($rowcid = 0; $rowcid < pg_numrows($result_aptocateg); $rowcid++) {
							
						$catdscing = pg_result($result_aptocateg, $rowcid, 'catdscing');
						$aptocatcod = pg_result($result_aptocateg, $rowcid, 'aptocatcod');
				
							
						echo '<option value="'.$aptocatcod.'">'.$catdscing.'</option>';
							
					}
				}
                      echo'
                          </select>
					</div>
					<div id="box14">
					   localizacao <br>
						<select name="loc1" id="loc1"  > 
                        <option value="0" selected>Apto location</option>';
	                            
                                 $query_aptoloc =
								    "
										SELECT
											 aptoloccod,
											 aptolocdsc,
											 aptolocdscesp,
											 aptolocdscing 
										FROM 
											conteudo_internet.apto_localizacao
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
						echo'
		                          </select>
							</div>
							<div id="box15">
							    Qtd.<br>
							    <input name="qtd1" id="qtd1"  type="text"   size="2" maxlength="20">
							</div>
							<div id="box14">
							    foto<br>
							   <input type="text" name="foto1" id="foto1" maxlength="100"   value="" size="30">
							</div>
					 </div> 
					 <div id="box6"><input type="button"  name="Go" value="Inserir" onclick="javascript:insere_novo_apto();"  ></div>
					 
						<div id="box6">APARTAMENTOS J&Aacute; CADASTRADOS</div>
						';

						
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
						    <div id="box14">
							categoria <br>';
							// query para pegar o descritivo da categoria cadastrada
							$query_aptocateg =
							"
							SELECT
								catdscing
							FROM
								conteudo_internet.apto_categoria
							WHERE 
								aptocatcod = $aptocatcod
								
							";
								
							$result_aptocateg = pg_exec($conn, $query_aptocateg);
							if ($result_aptocateg) {
							for ($rowapcateg = 0; $rowapcateg < pg_numrows($result_aptocateg); $rowapcateg++) {
						
									$catdscing = pg_result($result_aptocateg, $rowapcateg, 'catdscing');
										
									// output da categoria cadastrada
						
									echo '<input type="text" name="catdscing" id="catdscing" maxlength="100"   value="'.$catdscing.'" size="25">';
						
						}
						}
							
						echo '
							
						</div>
						<div id="box14">
						localizacao <br>';
						// query para pegar o descritivo da localização do apto cadastrado
							$query_aptoloc =
							"
							SELECT
								aptolocdscing
							FROM
								conteudo_internet.apto_localizacao
							WHERE  
								aptoloccod  =    $aptoloccod
							";
						
							$result_aptoloc = pg_exec($conn, $query_aptoloc);
							if ($result_aptoloc) {
								for ($rowaploc = 0; $rowaploc < pg_numrows($result_aptoloc); $rowaploc++) {
						
							//output da localização cadastrada
								$aptolocdscing = pg_result($result_aptoloc, $rowaploc, 'aptolocdscing');
								echo '<input type="text" name="aptolocdscing" id="aptolocdscing" maxlength="100"   value="'.$aptolocdscing.'" size="25">';
						
						}
						}
						
						ECHO '
						</div>
							<div id="box15">
								Qtd.<br>
								<input name="qtd" id="qtd"  type="text"   size="2" maxlength="20"  value="'.$aptqtd.'">
							</div>
							<div id="box14">
								foto<br>
								<input type="text" name="foto" id="foto" maxlength="100"   value="'.$aptoimgfoto.'" size="30">
							</div>
						</div>
						
						
						';
							
							
							
						}
						}
						
						echo'
						
						<div id="box13">
							<input type="hidden" name="frncod" id="frncod" value="'.$frncod.'">
							<br><a href="javascript:altera_hotel();"><< Voltar para altera&ccedil;&atilde;o do Hotel</a>
						</div>
						<div id="box13"></div> 
						';
						
?>

 