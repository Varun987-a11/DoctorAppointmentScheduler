<!--patient_logout.php-->
<?php
if (session_status() === PHP_SESSION_NONE) 
    session_start();

// Unset all session variables
$_SESSION = [];

// Destroy session cookie (optional but clean)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session itself
session_destroy();

// Redirect to the homepage (index.php)
header("Location: index.php");
exit();
?>
