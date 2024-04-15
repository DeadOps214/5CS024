<?php
    session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //check if something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
                //Read from database

                $query = "Select * from users where user_name = '$user_name' limit 1";
                
                $result = mysqli_query($con, $query);
                if($result)
                {
                    if($result && mysqli_num_rows($result) > 0)
                    {
                        
                        $user_data = mysqli_fetch_assoc($result);
                       if($user_data['password'] === $password)
                       {

                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("location: index.php");
                        die;
                       }
                    }
                }
            echo "Please enter valid information!!";
        }else
        {
            echo "Please enter valid information!!";
        }

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login page</title>  
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">  
    </head>
    <body>
        <h1>
            LOGIN PAGE
        </h1>
        <!--LOGIN form-->
        <form action="" method="post" autocomplete="on">
      
            <label for="user_name"><b>Username:</b></label>
            <input type="text" placeholder="Enter User_name" name="user_name" required value=""><br>

            <label for="Password"><b>Password:</b></label>
            <input type="password" placeholder="Enter Password" name="password"  required value=""><br>
         <!--LOGIN button -->
         
            <button type="submit">LOGIN</button>
            <label>
              <input type="checkbox" checked="checked" name="remember"> Remeber me
            </label>
        </form>
        <br>
        <P>If you are not regisstered yet, please register below.</P>
        <a href="Register.php"> Register  </a>
    </body>
</html>