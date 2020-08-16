<?php 
require 'frontEnd_Header.php';
require 'dbconnect.php';

$idlist=$_GET['id'];


$sql = "SELECT items.*,brands.name as brand_name,brands.id as brandid,	
						categories.name as category_name,subcategories.name as subcategory_name FROM items INNER JOIN brands ON items.brand_id=brands.id INNER JOIN subcategories ON items.subcategory_id =subcategories.id JOIN categories ON categories.id=subcategories.category_id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll();

foreach ($rows as $item ){

	$iid=$item['id'];

	if($idlist==$iid){

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
		$category_name = $item['category_name'];
		$brandid = $item['brandid'];
		$id=$item['subcategory_id'];

	}
}


?>

<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white">CodeNO: <?= $codeno; ?> </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container">

		<!-- Breadcrumb -->
		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
		    	<li class="breadcrumb-item">
		    		<a href="index.php" class="text-decoration-none secondarycolor"> Home </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Category </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> <?= $category_name; ?> </a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
					<?= $subcategory_name; ?>
		    	</li>
		  	</ol>
		</nav>

		<div class="row mt-5">

			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="<?= $photo; ?>" class="img-fluid">
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
				
				<h4> <?= $name; ?> </h4>

				<div class="star-rating">
					<ul class="list-inline">
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
					</ul>
				</div>

				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>

				<p> 
					<span class="text-uppercase "> Current Price : </span>
					<span class="maincolor ml-3 font-weight-bolder"> <?= $unitprice; ?> Ks </span>
				</p>

				<p> 
					<span class="text-uppercase "> Brand : </span>
					<span class="ml-3"> <a href="" class="text-decoration-none text-muted"> <?= $brand_name; ?> </a> </span>
				</p>


				<a href="#" class="addtocartBtn text-decoration-none">
					<i class="icofont-shopping-cart mr-2"></i> Add to Cart
				</a>
				
			</div>
		</div>

		<div class="row mt-5">
			<div class="col-12">
				<h3> Related Item </h3>
				<hr>
			</div>
			<?php
				$sql="SELECT * FROM items WHERE subcategory_id=:id"; 

					$stmt = $conn->prepare($sql);
					$stmt->bindParam('id',$id);
					$stmt->execute();
					$rows=$stmt->fetchAll();
					
					foreach($rows as $row):

						$rphoto=$row['photo'];	

			?>

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="<?= $rphoto; ?>" class="img-fluid">
				</a>
			</div>
		<?php endforeach; ?>
		</div>

		
	</div>

<?php
	include 'frontEnd_footer.php';
?>