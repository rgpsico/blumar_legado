<?php

/**
 * Documentação Interativa de APIs - Sistema Blumar
 * Gera documentação HTML intuitiva e permite testar as APIs
 * Lê automaticamente os docblocks dos arquivos PHP dentro da pasta /api/ e subpastas
 */

$apiDir = __DIR__ . '/api';

/**
 * Função recursiva para buscar todos os arquivos PHP
 */
function scanApiFiles($dir, $baseDir)
{
    $files = [];

    // Verifica se o diretório existe
    if (!is_dir($dir)) {
        error_log("Diretório não encontrado: $dir");
        return $files;
    }

    // Lista todos os itens do diretório
    $items = @scandir($dir);

    if ($items === false) {
        error_log("Erro ao ler diretório: $dir");
        return $files;
    }

    foreach ($items as $item) {
        // Ignora . e ..
        if ($item === '.' || $item === '..') continue;

        // Ignora arquivos/pastas ocultos
        if ($item[0] === '.') continue;

        $path = $dir . '/' . $item;

        if (is_dir($path)) {
            // Recursivamente busca em subpastas
            $files = array_merge($files, scanApiFiles($path, $baseDir));
        } elseif (is_file($path)) {
            // Verifica se é arquivo PHP
            $extension = strtolower(pathinfo($item, PATHINFO_EXTENSION));
            if ($extension === 'php') {
                $relativePath = str_replace($baseDir . '/', '', $path);
                $categoryPath = dirname($relativePath);

                $files[] = [
                    'path' => $path,
                    'relativePath' => $relativePath,
                    'name' => $item,
                    'category' => $categoryPath === '.' ? 'Principal' : $categoryPath
                ];
            }
        }
    }

    return $files;
}

$files = scanApiFiles($apiDir, $apiDir);
$docs = [];
$categories = [];

// Debug: mostrar arquivos encontrados
$debugInfo = [
    'apiDir' => $apiDir,
    'dirExists' => is_dir($apiDir),
    'filesFound' => count($files),
    'filesList' => []
];

foreach ($files as $fileInfo) {
    $debugInfo['filesList'][] = $fileInfo['relativePath'];
}

