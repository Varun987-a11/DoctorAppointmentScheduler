<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Appointment Scheduler - Home</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Lora:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Lora', serif;
      background-color:rgb(204, 206, 210);
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      color: #1B2A41;
    }

    header {
      background-color:hsl(216, 55.60%, 19.40%);
      padding: 30px 20px;
      color: white;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    header h1 {
      font-family: 'Roboto', sans-serif;
      /* font-size: 2.8em; */
      font-size: 45px; 
      letter-spacing: 1px;
      margin: 0;
    }

    nav {
      margin: 40px auto;
      width: 90%;
      max-width: 600px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    nav a {
      display: block;
      padding: 16px;
      background-color:hsl(216, 64.40%, 35.30%);
      color: white;
      text-decoration: none;
      text-align: center;
      border-radius: 10px;
      font-size: 19px;
      font-family: 'Roboto', sans-serif;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgb(0, 0, 0);
    }

    nav a:hover {
      background-color: #4DA8DA;
      color: #ffffff;
      transform: translateY(-3px);
    }

    nav a:active {
      transform: translateY(2px);
    }

    footer {
      margin-top: auto;
      background-color:rgb(38, 56, 83);
      color: white;
      text-align: center;
      padding: 20px;
      font-size: 14px;
    }

    footer .creator {
      color: #4DA8DA;
      font-weight: bold;
    }

    footer span {
      font-size: 12px;
      display: block;
      margin-top: 5px;
    }

    @media (max-width: 600px) {
      nav {
        width: 90%;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>Appointment Scheduler</h1>
  </header>

  <nav>
    <?php if (isset($_SESSION['admin_id'])): ?>
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="admin_logout.php">Logout</a>
    <?php elseif (isset($_SESSION['patient_id'])): ?>
        <a href="patient_dashboard.php">Patient Dashboard</a>
        <a href="patient_logout.php">Logout</a>
    <?php else: ?>
        <a href="admin_login.php">Admin Login</a>
        <a href="patient_login.php">Patient Login</a>
        <a href="patient_register.php">Patient Register</a>
    <?php endif; ?>
  </nav>

  <footer>
    &copy; <?php echo date("Y"); ?> Appointment Scheduler<br>
    <span class="creator">Created by Varun Kumar S</span>
  </footer>
</body>
</html>
