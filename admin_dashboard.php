<?php
include 'db_connect.php';
include 'common_styles.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch all appointments
$sql = "SELECT a.appointment_id, a.appointment_datetime, a.status, p.name AS patient_name, d.name AS doctor_name 
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id
        JOIN doctors d ON a.doctor_id = d.doctor_id
        ORDER BY a.appointment_datetime DESC"; // Updated to reflect datetime column

// Execute the query and check for errors
$result = $conn->query($sql);

if (!$result) {
    // Query failed, show error
    die("Error executing query: " . $conn->error);
}

render_header("Admin Dashboard - Appointments");

?>



<h2>Manage Appointments</h2>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Patient Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                    <td>
                        <?php 
                            $datetime = $row['appointment_datetime'];
                            if (!empty($datetime) && strtotime($datetime) !== false) {
                                echo htmlspecialchars(date("F j, Y", strtotime($datetime)));
                            } else {
                                echo "N/A";
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            $time = $row['appointment_datetime'];
                            if (!empty($time) && strtotime($time) !== false) {
                                echo htmlspecialchars(date("g:i A", strtotime($time)));
                            } else {
                                echo "N/A";
                            }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <form action="update_appointment_status.php" method="POST">
                            <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
                            <select name="status" required>
                                <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                <option value="approved" <?php if ($row['status'] == 'approved') echo 'selected'; ?>>Approved</option>
                                <option value="completed" <?php if ($row['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                                <option value="cancelled" <?php if ($row['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                            </select>
                            <input type="submit" value="Update Status">
                        </form>

                        <?php if ($row['status'] == 'completed'): ?>
                            <form action="delete_appointment.php" method="POST" style="margin-top: 10px;">
                                <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
                                <!--<input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this appointment?');">-->
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this appointment?');" style="background-color: red; color: white;">
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No appointments found.</p>
<?php endif; ?>

<?php render_footer(); ?>
