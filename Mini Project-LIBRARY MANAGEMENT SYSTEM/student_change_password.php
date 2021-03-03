<?php
session_start();
$student_id=$_SESSION['userid'];
 $sid = (isset($_POST['sid']) ? $_POST['sid'] : '');
 $old_pass = (isset($_POST['old_password']) ? $_POST['old_password'] : '');
 $new_pass = (isset($_POST['new_password']) ? $_POST['new_password'] : '');
 $confirm_pass = (isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '');
$error="";
$success="";
if(isset($_POST['submit'])){
	if(!empty($sid)||!empty($old_pass)||!empty($new_pass)||!empty($confirm_pass))
	{
	//create connection
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con,'test1');
	if(mysqli_connect_error()){
		die('connection error('.mysqli_connect_error().')'.mysqli_connect_error());
	}
	else{
		$s="SELECT * from student_login where sid='$sid' AND pass='$old_pass'";
		$result=mysqli_query($con,$s);
		$num=mysqli_num_rows($result);

		if($num == 1)
		{
		if($sid==$student_id)
		{
		if($new_pass==$confirm_pass)   
		{
			$s="UPDATE student_login,student_register SET student_login.pass='$new_pass',student_register.pass='$new_pass',student_register.cpass='$new_pass' WHERE student_login.sid='$sid' AND student_register.sid='$sid'";
			if ($con->query($s) === TRUE) 
			{
  			$success="Password updated successfully";
			}
			else
			{
  			$error="Error updating Password " . $con->error;
			}
		}
		else
		{
		$error="Enter the password correctly" ;
		}
		}
		else
		{
		$error="Incorrect Student ID";
		}	
			}
		else{
			$error="The entered data is incorrect";
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
	<title>LMS-Student</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
</head>
<body class="student_bg">
<header>
	<nav id="header-nav" class="navbar navbar-default navbar-static-top">
		<div class="container" id="heading">
			<div class="navbar-header">
				
					<div id="logo">Library Management System
					</div>
				<div class="user">
					<?php
					
					echo "Student ID: ".$_SESSION['userid'];
					?>
				</div>
			</div>
		</div>
	</nav>
</header>
<div class="container">
	<div class="row">
	<div class="sidebar col-sm-4">
	<header><span class="glyphicon glyphicon-user"></span> LMS-Students</header>
	<ul class="list">
		<li><a href="student_borrow_book.php"><span class="glyphicon glyphicon-book"></span> Borrow Books</a><hr></li>
		<li><a href="student_request_books.php"><span class="glyphicon glyphicon-bookmark"></span> Request Books</a><hr></li>
		<li><a href="student_change_password.php"><span class="glyphicon glyphicon-edit"></span> Change Password</a><hr></li>
	</ul>
	<center>
	<a href="logout.php"><button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-off"></span> 	Logout</button></a>
	</center>
</div>
<div class="login-box col-sm-8" id="box">
	<h2>Student-Change Password</h2>
	<form action="" method="post">
		<div class="form-group">
		<p class="error"><?php echo $error;?></p>
		<p class="success"><?php echo $success;?></p>
						<label>Student ID</label>
						<input type="text" name="sid" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Old Password</label>
						<input type="password" name="old_password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>New Password</label>
						<input type="Password" name="new_password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Confirm New Password</label>
						<input type="Password" name="confirm_password" class="form-control" required>
					</div>
					<div class="text-center">
					<button type="submit" class="btn btn-primary" name="submit">Reset</button>
					<br><br>
					<a href="student_page.php">Go back</a><br>
					</div>

					</form>
</div>	
</div>
</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>