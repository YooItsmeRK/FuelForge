<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['recipe_id'])) {
    $recipe_id = intval($_POST['recipe_id']);
    $user_id = intval($_SESSION['user_id']);
    
    // Fetch logged-in user's email to verify ownership
    $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($user_email);
    $stmt->fetch();
    $stmt->close();
    
    if ($user_email) {
        // Fetch recipe to ensure it exists and belongs strictly to this user
        $stmt = $conn->prepare("SELECT image FROM recipes WHERE id = ? AND email = ?");
        $stmt->bind_param("is", $recipe_id, $user_email);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $image_path = $row['image'];
            
            // Authorized -> Delete database record
            $del_stmt = $conn->prepare("DELETE FROM recipes WHERE id = ? AND email = ?");
            $del_stmt->bind_param("is", $recipe_id, $user_email);
            if ($del_stmt->execute()) {
                // Delete physical image file from the /uploads folder to save server space
                if ($image_path && file_exists($image_path)) {
                    unlink($image_path);
                }
                $_SESSION['flash_msg'] = "Recipe has been permanently deleted.";
            }
            $del_stmt->close();
        }
        $stmt->close();
    }
}

// Redirect quietly back to dashboard
header("Location: dashboard.php");
exit;
?>
