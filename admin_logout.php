<!--admin_logout.php-->
<?php
// Start session
session_start();

// Destroy all session variables
session_unset();
session_destroy();

// Redirect to login page
header("Location: index.php");
exit;
