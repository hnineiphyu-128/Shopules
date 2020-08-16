<?php
	require 'dbconnect.php';

	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$address=$_POST['address'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];


	$file_path="image/default.png";
	$role_id=2;
	$status=0;

	$sql="INSERT INTO users(name,profile,email,status,password,phone,address,role_id) VALUES(:name,:profile,:email,:status,:password,:phone,:address,:role_id)";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':profile',$file_path);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':status',$status);
	$stmt->bindParam(':password',$password);
	$stmt->bindParam(':phone',$phone);
	$stmt->bindParam(':address',$address);
	$stmt->bindParam(':role_id',$role_id);
	$stmt->execute();

	session_start();
	$_SESSION['reg_success']='Thanks! Your account has been sucessfully created and now Signed In.';

	header('Location:loginform.php');

?>