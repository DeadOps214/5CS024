<?php
session_start();

// Include necessary files
include("connection.php");
include("functions.php");

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: patient_login.php"); // Redirect to login page if not logged in
    exit();
}

// Get the user's ID
$customer_id = $_SESSION['customer_id'];

// Fetch user details from the database
$query = "SELECT * FROM customer_accounts WHERE customer_id = $customer_id";
$result = mysqli_query($con, $query);

// Fetch the user's data
$user_data = mysqli_fetch_assoc($result);

// Initialize message variable
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $user_name = $_POST['user_name'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Encrypt new password using MD5
    $new_password_hashed = md5($new_password);

    // Update user details in the database
    $update_query = "UPDATE customer_accounts SET user_name = '$user_name', full_name = '$full_name', email = '$email', password = '$new_password_hashed' WHERE customer_id = $customer_id";
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        $message = 'Details updated successfully!';
    } else {
        $message = 'Error updating details: ' . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
        body {
            padding-top: 60px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Patient Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="patient_dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Account Settings</h2>
    <?php if (!empty($message)) : ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="user_name">Username:</label>
            <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $user_data['user_name']; ?>">
        </div>
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $user_data['full_name']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email']; ?>">
        </div>
        <div class="form-group">
            <label for="old_password">Old Password:</label>
            <input type="password" class="form-control" id="old_password" name="old_password" value="<?php echo str_repeat('*', strlen($user_data['password'])); ?>" disabled>
        </div>
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div>
        <!-- Add more form fields here for other details -->
        <button type="submit" class="btn btn-primary">Update Details</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




