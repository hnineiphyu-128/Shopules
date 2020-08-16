<?php
	require 'dbconnect.php';

	$name=$_POST['name'];
	$category_id=$_POST['category'];

	$sql="INSERT INTO subcategories(name,category_id) VALUES(:name, :category_id)";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':category_id',$category_id);
	$stmt->execute();

	header('Location:subcategorylist.php');

?>