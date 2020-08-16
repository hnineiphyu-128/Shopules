<?php
    require 'dbconnect.php';

    $id=$_GET['id'];
    $price=$_POST['price'];
    $codeno=$_POST['codeno'];
    $discount=$_POST['discount'];
    $description=$_POST['description'];
    $oldPhoto=$_POST['oldPhoto'];
    $brand_id=$_POST['brand_id'];
    $subcategory_id=$_POST['subcategory_id'];
    $name=$_POST['name'];
    $newPhoto=$_FILES['photo'];
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


    $sql="UPDATE items SET codeno=:codeno,photo=:photo,name=:name,price=:price,discount=:discount,description=:description,brand_id=:brand_id,subcategory_id=:subcategory_id WHERE id=:id";

    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':photo',$file_path);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':codeno',$codeno);
    $stmt->bindParam(':price',$price);
    $stmt->bindParam(':discount',$discount);
    $stmt->bindParam(':description',$description);
    $stmt->bindParam(':brand_id',$brand_id);
    $stmt->bindParam(':subcategory_id',$subcategory_id);
    $stmt->execute();

    header('location:itemlist.php');



?>