<?php

 session_start();
 
	include("connecttodb.php");
		
if (isset($_POST['update_password'])) {
    // Fetch the user ID from the session or wherever it's stored
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in

    // Fetch current and new passwords from the form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Check if the current password matches the one in the database for this user
    $check_query = "SELECT * FROM Users WHERE user_id = '$user_id' AND password = '$current_password'";
    $check_result = mysqli_query($mysqli, $check_query);

    if (mysqli_num_rows($check_result) == 1) {
        // Current password matches, proceed with updating the password
        $update_query = "UPDATE Users SET password = '$new_password' WHERE user_id = '$user_id'";
        $update_result = mysqli_query($mysqli, $update_query);

        if ($update_result) {
            // Password updated successfully
            echo "Password updated successfully";
            // You might want to redirect the user or perform other actions after successful password update
            // header("Location: password_updated.php");
            // die;
        } else {
            // Handle update failure
            echo "Password update failed";
        }
    } else {
        // Current password doesn't match, show an error message
        echo "Current password is incorrect";
    }
}
?>

 <!DOCTYPE html>
 <html>
 <head>
	<title>Update Pasword</title>
</head>
<body>

	<style type=text.css">
	{

    margin: 0;
    padding: 0;
    background-color:#6abadeba;
    font-family: 'Arial';
	}
	
	.login{
			width: 382px;
			overflow: hidden;
			margin: auto;
			margin: 20 0 0 450px;
			padding: 80px;
			background: #23463f;
			border-radius: 15px ;
			}
	h2{
		text-align: center;
		color: #277582;
		padding: 20px;
		}
	label{
		color: #08ffd1;
		font-size: 17px;
		}
	#Uname{
		width: 300px;
		height: 30px;
		border: none;
		border-radius: 3px;
		padding-left: 8px;
		}
	#Pass{
		width: 300px;
		height: 30px;
		border: none;
		border-radius: 3px;
		padding-left: 8px;
		}
	#log{
		width: 300px;
		height: 30px;
		border: none;
		border-radius: 17px;
		padding-left: 7px;
		color: blue;


	}
	span{
		color: white;
		font-size: 17px;
	}
	a{
		float: right;
		background-color: grey;
	}
	
	</style>
	
	<form method="post">
    <div style="font-size: 20px;margin: 10px;">Update Password</div>
    <input type="password" name="current_password" placeholder="Current Password"><br><br>
    <input type="password" name="new_password" placeholder="New Password"><br><br>
    
    <input type="submit" value="Update Password" name="update_password">
    
    <!-- Other form fields -->
</form>
	</div>
</body>
</html>