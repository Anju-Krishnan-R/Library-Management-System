<?php
session_start();

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
	<nav id="header-nav" class="navbar navbar-default">
		<div class="container" id="heading">
			<div class="navbar-header">
					<div id="logo">Library Management System
					</div>
				<div class="user">
					<?php
					echo "Student ID: ".$_SESSION['userid'];
					$sid=$_SESSION['userid'];
					?>
				</div>
			</div>
		</div>
	</nav>
	</header>
	<div class="container">
		<div class="login-box" style="max-width: 1000px;">
				<h2>Request Status</h2><br>
	<table>
		<tr>
			<th>ID</th>
			<th>Book Name</th>
			<th>Author Name</th>
			<th>Status</th>
		</tr>
		<?php
		$conn=mysqli_connect("localhost","root","","test1");
		if($conn->connect_error){
		die("Connection failed:". $conn->connect_error);
		}
		$sql="SELECT id,book,author,status from student_request_books where sid='$sid'";
		$result=$conn->query($sql);
		if($result->num_rows==0){
			echo "No Books are available in the library";
		}
		else{
		while($row=$result->fetch_assoc()){
		echo "<tr><td>".$row["id"].
				"</td><td>".$row["book"].
				"</td><td>".$row["author"].
				"</td><td>".$row["status"].
				"</td></tr>";
	}
echo "</table>";
	}
	
$conn->close();
?>
</table>
<br><br>
<center>
	<a href="student_request_books.php">Go back</a>
</center>

		</div>
	</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>