<?php
$conn=mysqli_connect("localhost","root","","test1");
if($conn->connect_error){
		die("Connection failed:". $conn->connect_error);
	}
$id=$_GET['rn1'];
$book=$_GET['rn2'];
$author=$_GET['rn3'];
$sid=$_GET['rn4'];
$status="Denied";
$d="DELETE from admin_book_requests where id='$id'";

if($conn->query($d)===TRUE)
{
	header('location:admin_book_requests.php');
}
else{
	echo "Something went wrong" . $conn->error;
}
$s="UPDATE student_request_books SET status='$status' where book='$book' and author='$author' and sid='$sid'";
	
if ($conn->query($s) === TRUE) 
{
	header('location:admin_book_requests.php');
}
else
{
	echo "Something went wrong" . $conn->error;
}
$stmt->close();
?>