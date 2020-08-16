<?php 
	require 'dbconnect.php';

	$id=$_GET['id'];

	$sql="DELETE FROM subcategories WHERE id=:id";

	$stmt=$conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    header('location:subcategorylist.php');

?>