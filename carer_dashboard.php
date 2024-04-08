<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("location: carer_login.php");
    exit();
}

include("connection.php");

// Fetch user's name
$user_id = $_SESSION['user_id'];
$query = "SELECT full_name FROM carer_accounts WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
if (!$result) {
    echo "Error fetching user data: " . mysqli_error($con);
    exit();
}
$user_data = mysqli_fetch_assoc($result);
$user_name = $user_data['full_name'];

// Fetch user's timetable
$query = "SELECT * FROM carer_timetable WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
if (!$result) {
    echo "Error fetching timetable data: " . mysqli_error($con);
    exit();
}

// Check if the form is submitted for updating the timetable
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Update timetable
    // Validate and sanitize inputs
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
    $appointment = mysqli_real_escape_string($con, $_POST['appointment']);

    // Insert or update timetable entry
    $query = "INSERT INTO carer_timetable (user_id, date, time, appointment) VALUES ('$user_id', '$date', '$time', '$appointment')
              ON DUPLICATE KEY UPDATE time = '$time', appointment = '$appointment'";
    $result = mysqli_query($con, $query);
    if (!$result) {
        echo "Error updating timetable: " . mysqli_error($con);
        exit();
    }

    // Redirect to prevent form resubmission
    header("Location: carer_dashboard.php");
    exit();
}

// Close the connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carer Dashboard</title>
    <!-- Add your CSS styles here -->
</head>
<body>

<h1>Welcome, <?php echo $user_name; ?>!</h1>

<h2>Your Timetable</h2>
<table border="1">
    <thead>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Appointment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['time'] . "</td>";
            echo "<td>" . $row['appointment'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<h2>Add/Update Appointment</h2>
<form action="" method="post">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br>
    <label for="time">Time:</label>
    <input type="time" id="time" name="time" required><br>
    <label for="appointment">Appointment:</label>
    <input type="text" id="appointment" name="appointment" required><br>
    <button type="submit">Submit</button>
</form>

</body>
</html>