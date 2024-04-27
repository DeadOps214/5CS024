<?php
session_start();

include("connection.php");
include("functions.php");

// Check if the user is logged in as a carer
if (!isset($_SESSION['carer_id'])) {
    header("Location: carer_login.php"); // Redirect to carer login page if not logged in
    exit();
}

// Fetch available patients from patient_accounts
$query = "SELECT customer_id, full_name FROM customer_accounts";
$result = mysqli_query($con, $query);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $carer_id = $_SESSION['carer_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $customer_id = $_POST['customer_id'];

    // Validate form data (You can add more validation if needed)

    // Insert new appointment into the database
    $query = "INSERT INTO appointments (carer_id, customer_id, appointment_date, appointment_time, location) VALUES ('$carer_id', '$customer_id', '$date', '$time', '$location')";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Fetch carer name
        $carerQuery = "SELECT full_name FROM carer_accounts WHERE carer_id = '$carer_id'";
        $carerResult = mysqli_query($con, $carerQuery);
        $carerData = mysqli_fetch_assoc($carerResult);
        $carer_name = $carerData['full_name'];

        // Send email notifications
        sendEmailNotification($carer_id, "carer", $date, $time, $location, $customer_name);
        sendEmailNotification($customer_id, "customer", $date, $time, $location, $carer_name);

        header("Location: carer_dashboard.php"); // Redirect back to carer dashboard
        exit();
    } else {
        // Appointment creation failed
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <h1>Create New Appointment</h1>

    <form action="create_appointment.php" method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>

        <label for="customer_id">Select Customer:</label>
        <select id="customer_id" name="customer_id" required>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <option value="<?php echo $row['customer_id']; ?>"><?php echo $row['full_name']; ?></option>
            <?php endwhile; ?>
        </select><br>

        <button type="submit">Create Appointment</button>
    </form>

    <!-- Add any additional content or scripts as needed -->
</body>
</html>

