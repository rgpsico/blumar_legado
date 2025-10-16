<?php
require_once 'util/connection.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Visualizar Tabelas do Banco</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">📊 Visualizador de Tabelas</h4>
    </div>
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-8">
          <label for="tabela" class="form-label">Selecione ou digite o nome completo da tabela</label>
          <input list="listaTabelas" class="form-control" id="tabela" placeholder="Ex: sbd95.fornec, conteudo_internet.ci_hotel...">
          <datalist id="listaTabelas">
            <?php
              // 🔍 Lista todas as tabelas de todos os schemas do usuário
              $sql = "
                SELECT table_schema, table_name 
                FROM information_schema.tables 
                WHERE table_schema NOT IN ('pg_catalog','information_schema') 
                ORDER BY table_schema, table_name;
              ";
              $res = pg_query($conn, $sql);
              while ($row = pg_fetch_assoc($res)) {
                $full_name = "{$row['table_schema']}.{$row['table_name']}";
                echo "<option value='{$full_name}'>";
              }
            ?>
          </datalist>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button id="btnBuscar" class="btn btn-success w-100">🔍 Buscar Registros</button>
        </div>
      </div>

      <div id="resultado" class="mt-4"></div>
    </div>
  </div>
</div>


<script>
$(document).ready(function() {


  let tabela = document.querySelector('#resultado table');
  
  if (!tabela) {
    alert('Nenhum dado encontrado para exportar.');
    return;
  }

  let csv = [];
  let linhas = tabela.querySelectorAll('tr');

  linhas.forEach(linha => {
    let colunas = linha.querySelectorAll('th, td');
    let linhaCSV = [];
    colunas.forEach(coluna => {
      // Escapa aspas e vírgulas
      let texto = coluna.innerText.replace(/"/g, '""');
      linhaCSV.push(`"${texto}"`);
    });
    csv.push(linhaCSV.join(','));
  });

  // Cria e baixa o arquivo CSV
  let blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
  let link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = 'dados_exportados.csv';
  link.click();
});



  $('#btnBuscar').click(function() {
    let tabela = $('#tabela').val().trim();
    if (tabela === '') {
      alert('Por favor, digite ou selecione o nome completo da tabela.');
      return;
    }

    $('#resultado').html('<div class="text-center my-3"><div class="spinner-border text-primary"></div> Carregando...</div>');

    $.ajax({
      url: 'get_tabela.php',
      type: 'POST',
      data: { tabela: tabela },
      success: function(data) {
        $('#resultado').html(data);
      },
      error: function() {
        $('#resultado').html('<div class="alert alert-danger">Erro ao buscar dados.</div>');
      }
    });
  });

</script>

</body>
</html>
