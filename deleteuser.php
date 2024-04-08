<?php
 session_start();
 
	include("connecttodb.php");

if (isset($_POST['delete_account'])) 
{
    // Assuming you have authenticated the user and fetched their user_id
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in

    // Perform the deletion query
    $delete_query = "DELETE FROM Users WHERE user_id = '$user_id'";
    $result = mysqli_query($mysqli, $delete_query);

    if ($result) 
	{
        // Redirect or perform actions after successful deletion
        echo "Account deleted successfully";
        // You might want to redirect the user to a different page after deletion
        // header("Location: deleted_account.php");
        // die;
    } else {
        // Handle deletion failure
        echo "Account deletion failed";
    }
}
?>









<!DOCTYPE html>

<html>
 <head>
	<title>Delete Account</title>
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
    <div style="font-size: 20px;margin: 10px;">Delete Account</div>
    <input type="text" name="user_name"><br><br>
    <input type="password" name="password"><br><br>
    
    <input type="submit" value="Signup"><br><br>
    
    <a href="login.php">Click To LogIn</a><br><br>
    
    <!-- Add delete account option -->
    <input type="submit" value="Delete Account" name="delete_account">
</form>
</html>