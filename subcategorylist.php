<?php
require 'dbconnect.php';
include ('BackEnd_header.php');

$sql="SELECT subcategories.*,categories.name as category_name FROM subcategories JOIN categories ON subcategories.category_id=categories.id";
$stmt=$conn->prepare($sql);
$stmt->execute();
$subcategories=$stmt->fetchAll();




 ?>
    <main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Subategory </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="subcategorynew.php" class="btn btn-outline-primary">
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
                                          <th>Category</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            foreach ($subcategories as $subcategory): 
                                                $id=$subcategory['id'];
                                                $name=$subcategory['name'];
                                                $category_id=$subcategory['category_name'];
                                            

                                        ?>
                                        <tr>
                                            <td> 
                                                <?php echo $i++; ?> 
                                            </td>
                                            <td> 
                                                <?= $name ?> 
                                            </td>
                                            <td> 
                                                <?= $category_id ?> 
                                            </td>
                                            <td>
                                                <a href="subcategoryedit.php? id=<?= $id ?>" class="btn btn-outline-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <a href="subcategorydelete.php?id=<?= $id ?>" class="btn btn-outline-danger">
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