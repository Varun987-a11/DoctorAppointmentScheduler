<?php
include 'db_connect.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if admin is logged in
if (isset($_SESSION['admin_id'])) {
    // Admin is logged in
    if (isset($_POST['appointment_id'])) {
        $appointment_id = $_POST['appointment_id'];

        // Admin can delete any appointment without checking patient_id
        $stmt = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ?");
        $stmt->bind_param("i", $appointment_id);

        if ($stmt->execute()) {
            // Redirect back to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            die("Error deleting appointment: " . $stmt->error);
        }
    } else {
        header("Location: admin_dashboard.php");
        exit();
    }
}

// Otherwise, if patient is logged in
elseif (isset($_SESSION['patient_id'])) {
    if (isset($_POST['appointment_id'])) {
        $appointment_id = $_POST['appointment_id'];

        // Delete appointment only if it belongs to the logged-in patient
        $stmt = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ? AND patient_id = ?");
        $stmt->bind_param("ii", $appointment_id, $_SESSION['patient_id']);

        if ($stmt->execute()) {
            // Redirect back to patient dashboard
            header("Location: patient_dashboard.php");
            exit();
        } else {
            die("Error deleting appointment: " . $stmt->error);
        }
    } else {
        header("Location: patient_dashboard.php");
        exit();
    }
}

// If neither admin nor patient is logged in, redirect to homepage
else {
    header("Location: index.php");
    exit();
}
?>
