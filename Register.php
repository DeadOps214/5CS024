<?php
session_start();

    include("connection.php");
    include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //check if something was posted
       $fullname = $_POST['full_name'];
       $user_name = $_POST['user_name'];
       $Email = $_POST['email'];
       $password = $_POST['password'];
        if(!empty($fullname) && !empty($Email) && !empty($password) && !is_numeric($user_name))
        {
                //if correctly entered, saves to database
                $user_id = random_num(50);
                $query = "insert into users (user_id,full_name,user_name,email,password) value ('$user_id','$fullname','$user_name','$Email','$password')";
                mysqli_query($con, $query);
                header("location: login.php");
                die;
        }
        else
        {
            echo "Please enter valid information!!";
        }

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <h1>
            REGISTRATION FORM
        </h1>
        <!--registeration form-->
        <form action="" method="post" autocomplete="on">
            <label for="fullname"><b>Name:</b></label>
            <input type="text" placeholder="Name" name="full_name" required value=""><br>
      
            <label for="user_name"><b>Username:</b></label>
            <input type="text" placeholder="Enter Username" name="user_name" required value=""><br>
         
            <label for="Email"><b>Email:</b></label>
            <input type="text" placeholder="Enter Email" name="email"  required value=""><br>

            <label for="password"><b>Password:</b></label>
            <input type="password" placeholder="Enter Password" name="password"  required value=""><br>

            <label for="PasswordConfrimation"><b>comfirm password:</b></label>
            <input type="password-repeat" placeholder="Comfirm Password" name="passwordConfrimation"  required value=""><br>
         <!--Register button -->
         
            <button type="submit">Register</button>
            <label>
              <input type="checkbox" checked="checked" name="remember"> Remeber me
            </label>
        </form>
        <br>
        <a href="login.php"> Login </a>
    </body>
</html>