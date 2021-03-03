<?php
//starting session
session_start();
//storing the entered student id and password
 $sid = (isset($_POST['user']) ? $_POST['user'] : '');
 $pass = (isset($_POST['password']) ? $_POST['password'] : '');
 $error="";
 //on click of the login button
if(isset($_POST['submit'])){
	//check if both the fields are entered
	if(!empty($sid)||!empty($pass))
	{
	//create connection
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con,'test1');
	//if connection fails
	if(mysqli_connect_error()){
		die('connection error('.mysqli_connect_error().')'.mysqli_connect_error());
	}
	//if connection is successful do the following
	else{
		$s="SELECT * from student_login where BINARY sid = '$sid' AND BINARY pass='$pass'";
		$result=mysqli_query($con,$s);
		$num=mysqli_num_rows($result);
		if($num == 1){
		$_SESSION['userid']=$sid;
		header('Location:student_page.php');
		}
		else{
		$error="invalid Student ID or Password" ;
		}
	}
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LMS</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
</head>
<body>
<header>
	<nav id="header-nav" class="navbar navbar-default">
		<div class="container" id="heading">
			<div class="navbar-header">
				<a href="index.php">
					<div id="logo"><img src="logo.png" width="100px" height="100px" style="padding-right:15px;">Library Management System
					</div>
				</a>
			</div>
		</div>
	</nav>
</header>
<div class="container">
	<div class="login-box">
		<h2>Login Here</h2>
			<form method="post">
					<p class="error"><?php echo $error;?></p>
					<div class="form-group">
						<label>Student ID</label>
						<input type="text" name="user" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="Password" name="password" class="form-control" required>
					</div>
					<div class="text-center">
					<a href="student_page.php"><button type="submit" class="btn btn-primary" name="submit">Login </button></a>
					<br><br>
					<a href="admin_login.php">Admin login</a><br>
					<a href="register_student.php">Sign Up</a>
				</div>
			</form>
	</div>
	</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>