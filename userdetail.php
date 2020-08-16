<?php 
require 'Backend_Header.php';
require 'dbconnect.php';

$id=$_GET['id'];


$sql = "SELECT users.*,roles.name as role_name 
FROM users 
LEFT JOIN roles
ON users.role_id=roles.id
WHERE users.id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id',$id);
$stmt->execute();
$user=$stmt->fetch(PDO:: FETCH_ASSOC);


?>
<main class="app-content">
	<div class="app-title">
		<div>
			<h1> <i class="icofont-list"></i> Users Details </h1>
		</div>
		<ul class="app-breadcrumb breadcrumb side">
			<a href="userlist.php" class="btn btn-outline-primary">
				<i class="icofont-double-left"></i>
			</a>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<?php
						$profile=$user['profile'];
						$name=$user['name'];
						$email=$user['email'];
						$phone=$user['phone'];
						$address=$user['address'];
						$status=$user['status'];
						$role_name=$user['role_name'];
						$sql = "SELECT orders.total AS totalorder,orders.status AS status FROM orders INNER JOIN users ON orders.user_id=users.id WHERE orders.user_id = :id";

						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':id',$id);
						$stmt->execute();
						$rows=$stmt->fetchAll();
						$totalorder = 0;

						foreach ($rows as $row) {
							if($row['status'] == 1 ){
								$totalorder += $row['totalorder'];
							}
						}

					?>

					<div class="row">

						<div class="col-md-5 ">
							<img src="<?= $profile ?>" width="400" height="400" class="pb-4">
						</div>

						<div class="cocol-md-7 py-5 pl-3">
							<h4>Name : <?= $name ?></h4> 
							<ul>
								<li>
									<h5>Email : <?= $email ?></h5> 
								</li>
								<li>
									<h5>Role : <?= $role_name; ?></h5>
								</li>
								<li>
									<h5>Phone : <?= $phone; ?></h5>
								</li>
								<li>
									<h5>Address : <?= $address; ?></h5>
								</li>
								<?php if($totalorder > 0 ):?>
									<li>
										<h5>Totally Amount : <span class="text-danger h3"> <?= $totalorder; ?> KS</span></h5>
									</li>
								<?php else:?>
									<li>
										<h5 class="text-danger">There is no order recieve!</h5>
									</li>
								<?php endif;?>
								<?php if($status == 1):?>
									<li>
										<h5 class="text-danger">This user is blocked!</h5>
									</li>
								<?php endif;?>
							</ul>
						</div>

						
						<?php 
							$sql="SELECT * FROM orders WHERE user_id = :user_id";
							$stmt=$conn->prepare($sql);
							$stmt->bindParam(':user_id',$id);
							$stmt->execute();

							$orders=$stmt->fetchAll();
							if($orders):
						?>
						<div class="col-md-12">
		                    <div class="tile">
		                        <div class="tile-body">
		                            <div class="table-responsive">
		                            	<h4 class="py-2">Order History</h4>
		                                <table class="table table-hover table-bordered" id="">
		                                    <thead>
		                                        <tr>
		                                          <th>#</th>
		                                          <th>Date</th>
		                                          <th>Voucherno</th>
		                                          <th>Total</th>
		                                          <th>Status</th>
		                                          <th>Action</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <?php
		                                            $i=1;
		                                            
													foreach($orders as $order):
		                                               $orderid=$order['id'];
		                                               $orderdate=$order['orderdate'];
		                                               $voucherno=$order['voucherno'];
		                                               $total=$order['total'];
		                                               $note=$order['note'];
		                                               $order_status=$order['status'];
		                                               if($order_status==0){
		                                                   $status="Order";
		                                               }elseif($order_status==2){
		                                                   $status="Order Cancel";
		                                               }
		                                               else{
		                                                   $status="Confirmed order";
		                                               }

		                                        ?>
		                                        <tr>
		                                            <td> 
		                                                <?php echo $i++; ?> 
		                                            </td>
		                                            <td> 
		                                                <?= $orderdate ?> 
		                                            </td>
		                                            <td> 
		                                                <?= $voucherno ?> 
		                                            </td>
		                                            <td> 
		                                                <?= $total ?> 
		                                            </td>
		                                            <td> 
		                                                <?= $status ?> 
		                                            </td>
		                                            <td>

		                                                <a href="orderdetail.php?id=<?= $orderid ?>" class="btn btn-outline-info">
		                                                    <i class="icofont-info"></i>
		                                                </a>
		                                                <?php if($order_status==0): ?>
		                                                    <a href="orderconfirm.php?id=<?= $orderid ?>" class="btn btn-outline-success">
		                                                        <i class="icofont-ui-check"></i>
		                                                    </a>
		                                                    
		                                                    <a href="orderdelete.php?id=<?= $orderid ?>" class="btn btn-outline-danger">
		                                                        <i class="icofont-close"></i>
		                                                    </a>
		                                                <?php endif; ?>
		                                            </td>

		                                        </tr>
		                                    	<?php endforeach;?>
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            	<?php endif;?>
					</div>

					

				</div>	
			</div>
		</div>
	</div>
</main>


<?php 
require 'Backend_Footer.php';
?>