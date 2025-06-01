<?php
header('Content-Type: application/json');

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);
$question = trim($data["question"] ?? "");

// Validate question
if (empty($question)) {
    echo json_encode(["answer" => "❌ Please enter a question."]);
    exit;
}

// Your OpenAI API Key (NEVER expose this on the frontend!)
$apiKey = "YOUR_OPENAI_API_KEY"; // 🔐 Replace with a real key from https://platform.openai.com/account/api-keys

// Prepare OpenAI API request
$payload = json_encode([
    "model" => "gpt-3.5-turbo",
    "messages" => [
        ["role" => "user", "content" => $question]
    ]
]);

$ch = curl_init("https://api.openai.com/v1/chat/completions");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ]
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Handle response
if ($httpCode !== 200 || !$response) {
    echo json_encode(["answer" => "⚠️ Failed to get a response from AI (Status: $httpCode)."]);
    exit;
}

$decoded = json_decode($response, true);
$answer = $decoded["choices"][0]["message"]["content"] ?? "⚠️ No response received.";

echo json_encode(["answer" => nl2br(htmlspecialchars($answer))]);
