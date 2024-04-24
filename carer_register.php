<?php
session_start();

include("connection.php");
include("functions.php");

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if something was posted
    $fullname = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['passwordConfirmation'];

    // Validate inputs
    if(empty($fullname)) {
        $errors['fullname'] = "Name is required";
    }
    if(empty($user_name)) {
        $errors['user_name'] = "Username is required";
    }
    if(empty($email)) {
        $errors['email'] = "Email is required";
    } elseif(!isValidEmail($email)) {
        $errors['email'] = "Invalid email address";
    }
    if(empty($password)) {
        $errors['password'] = "Password is required";
    } elseif(strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long";
    }
    if($password !== $passwordConfirmation) {
        $errors['passwordConfirmation'] = "Passwords do not match";
    }

    // If no errors, proceed with registration
    if(empty($errors)) {
        $user_id = random_num(11);
        $query = "INSERT INTO carer_accounts (carer_id, full_name, user_name, email, password) VALUES ('$user_id', '$fullname', '$user_name', '$email', md5('$password'))";
        $result = mysqli_query($con, $query);

        if($result) {
            header("location: carer_login.php");
            exit;
        } else {
            $errors['database'] = "Error inserting data into the database";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carer Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
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

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Carer Registration</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Carers
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="carer_login.php">Login</a>
                    <a class="dropdown-item" href="carer_register.php">Register</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Patients
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="patient_login.php">Login</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h1>CARER REGISTRATION FORM</h1>
    <!-- Registration form -->
    <form id="registrationForm" action="" method="post" autocomplete="on">
        <div style="position: relative;">
            <label for="fullname"><b>Name:</b></label>
            <input type="text" placeholder="Name" name="full_name" required value="">
            <div class="error" id="fullnameError">
                <?php echo isset($errors['fullname']) ? $errors['fullname'] : ''; ?>
            </div>
        </div>
        <br>

        <div style="position: relative;">
            <label for="user_name"><b>Username:</b></label>
            <input type="text" placeholder="Enter Username" name="user_name" required value="">
            <div class="error" id="usernameError">
                <?php echo isset($errors['user_name']) ? $errors['user_name'] : ''; ?>
            </div>
        </div>
        <br>

        <div style="position: relative;">
            <label for="email"><b>Email:</b></label>
            <input type="email" placeholder="Enter Email" name="email" required value="">
            <div class="error" id="emailError">
                <?php echo isset($errors['email']) ? $errors['email'] : ''; ?>
            </div>
        </div>
        <br>

        <div style="position: relative;">
            <label for="password"><b>Password:</b></label>
            <input type="password" placeholder="Enter Password" name="password" required value="">
            <div class="error" id="passwordError">
                <?php echo isset($errors['password']) ? $errors['password'] : ''; ?>
            </div>
        </div>
        <br>

        <div style="position: relative;">
            <label for="passwordConfirmation"><b>Confirm password:</b></label>
            <input type="password" placeholder="Confirm Password" name="passwordConfirmation" required value="">
            <div class="error" id="passwordConfirmationError">
                <?php echo isset($errors['passwordConfirmation']) ? $errors['passwordConfirmation'] : ''; ?>
            </div>
        </div>
        <br>
        <!-- Register button -->

        <button type="submit" class="btn btn-primary">Register</button>
        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
    </form>
    <br>
    <a href="patient_login.php"> Login </a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('#registrationForm input').on('input', function() {
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
            case 'password':
                if(inputValue === '') {
                    errorDiv.html('Password is required').show();
                } else if(inputValue.length < 8) {
                    errorDiv.html('Password must be at least 8 characters long').show();
                }
                break;
            case 'passwordConfirmation':
                var passwordValue = $('input[name="password"]').val().trim();
                if(inputValue === '') {
                    errorDiv.html('Confirm password is required').show();
                } else if(inputValue !== passwordValue) {
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
