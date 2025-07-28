<!--db_connect.php-->

<?php
$host = "localhost";
$username = "root"; // <-- change to your actual MySQL username
$password = "vKs$135#";
$database = "appointment_scheduler";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
