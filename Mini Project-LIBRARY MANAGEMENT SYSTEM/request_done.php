<?php

$conn=mysqli_connect("localhost","root","","test1");
if($conn->connect_error){
		die("Connection failed:". $conn->connect_error);
	}
$book=$_GET['rn1'];
$author=$_GET['rn2'];
$sid=$_GET['rn3'];
$status="Accepted";

$insert="INSERT into admin_add_books (book,author) values (?,?)";
$stmt=$conn->prepare($insert);
$stmt->bind_param("ss",$book,$author);
$stmt->execute();


$d="DELETE from admin_book_requests where book='$book' and author='$author'";


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