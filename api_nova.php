<?php
header('Content-Type: application/json');

$chaveSuja = 'AIzaSyBVg7D-IPf6v26ToK2FcBJ3XyHGu2PqkFY'; 
$apiKey = trim($chaveSuja); 

$input = json_decode(file_get_contents('php://input'), true);
// Captura a mensagem real que o usuário digitou
$userMessage = $input['message'] ?? 'Oi'; 

$data = [
    "contents" => [
        [
            "parts" => [
                // IMPORTANTE: Use a variável $userMessage aqui dentro das aspas
                ["text" => "Você é o Assistente Neural do SENAI VR. Responda de forma técnica: " . $userMessage]
            ]
        ]
    ]
];

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-8b:generateContent?key=" . $apiKey;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Desabilitar verificação SSL (apenas para ambiente local/XAMPP se der erro de certificado)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$result = json_decode($response, true);
curl_close($ch);

if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    echo json_encode(['response' => $result['candidates'][0]['content']['parts'][0]['text']]);
} else {
    // Caso a chave esteja inválida ou o Google bloqueie, ele avisará aqui
    echo json_encode(['response' => "Erro no Núcleo Neural: " . ($result['error']['message'] ?? 'Conexão instável.')]);
}