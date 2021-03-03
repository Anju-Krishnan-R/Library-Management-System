<?php
 $old_pass = (isset($_POST['old_password']) ? $_POST['old_password'] : '');
 $new_pass = (isset($_POST['new_password']) ? $_POST['new_password'] : '');
 $confirm_pass = (isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '');
$error="";
$success="";
if(isset($_POST['submit'])){
	if(!empty($old_pass)||!empty($new_pass)||!empty($confirm_pass))
	{
	//create connection
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con,'test1');
	if(mysqli_connect_error()){
		die('connection error('.mysqli_connect_error().')'.mysqli_connect_error());
	}
	else{
		$s="SELECT password from admin_login where username='admin' AND password='$old_pass'";
		$result=mysqli_query($con,$s);
		$num=mysqli_num_rows($result);

		if($num == 1){
		if($new_pass==$confirm_pass)
		{
			$s="UPDATE admin_login SET password='$new_pass' WHERE username='admin'";
			if ($con->query($s) === TRUE) {
  			$success="Password updated successfully";
			}
			else
			{
  			$error="Error updating password " . $con->error;
			}
		}
		else{
		$error="Enter the password correctly" ;
		}
		}
		else{
			$error="Old Password is incorrect";
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
	<title>LMS-Admin</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
</head>
<body class="admin_bg">
<header>
	<nav id="header-nav" class="navbar navbar-default navbar-static-top">
		<div class="container" id="heading">
			<div class="navbar-header">
				
					<div id="logo">Library Management System
					</div>
				<div class="user">
					<?php
					session_start();
					echo "Username: ".$_SESSION['adminid'];
					?>
				</div>
				
			</div>
		</div>
	</nav>
</header>
<div class="container">
	<div class="row"> 

 <div class="sidebar col-sm-4">
	<header><span class="glyphicon glyphicon-user"> </span> LMS-Admin</header>
	<ul class="list">
		<li><a href="books_available.php"><span class="glyphicon glyphicon-book"> </span> Books Available</a><hr></li>
		<li><a href="admin_issued_books.php"><span class="glyphicon glyphicon-tags"> </span> Issued Books</a><hr></li>
		<li><a href="admin_book_requests.php"><span class="glyphicon glyphicon-bookmark"> </span> Book requests</a><hr></li>
		<li><a href="admin_add_books.php"><span class="glyphicon glyphicon-plus"> </span> Add Books</a><hr></li>
		<li><a href="student_list.php"><span class="glyphicon glyphicon-list"> </span> Student List</a><hr></li>
		<li><a href="admin_change_password.php"><span class="glyphicon glyphicon-edit"> </span> Change Password</a><hr></li>
		<center>
			<li><a href="logout.php"><button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-off"> </span> Logout</button></a></li>
		</center>
		
	</ul>
	<!-- <center> -->
		
	<!-- </center> -->
</div>		
<div class="login-box col-sm-8" id="box">
	<h2>LMS-Admin-Change Password</h2>
	<form action="" method="post">
		<p class="error"><?php echo $error;?></p>
		<p class="success"><?php echo $success;?></p>
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
					<a href="admin_page.php">Go back</a><br>
					</div>

					</form>
</div>	
</div>
</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>