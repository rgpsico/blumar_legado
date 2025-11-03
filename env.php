<?php


/**
 * Lê variáveis do arquivo .env e define no ambiente PHP
 */
function loadEnv($path)
{
    if (!file_exists($path)) {
        die("❌ Arquivo .env não encontrado em: $path");
    }

    $env = parse_ini_file($path, false, INI_SCANNER_RAW);
    if (!$env) {
        die("❌ Erro ao ler o arquivo .env");
    }

    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
        putenv("$key=$value"); // Define também como variável de ambiente
    }

    return $env;
}
