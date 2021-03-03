<?php
$conn=mysqli_connect("localhost","root","","test1");
if($conn->connect_error){
		die("Connection failed:". $conn->connect_error);
	}
$sid=$_GET['rn'];
$d="DELETE from student_register where sid='$sid'";

if($conn->query($d)===TRUE)
{
	header('location:student_list.php');
}
else{
	echo "Something went wrong" . $conn->error;
}
?>