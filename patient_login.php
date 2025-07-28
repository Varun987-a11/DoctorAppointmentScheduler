<!--patient_login.php-->
<?php
ob_start(); // Start output buffering

if (session_status() === PHP_SESSION_NONE) 
    session_start();

include 'db_connect.php';

$message = "";

// Handle login logic first (before any output)
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from DB
    $stmt = $conn->prepare("SELECT * FROM patients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['patient_id'] = $user['patient_id'];
            $_SESSION['patient_name'] = $user['name'];
            header("Location: patient_dashboard.php"); // Redirect without echoing anything
            exit();
        } else {
            $message = "❌ Incorrect password.";
        }
    } else {
        $message = "❌ Email not found.";
    }
}

include 'common_styles.php';
render_header("Admin Login", false);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Login</title>
</head>
<body>
    <h2>Patient Login</h2>

    <?php if (!empty($message)): ?>
        <p style="color: red; text-align: center;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST" action="patient_login.php" style="width: 300px; margin: 0 auto;">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>

<?php
render_footer();
ob_end_flush(); // End output buffering
?>
