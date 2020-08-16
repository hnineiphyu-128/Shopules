<?php
require 'dbconnect.php';
 include ('BackEnd_header.php');

 $sql="SELECT * FROM orders ORDER BY status";
 $stmt=$conn->prepare($sql);
 $stmt->execute();

 $orders=$stmt->fetchAll();


  ?>

    <main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> order </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="ordernew.php" class="btn btn-outline-primary">
                        <i class="icofont-plus"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
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
                                            foreach ($orders as $order): 
                                                $id=$order['id'];
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

                                                <a href="orderdetail.php?id=<?= $id ?>" class="btn btn-outline-info">
                                                    <i class="icofont-info"></i>
                                                </a>
                                                <?php if($order_status==0): ?>
                                                    <a href="orderconfirm.php?id=<?= $id ?>" class="btn btn-outline-success">
                                                        <i class="icofont-ui-check"></i>
                                                    </a>
                                                    
                                                    <a href="orderdelete.php?id=<?= $id ?>" class="btn btn-outline-danger">
                                                        <i class="icofont-close"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>

                                        </tr>

                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>

<?php include ('BackEnd_footer.php'); ?>   