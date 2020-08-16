<?php
	require 'dbconnect.php';

	$id=$_POST['id'];
	$oldPhoto=$_POST['oldLogo'];
	$name=$_POST['name'];
	$newPhoto=$_FILES['logo'];
	$image_name=$newPhoto['name'];

	if($newPhoto['size']>0){
		$source_dir="image/";
		$file_name=mt_rand(100000,999999);
		$file_exe_array=explode('.', $image_name);
		$file_exe=$file_exe_array[1];

		$file_path=$source_dir.$file_name.'.'.$file_exe;

		move_uploaded_file($newPhoto['tmp_name'], $file_path);
	}else{
		$file_path=$oldPhoto;
	}


	$sql="UPDATE brands SET logo=:logo,name=:name WHERE id=:id";

	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':logo',$file_path);
	$stmt->bindParam(':name',$name);
	$stmt->execute();

	header('location:brandlist.php');



?>