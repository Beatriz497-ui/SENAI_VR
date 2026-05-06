<?php
header('Content-Type: application/json');

// Colamos a chave e usamos o trim() para garantir que ela fique limpa
$chaveSuja = 'AIzaSyBVg7D-IPf6v26ToK2FcBJ3XyHGu2PqkFY'; 
$apiKey = trim($chaveSuja); 

$input = json_decode(file_get_contents('php://input'), true);
// ... resto do código igual ao anterior
$userMessage = $input['message'] ?? 'Oi';

$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => "Oi, quem é você?"]
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
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$response = curl_exec($ch);
$result = json_decode($response, true);
curl_close($ch);

if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    echo json_encode(['response' => $result['candidates'][0]['content']['parts'][0]['text']]);
} else {
    echo json_encode(['response' => "Erro do Google: " . ($result['error']['message'] ?? 'Desconhecido')]);
}