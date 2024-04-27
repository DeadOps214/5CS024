<?php
session_start();

include("connection.php");
include("functions.php");

// Check if the user is logged in as a carer
if (!isset($_SESSION['carer_id'])) {
    header("Location: carer_login.php"); // Redirect to carer login page if not logged in
    exit();
}

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if something was posted
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch carer's details
    $carer_id = $_SESSION['carer_id'];
    $query = "SELECT * FROM carer_accounts WHERE carer_id = $carer_id";
    $result = mysqli_query($con, $query);
    $carer_data = mysqli_fetch_assoc($result);

    // Validate inputs
    if (empty($full_name)) {
        $errors['full_name'] = "Name is required";
    }
    if (empty($user_name)) {
        $errors['user_name'] = "Username is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!isValidEmail($email)) {
        $errors['email'] = "Invalid email address";
    }
    if (!empty($old_password) || !empty($new_password) || !empty($confirm_password)) {
        // Check if old password matches the one in the database
        $hashed_old_password = md5($old_password);
        if ($hashed_old_password !== $carer_data['password']) {
            $errors['old_password'] = "Incorrect old password";
        }
        if (empty($new_password)) {
            $errors['new_password'] = "New password is required";
        } elseif (strlen($new_password) < 8) {
            $errors['new_password'] = "Password must be at least 8 characters long";
        }
        if ($new_password !== $confirm_password) {
            $errors['confirm_password'] = "Passwords do not match";
        }
    }

    // If no errors, proceed with updating details
    if (empty($errors)) {
        // Construct the update query
        $update_query = "UPDATE carer_accounts SET full_name = '$full_name', user_name = '$user_name', email = '$email'";
        if (!empty($new_password)) {
            // Update password if a new one is provided
            $hashed_new_password = md5($new_password);
            $update_query .= ", password = '$hashed_new_password'";
        }
        $update_query .= " WHERE carer_id = $carer_id";

        // Execute the update query
        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            // Display success message and redirect to dashboard
            echo "<script>alert('Details updated successfully');</script>";
            echo "<script>window.location.href = 'carer_dashboard.php';</script>";
            exit();
        } else {
            $errors['database'] = "Error updating data in the database";
        }
    }
}

// Fetch carer's details to pre-fill the form
$carer_id = $_SESSION['carer_id'];
$query = "SELECT * FROM carer_accounts WHERE carer_id = $carer_id";
$result = mysqli_query($con, $query);
$carer_data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer Account</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .error {
            color: red;
            position: absolute;
            font-size: 0.8rem;
            background-color: #ffffff;
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
            display: none;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand">Carer Account</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="carer_dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h1>Carer Account Details</h1>
    <!-- Account update form -->
    <form id="updateForm" action="" method="post" autocomplete="off">
        <div style="position: relative;">
            <label for="full_name"><b>Name:</b></label>
            <input type="text" placeholder="Name" name="full_name" required value="<?php echo $carer_data['full_name']; ?>">
            <div class="error" id="fullNameError"><?php echo isset($errors['full_name']) ? $errors['full_name'] : ''; ?></div>
        </div>
        <br>

        <div style="position: relative;">
            <label for="user_name"><b>Username:</b></label>
            <input type="text" placeholder="Enter Username" name="user_name" required value="<?php echo $carer_data['user_name']; ?>">
            <div class="error" id="usernameError"><?php echo isset($errors['user_name']) ? $errors['user_name'] : ''; ?></div>
        </div>
        <br>

        <div style="position: relative;">
            <label for="email"><b>Email:</b></label>
            <input type="text" placeholder="Enter Email" name="email" required value="<?php echo $carer_data['email']; ?>">
            <div class="error" id="emailError"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></div>
        </div>
        <br>

        <div style="position: relative;">
            <label for="old_password"><b>Old Password:</b></label>
            <input type="password" placeholder="Enter Old Password" name="old_password">
            <div class="error" id="oldPasswordError"><?php echo isset($errors['old_password']) ? $errors['old_password'] : ''; ?></div>
        </div>
        <br>

        <div style="position: relative;">
            <label for="new_password"><b>New Password:</b></label>
            <input type="password" placeholder="Enter New Password" name="new_password">
            <div class="error" id="newPasswordError"><?php echo isset($errors['new_password']) ? $errors['new_password'] : ''; ?></div>
        </div>
        <br>

        <div style="position: relative;">
            <label for="confirm_password"><b>Confirm Password:</b></label>
            <input type="password" placeholder="Confirm Password" name="confirm_password">
            <div class="error" id="confirmPasswordError"><?php echo isset($errors['confirm_password']) ? $errors['confirm_password'] : ''; ?></div>
        </div>
        <br>

        <!-- Update button -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('#updateForm input').on('input', function() {
        var inputName = $(this).attr('name');
        var inputValue = $(this).val().trim();
        var errorDiv = $('#' + inputName + 'Error');

        // Remove previous error messages
        errorDiv.hide();

        // Validate input
        switch(inputName) {
            case 'full_name':
                if(inputValue === '') {
                    errorDiv.html('Name is required').show();
                }
                break;
            case 'user_name':
                if(inputValue === '') {
                    errorDiv.html('Username is required').show();
                }
                break;
            case 'email':
                if(inputValue === '') {
                    errorDiv.html('Email is required').show();
                } else if(!isValidEmail(inputValue)) {
                    errorDiv.html('Invalid email address').show();
                }
                break;
            case 'old_password':
                // No validation required for old password
                break;
            case 'new_password':
                if(inputValue.length < 8) {
                    errorDiv.html('Password must be at least 8 characters long').show();
                }
                break;
            case 'confirm_password':
                var newPasswordValue = $('input[name="new_password"]').val().trim();
                if(inputValue !== newPasswordValue) {
                    errorDiv.html('Passwords do not match').show();
                }
                break;
        }
    });
});

// Function to validate email
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}
</script>

</body>
</html>
