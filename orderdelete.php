<?php 
	require 'dbconnect.php';

	$id=$_GET['id'];

	$status=2;

	$sql="UPDATE orders SET status=:status WHERE id=:id";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':status',$status);
 	$stmt->execute();

 	

 	header('location:orderlist.php');


?>