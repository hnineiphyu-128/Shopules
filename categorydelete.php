<?php 
	require 'dbconnect.php';

	$id=$_GET['id'];

	$sql="DELETE FROM categories WHERE id=:id";

	$stmt=$conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    header('location:categorylist.php');

?>