<?php
// Define o cabeçalho para permitir solicitações de outros domínios (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obtém os dados JSON enviados via POST
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    // Define o caminho e o nome do arquivo JSON
    $file = 'form_data.json';

    // Abre o arquivo JSON existente, ou cria um novo se não existir
    if (file_exists($file)) {
        $current_data = json_decode(file_get_contents($file), true);
    } else {
        $current_data = [];
    }

    // Adiciona os novos dados ao array existente
    $current_data[] = $data;

    // Salva os dados atualizados no arquivo JSON
    file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT));

    // Retorna uma resposta de sucesso
    echo json_encode(["message" => "Dados salvos com sucesso!"]);
} else {
    // Retorna uma resposta de erro se os dados não forem recebidos
    echo json_encode(["message" => "Nenhum dado recebido!"]);
}
?>