foreach ($files as $fileInfo) {
    $content = file_get_contents($fileInfo['path']);
    $doc = null;

    // Extrai docblock
    if (preg_match('/\/\*\*(.*?)\*\//s', $content, $match)) {
        $doc = trim($match[1]);
    }

    // Extrai informações estruturadas do docblock
    $endpoints = [];
    $methods = [];
    $params = [];
    $responses = [];
    $description = '';
    $fullDescription = '';
    $statusCodes = [];
    $relatedTables = [];
    $examplePayloads = [];
    $exampleResponses = [];

    if ($doc) {
        // Descrição principal (primeira parte até "Endpoints:" ou "Descrição:")
        if (preg_match('/^\s*\*\s*API\s+para\s+(.+?)(?=\n\s*\*\s*Descrição:|\n\s*\*\s*Endpoints:)/is', $doc, $m)) {
            $description = trim(preg_replace('/\n\s*\*\s*/', ' ', $m[1]));
        }

        // Descrição completa
        if (preg_match('/Descrição:\s*(.*?)(?=\n\s*\*\s*Endpoints:)/is', $doc, $m)) {
            $fullDescription = trim(preg_replace('/\n\s*\*\s*/', "\n", $m[1]));
        }

        // Endpoints com métodos
        if (preg_match('/Endpoints:\s*(.*?)(?=\n\s*\*\s*Métodos suportados:)/is', $doc, $m)) {
            $endpointSection = $m[1];
            // Extrai cada endpoint com seu método
            preg_match_all('/[-*]\s*(GET|POST|PUT|DELETE|PATCH)\s+(.+?)$/im', $endpointSection, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $methods[] = trim($match[1]);
                $endpoint = trim($match[2]);

                // Separa a descrição do endpoint
                if (preg_match('/^(.+?)\s+→\s+(.+)$/s', $endpoint, $epMatch)) {
                    $endpoints[] = [
                        'url' => trim($epMatch[1]),
                        'description' => trim(preg_replace('/\n\s*/', ' ', $epMatch[2]))
                    ];
                } else {
                    $endpoints[] = [
                        'url' => $endpoint,
                        'description' => ''
                    ];
                }
            }
        }

        // Extrai payloads de exemplo (JSON)
        preg_match_all('/Body JSON.*?:\s*\{(.*?)\}/is', $doc, $payloadMatches, PREG_SET_ORDER);
        foreach ($payloadMatches as $match) {
            $jsonStr = '{' . $match[1] . '}';
            // Limpa comentários e formata
            $jsonStr = preg_replace('/\n\s*\*\s*/', "\n", $jsonStr);
            $examplePayloads[] = trim($jsonStr);
        }

        // Códigos de status HTTP
        if (preg_match('/Retornos:\s*(.*?)(?=\n\s*\*\s*Exemplo|\n\s*\*\s*Tabelas|\*\/|$)/is', $doc, $m)) {
            preg_match_all('/[-*]\s*(\d{3}):\s*(.+?)$/m', $m[1], $statusMatches, PREG_SET_ORDER);
            foreach ($statusMatches as $match) {
                $statusCodes[] = [
                    'code' => $match[1],
                    'description' => trim($match[2])
                ];
            }
        }

        // Tabelas relacionadas
        if (preg_match('/Tabelas relacionadas:\s*(.*?)(?=\n\s*\*\s*Retornos:|\n\s*\*\s*Exemplo|\*\/|$)/is', $doc, $m)) {
            preg_match_all('/[-*]\s*(.+?)$/m', $m[1], $tableMatches);
            $relatedTables = array_map('trim', $tableMatches[1]);
        }

        // Exemplo de resposta completa
        if (preg_match('/Exemplo de resposta.*?:\s*\{(.*?)\}/is', $doc, $m)) {
            $jsonStr = '{' . $m[1] . '}';
            $jsonStr = preg_replace('/\n\s*\*\s*/', "\n", $jsonStr);
            $exampleResponses[] = trim($jsonStr);
        }
    }

    $category = $fileInfo['category'] === '.' ? 'Principal' : ucfirst(str_replace('/', ' / ', $fileInfo['category']));
    $categories[$category][] = [
        'file' => $fileInfo['name'],
        'relativePath' => $fileInfo['relativePath'],
        'fullPath' => str_replace(__DIR__, '', $fileInfo['path']),
        'description' => $description ?: 'Sem descrição',
        'fullDescription' => $fullDescription,
        'endpoints' => $endpoints,
        'methods' => $methods,
        'statusCodes' => $statusCodes,
        'relatedTables' => $relatedTables,
        'examplePayloads' => $examplePayloads,
        'exampleResponses' => $exampleResponses,
        'rawDoc' => $doc
    ];
}

