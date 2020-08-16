<?php 
require 'Backend_Header.php';
require 'dbconnect.php';

$idlist=$_GET['id'];


$sql = "SELECT items.*,brands.name as brand_name,subcategories.name as subcategory_name 
FROM items 
INNER JOIN brands
ON items.brand_id=brands.id
INNER JOIN subcategories
ON items.subcategory_id = subcategories.id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll();


?>
<main class="app-content">
	<div class="app-title">
		<div>
			<h1> <i class="icofont-list"></i> Items Details </h1>
		</div>
		<ul class="app-breadcrumb breadcrumb side">
			<a href="itemlist.php" class="btn btn-outline-primary">
				<i class="icofont-double-left"></i>
			</a>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<?php

					foreach ($rows as $item ):

						$id=$item['id'];

						if($idlist==$id){
							$photo=$item['photo'];
							$name=$item['name'];
							$codeno=$item['codeno'];
							$description=$item['description'];
							$price=$item['price'];                   
							$discount=$item['discount'];
							if($discount>0){
								$unitprice=$price-$discount;
							}else{
								$unitprice=$price;
							}
							$brand_name=$item['brand_name'];
							$subcategory_name = $item['subcategory_name'];

						}

						?>
					<?php endforeach; ?>
					<h3>CodeNo: <?php echo $codeno ?></h3> 
					<p>ItemName: <?php echo $name ?></p>

					<div class="row">

						<div class="col-md-5 ">
							<img src="<?= $photo ?>" width="400" height="400" class="pb-4">
						</div>

						<div class="cocol-md-7">
							<h5>Brand: <?= $brand_name; ?></h5>
							<h5>Subcategory: <?= $subcategory_name; ?></h5>
							<br><br>
							<h5>Price: <?= $price; ?></h5>
						</div>

					</div>

					<ul>
						<li>
							<p><?= $description; ?></p>
						</li>
						<li>
							<p><?= $description; ?></p>
						</li>
						
					</ul>

				</div>	
			</div>
		</div>
	</div>
</main>


<?php 
require 'Backend_Footer.php';
?>