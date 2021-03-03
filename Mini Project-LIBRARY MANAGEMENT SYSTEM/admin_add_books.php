<?php
 $book1=(isset($_POST['bname']) ? $_POST['bname'] : '');
 $book=strtolower($book1);
 $author1= (isset($_POST['author']) ? $_POST['author'] : '');
 $author=strtolower($author1);
//$no_of_books = (isset($_POST['no_of_books']) ? $_POST['no_of_books'] : '');
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
			$s="SELECT id from admin_add_books where book='$book' and author='$author'";
			$result=mysqli_query($con,$s);
			$num=mysqli_num_rows($result);
			if($num == 1){
				/*$u="UPDATE admin_add_books SET no_of_books=no_of_books+'$no_of_books' WHERE id=(SELECT id from admin_add_books where book='$book' and author='$author')";
				if ($con->query($u) === TRUE) {
  					$success="Book record updated successfully";
				}
				else
				{
  					$error="Error updating the book record" . $con->error;
				}*/
				$error="Book already exists in Library";
			}
			else{
				$u="INSERT into admin_add_books (book,author) values(?,?)";
				//$result=mysqli_query($con,$s);
				$stmt=$con->prepare($u);
				$stmt->bind_param("ss",$book,$author);
				$stmt->execute();
				$stmt->close();
				$success="New book inserted successfully";
			}

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
					</div >
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
<div class="container" >
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
	<h2>Add Books</h2>
					<form method="post">
						<p class="error"><?php echo $error;?></p>
						<p class="success"><?php echo $success;?></p>
					<div class="form-group">
						<label>Book Name</label>
						<input type="text" name="bname" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Author Name</label>
						<input type="text" name="author" class="form-control" required>
					</div>
					<!-- <div class="form-group">
						<label>No. of Books</label>
						<input type="number" pattern="[0-9]" name="no_of_books" class="form-control" required>
					</div> -->
					<div class="text-center">
					<button type="submit" class="btn btn-primary" name="submit"> Add Book </button>
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