<?php
header('Content-Type: application/json');
require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $title = $conn->real_escape_string($_POST['title'] ?? '');
    $category = $conn->real_escape_string($_POST['category'] ?? '');
    $prep_time = $conn->real_escape_string($_POST['prep_time'] ?? '');
    $ingredients = $conn->real_escape_string($_POST['ingredients'] ?? '');
    $instructions = $conn->real_escape_string($_POST['instructions'] ?? '');
    
    // Validate required fields
    if(empty($name) || empty($email) || empty($title) || empty($category) || empty($prep_time) || empty($ingredients) || empty($instructions)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }
    
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        
        $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9.\-_]/", "", basename($_FILES['image']['name']));
        $targetFilePath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $image_path = $conn->real_escape_string($targetFilePath);
        }
    }
    
    $sql = "INSERT INTO recipes (name, email, title, category, prep_time, ingredients, instructions, image) 
            VALUES ('$name', '$email', '$title', '$category', '$prep_time', '$ingredients', '$instructions', " . ($image_path ? "'$image_path'" : "NULL") . ")";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Recipe submitted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}

$conn->close();
?>
