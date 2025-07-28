<!--patient_view_appointments.php-->

<?php
include 'common_styles.php';
render_header("Page Title Here"); // Pass a title optionally
?>

<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// Fetch appointments for the patient
$stmt = $conn->prepare("SELECT appointments.appointment_id, doctors.name AS doctor_name, appointments.appointment_date, appointments.appointment_time, appointments.status 
                        FROM appointments 
                        JOIN doctors ON appointments.doctor_id = doctors.doctor_id 
                        WHERE appointments.patient_id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Appointments</title>
</head>
<body>
    <h2>My Appointments</h2>

    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Doctor Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
            </tr>
            <?php while ($appointment = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $appointment['doctor_name']; ?></td>
                    <td><?php echo $appointment['appointment_date']; ?></td>
                    <td><?php echo $appointment['appointment_time']; ?></td>
                    <td><?php echo $appointment['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You have no appointments booked yet.</p>
    <?php endif; ?>
</body>
</html>
<?php
render_footer();
?>
