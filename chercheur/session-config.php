<?php 
    // Start the session
    session_start();
    // Check if the session is not active or expired
    if (!isset($_SESSION['chrcheurEmail']) || time() > $_SESSION['expiration_time']) {
        // Session expired, destroy the session and redirect to the login page
        session_destroy();
        header("Location: login.php");
        exit();
    }

    // Update the expiration time to extend the session
    $_SESSION['expiration_time'] = time() + 30 * 60;

?>