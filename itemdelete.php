<?php 
	require 'dbconnect.php';
	$id = $_GET['id'];
	$sql = "DELETE FROM items WHERE id = :id";
	$stmt =$conn->prepare($sql);
	$stmt ->bindParam(':id', $id);
	$stmt->execute();
	
		header("location: itemlist.php");
	
 ?>
