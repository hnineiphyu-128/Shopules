<?php
	require 'dbconnect.php';

?>

<!-- Navigation-->
	<div class="container-fluid">

		<div class="row shadow-sm p-3 bg-white rounded d-flex align-items-center">
			<!-- LOGO -->
			<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 order-1">
				<span class="d-xl-none d-lg-none d-md-inline d-sm-inline d-inline  p-1 navslidemenu">
					<i class="icofont-navigation-menu"></i>
				</span>
				<img src="logo/logo_big.jpg" class="img-fluid d-xl-inline d-lg-inline d-md-none d-sm-none d-none">

				<img src="logo/logo_med.jpg" class="img-fluid d-xl-none d-lg-none d-md-inline d-sm-none d-none" style="width: 100px">

				<img src="logo/logo.jpg" class="img-fluid d-xl-none d-lg-none d-md-none d-sm-inline d-inline pl-2" style="width: 30px">
			</div>
			
			<!-- Search Bar -->
			<div class="col-xl-6 col-lg-6 col-md-4 col-sm-2 col-2 order-xl-2 order-lg-2 order-md-3 order-sm-3 order-3">
				<div class="row">
					<div class="col-lg-8 col-2 ">
						<div class="has-search d-xl-block d-lg-block d-none ">
						    <div class="input-group">
				                <input class="form-control pl-4 border-right-0 border" type="search" placeholder="Search" id="">
				                <span class="input-group-append searchBtn">
				                    <div class="input-group-text bg-transparent">
				                    	<i class="icofont-search"></i>
				                    </div>
				                </span>
				            </div>
						</div>
					</div>
					<div class="dropdown d-inline-block col-lg-4 col-10">
						<?php
						if(isset($_SESSION['loginuser'])):
						?>
						<a class="nav-link text-decoration-none text-dark font-weight-bold d-block" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="mr-2 text-danger"> <?= $_SESSION['loginuser']['name'] ?></span>
							<i class="icofont-rounded-down pt-2"></i>
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<li class="dropdown-submenu">
								<a class="dropdown-item" href="#">Profile
								</a>
							</li>	
							<li class="dropdown-submenu">
								<a class="dropdown-item" href="signout.php">Logout
								</a>
							</li>	
						</ul>
					<?php endif; ?>

					<?php if (!isset($_SESSION['loginuser'])): ?>
						<a href="registerform.php" class="d-xl-block d-lg-block d-md-block d-none  text-decoration-none loginLink float-right"> Sign-up  </a>

						<a href="loginform.php" class="d-xl-block d-lg-block d-md-block d-none  text-decoration-none loginLink float-right"> Login|</a>

					<?php endif; ?>
						
					</div>
				</div>
			</div>
			
			<!-- Shopping-cart -->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 order-xl-3 order-lg-3 order-md-4 order-sm-4 order-4 text-right">
				<!-- Search ICON shopping cart -->

				<div class="d-xl-none d-lg-none d-md-none d-sm-inline d-inline searchiconBtn mr-2">
					<i class="icofont-search"></i>
				</div>

				<a href="cart.php" class="text-decoration-none d-xl-inline d-lg-inline d-md-inline d-sm-none d-none shoppingcartLink"> 
					<i class="icofont-shopping-cart"></i> 
					<span class="badge badge-pill badge-light badge-notify cartNotistyle cartNoti">  </span>
					<span class="cartTotal">  </span>
				</a>

				<a href="cart.php" class="text-decoration-none d-xl-none d-lg-none d-md-none d-sm-inline-block d-inline-block shoppingcartLink"> 
					<i class="icofont-shopping-cart"></i>
					<span class="badge badge-pill badge-light badge-notify cartNotistyle cartNoti">  </span>
				</a>

				<!-- App Download -->

				<img src="frontend/image/download.png" class="img-fluid d-xl-inline d-lg-inline d-md-none d-sm-none d-none" style="width: 150px">
			</div>
		</div>
	</div>
	<div id="myPage"></div>
	
	<!-- Sub Nav (MOBILE) -->
	<div class="container subNav d-xl-block d-lg-block d-none my-3">
		<div class="row align-items-center">
			<div class="col-3 align-items-center">
				<p class="d-inline pr-3"> Shop By </p>

				<div class="dropdown d-inline-block">
          			<a class="nav-link text-decoration-none text-dark font-weight-bold d-block" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          	<span class="mr-2"> Category </span>
						<i class="icofont-rounded-down pt-2"></i>

			        </a>
			        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

			        	<?php
			        		$sql="SELECT * FROM categories ORDER BY name ASC ";

			        		$stmt = $conn->prepare($sql);
              				$stmt->execute();
              				$categories=$stmt->fetchAll();

              				foreach ($categories as $category):
              				$cid=$category['id'];
              				$cname=$category['name'];


			        	?>

			          	<li class="dropdown-submenu">
			          		<a class="dropdown-item" href="javascript:void(0)">
			          			<?= $cname; ?>
			          			<i class="icofont-rounded-right float-right"></i>
			          		</a>
				            <ul class="dropdown-menu">
				            	<h6 class="dropdown-header">
				            		<?= $cname; ?>
				            	</h6>

				            	<?php
				            	$sql="SELECT * FROM subcategories WHERE category_id=:id ORDER BY name ASC ";

			        			$stmt = $conn->prepare($sql);
			        			$stmt->bindParam(':id',$cid);
              					$stmt->execute();

              					$subcategories=$stmt->fetchAll();

              					foreach ($subcategories as $subcategory): 
              						$sid=$subcategory['id'];
              						$sname=$subcategory['name'];


				            	?>

				              	<li><a class="dropdown-item" href="subcategory.php?id=<?= $sid; ?>"><?= $sname; ?></a></li>

				              	<?php endforeach; ?>
				              
				            </ul>
			          	</li>
			          	<div class="dropdown-divider"></div>

			          <?php endforeach; ?>

			        </ul>
        		</div>
			</div>

			<div class="col-3">
				<a href="promotion.php" class="text-decoration-none text-dark font-weight-bold"> Promotion </a>
			</div>
			<div class="col-3">
				<div class="hov-dropdown d-inline-block">
          			<a class="text-decoration-none text-dark font-weight-bold" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          				<span class="mr-2"> Brands </span>
						<i class="icofont-rounded-down pt-2"></i>

          			</a>
          			<div class="dropdown-menu" aria-labelledby="navbarDropdown2">

          				<?php
			        		$sql="SELECT * FROM brands ORDER BY name ASC ";

			        		$stmt = $conn->prepare($sql);
              				$stmt->execute();
              				$brands=$stmt->fetchAll();

              				foreach ($brands as $brand):
              				$bid=$brand['id'];
              				$bname=$brand['name'];


			        	?>
            			<a class="dropdown-item" href="#"><?= $bname; ?></a>
            		<?php endforeach; ?>

          			</div>
        		</div>
			</div>

			<div class="col-3">
				<div class="hov-dropdown d-inline-block">
          			<a class="text-decoration-none text-dark font-weight-bold" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          				<span class="mr-2"> Services </span>
						<i class="icofont-rounded-down pt-2"></i>

          			</a>
          			<div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            			<a class="dropdown-item" href="#">
            				Help Center
            			</a>
            			<div class="dropdown-divider"></div>
            			
            			<a class="dropdown-item" href="#">
            				Order
            			</a>
            			<div class="dropdown-divider"></div>
            			
            			<a class="dropdown-item" href="#">
            				Shipping & Delivery
            			</a>
            			<div class="dropdown-divider"></div>

            			<a class="dropdown-item" href="#">
            				Payment
            			</a>
            			<div class="dropdown-divider"></div>

            			<a class="dropdown-item" href="#">
            				Returns & Refunds
            			</a>

          			</div>
        		</div>
			</div>
		</div>
	</div>

	<!-- Sub Nav (WEB) -->
	<div id="mySidebar" class="sidebar">
		<div class="row">
			<div class="col-10">
	  			<img src="logo/logo_med_trans.png" class="img-fluid" style="width: 100px">
			</div>
			<div class="col-2">
				<a href="javascript:void(0)" class="closebtn text-decoration-none">
			  		<i class="icofont-close-line"></i>
			  	</a>
			</div>
		</div>
		
		<div class="mt-3">
			<p class="text-muted ml-4"> Shop By </p>
			<hr>

			<?php
              	foreach ($categories as $category):
              		$cid=$category['id'];
              		$cname=$category['name'];


			   ?>

		  	<a data-toggle="collapse" href="#category<?= $cid; ?>" role="button" aria-expanded="false" aria-controls="category<?= $cid; ?>">
		   		<?= $cname; ?>
		   		<i class="icofont-rounded-down float-right mr-3"></i>

		  	</a>

		  

			<div class="collapse sidebardropdown_container_category mt-3" id="category<?= $cid; ?>">

				<?php
				$sql="SELECT * FROM subcategories WHERE category_id=:id ORDER BY name ASC ";

			        			$stmt = $conn->prepare($sql);
			        			$stmt->bindParam(':id',$cid);
              					$stmt->execute();
              					$s=$stmt->fetchAll();

				foreach ($s as $subcategory): 
					$sid=$subcategory['id'];
					$sname=$subcategory['name'];

					?>

				    <a href="subcategory.php?id=<?= $sid; ?>" class="py-2"> <?= $sname; ?> </a>
				<?php endforeach; ?>
			</div>

			<hr>
			<?php endforeach; ?>

		  	<a href="promotion.php"> Poromotion </a>
			<hr>

		  	<a data-toggle="collapse" href="#brand" role="button" aria-expanded="false" aria-controls="brand">
		   		Merchants
		   		<i class="icofont-rounded-down float-right mr-3"></i>

		  	</a>

			<div class="collapse sidebardropdown_container_category mt-3" id="brand">
			    <a href="" class="py-2"> Brand One </a>
			    <a href="" class="py-2"> Brand Two </a>
			    <a href="" class="py-2"> Brand Three </a>
			    <a href="" class="py-2"> Brand Four </a>
			    <a href="" class="py-2"> Brand Five </a>
			</div>
			<hr>

			<a data-toggle="collapse" href="#service" role="button" aria-expanded="false" aria-controls="service">
		   		Service
		   		<i class="icofont-rounded-down float-right mr-3"></i>
		  	</a>

			<div class="collapse sidebardropdown_container_category mt-3" id="service">
			    <a href="" class="py-2"> Help Center </a>
			    <a href="" class="py-2"> Order </a>
			    <a href="" class="py-2"> Shipping & Delivery </a>
			    <a href="" class="py-2"> Payment </a>
			    <a href="" class="py-2"> Returns & Refunds </a>
			</div>
			<hr>

			<a href="#"> Login | Signup</a>
			<hr>

			<a href="#"> Cart [ <span class="cartNoti"> 1 </span> ]  </a>
			<hr>

			<img src="frontend/image/download.png" class="img-fluid ml-2 text-center" style="width: 150px">
			<hr>

			<p class="text-white ml-3"> Copyright &copy; <img src="logo/logo_wh_transparent.png" style="width: 20px; height: 20px"> 2019  </p>

		</div>
	  	
	</div>