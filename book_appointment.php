<?php
include 'db_connect.php';

if (session_status() === PHP_SESSION_NONE) 
    session_start();

// Check if user is logged in (before any output)
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

include 'common_styles.php';
render_header("Book Appointment");

// Fetch available doctors from the database
$doctors = [];
$stmt = $conn->prepare("SELECT * FROM doctors");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}

$message = "";

if (isset($_POST['book_appointment'])) {
    $doctor_id = $_POST['doctor_id'];
    $appointment_time_raw = $_POST['appointment_time'];
    $patient_id = $_SESSION['patient_id'];

    // Convert the datetime-local format to MySQL format (using both date and time)
    $appointment_datetime = date("Y-m-d H:i:s", strtotime($appointment_time_raw));

    // Debugging output: Check the formatted appointment datetime
    echo "Formatted Appointment DateTime: $appointment_datetime <br>";

    // Fetch the doctor's schedule for the selected time (Check day and if time is within available hours)
    $stmt = $conn->prepare("SELECT * FROM doctor_schedule WHERE doctor_id = ? 
                            AND ? BETWEEN start_time AND end_time");
    $stmt->bind_param("is", $doctor_id, $appointment_datetime);
    $stmt->execute();
    $schedule = $stmt->get_result()->fetch_assoc();

    // Debugging output: Check if doctor schedule is returned
    if (!$schedule) {
        $message = "<p style='color: red;'>❌ Error: Doctor is not available at the selected time.</p>";
    } else {
        // Check if the selected time is already taken by another appointment
        $stmt = $conn->prepare("SELECT * FROM appointments WHERE doctor_id = ? AND appointment_datetime = ?");
        $stmt->bind_param("is", $doctor_id, $appointment_datetime);
        $stmt->execute();
        $appointment_check = $stmt->get_result()->fetch_assoc();

        if ($appointment_check) {
            $message = "<p style='color: red;'>❌ Error: This time slot is already taken. Please choose another time.</p>";
        } else {
            // Debugging output: Check if insert query executes successfully
            $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_datetime) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $patient_id, $doctor_id, $appointment_datetime);

            if ($stmt->execute()) {
                $message = "<p style='color: green;'>✅ Appointment booked successfully!</p>";
                
            } else {
                echo "Insert Error: " . htmlspecialchars($stmt->error) . "<br>";
                $message = "<p style='color: red;'>❌ Error: " . htmlspecialchars($stmt->error) . "</p>";
            }
            
        }
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

    <?php if (!empty($message)) echo $message; ?>

    <form method="POST" action="">
        <label>Select Doctor:</label><br>
        <select name="doctor_id" required>
            <option value="">Select a Doctor</option>
            <?php foreach ($doctors as $doctor): ?>
                <option value="<?php echo $doctor['doctor_id']; ?>"><?php echo htmlspecialchars($doctor['name']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Appointment Time:</label><br>
        <input type="datetime-local" name="appointment_time" required><br><br>

        <input type="submit" name="book_appointment" value="Book Appointment">
        
    </form>
</body>
</html>

<?php 
render_footer(); 
?>
