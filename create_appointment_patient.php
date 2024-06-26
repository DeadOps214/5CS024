<?php
session_start();

include("connection.php");
include("functions.php");

// Check if the user is logged in as a customer
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php"); // Redirect to customer login page if not logged in
    exit();
}

// Fetch available carers from carer_accounts
$query = "SELECT carer_id, full_name, email FROM carer_accounts";
$resultCarers = mysqli_query($con, $query);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_id = $_SESSION['customer_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $carer_id = $_POST['carer_id'];

    // Validate form data (You can add more validation if needed)

    // Insert new appointment into the database
    $query = "INSERT INTO appointments (carer_id, customer_id, appointment_date, appointment_time, location) VALUES ('$carer_id', '$customer_id', '$date', '$time', '$location')";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Appointment created successfully

        // Fetch carer's email address and name
        $carer_email_query = "SELECT email, full_name FROM carer_accounts WHERE carer_id = '$carer_id'";
        $carer_email_result = mysqli_query($con, $carer_email_query);
        $carer_email_row = mysqli_fetch_assoc($carer_email_result);
        $carer_email = $carer_email_row['email'];
        $carer_name = $carer_email_row['full_name'];

        // Send email notification to carer
        $carer_subject = "Appointment Booked";
        $carer_message = "Appointment booked with you by a patient on $date at $time. Location: $location";

        sendEmailNotification($carer_email, $carer_subject, $carer_message);

        // Fetch customer's email address and name
        $customer_email_query = "SELECT email, full_name FROM customer_accounts WHERE customer_id = '$customer_id'";
        $customer_email_result = mysqli_query($con, $customer_email_query);
        $customer_email_row = mysqli_fetch_assoc($customer_email_result);
        $customer_email = $customer_email_row['email'];
        $customer_name = $customer_email_row['full_name'];

        // Send email notification to customer
        $customer_subject = "Appointment Booked";
        $customer_message = "Appointment booked with carer $carer_name on $date at $time. Location: $location";

        sendEmailNotification($customer_email, $customer_subject, $customer_message);

        // Redirect back to patient dashboard
        header("Location: patient_dashboard.php");
        exit();
    } else {
        // Appointment creation failed
        echo "Error: " . mysqli_error($con);
    }
}

// Fetch customer's appointments
$customer_id = $_SESSION['customer_id'];
$query = "SELECT * FROM appointments WHERE customer_id = $customer_id ORDER BY appointment_date ASC";
$resultAppointments = mysqli_query($con, $query);
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

    <form action="create_appointment_patient.php" method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>

        <label for="carer_id">Select Carer:</label>
        <select id="carer_id" name="carer_id" required>
            <?php while ($row = mysqli_fetch_assoc($resultCarers)) : ?>
                <option value="<?php echo $row['carer_id']; ?>"><?php echo $row['full_name']; ?></option>
            <?php endwhile; ?>
        </select><br>

        <button type="submit">Create Appointment</button>
    </form>

    <!-- Add any additional content or scripts as needed -->
</body>
</html>
