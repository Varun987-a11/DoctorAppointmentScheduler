<?php
ob_start();
session_start();

include 'db_connect.php';

$errorMsg = "";

if (isset($_POST['register'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare and execute insert query
    $stmt = $conn->prepare("INSERT INTO patients (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        // Redirect to login page upon successful registration
        header("Location: patient_login.php");
        exit();
    } else {
        $errorMsg = htmlspecialchars($stmt->error);
    }
}

include 'common_styles.php';
render_header("Patient Registration", false);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Registration</title>
</head>
<body>
    <h2>Patient Registration</h2>

    <?php if (!empty($errorMsg)): ?>
        <p class="error-message"><?php echo $errorMsg; ?></p>
    <?php endif; ?>

    <form method="POST" action="patient_register.php">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>

<?php
render_footer();
ob_end_flush();
?>
