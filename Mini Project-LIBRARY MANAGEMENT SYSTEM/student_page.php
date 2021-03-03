<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LMS-Student</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- <link rel="stylesheet" href="css/stylenav.css"> -->
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
					session_start();
					echo "Student ID: ".$_SESSION['userid'];
					?>
				</div>
				
			</div>
		</div>
	</nav>
</header>
<div class="container">
<!-- <div class="login-box"> -->

	<div class="row">
		<!-- using html and css to create a menu bar that is responsive -->
	<!-- <input type="checkbox" class="visible-xs" id="check">
	<label for="check">
		<span class="glyphicon glyphicon-menu-hamburger visible-xs" id="btn"></span>
		<span class="glyphicon glyphicon-triangle-left visible-xs" id="cancel"></span>
	</label> -->
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
	<h1 style="text-align: center;">WELCOME TO THE LIBRARY MANAGEMENT SYSTEM</h1>
	</div>
</div>
</div>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>