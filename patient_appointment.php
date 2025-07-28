<!--patient_appointment.php-->

<?php
include 'common_styles.php';
render_header("Page Title Here"); // Pass a title optionally
?>

<?php
session_start();
include 'db_connect.php';

// Fetch all doctors
$stmt = $conn->prepare("SELECT doctor_id, name FROM doctors");
$stmt->execute();
$doctors_result = $stmt->get_result();

// Debugging: Check if any rows are returned
if ($doctors_result->num_rows === 0) {
    echo "❌ No doctors available. Please check the database.";
} else {
    // Continue with the rest of the code
}

// Check if the form is submitted
if (isset($_POST['book_appointment'])) {
    $patient_id = $_SESSION['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = 'pending'; // Default status for a new appointment

    // Insert the appointment into the database
    $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $patient_id, $doctor_id, $appointment_date, $appointment_time, $status);

    if ($stmt->execute()) {
        echo "✅ Appointment booked successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
</head>
<body>
    <h2>Book Appointment</h2>

    <form method="POST" action="patient_appointment.php">
        <label for="doctor">Select Doctor:</label><br>
        <select name="doctor_id" required>
            <option value="">Select a Doctor</option>
            <?php while ($doctor = $doctors_result->fetch_assoc()): ?>
                <option value="<?php echo $doctor['doctor_id']; ?>"><?php echo $doctor['name']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="appointment_date">Select Date:</label><br>
        <input type="date" name="appointment_date" required><br><br>

        <label for="appointment_time">Select Time:</label><br>
        <input type="time" name="appointment_time" required><br><br>

        <input type="submit" name="book_appointment" value="Book Appointment">
    </form>
</body>
</html>
<?php
render_footer();
?>
