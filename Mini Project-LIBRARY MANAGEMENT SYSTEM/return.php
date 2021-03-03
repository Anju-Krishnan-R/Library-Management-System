<?php
$conn=mysqli_connect("localhost","root","","test1");
if($conn->connect_error){
		die("Connection failed:". $conn->connect_error);
	}
$id=$_GET['rn'];
//$book=$_GET['b'];
//$author=$_GET['a'];
/*$s="UPDATE admin_add_books SET no_of_books=no_of_books+1 where id=(SELECT id from admin_add_books where book='$book' and author='$author')";
if ($con->query($s) === TRUE) {
  			$success="Book is returned successfully";
			}
			else
			{
  			$error="Error" . $con->error;
			}*/
$d="DELETE from admin_issued_books where id='$id'";
if($conn->query($d)===TRUE)
{
	header('location:admin_issued_books.php');
}
else{
	echo "Something went wrong" . $conn->error;
}


?>