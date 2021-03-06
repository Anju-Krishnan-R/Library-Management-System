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
<!-- <div class="login-box">
 -->	
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
<div class="login-box col-sm-8 " id="dash" style="max-width:1000px;">
	<h2>Issued Books</h2>
<table>
		<tr>
			<th>Sl no.</th>
			<th>SID</th>
			<th>Book Name</th>
			<th>Date</th>
			<th>Status</th>
			
		</tr>
		<?php
		$conn=mysqli_connect("localhost","root","","test1");
		if($conn->connect_error){
		die("Connection failed:". $conn->connect_error);
		}
		$sql="SELECT * from admin_issued_books";
		$result=$conn->query($sql);
		if($result->num_rows>0){
		while($row=$result->fetch_assoc()){
		echo "<tr><td>".$row["id"].
				"</td><td>".$row["sid"].
				"</td><td>".$row["book"].
				"</td><td>".$row["date"].
				"</td><td><a href='return.php?rn=$row[id]'><button class='btn btn-primary'>Return</button></a></td></tr>";
	}
echo "</table>";
	}
	else{
	echo "No books are issued yet";
}
$conn->close();
?>

	</table>
	<br><br>
	<center>
	<a href="admin_page.php">Go Back</a>
	</center>
</div>
<!-- </div> -->
</div>
</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>