<?php
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Check if a file was uploaded
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filePath = 'uploads/' . basename($file['name']);

    // Create the uploads directory if it doesn't exist
    if (!is_dir('uploads')) {
        mkdir('uploads', 0755, true);
    }

    // Move the uploaded file to the server
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Dummy AI percentage calculation (replace this with real AI analysis logic)
        $aiPercentage = rand(0, 100);

        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO uploads (name, ai_percentage, file_path, upload_time) VALUES (?, ?, ?, NOW())");
        if (!$stmt) {
            echo json_encode(["success" => false, "message" => "Database prepare failed: " . $conn->error]);
            exit();
        }

        $stmt->bind_param("sis", $file['name'], $aiPercentage, $filePath);

        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "ai_percentage" => $aiPercentage,
                "file_path" => $filePath
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Database insert failed: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "File upload failed"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No file uploaded"]);
}

// Close the database connection
$conn->close();
?>
