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
			$user_id = random_num(20);
			$query = "insert into Users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
			mysqli_query($mysqli,$query);
			
			header("Location: login.php");
			die;
		}else
		{
				echo "Please Enter A Valid Username";
		}
	}
?>
 
 <!DOCTYPE html>
 <html>
 <head>
	<title>Signup</title>
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
    <div style="font-size: 20px;margin: 10px;">Sign Up</div>
    <input type="text" name="user_name"><br><br>
    <input type="password" name="password"><br><br>
    
    <input type="submit" value="Signup"><br><br>
    
    <a href="login.php">Click To Login</a><br><br>
</form>
</body>
</html>