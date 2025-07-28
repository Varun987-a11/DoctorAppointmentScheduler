
<!--common_styles.php-->
<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function render_header($title = "Appointment Scheduler", $show_nav = true) {
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($title); ?></title>
    <style>
        /* Revised color palette and improved styles */
        :root {
            --primary-color: #4a90e2;
            --primary-hover: #357ABD;
            --secondary-color: #50e3c2;
            --secondary-hover: #3bbf9a;
            --header-bg: #2c3e50;
            --nav-bg: #34495e;
            --nav-hover-bg: #3d566e;
            --text-color: #2c3e50;
            --text-light: #7f8c8d;
            --background-color: #f5f7fa;
            --error-color: #e74c3c;
            --success-color: #27ae60;
            --table-header-bg: #4a90e2;
            --table-header-color: #ffffff;
            --table-row-even-bg: #ecf0f1;
            --border-radius: 6px;
            --transition-speed: 0.3s;
        }

        body {
            margin: 0;
            padding: 0;
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            line-height: 1.6;
        }
        header {
            background-color: var(--header-bg);
            color: white;
            padding: 20px 30px;
            text-align: center;
            font-size: 40px;
            font-weight: 900;
            letter-spacing: 1.2px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
<?php if ($show_nav): ?>
        nav {
            background-color: var(--nav-bg);
            padding: 12px 20px;
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            box-shadow: inset 0 -1px 0 rgba(255,255,255,0.1);
        }
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 18px;
            border-radius: var(--border-radius);
            transition: background-color var(--transition-speed) ease;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        nav a:hover, nav a:focus {
            background-color: var(--nav-hover-bg);
            outline: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
<?php endif; ?>
        main {
            max-width: 960px;
            margin: 30px auto 50px auto;
            padding: 20px 30px 40px 30px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: var(--border-radius);
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
            max-width: 450px;
            margin: 0 auto;
        }
        label {
            font-weight: 600;
            font-size: 16px;
            color: var(--text-color);
        }
        input[type="text"],
        input[type="password"],
        select {
            padding: 12px 14px;
            font-size: 16px;
            border: 1.5px solid #ccc;
            border-radius: var(--border-radius);
            width: 100%;
            box-sizing: border-box;
            transition: border-color var(--transition-speed) ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 6px var(--primary-color);
        }
        input[type="submit"], button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 14px 0;
            font-size: 18px;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: background-color var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            font-weight: 700;
            box-shadow: 0 4px 8px rgba(74, 144, 226, 0.4);
        }
        input[type="submit"]:hover, input[type="submit"]:focus, button:hover, button:focus {
            background-color: var(--primary-hover);
            outline: none;
            box-shadow: 0 6px 12px rgba(53, 122, 189, 0.6);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            font-size: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 14px 18px;
            text-align: left;
        }
        th {
            background-color: var(--table-header-bg);
            color: var(--table-header-color);
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: var(--table-row-even-bg);
        }
        tr:hover {
            background-color: var(--secondary-color);
            color: var(--header-bg);
            transition: background-color var(--transition-speed) ease;
        }
        .error-message {
            color: var(--error-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }
        .success-message {
            color: var(--success-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }
        footer {
            text-align: center;
            padding: 20px 10px;
            color: var(--text-light);
            font-size: 14px;
            margin-top: 60px;
            border-top: 1px solid #ddd;
            user-select: none;
        }
        .patient-name {
    font-size: 62px;
    font-weight: bold;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color:rgb(69, 150, 147);
}



        /* Responsive improvements */
        @media (max-width: 600px) {
<?php if ($show_nav): ?>
            nav {
                flex-direction: column;
                gap: 12px;
            }
<?php endif; ?>
            main {
                margin: 20px 10px 40px 10px;
                padding: 15px 20px 30px 20px;
            }
            input[type="submit"], button {
                font-size: 16px;
                padding: 12px 0;
            }
        }
    </style>
</head>
<body>
    <header>Appointment Scheduler</header>
<?php if ($show_nav): ?>
    <nav>
        <a href="index.php">Home</a>
        <?php if (isset($_SESSION['admin_id'])): ?>
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="admin_logout.php">Logout</a>
        <?php elseif (isset($_SESSION['patient_id'])): ?>
            <a href="book_appointment.php">Book Appointment</a>
            <a href="patient_dashboard.php">Patient Dashboard</a>
            <a href="view_doctors.php">View Doctors</a>
            <a href="patient_logout.php">Logout</a>

        <?php else: ?>
            <!-- <a href="index.php">Home</a> -->
            <a href="admin_login.php">Admin Login</a>
            <a href="patient_login.php">Patient Login</a>
            <a href="patient_register.php">Patient Register</a>
            <a href="view_doctors.php">View Doctors</a>
            <a href="book_appointment.php">Book Appointment</a>
        <?php endif; ?>
    </nav>
<?php endif; ?>
    <main>
<?php
}

function render_footer() {
?>
    </main>
    <footer>
        &copy; <?php echo date("Y"); ?>  Appointment Scheduler
    </footer>
</body>
</html>
<?php
}
?>
