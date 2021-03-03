<?php
session_start();
 $username = (isset($_POST['user']) ? $_POST['user'] : '');
 $password = (isset($_POST['password']) ? $_POST['password'] : '');
$error="";
if(isset($_POST['submit'])){
	if(!empty($username)||!empty($password))
	{
	//create connection
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con,'test1');
	if(mysqli_connect_error()){
		die('connection error('.mysqli_connect_error().')'.mysqli_connect_error());
	}
	else{
		$s="SELECT * from admin_login where BINARY username ='$username' AND BINARY password ='$password'";
		$result=mysqli_query($con,$s);
		$num=mysqli_num_rows($result);

		if($num == 1){
		$_SESSION['adminid']=$username;
		header('Location:admin_page.php');
		}
		else{
		$error="invalid Username or Password" ;
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
	<title>LMS-Admin login</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
</head>
<body style="background-image: url('bg.png');">
<header>
	<nav id="header-nav" class="navbar navbar-default">
		<div class="container" id="heading">
			<div class="navbar-header">
				<div id="logo"><img src="logo.png" width="100px" height="100px" style="padding-right:15px;">Library Management System
					</div>
				
			</div>
		</div>
	</nav>
</header>
	<div class="container">
		<div class="login-box">
			<h2>Admin Login</h2>
				<form  method="post">
					<p class="error"><?php echo $error;?></p>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="user" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="Password" name="password" class="form-control" required>
					</div>
					<div class="text-center">
					<a href="admin_page.php"><button type="submit" class="btn btn-primary" name="submit"> Login  </button></a>
					<br><br>
					<a href="logout.php">Go back</a><br>
					</div>
		</form>

		</div>
	</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>