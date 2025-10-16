<?php
// get_tabela.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'util/connection.php';

$tabela_input = $_REQUEST['tabela'] ?? '';
if (empty($tabela_input)) {
    echo "<div class='alert alert-warning'>Nenhuma tabela informada.</div>";
    exit;
}

// Se vier "schema.table" separa, se não tenta descobrir schema automaticamente
if (strpos($tabela_input, '.') !== false) {
    list($schema_in, $table_in) = explode('.', $tabela_input, 2);
    $schema_in = trim($schema_in);
    $table_in  = trim($table_in);
} else {
    $schema_in = null;
    $table_in  = trim($tabela_input);
}

// Primeiro: validar se a tabela existe e obter schema correto
if ($schema_in) {
    $sql_check = "SELECT table_schema, table_name
                  FROM information_schema.tables
                  WHERE table_schema = $1 AND table_name = $2
                  LIMIT 1;";
    $res_check = pg_query_params($conn, $sql_check, array($schema_in, $table_in));
} else {
    $sql_check = "SELECT table_schema, table_name
                  FROM information_schema.tables
                  WHERE table_name = $1
                  LIMIT 1;";
    $res_check = pg_query_params($conn, $sql_check, array($table_in));
}

if (!$res_check || pg_num_rows($res_check) === 0) {
    echo "<div class='alert alert-danger'>Tabela <b>" . htmlspecialchars($tabela_input) . "</b> não encontrada.</div>";
    exit;
}

$row_check = pg_fetch_assoc($res_check);
$schema = $row_check['table_schema'];
$table  = $row_check['table_name'];

// montar identificador seguro (duplicando aspas internas)
$schema_q = '"' . str_replace('"', '""', $schema) . '"';
$table_q  = '"' . str_replace('"', '""', $table) . '"';
$full_table = $schema_q . '.' . $table_q;

// Se for export CSV (via GET), envia CSV
if (isset($_GET['export']) && strtolower($_GET['export']) === 'csv') {
    // pega colunas
    $cols_sql = "SELECT column_name FROM information_schema.columns
                 WHERE table_schema = $1 AND table_name = $2
                 ORDER BY ordinal_position;";
    $cols_res = pg_query_params($conn, $cols_sql, array($schema, $table));
    $cols = [];
    while ($r = pg_fetch_assoc($cols_res)) $cols[] = $r['column_name'];

    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'. $schema . '_' . $table .'.csv"');
    $out = fopen('php://output', 'w');
    // cabeçalho
    fputcsv($out, $cols);

    // busca todos os dados (atenção: pode ser grande)
    $data_sql = "SELECT * FROM $full_table;";
    $data_res = pg_query($conn, $data_sql);
    while ($row = pg_fetch_assoc($data_res)) {
        $line = [];
        foreach ($cols as $c) $line[] = $row[$c] ?? '';
        fputcsv($out, $line);
    }
    fclose($out);
    exit;
}

// Pegar colunas com tipos e info
$col_sql = "SELECT column_name, data_type, is_nullable, character_maximum_length
            FROM information_schema.columns
            WHERE table_schema = $1 AND table_name = $2
            ORDER BY ordinal_position;";
$col_res = pg_query_params($conn, $col_sql, array($schema, $table));
if (!$col_res || pg_num_rows($col_res) === 0) {
    echo "<div class='alert alert-warning'>Nenhuma coluna encontrada para <b>$schema.$table</b>.</div>";
    exit;
}
$columns = [];
while ($c = pg_fetch_assoc($col_res)) $columns[] = $c;

// busca até 100 registros (você pode alterar o LIMIT)
$limit = 100;
$data_sql = "SELECT * FROM $full_table LIMIT $limit;";
$data_res = pg_query($conn, $data_sql);
if ($data_res === false) {
    $err = pg_last_error($conn);
    echo "<div class='alert alert-danger'><strong>Erro ao ler dados:</strong><pre>" . htmlspecialchars($err) . "</pre></div>";
    exit;
}

// ---------------- HTML resposta (fragmento que será inserido em #resultado) ----------------
?>
<div class="mb-3">
  <h5>Tabela: <b><?php echo htmlspecialchars("$schema.$table"); ?></b></h5>
  <p><small><?php echo count($columns); ?> campos • exibindo até <?php echo $limit; ?> registros</small></p>
  <div class="mb-2">
  <button id="btnExportar" class="btn btn-outline-primary mt-3">⬇️ Exportar CSV</button>

  </div>
</div>

<!-- Colunas -->
<div class="card mb-3">
  <div class="card-header bg-secondary text-white">Campos / Tipos</div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm table-striped mb-0">
        <thead class="table-light">
          <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Nullable</th>
            <th>Tamanho</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($columns as $col): ?>
          <tr>
            <td><?php echo htmlspecialchars($col['column_name']); ?></td>
            <td><?php echo htmlspecialchars($col['data_type']); ?></td>
            <td><?php echo htmlspecialchars($col['is_nullable']); ?></td>
            <td><?php echo htmlspecialchars($col['character_maximum_length'] ?? ''); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Registros -->
<div class="card">
  <div class="card-header bg-dark text-white">Registros (até <?php echo $limit; ?>)</div>
  <div class="card-body p-0">
    <div class="table-responsive" style="max-height:60vh; overflow:auto;">
      <table class="table table-sm table-bordered table-hover mb-0">
        <thead class="table-primary">
          <tr>
            <?php foreach ($columns as $col): ?>
              <th><?php echo htmlspecialchars($col['column_name']); ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php if (pg_num_rows($data_res) > 0): ?>
            <?php while ($row = pg_fetch_assoc($data_res)): ?>
              <tr>
                <?php foreach ($columns as $col): 
                    $name = $col['column_name'];
                    $val = $row[$name] ?? '';
                    // limitar tamanho de campos para visualização
                    $out = (is_string($val) && strlen($val) > 300) ? substr($val,0,300) . '...': $val;
                ?>
                  <td><?php echo nl2br(htmlspecialchars((string)$out)); ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="<?php echo count($columns); ?>" class="text-center text-muted">Nenhum registro encontrado</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
