<?php 
require 'Backend_Header.php';
require 'dbconnect.php';

$id=$_GET['id'];


$sql = "SELECT orders.*,users.name as user_name 
FROM orders 
INNER JOIN users
ON orders.user_id=users.id
WHERE orders.id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id',$id);
$stmt->execute();
$order=$stmt->fetch(PDO::FETCH_ASSOC);


?>
<main class="app-content">
	<div class="app-title">
		<div>
			<h1> <i class="icofont-list"></i> Orders Details </h1>
		</div>
		<ul class="app-breadcrumb breadcrumb side">
			<a href="orderlist.php" class="btn btn-outline-primary">
				<i class="icofont-double-left"></i>
			</a>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<?php 
						$orderdate = $order['orderdate'];
						$voucherno = $order['voucherno'];
						$total = $order['total'];
						$note = $order['note'];
						$order_status = $order['status'];
						$user_id = $order['user_id'];
						$user_name = $order['user_name'];
						if($order_status==0){
                            $status="Order";
                        }elseif($order_status==2){
                            $status="Order Cancel";
                        }
                        else{
                            $status="Confirmed order";
                        }
                        $sql = "SELECT orderdetails.*, items.name AS item_name, items.codeno AS item_codeno, items.photo AS item_photo, items.price AS item_price  
								FROM orderdetails 
								INNER JOIN items
								ON orderdetails.item_id=items.id
								WHERE orderdetails.voucherno = :voucherno";
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':voucherno',$voucherno);
						$stmt->execute();
						$orderdetails=$stmt->fetchAll();
					?>
					<h3>Voucher No : <?= $voucherno ?></h3> 
					<p>Order Date : <?= $orderdate ?></p>
					<p>Ordered By : <a href="userdetail.php?id=<?= $user_id ?>"><?= $user_name ?></a></p>
					<p>Total Price : <?= $total ?></p>
					<p>Status : <?= $status ?></p>
					<p>Note : <?= $note ?></p>

					<?php if($order_status==0): ?>
                        <a href="orderconfirm.php?id=<?= $id ?>" class="btn btn-outline-success">
                            <i class="icofont-ui-check"></i>
                        </a>
                        
                        <a href="orderdelete.php?id=<?= $id ?>" class="btn btn-outline-danger">
                            <i class="icofont-close"></i>
                        </a>
                    <?php endif; ?>
					<?php
						foreach ($orderdetails as $orderdetail):
							$item_name = $orderdetail['item_name'];
							$item_codeno = $orderdetail['item_codeno'];
							$item_price = $orderdetail['item_price'];
							$item_photo = $orderdetail['item_photo'];
							$qty = $orderdetail['qty'];
					?>

					
					<div class="row pt-2 mt-2">

						<div class="col-md-5 ">
							<img src="<?= $item_photo ?>" width="400" height="400" class="pb-4">
						</div>

						<div class="cocol-md-7 py-3">
							<ul>
								<li>
									<h5>Code No : <?= $item_codeno; ?></h5>
								</li>
								<li>
									<h5>Item Name : <?= $item_name; ?></h5>
								</li>
								<li>
									<h5>Price : <?= $item_price; ?></h5>
								</li>
								<li>
									<h5>Qty : <?= $qty; ?></h5>
								</li>
							</ul>
							
						</div>

					</div>
					<hr>

					<?php endforeach;?>

				</div>	
			</div>
		</div>
	</div>
</main>


<?php 
require 'Backend_Footer.php';
?>