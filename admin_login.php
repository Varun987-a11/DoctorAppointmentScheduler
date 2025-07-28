
<!--admin_login.php-->
<?php
session_start();
include 'db_connect.php';
include 'common_styles.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT admin_id, password FROM admins WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($admin_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['admin_id'] = $admin_id;
                header("Location: admin_dashboard.php");
                exit;
            } else {
                $error_message = "Invalid password.";
            }
        } else {
            $error_message = "No admin found with that username.";
        }
        $stmt->close();
    } else {
        $error_message = "Query failed: " . $conn->error;
    }
}

render_header("Admin Login", false);
?>

<h2 style="text-align:center;">Admin Login</h2>

<?php if (!empty($error_message)): ?>
    <p class="error-message"><?php echo $error_message; ?></p>
<?php endif; ?>

<form method="POST" action="admin_login.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <input type="submit" value="Login">
</form>

<?php render_footer(); ?>
