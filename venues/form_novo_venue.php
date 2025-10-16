<?php 

require_once '../util/connection.php';


$lista_cidades = "
SELECT *
FROM
tarifario.cidade_tpo
ORDER BY
nome_pt ASC
";


echo '
<b>Cadastro de Venue</b>
<br>
<br>
MNEU_FOR: <input type="text" id="mneu_for" maxlength="4"   value="" size="4"><br>
Nome: <input type="text" id="nome"  size="60"><br>
Selecione uma Cidade: <select id="citie"   >
<option value="0" selected>--------------------</option>
';

$result_cid = pg_exec($conn, $lista_cidades);
if ($result_cid) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++) {
		$nome_en = pg_result($result_cid, $rowcid, 'nome_en');
		$cidade_cod = pg_result($result_cid, $rowcid, 'cidade_cod');
			
		echo '<option value="'.$cidade_cod.'">'.$nome_en.'</option>' ;

	}
}

echo'
</select><br>
Especialidade: <input type="text" id="especialidade"  size="60"><br>
<br>
Descritivo em Inglês:<br>
<textarea id="descritivo_en" cols="60" rows="4"></textarea><br>
Descritivo em Português:<br>
<textarea id="descritivo_pt" cols="60" rows="4"></textarea><br>
Descritivo em Espanhol<br>
<textarea id="descritivo_esp" cols="60" rows="4"></textarea><br>
<br>
Foto 1: <input type="text" id="foto1" maxlength="100"   value="" size="60"><br> 
Foto 2: <input type="text" id="foto2" maxlength="100"   value="" size="60"><br> 
<br>
<br>
<input type="checkbox"  id="ativo" checked > - Ativo na Internet <font size="1" color="000000">( Irá aparecer na internet se marcado )</font><br>
<br>
<input   type="submit"  name="Go" value="Inserir"    onclick="javascript:insere_novo_venue();"><br>
<br>
';


?>