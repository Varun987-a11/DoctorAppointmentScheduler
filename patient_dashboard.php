<?php
if (session_status() === PHP_SESSION_NONE) 
    session_start();

include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

// Now safe to load HTML
include 'common_styles.php';
render_header("Patient Dashboard");

// Fetch patient details from the database
$patient_id = $_SESSION['patient_id'];
$stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

// Fetch appointments for the logged-in patient
$appointments = [];
$stmt = $conn->prepare("SELECT a.appointment_id, a.appointment_datetime, a.status, d.name AS doctor_name 
                        FROM appointments a 
                        JOIN doctors d ON a.doctor_id = d.doctor_id 
                        WHERE a.patient_id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
</head>
<body>
    <!-- <h2>Welcome, <?php echo htmlspecialchars($patient['name']); ?>!</h2> -->
    <div style="text-align: center; margin-top: 20px;">
    <h2>Welcome, <span class="patient-name"><?php echo htmlspecialchars($patient['name']); ?>!</span></h2>
</div>

    <p>Email: <?php echo htmlspecialchars($patient['email']); ?></p>
    <p>Registered on: <?php echo htmlspecialchars($patient['created_at']); ?></p>

    <!-- Appointment Section -->
    <h3>Your Appointments</h3>

    <?php if (empty($appointments)): ?>
        <p>You don't have any appointments yet. You can <a href="book_appointment.php">book an appointment</a> now!</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Appointment Date & Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment['doctor_name']); ?></td>
                        <td>
                            <?php
                                // Format the datetime from appointment_datetime column
                                $datetime = $appointment['appointment_datetime'];
                                if ($datetime) {
                                    echo htmlspecialchars(date("F j, Y, g:i A", strtotime($datetime)));
                                } else {
                                    echo "N/A";
                                }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($appointment['status']); ?></td>
                        <td>
                            <!-- Add Delete button for each appointment -->
                            <form action="delete_appointment.php" method="POST" style="display:inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this appointment?');" style="background-color: red; color: white;">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <br>
    <!-- <a href="patient_logout.php">Logout</a> -->
    <div style="text-align: center; margin-top: 30px;">
    <a href="patient_logout.php" style="display: inline-block; padding: 10px 20px; background-color: #d9534f; color: white; text-decoration: none; border: none; border-radius: 5px; font-weight: bold;">Logout</a>
</div>

</body>
</html>

<?php
render_footer();
?>
