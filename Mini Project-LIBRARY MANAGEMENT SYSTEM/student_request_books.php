<?php
session_start();
$sid=$_SESSION['userid'];

 $book = (isset($_POST['book_name']) ? $_POST['book_name'] : '');
 $author = (isset($_POST['author']) ? $_POST['author'] : '');
$error="";
$success="";
if(isset($_POST['submit'])){
	if(!empty($book)||!empty($author))
	{
	//create connection
	$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con,'test1');
	if(mysqli_connect_error()){
		die('connection error('.mysqli_connect_error().')'.mysqli_connect_error());
	}
	else{
		$s="SELECT * from admin_add_books where book = '$book' AND author='$author'";
		$result=mysqli_query($con,$s);
		$num=mysqli_num_rows($result);
		if($num==1){
			$error="Book already exists in the library";
		}
		else{
		$s="SELECT * from admin_book_requests where book = '$book' AND author='$author'";
		$result=mysqli_query($con,$s);
		$num=mysqli_num_rows($result);
		if($num==1)
		{
			$error="Book is already requested. Please wait";
		}
		else{
		$INSERT="INSERT into admin_book_requests (sid,book,author) values(?,?,?)";
		$INSERT1="INSERT into student_request_books (sid,book,author) values(?,?,?)";
		$stmt=$con->prepare($INSERT);
		$stmt->bind_param("sss",$sid,$book,$author);
		$stmt->execute();
		$stmt=$con->prepare($INSERT1);
		$stmt->bind_param("sss",$sid,$book,$author);
		$stmt->execute();
		$stmt->close();
		$success="Request sent";
		}
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
			<h2>Request Books</h2>
			<p class="error"><?php echo $error;?></p>
			<p class="success"><?php echo $success;?></p>
				<form action="" method="post">
					<div class="form-group">
						<label>Book Name</label>
						<input type="text" name="book_name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Author Name</label>
						<input type="text" name="author" class="form-control" required>
					</div>
					<div class="text-center">
					<button type="submit" class="btn btn-primary" name="submit"> Request </button>
					<br><br>
					<a href="student_check_status.php">Check Status</a><br>
					<a href="student_page.php">Go back</a>
					</div>
				</form>
		</div>
	</div>
	</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>