<?php
	require 'dbconnect.php';

	$id=$_GET['id'];
	$category_id=$_POST['category'];
	$name=$_POST['name'];
	

	$sql="UPDATE subcategories SET category_id=:category_id,name=:name WHERE id=:id";

	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':category_id',$category_id);
	$stmt->bindParam(':name',$name);
	$stmt->execute();

	header('location:subcategorylist.php');



?>