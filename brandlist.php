<?php
require 'dbconnect.php';
 include ('BackEnd_header.php');

 $sql="SELECT * FROM brands";
 $stmt=$conn->prepare($sql);
 $stmt->execute();

 $brands=$stmt->fetchAll();


  ?>

    <main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="app-menu__icon icofont-ui-tag"></i> Brand </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="brandnew.php" class="btn btn-outline-primary">
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
                                          <th>Name</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            foreach ($brands as $brand): 
                                                $id=$brand['id'];
                                                $name=$brand['name'];
                                                $logo=$brand['logo'];
                                            

                                        ?>
                                        <tr>
                                            <td> 
                                                <?php echo $i++; ?> 
                                            </td>
                                            <td> 
                                                <img src="<?= $logo ?>" class="img-fluid w-25" />
                                                <?= $name ?> 
                                            </td>
                                            <td>
                                                <a href="brandedit.php?id=<?= $id ?>" class="btn btn-outline-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <a href="branddelete.php?id=<?= $id ?>" class="btn btn-outline-danger">
                                                    <i class="icofont-close"></i>
                                                </a>
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