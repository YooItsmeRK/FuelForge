<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashed_password);
            $stmt->fetch();
            
            if (password_verify($password, $hashed_password)) {
                // Password is correct, start session
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                header("Location: ../dashboard.php");
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No user found with that email address.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | FuelForge</title>
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
        <h2 class="mt-4">Login</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-danger p-2 text-center"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <button type="submit" class="btn-auth">Login</button>
        </form>
        
        <div class="auth-links">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
