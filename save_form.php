<?php
// Define o caminho para o arquivo JSON
$file = 'form_data.json';

// Recebe os dados enviados pelo AJAX
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data) {
    // Lê o conteúdo atual do arquivo JSON
    if (file_exists($file)) {
        $jsonData = json_decode(file_get_contents($file), true);
    } else {
        $jsonData = [];
    }

    // Adiciona os novos dados ao array existente
    $jsonData[] = $data;

    // Salva o array atualizado de volta ao arquivo JSON
    if (file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT))) {
        echo json_encode(['message' => 'Dados salvos com sucesso!']);
    } else {
        echo json_encode(['message' => 'Erro ao salvar os dados!']);
    }
} else {
    echo json_encode(['message' => 'Dados inválidos!']);
}
?>
