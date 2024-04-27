<?php
session_start();

include("connection.php");
include("functions.php");

// Check if the user is logged in as a carer
if (!isset($_SESSION['carer_id'])) {
    header("Location: carer_login.php"); // Redirect to carer login page if not logged in
    exit();
}

// Fetch carer's appointments
$carer_id = $_SESSION['carer_id'];
$query = "SELECT * FROM appointments WHERE carer_id = $carer_id ORDER BY appointment_date ASC";
$result = mysqli_query($con, $query);

// Retrieve the logged-in user's username if set in the session
$username = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Undefined";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer Dashboard</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .header {
            text-align: center;
            padding: 50px 0;
            background-color: #f9f9f9;
        }
        .header h1 {
            font-size: 36px;
        }
        .jumbotron {
            background-color: #f9f9f9;
            margin-bottom: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand">Carer Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="carer_account.php"><?php echo $username; ?></a>
            </li>
        </ul>
    </div>
</nav>

<div class="header">
    <h1>Welcome, Carer!</h1>
</div>

<div class="container">
    <div class="jumbotron">
        <h2>Your Appointments:</h2>

        <!-- Display existing appointments in a table -->
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Customer Name</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['appointment_date']; ?></td>
                        <td><?php echo $row['appointment_time']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <!-- Fetch customer name from related table -->
                        <?php
                            $customer_id = $row['customer_id'];
                            $customer_query = "SELECT full_name FROM customer_accounts WHERE customer_id = $customer_id";
                            $customer_result = mysqli_query($con, $customer_query);
                            $customer_data = mysqli_fetch_assoc($customer_result);
                            $customer_name = $customer_data['full_name'];
                        ?>
                        <td><?php echo $customer_name; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>No appointments found.</p>
        <?php endif; ?>

        <h2>Create New Appointment:</h2>
        <!-- Link to create appointment form -->
        <a href="create_appointment.php">Create New Appointment</a>
    </div>
</div>

<footer class="footer mt-auto py-3 bg-dark">
    <div class="container text-white">
        <span class="text-muted">Helping Hands - Connecting Hearts, Enriching Lives.</span>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



