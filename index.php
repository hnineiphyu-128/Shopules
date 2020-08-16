<?php

require('frontEnd_header.php');
require('frontEnd_nav.php');

?>
	
	<!-- Carousel -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  		<ol class="carousel-indicators">
    		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  		</ol>
  		
  		<div class="carousel-inner">
    		<div class="carousel-item active">
		      	<img src="frontend/image/banner/ac.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/giordano.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/garnier.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
  		</div>
	</div>


	<!-- Content -->
	<div class="container mt-5 px-5">
		<!-- Category -->
		<div class="row">

			<?php

				$sql="SELECT * FROM categories ORDER BY rand() limit 8";

			    $stmt = $conn->prepare($sql);
              	$stmt->execute();
              	$categories=$stmt->fetchAll();

              	foreach ($categories as $category):
              	$cid=$category['id'];
              	$cname=$category['name'];
              	$cphoto=$category['photo'];

			 ?>

			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 ">
				<div class="card categoryCard border-0 shadow-sm p-3 mb-5 rounded text-center">
				  	<img src="<?= $cphoto; ?>" class="card-img-top" alt="..." style="height:170px; object-fit: cover;">
				  	<div class="card-body">
				    	<p class="card-text font-weight-bold text-truncate"> <?= $cname; ?> </p>
				  	</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>

		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>
		
		<!-- Discount Item -->
		<div class="row mt-5">
			<h1> Discount Item </h1>
		</div>

	    <!-- Disocunt Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php

		            	$sql="SELECT * FROM items WHERE discount !='' ORDER BY rand() limit 8";

		            	$stmt = $conn->prepare($sql);
		            	$stmt->execute();
		            	$items=$stmt->fetchAll();

		            	foreach ($items as $item):
		            		$iid=$item['id'];
		            		$iname=$item['name'];
		            		$iphoto=$item['photo'];
		            		$iprice=$item['price'];
		            		$idiscount=$item['discount'];
		            		$icodeno=$item['codeno'];

		            		?>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="<?= $iphoto; ?>" class="img-fluid">
		                        <p class="text-truncate"><?= $iname; ?></p>
		                        <p class="item-price">
		                        	<?php if($idiscount): ?>
		                        	<strike><?= $iprice; ?> Ks</strike> 
		                        	<span class="d-block"><?= $iprice-$idiscount; ?> Ks</span>

		                        	<?php else: ?>
		                        		<span class="d-block"><?= $iprice; ?> Ks</span>
		                        	<?php endif ?>
		                        </p>

		                       	 <a href="frontend_itemdetail.php?id=<?= $iid; ?>" class="addtocartBtn text-decoration-none">More Details</a>

		                        <div class="star-rating pt-3">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>
								
								<a href="#" class="addtocartBtn text-decoration-none" data-id="<?= $iid ?>" data-name="<?= $iname ?>" data-codeno="<?= $icodeno ?>" data-photo="<?= $iphoto ?>" data-price="<?= $iprice ?>" data-discount="<?= $idiscount ?>">Add to Cart</a>

		                    </div>
		                </div>
		            <?php endforeach; ?>
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Flash Sale Item -->
		<div class="row mt-5">
			<h1> Flash Sale </h1>
		</div>

	    <!-- Flash Sale Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php

		            	$sql="SELECT * FROM items ORDER BY rand() limit 10";

		            	$stmt = $conn->prepare($sql);
		            	$stmt->execute();
		            	$items=$stmt->fetchAll();

		            	foreach ($items as $item):
		            		$iid=$item['id'];
		            		$iname=$item['name'];
		            		$iphoto=$item['photo'];
		            		$iprice=$item['price'];
		            		$idiscount=$item['discount'];

		            		?>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="<?= $iphoto; ?>" class="img-fluid">
		                        <p class="text-truncate"><?= $iname; ?></p>
		                        <p class="item-price">
		                        	<?php if($idiscount): ?>
		                        	<strike><?= $iprice; ?> Ks</strike> 
		                        	<span class="d-block"><?= $iprice-$idiscount; ?> Ks</span>

		                        	<?php else: ?>
		                        		<span class="d-block"><?= $iprice; ?> Ks</span>
		                        	<?php endif ?>
		                        </p>

		                        <a href="frontend_itemdetail.php?id=<?= $iid; ?>" class="addtocartBtn text-decoration-none">More Details</a>

		                        <div class="star-rating pt-3">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none" data-id="<?= $iid ?>" data-name="<?= $iname ?>" data-codeno="<?= $icodeno ?>" data-photo="<?= $iphoto ?>" data-price="<?= $iprice ?>" data-discount="<?= $idiscount ?>">Add to Cart</a>

		                    </div>
		                </div>

		            <?php endforeach; ?>
	
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Random Catgory ~ Item -->
		<div class="row mt-5">
			<h1> Fresh Picks </h1>
		</div>

	    <!-- Random Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/saisai_one.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<strike>250,000 Ks </strike> 
		                        	<span class="d-block">230,000 Ks</span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/saisai_two.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/saisai_three.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<strike>250,000 Ks </strike> 
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/saisai_four.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<strike>250,000 Ks </strike> 
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/giordano_one.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<strike>250,000 Ks </strike> 
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/giordano_two.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/giordano_three.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/giordano_four.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<strike>250,000 Ks </strike> 
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/apple_four.jpeg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/apple_one.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<strike>250,000 Ks </strike> 
		                        	<span class="d-block">230,000 Ks</span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/apple_three.jpg" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="frontend/image/item/apple_two.png" class="img-fluid">
		                        <p class="text-truncate">Multi Item Carousel</p>
		                        <p class="item-price">
		                        	<strike>250,000 Ks </strike> 
		                        	<span class="d-block">230,000 Ks </span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>

		                    </div>
		                </div>
		                
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		
		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	    <!-- Brand Store -->
	    <div class="row mt-5">
			<h1> Top Brand Stores </h1>
	    </div>

	    <!-- Brand Store Item -->
	    <section class="customer-logos slider mt-5">
	      	<div class="slide">
	      		<a href="">
		      		<img src="frontend/image/brand/loacker_logo.jpg">
		      	</a>
	      	</div>
	      	
	      	<div class="slide">
	      		<a href="">
	      			<img src="frontend/image/brand/lockandlock_logo.png">
	      		</a>
	      	</div>
	      	
	      	<div class="slide">
	      		<a href="">
	      			<img src="frontend/image/brand/apple_logo.png">
	      		</a>
	      	</div>
	      	
	      	<div class="slide">
	      		<a href="">
	      			<img src="frontend/image/brand/giordano_logo.png">
	      		</a>
	      	</div>
	      	
	      	<div class="slide">
	      		<a href="">
	      			<img src="frontend/image/brand/saisai_logo.png">
	      		</a>
	      	</div>
	      	
	      	<div class="slide">
	      		<a href="">
	      			<img src="frontend/image/brand/brands_logo.png">
	      		</a>	
	      	</div>
	      	
	      	<div class="slide">
	      		<a href="">
	      			<img src="frontend/image/brand/acer_logo.png">
	      		</a>
	      	</div>
	      	
	      	<div class="slide">
	      		<a href="">
	      			<img src="frontend/image/brand/bella_logo.png">
	      		</a>
	      	</div>
	      	
	      	<div class="slide">
	      		<a href="">
	      			<img src="frontend/image/brand/ariel_logo.png">
	      		</a>
	      	</div>
	   	</section>

	    <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	</div>


	<!-- Footer -->
	<div class="container-fluid bg-light p-5 align-content-center align-items-center mt-5">
		
		<div class="row">
	  		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<div class="row">
				    <div class="col-md-4">
				    	<i class="icofont-fast-delivery serviceIcon maincolor"></i>
				    </div>
			    
			    	<div class="col-md-8">
		        		<h6>Door to Door Delivery</h6>
		        		<p class="text-muted" style="font-size: 12px">On-time Delivery</p>
			    	</div>
			  	</div>
	  		</div>

	  		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<div class="row">
				    <div class="col-md-4">
				    	<i class="icofont-headphone-alt-2 serviceIcon maincolor"></i>
				    </div>
			    
			    	<div class="col-md-8">
		        		<h6> Customer Service </h6>
		        		<p class="text-muted" style="font-size: 12px">  09-779-999-915 ၊ <br> 09-779-999-913 </p>
			    	</div>
			  	</div>
	  		</div>

	  		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<div class="row">
				    <div class="col-md-4">
				    	<i class='bx bx-undo serviceIcon maincolor'></i>
				    </div>
			    
			    	<div class="col-md-8">
		        		<h6 > 100% satisfaction </h6>
		        		<p class="text-muted" style="font-size: 12px"> 3 days return </p>
			    	</div>
			  	</div>
	  		</div>

	  		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<div class="row">
				    <div class="col-md-4">
				    	<i class="icofont-credit-card serviceIcon maincolor"></i>
				    </div>
			    
			    	<div class="col-md-8">
		        		<h6> Cash on Delivery </h6>
		        		<p class="text-muted" style="font-size: 12px"> Door to Door Service </p>
			    	</div>
			  	</div>
	  		</div>
	  	</div>
	</div>
	
	<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	<div class="container">
		<div class="row text-center">
			<div class="col-12">
				<h1> News Letter </h1>
				<p>
					Subscribe to our newsletter and get 10% off your first purchase
				</p>

			</div>
			
			<div class="offset-2 col-8 offset-2 mt-5">
				<form>
					<div class="input-group mb-3">
						<input type="text" class="form-control form-control-lg px-5 py-3" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" style="border-top-left-radius: 15rem; border-bottom-left-radius: 15rem">
					  	
					  	<div class="input-group-append">
					    	<button class="btn btn-secondary subscribeBtn" type="button" id="button-addon2"> Subscribe </button>
					  	</div>


					</div>
				</form>
			</div>

		</div>
	</div>


	<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>
	

<?php
require('frontEnd_footer.php');
?>