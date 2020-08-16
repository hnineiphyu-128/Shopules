<?php 
	require 'dbconnect.php';
	$image = $_FILES['photo'];
	$name=$_POST['name'];
	$codeno = mt_rand(100000,999999);
	$price = $_POST['price'];
	$discount = $_POST['discount'];
	$description = $_POST['description'];
	$brand = $_POST['brand'];
	$subcategory = $_POST['subcategory'];

	$image_name=$image['name'];

$source_dir='image/';
$file_name=mt_rand(100000,999999);
$file_exe_array=explode('.',$image_name);
$file_exe=$file_exe_array[1];


$file_path=$source_dir.$file_name.$file_exe;
move_uploaded_file($image['tmp_name'],$file_path);

	$sql = "INSERT INTO items(codeno,name,photo,price,discount,
								description,brand_id,subcategory_id) 
			VALUES(:codeno,:name,:photo,:price,:discount,:description,:brand,:subcategory)";


	$stmt = $conn->prepare($sql);
	
	$stmt->bindParam(':codeno',$codeno);
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':photo',$file_path);
	$stmt->bindParam(':price',$price);
	$stmt->bindParam(':discount',$discount);
	$stmt->bindParam(':description',$description);
	$stmt->bindParam(':brand',$brand);
	$stmt->bindParam(':subcategory',$subcategory);
	$stmt->execute();
	// echo $sql;die();

		header("location: itemlist.php");
	
 ?>

