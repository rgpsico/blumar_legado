<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$uploadDir = __DIR__ . '/uploads/';
$uploadUrl = 'blogv2/uploads/'; // caminho acessível pelo navegador, relativo à página

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (!empty($_FILES['file']['name'])) {
    $fileName = uniqid() . '_' . basename($_FILES['file']['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        // 🔹 Caminho acessível para o navegador
        $url = $uploadUrl . $fileName;
        echo json_encode(['location' => $url]);
        exit;
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Falha ao mover o arquivo.']);
        exit;
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Nenhum arquivo recebido.']);
    exit;
}
