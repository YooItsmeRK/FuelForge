<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require 'includes/db.php';

$success = false;
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $subject = $conn->real_escape_string($_POST['subject'] ?? '');
    $message = $conn->real_escape_string($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = "All text fields must be completed before transmission.";
    } else {
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        if ($conn->query($sql) === TRUE) {
            $success = true;
            
            /* =========================================================
             *  OPTIONAL: PHPMAILER NOTIFICATION SETUP
             * =========================================================
             * To send real emails from a WAMP/XAMPP localhost server
             * you must use an SMTP relay like Gmail, because localhost
             * mail() servers are usually blocked by spam filters.
             *
             * HOW TO ENABLE:
             * 1. Run: `composer require phpmailer/phpmailer` in terminal
             * 2. Replace this comment block with the template below:
             * 
             * use PHPMailer\PHPMailer\PHPMailer;
             * require 'vendor/autoload.php';
             * $mail = new PHPMailer(true);
             * $mail->isSMTP();
             * $mail->Host = 'smtp.gmail.com';
             * $mail->SMTPAuth = true;
             * $mail->Username = 'yourgmail@gmail.com';
             * $mail->Password = 'your-secure-app-password';
             * $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
             * $mail->Port = 587;
             * $mail->setFrom($email, $name);
             * $mail->addAddress('admin@fuelforge.com', 'Admin');
             * $mail->Subject = "Contact Query: " . $subject;
             * $mail->Body = $message;
             * $mail->send();
             * ======================================================== */
             
        } else {
            $error = "Internal database error: " . $conn->error;
        }
    }
}

// Prefill form if user is logged in
$logged_in_name = '';
$logged_in_email = '';
if (isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT email, username FROM users WHERE id = ?");
    $user_id = $_SESSION['user_id'];
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($logged_in_email, $logged_in_name);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | FuelForge</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { background-color: #0a0a0a; color: white; display: flex; flex-direction: column; min-height: 100vh; }
        .contact-card {
            background-color: #1e1e1e;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
            border: 1px solid #333;
        }
        .contact-icon {
            font-size: 3rem;
            color: #ff5722;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Contact Page Content -->
    <section class="section-padding flex-grow-1" style="padding-top: 60px; padding-bottom: 60px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    
                    <div class="text-center mb-5">
                        <i class="bi bi-chat-square-text-fill contact-icon"></i>
                        <h2 class="font-heading" style="color: #ff5722;">Transmit a Message</h2>
                        <p class="text-secondary">Encountered an issue or simply want to chat? Drop us a line below.</p>
                    </div>

                    <div class="contact-card">
                        <?php if ($error): ?>
                            <div class="alert alert-danger" style="background-color: #2a0808; border-color: #dc3545; color: #ffcccc;">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="contact.php" id="contactForm">
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="form-label text-white fw-bold">Your Name</label>
                                    <input type="text" class="form-control p-3" id="name" name="name"
                                        placeholder="John Wick"
                                        value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : htmlspecialchars($logged_in_name); ?>"
                                        style="background-color: #111; color: white; border: 1px solid #333;" required>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label text-white fw-bold">Email Address</label>
                                    <input type="email" class="form-control p-3" id="email" name="email"
                                        placeholder="john@example.com"
                                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($logged_in_email); ?>"
                                        style="background-color: #111; color: white; border: 1px solid #333;" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="subject" class="form-label text-white fw-bold">Subject</label>
                                <input type="text" class="form-control p-3" id="subject" name="subject"
                                    placeholder="e.g. Broken Recipe Link"
                                    style="background-color: #111; color: white; border: 1px solid #333;" required>
                            </div>

                            <div class="mb-5">
                                <label for="message" class="form-label text-white fw-bold">Message Layout</label>
                                <textarea class="form-control p-3" id="message" name="message" rows="6"
                                    placeholder="Type your message explicitly here..."
                                    style="background-color: #111; color: white; border: 1px solid #333;" required></textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-5 py-3 fw-bold" style="background-color: #ff5722; border:none; letter-spacing: 1px;">
                                    <i class="bi bi-send-fill me-2"></i> FIRE AWAY
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="margin-top: auto; border-top: 1px solid #333; padding: 20px 0; background-color: #050505;">
        <div class="container text-center text-secondary">
            <p class="mb-0">© 2026 FuelForge | Forged in Code</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php if ($success): ?>
    <script>
        document.getElementById('contactForm').reset();
        Swal.fire({
            title: 'Message Transmitted!',
            text: 'We have securely logged your query into our system. Our team will review it shortly.',
            icon: 'success',
            background: '#1a1a1a',
            color: '#fff',
            confirmButtonColor: '#ff5722'
        });
    </script>
    <?php endif; ?>

</body>
</html>
