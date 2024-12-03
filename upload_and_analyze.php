<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file = $_FILES['file'];
        // You can move the file to a folder, process it, or send it to an API
        // For example, sending it to an AI detection API
        $aiGeneratedPercentage = rand(0, 100); // Simulated AI percentage

        // Respond with AI detection result
        echo json_encode(['success' => true, 'ai_percentage' => $aiGeneratedPercentage]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
