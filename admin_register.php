<!--admin_register.php-->
<?php
include 'common_styles.php';
render_header("Page Title Here"); // Pass a title optionally
?>


<?php
include 'db_connect.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash password for security

    // Insert the admin details into the database
    $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "✅ Admin registered successfully! You can now log in.";
        echo "<br><br><a href='admin_login.php' style='padding: 10px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;'>Go to Admin Login</a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
</head>
<body>
    <h2>Admin Registration</h2>
    <form method="POST" action="admin_register.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>

<?php
render_footer();
?>
