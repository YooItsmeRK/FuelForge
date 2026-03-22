<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize_input($_POST['username'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Check if user exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $error = "Username or Email already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("sss", $username, $email, $hashed_password);
            
            if ($insert_stmt->execute()) {
                $success = "Registration successful! You can now <a href='login.php'>login</a>.";
            } else {
                $error = "Something went wrong. Please try again later.";
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | FuelForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body { background-color: #0a0a0a; color: white; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .auth-container { background-color: #1a1a1a; padding: 40px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.5); width: 100%; max-width: 400px; }
        .auth-container h2 { color: #ff5722; font-family: 'Cinzel', serif; font-weight: 700; text-align: center; margin-bottom: 20px; }
        .form-control { background-color: #0d0d0d; border: 1px solid #333; color: white; margin-bottom: 15px; }
        .form-control:focus { background-color: #0d0d0d; color: white; border-color: #ff5722; box-shadow: none; }
        .btn-auth { background-color: #ff5722; color: white; border: none; width: 100%; padding: 10px; border-radius: 5px; font-weight: 600; }
        .btn-auth:hover { background-color: #e64a19; }
        .auth-links { text-align: center; margin-top: 15px; }
        .auth-links a { color: #ff9800; text-decoration: none; }
        .auth-links a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="text-center mb-4">
            <a href="../index.php"><img src="../images/logo.png" alt="FuelForge" style="height: 40px; transform: scale(2.2); transform-origin: center;"></a>
        </div>
        <h2 class="mt-4">Register</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-danger p-2 text-center"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success p-2 text-center"><?php echo $success; ?></div>
        <?php else: ?>
        <form method="POST" action="register.php">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <button type="submit" class="btn-auth">Register</button>
        </form>
        <?php endif; ?>
        <div class="auth-links">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
