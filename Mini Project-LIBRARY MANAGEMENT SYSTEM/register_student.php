<?php
//storing the entered data
$name = (isset($_POST['sname']) ? $_POST['sname'] : '');
$email = (isset($_POST['semail']) ? $_POST['semail'] : '');
$sem = (isset($_POST['sem']) ? $_POST['sem'] : '');
$branch = (isset($_POST['branch']) ? $_POST['branch'] : '');
$sid = (isset($_POST['sid']) ? $_POST['sid'] : '');
$pass = (isset($_POST['password']) ? $_POST['password'] : '');
$cpass= (isset($_POST['cpassword']) ? $_POST['cpassword'] : '');

$error="";
$success="";
//on click of register button
if(isset($_POST['submit'])){
	//if all fields are entered do the following
if(!empty($name)||!empty($email)||!empty($sem)||!empty($branch)||!empty($sid)||!empty($pass)||!empty($cpass))
{	
	//check if new password and confirm password is same
if($pass==$cpass){
//create connection
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con,'test1');
	//if connection fails
	if(mysqli_connect_error()){
		die('connection error('.mysqli_connect_error().')'.mysqli_connect_error());
	}
	//if connection is succesful do the following
	else
	{
		$SELECT="SELECT sid from student_login where sid=? Limit 1";
		
		$INSERT="INSERT into student_register (name,email,sem,branch,sid,pass,cpass) values(?,?,?,?,?,?,?)";
		$INSERT2="INSERT into student_login (sid,pass) values(?,?)";
		//prepare statement for the select statement
		$stmt=$con->prepare($SELECT);
		$stmt->bind_param("s",$sid);
		$stmt->execute();
		$stmt->bind_result($sid);
		$stmt->store_result();
		$rnum=$stmt->num_rows;
		
		if($rnum==0)
		{
			$stmt->close();
			$stmt=$con->prepare($INSERT);
			$stmt->bind_param("ssissss",$name,$email,$sem,$branch,$sid,$pass,$cpass);
			$stmt->execute();
			$stmt=$con->prepare($INSERT2);
			$stmt->bind_param("ss",$sid,$pass);
			$stmt->execute();
			
			$success="New Student inserted Successfully";
		}
	
		else{
			$error="The student with this student ID already exists";
		}
		$stmt->close();
		$con->close();
}
}
else{
	$error="Enter the password correctly";
}
}
else{
	$error="All fields are required";
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LMS-Student Registration</title>
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
			<h2>Student Registration</h2>
				<form method="post">
					<div class="form-group">
						<p class="error"><?php echo $error;?></p>
						<p class="success"><?php echo $success;?></p>
						<label>Student Name</label>
						<input type="text" name="sname" class="form-control" required>
					</div>
					
					<div class="form-group">
						<label>Semester </label>
						<select name="sem" required>
							<option value="" selected="selected" hidden="hidden" >Select Semester</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
						</select>
					</div>

					<div class="form-group">
						<label>Branch</label>
						<select name="branch" required>
							<option value="" selected="selected" hidden="hidden">Select Branch</option>
							<option value="Computer Science and Engineering">Computer Science and Engineering</option>
							<option value="Information Science and Engineering">Information Science and Engineering</option>
							<option value="Electronics and Communications Engineering">Electronics and Communications Engineering</option>
							<option value="Electrical and Electronics Engineering">Electrical and Electronics Engineering</option>
							<option value="Mechanical Engineering">Mechanical Engineering</option>
							<option value="Civil Engineering">Civil Engineering</option>
						</select>
					</div>
					<div class="form-group">
						<label>Student ID</label>
						<input type="text" name="sid" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="Password" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="Password" name="cpassword" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Student E-mail</label>
						<input type="email" name="semail" pattern="[a-z0-9._%+-]+@[gmailemailhotmailyahooedu]+\.[cominorg]{2,}$" class="form-control" required>
					</div>
					<div class="text-center">
					<button type="submit" class="btn btn-primary" name='submit'>Register</button>
					<br><br>
					<a href="logout.php">Go back</a>
					</div>
					</form>
	</div>
	</div>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
