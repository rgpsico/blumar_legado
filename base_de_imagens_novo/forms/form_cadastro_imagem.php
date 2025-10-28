<?php
// form_cadastro_imagem.php
// Este arquivo é incluído na aba de Cadastro e replica a lógica do formulário legado
// Mantém o uso de $_SESSION e $conn da página principal
require_once '../util/connection.php';
// Função auxiliar para nome da categoria (já definida na página principal, mas duplicada aqui se necessário)

?>

<form id="cadastroImagemForm" enctype="multipart/form-data" method="post">
    <div class="cadastro-form-group">
        <label for="tp_produto">Tipo de Produto:</label>
        <select id="tp_produto" name="tp_produto" onchange="javascript:pega_tp_produto();" class="form-control" required>
            <option value="1" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '1') ? 'selected' : ''; ?>>Hotel</option>
            <option value="2" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '2') ? 'selected' : ''; ?>>Tour</option>
            <option value="3" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '3') ? 'selected' : ''; ?>>Venue</option>
            <option value="4" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '4') ? 'selected' : ''; ?>>Restaurante</option>
            <option value="5" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '5') ? 'selected' : ''; ?>>Gifts</option>
            <option value="6" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '6') ? 'selected' : ''; ?>>Transportes</option>
            <option value="7" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '7') ? 'selected' : ''; ?>>Various</option>
            <option value="8" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '8') ? 'selected' : ''; ?>>Tours for incentives</option>
            <option value="9" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '9') ? 'selected' : ''; ?>>Tours technical</option>
            <option value="10" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '10') ? 'selected' : ''; ?>>Cidade</option>
            <option value="11" <?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '11') ? 'selected' : ''; ?>>Inspection Report</option>
            <option value="0" <?php echo (!isset($_SESSION['tp_produto'])) ? 'selected' : ''; ?>>Selecione um</option>
        </select>
    </div>

    <div id="miolo_produto" class="<?php echo (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] != '0') ? 'show' : ''; ?>">
        <?php
        // Lógica para cidade selecionada (comum a vários tipos)
        $sected = '';
        if (isset($_SESSION['cidade_cod']) && $_SESSION['cidade_cod'] != '0') {
            $unocidade_cod = $_SESSION['cidade_cod'];
            $select_unocidade = "select cidade_cod, nome_en from tarifario.cidade_tpo where cidade_cod = '$unocidade_cod'";
            $result_unocidade = pg_exec($conn, $select_unocidade);
            if ($result_unocidade && pg_numrows($result_unocidade) > 0) {
                $ucidade_cod = pg_result($result_unocidade, 0, 'cidade_cod');
                $unonome_en = pg_result($result_unocidade, 0, 'nome_en');
                $sected = '<option value="' . $ucidade_cod . '" selected>' . $unonome_en . '</option>';
            }
        }

        // Módulo de escolha de cidade (comum)
        $query_cidade = "select pk_cidade_tpo, nome_pt, nome_en, descritivo_pt, descritivo_en, foto1, foto2, tpocidcod, cidade_cod from tarifario.cidade_tpo order by nome_en";
        $result_cidade = pg_exec($conn, $query_cidade);
        $select_cidade = '<select name="cidade_cod" id="cidade_cod" class="form-control">';
        if (strlen($sected) != 0) {
            $select_cidade .= $sected;
        } else {
            $select_cidade .= '<option value="0" selected>Escolha uma cidade</option>';
        }
        if ($result_cidade) {
            for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
                $nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
                $cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
                $select_cidade .= '<option value="' . $cidade_cod . '">' . $nome_en . '</option>';
            }
        }
        $select_cidade .= '</select>';
        ?>

        <?php if (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '1') { // Hotel 
        ?>
            <?php
            $lista_umhtl = '';
            if (isset($_SESSION['mneu_for'])) {
                $mneu_for = $_SESSION['mneu_for'];
                $pegaumhtl = "select nome_for, frncod, nome_htl FROM conteudo_internet.ci_hotel left outer JOIN sbd95.fornec ON ci_hotel.mneu_for = sbd95.fornec.mneu_for where ci_hotel.mneu_for = '$mneu_for'";
                $result_umhtl = pg_exec($conn, $pegaumhtl);
                if (pg_numrows($result_umhtl) != 0) {
                    for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) {
                        $nome_htl = pg_result($result_umhtl, $rowhtl, 'nome_htl');
                        $nome_for = pg_result($result_umhtl, $rowhtl, 'nome_for');
                        $frncod = pg_result($result_umhtl, $rowhtl, 'frncod');
                        $lista_umhtl .= '<option value="' . $mneu_for . ',' . $frncod . '" selected>';
                        $lista_umhtl .= (strlen($nome_for) != '0') ? $nome_for : $nome_htl;
                        $lista_umhtl .= '</option>';
                    }
                } else {
                    $select_umavulso = "select distinct nome_produto, mneu_for from banco_imagem.bco_img where mneu_for = '$mneu_for'";
                    $result_umavulso = pg_exec($conn, $select_umavulso);
                    if (pg_numrows($result_umavulso) != 0) {
                        for ($rowuav = 0; $rowuav < pg_numrows($result_umavulso); $rowuav++) {
                            $mneu_for = pg_result($result_umavulso, $rowuav, 'mneu_for');
                            $nome_produto = pg_result($result_umavulso, $rowuav, 'nome_produto');
                            $lista_umhtl .= '<option value="' . $mneu_for . ',0" selected>' . $nome_produto . '</option>';
                        }
                    }
                }
            }

            $lista_htl = '';
            $query_htl = "SELECT conteudo_internet.ci_hotel.nome_htl, conteudo_internet.ci_hotel.frncod, sbd95.fornec.nome_for, sbd95.fornec.mneu_for FROM conteudo_internet.ci_hotel left outer JOIN sbd95.fornec ON ci_hotel.mneu_for = sbd95.fornec.mneu_for order by nome_for";
            $result_htl = pg_exec($conn, $query_htl);
            if ($result_htl) {
                for ($rowhtl = 0; $rowhtl < pg_numrows($result_htl); $rowhtl++) {
                    $nome_htl = pg_result($result_htl, $rowhtl, 'nome_htl');
                    $mneu_for1 = pg_result($result_htl, $rowhtl, 'mneu_for');
                    $nome_for = pg_result($result_htl, $rowhtl, 'nome_for');
                    $frncod = pg_result($result_htl, $rowhtl, 'frncod');
                    $lista_htl .= '<option value="' . $mneu_for1 . ',' . $frncod . '">';
                    $lista_htl .= (strlen($nome_for) != '0') ? $nome_for : $nome_htl;
                    $lista_htl .= '</option>';
                }
            }

            $select_avulso = "select distinct nome_produto, mneu_for from banco_imagem.bco_img where av = 't' and tp_produto = '1' order by nome_produto";
            $result_avulso = pg_exec($conn, $select_avulso);
            if (pg_numrows($result_avulso) != 0) {
                for ($rowav = 0; $rowav < pg_numrows($result_avulso); $rowav++) {
                    $nome_produtoav = pg_result($result_avulso, $rowav, 'nome_produto');
                    $mneu_for = pg_result($result_avulso, $rowav, 'mneu_for');
                    $lista_htl .= '<option value="' . $mneu_for . ',0">' . $nome_produtoav . '</option>';
                }
            }
            ?>
            <div class="cadastro-form-group">
                <label for="mneu_for">Hotel:</label>
                <select name="mneu_for" id="mneu_for" onchange="javascript:pega_cid_htl();" class="form-control">
                    <?php
                    if (pg_numrows($result_avulso) != 0) {
                        echo $lista_umhtl . '<option value="0,0">Escolha um hotel / Hotel Avulso</option>';
                    } else {
                        echo '<option value="0,0" selected>Escolha um hotel</option>';
                    }
                    echo $lista_htl;
                    ?>
                </select>
            </div>
            <div id="cidcod">
                <div class="cadastro-form-group">
                    <label for="nome_produto">ou Hotel Avulso:</label>
                    <input type="text" id="nome_produto" name="nome_produto" size="50" class="form-control" value="<?php echo isset($nome_produto) ? htmlspecialchars($nome_produto) : ''; ?>">
                </div>
                <div class="cadastro-form-group">
                    <label>Cidade:</label>
                    <?php echo $select_cidade; ?>
                </div>
            </div>

        <?php } elseif (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '2') { // Tour 
        ?>
            <?php
            $selected = '';
            if (isset($_SESSION['cidade_cod'])) {
                $tourcidade_cod = $_SESSION['cidade_cod'];
                $query_tpocidcod = "select tpocidcod, nome_en from tarifario.cidade_tpo where cidade_cod = $tourcidade_cod";
                $result_tpocidcod = pg_exec($conn, $query_tpocidcod);
                if (pg_numrows($result_tpocidcod) > 0) {
                    $fk_tpocidcod = pg_result($result_tpocidcod, 0, 'tpocidcod');
                    $nome_en = pg_result($result_tpocidcod, 0, 'nome_en');
                    $selected = '<option value="' . $fk_tpocidcod . '" selected>' . $nome_en . '</option>';

                    $pega_tour = "select pk_descritivo_tours, nome_en from tarifario.descritivo_tours where fk_tpocidcod = $fk_tpocidcod";
                    $result_tour = pg_exec($conn, $pega_tour);
                }
            }

            $query_cidade = "select distinct fk_tpocidcod, (select nome_en from tarifario.cidade_tpo where tpocidcod::integer = fk_tpocidcod) as nome_cid from tarifario.descritivo_tours order by nome_cid";
            $result_cid = pg_exec($conn, $query_cidade);
            ?>
            <div class="cadastro-form-group">
                <label>Cidade para Tour:</label>
                <select name="pegatour" id="pegatour" onchange="javascript:pega_tour();" class="form-control">
                    <?php echo $selected . '<option value="0">Escolha uma cidade para escolher o tour</option>'; ?>
                    <?php if ($result_cid) {
                        for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++) {
                            $nome_cid = pg_result($result_cid, $rowcid, 'nome_cid');
                            $fk_tpocidcod = pg_result($result_cid, $rowcid, 'fk_tpocidcod');
                            echo '<option value="' . $fk_tpocidcod . '">' . $nome_cid . '</option>';
                        }
                    } ?>
                </select>
            </div>
            <div class="cadastro-form-group">
                <label>ou Tour Avulso:</label>
                <input type="text" id="nome_produto" name="nome_produto" size="50" class="form-control">
            </div>
            <div id="formalteratour">
                <input type="hidden" id="cidade_cod" name="cidade_cod" value="<?php echo $tourcidade_cod ?? ''; ?>">
                <div class="cadastro-form-group">
                    <label>Selecione um tour:</label>
                    <select name="mneu_for" id="mneu_for" class="form-control">
                        <option value="0,0">------------</option>
                        <?php if (isset($result_tour) && $result_tour) {
                            for ($rowcid = 0; $rowcid < pg_numrows($result_tour); $rowcid++) {
                                $pk_descritivo_tours = pg_result($result_tour, $rowcid, 'pk_descritivo_tours');
                                $nome_en = pg_result($result_tour, $rowcid, 'nome_en');
                                echo '<option value="' . $pk_descritivo_tours . ',0">' . $nome_en . '</option>';
                            }
                        } ?>
                    </select>
                </div>
            </div>

        <?php } elseif (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '3') { // Venue 
        ?>
            <?php
            // Lógica para select_cidade adaptada para Venue
            $select_cidade_venue = '<select name="cidade_cod" id="cidade_cod" class="form-control">';
            if (isset($_SESSION['cidade_cod'])) {
                $unocidade_cod = $_SESSION['cidade_cod'];
                $pega_cid_venue = "select nome_en from tarifario.cidade_tpo where cidade_cod = '$unocidade_cod'";
                $result_cid_venue = pg_exec($conn, $pega_cid_venue);
                if (pg_numrows($result_cid_venue) > 0) {
                    $unonome_en = pg_result($result_cid_venue, 0, 'nome_en');
                    $select_cidade_venue .= '<option value="' . $unocidade_cod . '" selected>' . $unonome_en . '</option>';
                } else {
                    $select_cidade_venue .= '<option value="0" selected>Escolha uma cidade</option>';
                }
            } else {
                $select_cidade_venue .= '<option value="0" selected>Escolha uma cidade</option>';
            }
            if ($result_cidade) {
                for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
                    $nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
                    $cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
                    $select_cidade_venue .= '<option value="' . $cidade_cod . '">' . $nome_en . '</option>';
                }
            }
            $select_cidade_venue .= '</select>';

            $selected_venue = '';
            $select_venue = '<select id="mneu_for" name="mneu_for" onchange="javascript:pega_cid_venue();" class="form-control">';
            if (isset($_SESSION['mneu_for'])) {
                $ummneu_for = $_SESSION['mneu_for'];
                $pega_umvenue = "select * from conteudo_internet.venues where cod_venues = $ummneu_for";
                $result_umvenue = pg_exec($conn, $pega_umvenue);
                if ($result_umvenue && pg_numrows($result_umvenue) > 0) {
                    $umcod_venues = pg_result($result_umvenue, 0, 'cod_venues');
                    $umnome = pg_result($result_umvenue, 0, 'nome');
                    $selected_venue = '<option value="' . $umcod_venues . '" selected>' . $umnome . '</option>';
                }
                $select_venue .= $selected_venue . '<option value="0">--------------------</option>';

                $pega_venue = "select * from conteudo_internet.venues order by nome";
                $result_venue = pg_exec($conn, $pega_venue);
                if ($result_venue) {
                    for ($rowrest = 0; $rowrest < pg_numrows($result_venue); $rowrest++) {
                        $cod_venues = pg_result($result_venue, $rowrest, 'cod_venues');
                        $nome = pg_result($result_venue, $rowrest, 'nome');
                        $select_venue .= '<option value="' . $cod_venues . '">' . $nome . '</option>';
                    }
                }
            }
            $select_venue .= '</select>';
            ?>
            <div class="cadastro-form-group">
                <label for="mneu_for">Venue:</label>
                <?php echo $select_venue; ?>
            </div>
            <div class="cadastro-form-group">
                <label>Cidade:</label>
                <?php echo $select_cidade_venue; ?>
            </div>
            <div class="cadastro-form-group">
                <label>ou Venue Avulso:</label>
                <input type="text" id="nome_produto" name="nome_produto" size="50" class="form-control">
            </div>

        <?php } elseif (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '11') { // Inspection Report 
        ?>
            <?php
            $ummneu_for = isset($_SESSION['mneu_for']) ? $_SESSION['mneu_for'] : '';
            $pega_inpections = "SELECT conteudo_internet.ireport_destinations.pk_ireport_destinations as pk_ireport_destinations, conteudo_internet.ireport_destinations.fk_brazilian_experts as fk_brazilian_experts, conteudo_internet.ireport_destinations.destinos as destinos, conteudo_internet.ireport_destinations.descricao as descricao, conteudo_internet.ireport_destinations.data as data, ativo, to_char (conteudo_internet.ireport_destinations.data, 'DD/MM/YYYY') as dia_inicio FROM conteudo_internet.ireport_destinations order by data desc";
            $result_experts = pg_exec($conn, $pega_inpections);
            ?>
            <div class="cadastro-form-group">
                <label>Galeria de imagens para Inspection Report:</label>
                <select name="mneu_for" id="mneu_for" class="form-control">
                    <option value="0,0">Selecione um Inspection Report</option>
                    <?php if ($result_experts) {
                        for ($rowcid = 0; $rowcid < pg_numrows($result_experts); $rowcid++) {
                            $destinos = pg_result($result_experts, $rowcid, 'destinos');
                            $pk_ireport_destinations = pg_result($result_experts, $rowcid, 'pk_ireport_destinations');
                            $dia_inicio = pg_result($result_experts, $rowcid, 'dia_inicio');
                            $ativo = pg_result($result_experts, $rowcid, 'ativo');
                            $selected = ($ummneu_for == $pk_ireport_destinations) ? 'selected' : '';
                            echo '<option value="' . $pk_ireport_destinations . ',0" ' . $selected . '>' . $pk_ireport_destinations . '- ' . $destinos . ' - ' . $dia_inicio . ' - ';
                            echo ($ativo == 't') ? 'Ativo' : 'Inativo';
                            echo '</option>';
                        }
                    } ?>
                </select>
            </div>
            <input type="hidden" id="nome_produto" name="nome_produto" value="0">
            <input type="hidden" id="cidade_cod" name="cidade_cod" value="0">

        <?php } // Outros tipos (4-10) podem ser adicionados similarmente se necessário; por enquanto, assume vazio para eles 
        ?>
    </div>

    <!-- Campos comuns para todos os tipos -->
    <!-- Campos comuns para todos os tipos -->
    <div class="section-title">Upload de Imagem</div>
    <div class="cadastro-form-group">
        <label for="imagem_original">Imagem Original (será redimensionada automaticamente):</label>
        <input type="file" id="imagem_original" name="imagem_original" accept="image/*" class="form-control" required>
        <small class="form-hint">Selecione uma imagem (JPG, PNG, etc.). Tamanhos gerados: 135x90, 300x200, 450x300, 840x560, original + ZIP.</small>
    </div>

    <!-- Hidden fields para os caminhos gerados (preenchidos via JS após processamento) -->
    <input type="hidden" id="tam_1" name="tam_1">
    <input type="hidden" id="tam_2" name="tam_2">
    <input type="hidden" id="tam_3" name="tam_3">
    <input type="hidden" id="tam_4" name="tam_4">
    <input type="hidden" id="tam_5" name="tam_5">
    <input type="hidden" id="zip" name="zip">

    <!-- Resto dos campos (legendas, autor, etc.) permanece igual -->
    <div class="section-title">Legendas e Metadados</div>
    <div class="form-row">
        <div class="cadastro-form-group">
            <label for="legenda">Legenda em Inglês:</label>
            <input type="text" id="legenda" name="legenda" size="70" class="form-control">
        </div>
        <div class="cadastro-form-group">
            <label for="legenda_pt">Legenda em Português:</label>
            <input type="text" id="legenda_pt" name="legenda_pt" size="70" class="form-control">
        </div>
    </div>
    <!-- ... (continua com legenda_esp, autor, autorizacao, palavras_chave, checkboxes e botões) -->

    <div class="btn-group">
        <button type="button" class="btn btn-primary" id="btnInserir" onclick="insert_new_image();">
            <i class="fas fa-save"></i> Inserir
        </button>
        <button type="reset" class="btn btn-secondary">
            <i class="fas fa-undo"></i> Limpar
        </button>
    </div>

    <script>
        // Função JS atualizada para submissão via AJAX (adicione isso ou em cadastro.js)
        function insert_new_image() {
            var form = document.getElementById('cadastroImagemForm');
            var formData = new FormData(form);

            // Desabilita botão durante upload
            var btn = document.getElementById('btnInserir');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processando...';

            fetch('processa_upload.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Imagem cadastrada com sucesso!');
                        // Preenche os hiddens com os caminhos gerados (se precisar exibir)
                        document.getElementById('tam_1').value = data.paths.tam_1;
                        document.getElementById('tam_2').value = data.paths.tam_2;
                        // ... (preenche os outros)
                        // Opcional: Limpa o form ou redireciona
                        form.reset();
                    } else {
                        alert('Erro: ' + data.error);
                    }
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-save"></i> Inserir';
                })
                .catch(error => {
                    alert('Erro no upload: ' + error);
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-save"></i> Inserir';
                });
        }
    </script>
</form>