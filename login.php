 <?php
 session_start();
 
	include("connecttodb.php");
	include("functions.php");
	
 
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
	
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		
 		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			
			
			$query = "select * from Users where user_name = '$user_name' limit 1";
			$result= mysqli_query($mysqli,$query);
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: VideoGameMainiaTwig.php");
						die;
					}
				}
			}
			
			echo "Please Enter Valid Information";
		}
	}
 ?>
 
 
 <!DOCTYPE html>
 <html>
 <head>
	<title>Login</title>
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
	
	<div id="box">
	
		<form method="post">
			<div style="font-size: 20px;margin: 10px;">Login</div>
			<input type="text" name="user_name"><br><br>
			<input type="password" name="password"><br><br>
		
			<input type="submit" value="Login"><br><br>
		
			<a href="signup.php">Click To Sign Up</a><br><br>
			<a href="deleteuser.php">Click To Delete Account</a><br><br>
			<a href="updatepass.php">Click To Update Your Password</a><br><br>
		</form>
	</div>
</body>
</html>