<?php
session_start();
$con=mysqli_connect('localhost','root','');
	mysqli_select_db($con,'test1');
	if(mysqli_connect_error()){
		die('connection error('.mysqli_connect_error().')'.mysqli_connect_error());
	}
	$s=$con->query("SELECT * FROM admin_add_books");
?>
<?php
//session_start();
$book=(isset($_POST['select_books']) ? $_POST['select_books'] : '');
//$author=(isset($_POST['$author']) ? $_POST['$author'] : '');
$sid=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
//$author="";
$date = date('Y-m-d H:i:s');
//create connection

	//selecting all the books from admin_add_books to use it for the dropdown below in html code
//$s=$con->query("SELECT * FROM admin_add_books");

$error="";
$success="";

if(isset($_POST['submit'])){
	if(!empty($book)||!empty($sid)){
		//if($no_of_books!=0)//check this line...this is for add books stuff where u should do something like decrementing the no_of_books in admin_add_books ,also to check if there is atleast one book that is available...etc(think)
		//{
		$select="SELECT * FROM admin_issued_books WHERE sid='$sid'";
		$result=mysqli_query($con,$select);
		$num=mysqli_num_rows($result);
		if($num == 5){
			$error="Maximum limit exceeded <br> Students cannot borrow more than 5 books";
		}
		else{
		$insert="INSERT into admin_issued_books (sid,book,date) values (?,?,?)";
		$stmt=$con->prepare($insert);
		$stmt->bind_param("sss",$sid,$book,$date);
		$stmt->execute();
		$stmt->close();
		$success="Book can be collected from the library";
		}
		
	}
	else{
		$error="Select a book";
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
	<h2>Borrow Book</h2>
	
	<form method="post" action="">
		<p class="error"><?php echo $error;?></p>
		<p class="success"><?php echo $success;?></p>
		<div class="form-group">
				<select name="select_books" required>
					<option value="" disabled="disabled" selected="selected">- -Select Book- -</option>
					<?php
					
					while($rows=$s->fetch_assoc())
					{
						$book_id=$rows['id'];
						$book_name=$rows['book'];
						$author=$rows['author'];
						echo "<option value='$book_name'>$book_name - AUTHOR : $author</option>";
						
					}

					
					?>
				</select>
			</div>
			<div class="text-center">
					<button type="submit" class="btn btn-primary" name="submit"> Borrow Book </button>
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

