<!--update_appointment_status.php-->
<?php
session_start();
include 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointment_id']) && isset($_POST['status'])) {
    $appointment_id = $_POST['appointment_id'];
    $status = $_POST['status'];

    // Update appointment status in the database
    $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE appointment_id = ?");
    $stmt->bind_param("si", $status, $appointment_id);
    
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php"); // Redirect back to dashboard after update
        exit();
    } else {
        echo "❌ Error updating appointment status.";
    }
} else {
    echo "❌ Invalid request.";
}
?>
