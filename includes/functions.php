<?php
// Helper functions (e.g., input validation)

/**
 * Sanitize user input to prevent XSS and injection
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

?>
