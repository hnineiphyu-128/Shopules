<?php 
	require 'dbconnect.php';

	$id=$_GET['id'];

	$status=1;

	$sql="UPDATE users SET status=:status WHERE id=:id";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':status',$status);
 	$stmt->execute();

 	

 	header('location:userlist.php');


?>