<?php
function check_login($con)
{
    if(isset($_SESSION['user_id']))
        {
            $id = $_SESSION['user_id'];
            $query = "select * from users where user_id = '$id' limit 1";

            $result = mysqli_query($con,$query);
            if($result && mysqli_num_rows($result) > 0)
            {
                
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
        //helps to redirect to login
        header("location: login.php");
        die;
}

function random_num($length)
{
    $text = "";

    if($length < 5)
    {
        $length = 5;
    }
    $len = rand(4,$length);

    for ($i=0; $i < $len; $i++) { 
        # code...

        $text .=rand(0,9);

    }
    return $text;

}

// Function to validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
//Function to send emails upon appointment booking
function sendEmailNotification($email, $subject, $message) {
    // Subject for the email
    $subject = "Appointment Booked";

    // Send email
    if (mail($email, $subject, $message)) {
        echo "Email notification sent successfully to $email";
    } else {
        echo "Failed to send email notification to $email";
    }
}



