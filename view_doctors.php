<!--view_doctors.php-->

<?php
ob_start(); // Start output buffering first
session_start();

// First, check session and redirect if needed (before any output)
if (!isset($_SESSION['patient_id'])) {
    header("Location: patient_login.php");
    exit();
}

// Then include common files
include 'common_styles.php';
render_header("Available Doctors");

include 'db_connect.php';

// Fetch doctor data
$query = "SELECT * FROM doctors";
$result = mysqli_query($conn, $query);
?>

<h2 style="text-align: center;">List of Available Doctors</h2>

<?php if (mysqli_num_rows($result) > 0): ?>
    <table style="border-collapse: collapse; width: 80%; margin: 20px auto;">
        <tr>
            <th style="padding: 12px; border: 1px solid #ccc;">Name</th>
            <th style="padding: 12px; border: 1px solid #ccc;">Specialization</th>
            <th style="padding: 12px; border: 1px solid #ccc;">Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td style="padding: 12px; border: 1px solid #ccc;"><?php echo htmlspecialchars($row['name']); ?></td>
                <td style="padding: 12px; border: 1px solid #ccc;"><?php echo htmlspecialchars($row['specialty']); ?></td>
                <td style="padding: 12px; border: 1px solid #ccc;">
                    <a class="button" href="book_appointment.php?doctor_id=<?php echo $row['doctor_id']; ?>" 
                       style="padding: 6px 12px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
                       Book Now
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php else: ?>
    <p style="text-align: center;">No doctors found.</p>
<?php endif; ?>

<?php 
render_footer(); 
ob_end_flush(); // Flush the output buffer at the end
?>
