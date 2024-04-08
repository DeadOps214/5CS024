<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if something was posted
    $fullname = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $Email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($fullname) && !empty($Email) && !empty($password) && !is_numeric($user_name)) {
        // If correctly entered, save to database
        $user_id = random_num(50);
        $query = "INSERT INTO carer_accounts (user_id, full_name, user_name, email, password) VALUES ('$user_id', '$fullname', '$user_name', '$Email', '$password')";
        mysqli_query($con, $query);
        header("location: carer_login.php");
        die;
    } else {
        echo "Please enter valid information!!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carer Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Patients
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="patient_login.php">Login</a>
                            <a class="dropdown-item" href="patient_register.php">Register</a>
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
    <form action="" method="post" autocomplete="on">
        <label for="fullname"><b>Name:</b></label>
        <input type="text" placeholder="Name" name="full_name" required value=""><br>

        <label for="user_name"><b>Username:</b></label>
        <input type="text" placeholder="Enter Username" name="user_name" required value=""><br>

        <label for="Email"><b>Email:</b></label>
        <input type="text" placeholder="Enter Email" name="email" required value=""><br>

        <label for="password"><b>Password:</b></label>
        <input type="password" placeholder="Enter Password" name="password" required value=""><br>

        <label for="PasswordConfirmation"><b>Confirm password:</b></label>
        <input type="password-repeat" placeholder="Confirm Password" name="passwordConfirmation" required value=""><br>
        <!-- Register button -->

        <button type="submit" class="btn btn-primary">Register</button>
        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
    </form>
    <br>
    <a href="login.php"> Login </a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