// Ordena categorias
ksort($categories);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📘 Documentação de APIs - Blumar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0078ff;
            --primary-dark: #0056b3;
            --secondary: #00b8a9;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --dark: #2c3e50;
            --light: #f8f9fa;
            --border: #dee2e6;
            --shadow: rgba(0, 0, 0, 0.1);
            --code-bg: #f6f8fa;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem 2rem 8rem;
            box-shadow: 0 4px 20px var(--shadow);
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        header p {
            font-size: 1.1rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .main-container {
            max-width: 1400px;
            margin: -5rem auto 3rem;
            padding: 0 2rem;
            position: relative;
            z-index: 10;
        }

        .top-controls {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 8px 30px var(--shadow);
            margin-bottom: 2rem;
            display: grid;
            gap: 1rem;
        }

        .search-box {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 250px;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 120, 255, 0.1);
        }

        .filter-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 2px solid var(--border);
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .filter-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .token-section {
            display: flex;
            gap: 1rem;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
        }

        .token-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Courier New', monospace;
        }

        .token-status {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .token-status.saved {
            background: #d4edda;
            color: #155724;
        }

        .token-status.empty {
            background: #fff3cd;
            color: #856404;
        }

        .content-grid {
            display: grid;
            gap: 2rem;
        }

        .category-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px var(--shadow);
            transition: transform 0.3s;
        }

        .category-section:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px var(--shadow);
        }

        .category-title {
            font-size: 1.5rem;
            color: var(--dark);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .api-card {
            border: 2px solid var(--border);
            border-radius: 10px;
            margin-bottom: 1.5rem;
            background: white;
            transition: all 0.3s;
            overflow: hidden;
        }

        .api-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px var(--shadow);
        }

        .api-card.expanded {
            border-color: var(--primary);
        }

        .api-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            cursor: pointer;
            user-select: none;
            background: var(--light);
            transition: all 0.3s;
        }

        .api-header:hover {
            background: #e9ecef;
        }

        .api-card.expanded .api-header {
            background: white;
            border-bottom: 2px solid var(--border);
        }

        .api-header-left {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex: 1;
        }

        .api-header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .expand-icon {
            font-size: 1.5rem;
            transition: transform 0.3s;
            color: var(--primary);
        }

        .api-card.expanded .expand-icon {
            transform: rotate(180deg);
        }

        .api-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .api-card.expanded .api-content {
            max-height: 5000px;
            transition: max-height 0.5s ease-in;
        }

        .api-content-inner {
            padding: 1.5rem;
        }

        .api-title {
            font-size: 1.25rem;
            color: var(--primary);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .endpoints-count {
            background: var(--primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .methods-preview {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .api-path {
            font-size: 0.85rem;
            color: #6c757d;
            font-family: 'Courier New', monospace;
            background: white;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
        }

        .api-description {
            color: #555;
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        .section-label {
            font-weight: 600;
            color: var(--dark);
            margin: 1rem 0 0.5rem;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .endpoint-box {
            background: #e3f2fd;
            border-left: 4px solid var(--primary);
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .method-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .method-get {
            background: #d4edda;
            color: #155724;
        }

        .method-post {
            background: #fff3cd;
            color: #856404;
        }

        .method-put {
            background: #d1ecf1;
            color: #0c5460;
        }

        .method-delete {
            background: #f8d7da;
            color: #721c24;
        }

        .params-list {
            background: white;
            padding: 1rem;
            border-radius: 6px;
            border: 1px solid var(--border);
        }

        .params-list li {
            margin-left: 1.5rem;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .status-codes-grid {
            display: grid;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0.75rem;
            background: white;
            border-radius: 6px;
            border-left: 3px solid;
        }

        .status-item.success {
            border-color: var(--success);
        }

        .status-item.created {
            border-color: #17a2b8;
        }

        .status-item.error {
            border-color: var(--danger);
        }

        .status-item.warning {
            border-color: var(--warning);
        }

        .status-badge {
            font-weight: 700;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            background: var(--code-bg);
            color: var(--dark);
        }

        .tables-list {
            background: white;
            padding: 1rem;
            border-radius: 6px;
            border: 1px solid var(--border);
        }

        .tables-list li {
            margin-left: 1.5rem;
            margin-bottom: 0.5rem;
            color: #555;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }

        .payload-box {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 1rem;
            border-radius: 8px;
            position: relative;
            margin-top: 0.5rem;
        }

        .payload-box pre {
            margin: 0;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            white-space: pre-wrap;
            word-wrap: break-word;
            overflow-x: auto;
        }

        .copy-button {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.75rem;
            transition: all 0.3s;
        }

        .copy-button:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .copy-button.copied {
            background: var(--success);
            border-color: var(--success);
        }

        .endpoint-full-url {
            background: #f8f9fa;
            border: 2px dashed var(--border);
            padding: 1rem;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            word-break: break-all;
            color: #495057;
        }

        .test-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.75rem;
        }

        .copy-url-button {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .copy-url-button:hover {
            background: var(--primary);
            color: white;
        }

        .endpoint-desc {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            line-height: 1.6;
        }

        .response-box {
            background: var(--code-bg);
            padding: 1rem;
            border-radius: 6px;
            border: 1px solid var(--border);
            overflow-x: auto;
        }

        .response-box pre {
            margin: 0;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .test-button {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .test-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 120, 255, 0.4);
        }

        .test-button:active {
            transform: translateY(0);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border);
        }

        .modal-header h2 {
            color: var(--dark);
            font-size: 1.5rem;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6c757d;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .close-modal:hover {
            background: var(--light);
            color: var(--danger);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--border);
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 120, 255, 0.1);
        }

        .params-grid {
            display: grid;
            gap: 1rem;
        }

        .param-item {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 0.5rem;
            align-items: center;
        }

        .send-button {
            background: var(--success);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .send-button:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }

        .response-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid var(--border);
        }

        .loading {
            display: none;
            text-align: center;
            padding: 2rem;
        }

        .loading.active {
            display: block;
        }

        .spinner {
            border: 4px solid var(--light);
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state svg {
            width: 100px;
            height: 100px;
            opacity: 0.3;
            margin-bottom: 1rem;
        }

        footer {
            text-align: center;
            padding: 2rem;
            color: white;
            font-size: 0.9rem;
            margin-top: 3rem;
        }

        @media (max-width: 768px) {
            header {
                padding: 1.5rem 1rem 6rem;
            }

            header h1 {
                font-size: 1.8rem;
            }

            .main-container {
                padding: 0 1rem;
                margin-top: -4rem;
            }

            .api-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .param-item {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>📘 Documentação de APIs</h1>
        <p>Sistema Integrado Blumar - Teste e explore todas as APIs disponíveis</p>
    </header>

    <div class="main-container">
        <!-- Debug Panel (remover em produção) -->
        <div style="background: #fff3cd; border: 2px solid #ffc107; border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
            <details>
                <summary style="cursor: pointer; font-weight: 600; color: #856404;">
                    🔍 Painel de Debug - Clique para expandir
                </summary>
                <div style="margin-top: 1rem; font-family: 'Courier New', monospace; font-size: 0.85rem;">
                    <p><strong>Pasta API:</strong> <?= htmlspecialchars($debugInfo['apiDir']) ?></p>
                    <p><strong>Diretório existe?</strong> <?= $debugInfo['dirExists'] ? '✅ Sim' : '❌ Não' ?></p>
                    <p><strong>Arquivos encontrados:</strong> <?= $debugInfo['filesFound'] ?></p>
                    <?php if (!empty($debugInfo['filesList'])): ?>
                        <p><strong>Lista de arquivos:</strong></p>
                        <ul style="margin-left: 1.5rem;">
                            <?php foreach ($debugInfo['filesList'] as $file): ?>
                                <li><?= htmlspecialchars($file) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p style="color: #dc3545;">⚠️ Nenhum arquivo PHP encontrado!</p>
                        <p><strong>Verifique:</strong></p>
                        <ul style="margin-left: 1.5rem;">
                            <li>A pasta <code>/api</code> existe no mesmo diretório deste arquivo?</li>
                            <li>Os arquivos têm extensão <code>.php</code>?</li>
                            <li>As permissões de leitura estão corretas?</li>
                        </ul>
                    <?php endif; ?>
                </div>
            </details>
        </div>

        <div class="top-controls">
            <div class="search-box">
                <input type="text" id="searchInput" class="search-input" placeholder="🔍 Pesquisar APIs (nome, endpoint, descrição...)">
                <button class="filter-btn active" data-filter="all">Todas</button>
            </div>

            <div class="filter-buttons" id="categoryFilters">
                <button class="filter-btn" onclick="expandAllCards()" style="background: #e3f2fd; border-color: var(--primary); color: var(--primary);">
                    📂 Expandir Todos
                </button>
                <button class="filter-btn" onclick="collapseAllCards()" style="background: #fff3cd; border-color: var(--warning); color: #856404;">
                    📁 Colapsar Todos
                </button>
                <?php foreach (array_keys($categories) as $category): ?>
                    <button class="filter-btn" data-filter="<?= htmlspecialchars($category) ?>">
                        <?= htmlspecialchars($category) ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="token-section">
                <label for="apiToken" style="font-weight: 600; color: var(--dark);">🔑 Token de Autenticação:</label>
                <input type="password" id="apiToken" class="token-input" placeholder="Cole seu token aqui...">
                <span class="token-status empty" id="tokenStatus">Sem token</span>
            </div>
        </div>

        <div class="content-grid" id="contentGrid">
            <?php if (empty($categories)): ?>
                <div class="empty-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3>Nenhuma API encontrada</h3>
                    <p>Não foram encontrados arquivos PHP com documentação na pasta <strong>/api</strong>.</p>
                </div>
            <?php else: ?>
                <?php $globalIndex = 0; ?>
                <?php foreach ($categories as $category => $apis): ?>
                    <div class="category-section" data-category="<?= htmlspecialchars($category) ?>">
                        <h2 class="category-title">
                            📁 <?= htmlspecialchars($category) ?>
                        </h2>

                        <?php foreach ($apis as $apiIndex => $api): ?>
                            <div class="api-card" id="api-<?= $globalIndex ?>" data-searchable="<?= htmlspecialchars(strtolower($api['file'] . ' ' . $api['description'] . ' ' . $api['fullDescription'])) ?>">
                                <div class="api-header" onclick="toggleApiCard('<?= $globalIndex ?>')">
                                    <div class="api-header-left">
                                        <h3 class="api-title">
                                            <?= htmlspecialchars($api['file']) ?>
                                            <?php if (!empty($api['methods'])): ?>
                                                <span class="endpoints-count"><?= count($api['methods']) ?> endpoints</span>
                                            <?php endif; ?>
                                        </h3>
                                        <?php if (!empty($api['methods'])): ?>
                                            <div class="methods-preview">
                                                <?php foreach ($api['methods'] as $method): ?>
                                                    <span class="method-badge method-<?= strtolower($method) ?>"><?= strtoupper($method) ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="api-header-right">
                                        <span class="api-path"><?= htmlspecialchars($api['relativePath']) ?></span>
                                        <span class="expand-icon">▼</span>
                                    </div>
                                </div>

                                <div class="api-content">
                                    <?php if ($api['description']): ?>
                                        <p class="api-description"><strong><?= htmlspecialchars($api['description']) ?></strong></p>
                                    <?php endif; ?>

                                    <?php if ($api['fullDescription']): ?>
                                        <div style="color: #666; margin-bottom: 1rem; line-height: 1.7;">
                                            <?= nl2br(htmlspecialchars($api['fullDescription'])) ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($api['endpoints'])): ?>
                                        <div class="section-label">🔗 Endpoints Disponíveis</div>
                                        <?php foreach ($api['endpoints'] as $idx => $endpoint): ?>
                                            <?php
                                            $method = isset($api['methods'][$idx]) ? strtoupper($api['methods'][$idx]) : 'GET';
                                            $methodClass = 'method-' . strtolower($method);
                                            $endpointUrl = is_array($endpoint) ? $endpoint['url'] : $endpoint;
                                            $endpointDesc = is_array($endpoint) ? $endpoint['description'] : '';

                                            // Constrói URL completa
                                            $baseUrl = 'https://webdeveloper.blumar.com.br/desenv/roger/conteudo/api/';
                                            $fullUrl = $baseUrl . $api['relativePath'] . $endpointUrl;
                                            ?>
                                            <div class="endpoint-box">
                                                <div style="flex: 1;">
                                                    <div style="margin-bottom: 0.5rem;">
                                                        <span class="method-badge <?= $methodClass ?>"><?= htmlspecialchars($method) ?></span>
                                                        <code style="margin-left: 0.5rem;"><?= htmlspecialchars($endpointUrl) ?></code>
                                                    </div>
                                                    <?php if ($endpointDesc): ?>
                                                        <div class="endpoint-desc"><?= htmlspecialchars($endpointDesc) ?></div>
                                                    <?php endif; ?>
                                                    <div class="endpoint-full-url">
                                                        <?= htmlspecialchars($fullUrl) ?>
                                                    </div>
                                                    <div class="test-actions">
                                                        <button class="copy-url-button" onclick="copyToClipboard('<?= htmlspecialchars($fullUrl, ENT_QUOTES) ?>', this)">
                                                            📋 Copiar URL
                                                        </button>
                                                        <button class="test-button" onclick="openTestModal(<?= htmlspecialchars(json_encode([
                                                                                                                'file' => $api['file'],
                                                                                                                'endpoint' => $endpointUrl,
                                                                                                                'fullUrl' => $fullUrl,
                                                                                                                'method' => $method,
                                                                                                                'examplePayload' => $api['examplePayloads'][$idx] ?? '',
                                                                                                                'exampleResponse' => $api['exampleResponses'][0] ?? ''
                                                                                                            ]), ENT_QUOTES) ?>)">
                                                            ⚡ Testar API
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($api['examplePayloads'])): ?>
                                        <div class="section-label">📝 Exemplo de Payload (Request Body)</div>
                                        <?php foreach ($api['examplePayloads'] as $idx => $payload): ?>
                                            <div class="payload-box">
                                                <button class="copy-button" onclick="copyPayload(this, <?= $idx ?>)">📋 Copiar</button>
                                                <pre><?= htmlspecialchars($payload) ?></pre>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($api['statusCodes'])): ?>
                                        <div class="section-label">📊 Códigos de Status HTTP</div>
                                        <div class="status-codes-grid">
                                            <?php foreach ($api['statusCodes'] as $status): ?>
                                                <?php
                                                $statusClass = 'warning';
                                                if (in_array($status['code'], ['200'])) $statusClass = 'success';
                                                elseif (in_array($status['code'], ['201'])) $statusClass = 'created';
                                                elseif ($status['code'][0] == '4' || $status['code'][0] == '5') $statusClass = 'error';
                                                ?>
                                                <div class="status-item <?= $statusClass ?>">
                                                    <span class="status-badge"><?= htmlspecialchars($status['code']) ?></span>
                                                    <span><?= htmlspecialchars($status['description']) ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($api['relatedTables'])): ?>
                                        <div class="section-label">🗄️ Tabelas Relacionadas</div>
                                        <ul class="tables-list">
                                            <?php foreach ($api['relatedTables'] as $table): ?>
                                                <li><?= htmlspecialchars($table) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

                                    <?php if (!empty($api['exampleResponses'])): ?>
                                        <div class="section-label">📤 Exemplo de Resposta</div>
                                        <div class="payload-box">
                                            <button class="copy-button" onclick="copyResponse(this)">📋 Copiar</button>
                                            <pre><?= htmlspecialchars($api['exampleResponses'][0]) ?></pre>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php $globalIndex++; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal de Teste -->
    <div class="modal" id="testModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>🧪 Testar API</h2>
                <button class="close-modal" onclick="closeTestModal()">×</button>
            </div>

            <div class="form-group">
                <label class="form-label">URL Completa</label>
                <input type="text" id="modalFullUrl" class="form-input" readonly style="font-family: 'Courier New', monospace; font-size: 0.85rem;">
            </div>

            <div class="form-group">
                <label class="form-label">Método HTTP</label>
                <select id="modalMethod" class="form-input">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                    <option value="PUT">PUT</option>
                    <option value="DELETE">DELETE</option>
                </select>
            </div>

            <div class="form-group" id="payloadGroup" style="display: none;">
                <label class="form-label">Request Body (JSON)</label>
                <textarea id="payloadInput" class="form-input" rows="10" style="font-family: 'Courier New', monospace; font-size: 0.85rem;" placeholder='{"exemplo": "valor"}'></textarea>
                <small style="color: #6c757d; display: block; margin-top: 0.5rem;">
                    💡 Edite o JSON acima conforme necessário
                </small>
            </div>

            <div class="form-group">
                <label class="form-label">Parâmetros de URL (Query String)</label>
                <div id="paramsContainer" class="params-grid"></div>
                <button type="button" onclick="addUrlParam()" style="margin-top: 0.5rem; padding: 0.5rem 1rem; background: var(--light); border: 2px dashed var(--border); border-radius: 6px; cursor: pointer; width: 100%;">
                    ➕ Adicionar Parâmetro
                </button>
            </div>

            <button class="send-button" onclick="sendRequest()">🚀 Enviar Requisição</button>

            <div class="loading" id="loadingSpinner">
                <div class="spinner"></div>
                <p>Enviando requisição...</p>
            </div>

            <div class="response-section" id="responseSection" style="display: none;">
                <div class="section-label">📥 Resposta da API</div>
                <div class="payload-box">
                    <button class="copy-button" onclick="copyResponse(this)">📋 Copiar</button>
                    <pre id="responseContent"></pre>
                </div>
                <div style="margin-top: 1rem; padding: 0.75rem; background: var(--light); border-radius: 6px;">
                    <strong>Status:</strong> <span id="responseStatus"></span> |
                    <strong>Tempo:</strong> <span id="responseTime"></span>ms
                </div>
            </div>
        </div>
    </div>

    <footer>
        Gerado automaticamente em <?= date('d/m/Y H:i') ?> • Sistema Blumar Intranet
    </footer>

    <script>
        // Função para toggle do accordion
        function toggleApiCard(index) {
            const card = document.getElementById(`api-${index}`);
            if (card) {
                card.classList.toggle('expanded');
            }
        }

        // Expandir todos os cards
        function expandAllCards() {
            document.querySelectorAll('.api-card').forEach(card => {
                card.classList.add('expanded');
            });
        }

        // Colapsar todos os cards
        function collapseAllCards() {
            document.querySelectorAll('.api-card').forEach(card => {
                card.classList.remove('expanded');
            });
        }

        // Gerenciamento de Token
        const tokenInput = document.getElementById('apiToken');
        const tokenStatus = document.getElementById('tokenStatus');

        // Carregar token salvo
        const savedToken = localStorage.getItem('apiToken');
        if (savedToken) {
            tokenInput.value = savedToken;
            updateTokenStatus(true);
        }

        tokenInput.addEventListener('input', function() {
            const token = this.value.trim();
            if (token) {
                localStorage.setItem('apiToken', token);
                updateTokenStatus(true);
            } else {
                localStorage.removeItem('apiToken');
                updateTokenStatus(false);
            }
        });

        function updateTokenStatus(hasSaved) {
            if (hasSaved) {
                tokenStatus.textContent = 'Token salvo ✓';
                tokenStatus.className = 'token-status saved';
            } else {
                tokenStatus.textContent = 'Sem token';
                tokenStatus.className = 'token-status empty';
            }
        }

        // Copiar para clipboard
        function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(() => {
                const originalText = button.textContent;
                button.textContent = '✓ Copiado!';
                button.style.background = 'var(--success)';
                button.style.color = 'white';
                button.style.borderColor = 'var(--success)';

                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.background = '';
                    button.style.color = '';
                    button.style.borderColor = '';
                }, 2000);
            });
        }

        // Copiar payload
        function copyPayload(button, index) {
            const pre = button.nextElementSibling;
            const text = pre.textContent;
            copyToClipboard(text, button);
        }

        // Copiar resposta
        function copyResponse(button) {
            const pre = button.nextElementSibling;
            const text = pre.textContent;
            copyToClipboard(text, button);
        }

        // Filtros de categoria
        const filterButtons = document.querySelectorAll('.filter-btn');
        const categorySections = document.querySelectorAll('.category-section');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.dataset.filter;

                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                categorySections.forEach(section => {
                    if (filter === 'all' || section.dataset.category === filter) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });

        // Busca
        const searchInput = document.getElementById('searchInput');
        const apiCards = document.querySelectorAll('.api-card');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            apiCards.forEach(card => {
                const searchableText = card.dataset.searchable;
                if (searchableText.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            // Mostrar/ocultar categorias vazias
            categorySections.forEach(section => {
                const visibleCards = section.querySelectorAll('.api-card[style="display: block;"], .api-card:not([style*="display"])');
                if (visibleCards.length === 0) {
                    section.style.display = 'none';
                } else {
                    section.style.display = 'block';
                }
            });
        });

        // Modal de Teste
        let currentTestData = {};

        function openTestModal(data) {
            currentTestData = data;
            const modal = document.getElementById('testModal');

            // Preencher dados
            document.getElementById('modalFullUrl').value = data.fullUrl || data.endpoint;
            document.getElementById('modalMethod').value = data.method;

            // Mostrar/ocultar payload baseado no método
            const payloadGroup = document.getElementById('payloadGroup');
            const payloadInput = document.getElementById('payloadInput');

            if (['POST', 'PUT', 'PATCH'].includes(data.method)) {
                payloadGroup.style.display = 'block';
                // Preencher com exemplo se existir
                if (data.examplePayload) {
                    try {
                        // Formata o JSON
                        const parsed = JSON.parse(data.examplePayload);
                        payloadInput.value = JSON.stringify(parsed, null, 2);
                    } catch (e) {
                        payloadInput.value = data.examplePayload;
                    }
                } else {
                    payloadInput.value = '{\n  \n}';
                }
            } else {
                payloadGroup.style.display = 'none';
                payloadInput.value = '';
            }

            // Limpar parâmetros anteriores
            const paramsContainer = document.getElementById('paramsContainer');
            paramsContainer.innerHTML = '';

            // Resetar resposta
            document.getElementById('responseSection').style.display = 'none';
            document.getElementById('responseContent').textContent = '';
            document.getElementById('loadingSpinner').classList.remove('active');

            modal.classList.add('active');
        }

        function closeTestModal() {
            document.getElementById('testModal').classList.remove('active');
        }

        // Adicionar parâmetro de URL dinamicamente
        function addUrlParam() {
            const paramsContainer = document.getElementById('paramsContainer');
            const paramDiv = document.createElement('div');
            paramDiv.className = 'param-item';
            paramDiv.innerHTML = `
                <input type="text" class="form-input" placeholder="chave" data-param-key>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" class="form-input" placeholder="valor" data-param-value style="flex: 1;">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" style="padding: 0.75rem; background: var(--danger); color: white; border: none; border-radius: 6px; cursor: pointer;">🗑️</button>
                </div>
            `;
            paramsContainer.appendChild(paramDiv);
        }

        async function sendRequest() {
            const fullUrl = document.getElementById('modalFullUrl').value;
            const method = document.getElementById('modalMethod').value;
            const token = tokenInput.value.trim();
            const payloadInput = document.getElementById('payloadInput');

            // Coletar parâmetros de URL
            const paramKeys = document.querySelectorAll('#paramsContainer input[data-param-key]');
            const paramValues = document.querySelectorAll('#paramsContainer input[data-param-value]');
            const params = {};

            paramKeys.forEach((keyInput, index) => {
                const key = keyInput.value.trim();
                const value = paramValues[index].value.trim();
                if (key && value) {
                    params[key] = value;
                }
            });

            // Construir URL com query string
            let url = fullUrl;
            if (Object.keys(params).length > 0) {
                const queryString = new URLSearchParams(params).toString();
                url += (url.includes('?') ? '&' : '?') + queryString;
            }

            // Mostrar loading
            document.getElementById('loadingSpinner').classList.add('active');
            document.getElementById('responseSection').style.display = 'none';

            const startTime = performance.now();

            try {
                const options = {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                };

                // Adicionar token se existir
                if (token) {
                    options.headers['Authorization'] = `Bearer ${token}`;
                }

                // Adicionar body para métodos POST, PUT, PATCH
                if (['POST', 'PUT', 'PATCH'].includes(method)) {
                    const payloadText = payloadInput.value.trim();
                    if (payloadText) {
                        try {
                            // Valida JSON
                            JSON.parse(payloadText);
                            options.body = payloadText;
                        } catch (e) {
                            alert('JSON inválido no payload!\n\n' + e.message);
                            document.getElementById('loadingSpinner').classList.remove('active');
                            return;
                        }
                    }
                }

                const response = await fetch(url, options);
                const endTime = performance.now();
                const responseTime = Math.round(endTime - startTime);

                // Tentar parsear como JSON
                let data;
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    data = await response.json();
                } else {
                    data = await response.text();
                }

                // Mostrar resposta
                if (typeof data === 'object') {
                    document.getElementById('responseContent').textContent = JSON.stringify(data, null, 2);
                } else {
                    document.getElementById('responseContent').textContent = data;
                }

                // Mostrar status
                document.getElementById('responseStatus').textContent = `${response.status} ${response.statusText}`;
                document.getElementById('responseStatus').style.color = response.ok ? 'var(--success)' : 'var(--danger)';
                document.getElementById('responseTime').textContent = responseTime;

                document.getElementById('responseSection').style.display = 'block';
            } catch (error) {
                document.getElementById('responseContent').textContent = `❌ Erro na requisição:\n\n${error.message}`;
                document.getElementById('responseStatus').textContent = 'Erro';
                document.getElementById('responseStatus').style.color = 'var(--danger)';
                document.getElementById('responseTime').textContent = '-';
                document.getElementById('responseSection').style.display = 'block';
            } finally {
                document.getElementById('loadingSpinner').classList.remove('active');
            }
        }

        // Atualizar visibilidade do payload ao mudar método
        document.getElementById('modalMethod').addEventListener('change', function() {
            const payloadGroup = document.getElementById('payloadGroup');
            if (['POST', 'PUT', 'PATCH'].includes(this.value)) {
                payloadGroup.style.display = 'block';
            } else {
                payloadGroup.style.display = 'none';
            }
        });

        // Fechar modal ao clicar fora
        document.getElementById('testModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTestModal();
            }
        });

        // Atalho ESC para fechar modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeTestModal();
            }
        });
    </script>
</body>

</html>