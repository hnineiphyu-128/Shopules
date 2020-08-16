<?php 
require 'dbconnect.php';
include('Backend_Header.php');
 ?>
 <main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Items Form </h1>
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
                            <form action="itemadd.php" method="POST" enctype="multipart/form-data">
                                
                                <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Photo </label>
                                    <div class="col-sm-10">
                                      <input type="file"  id="photo" name="photo">
                                    </div>
                                </div>                                
                                  <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Price </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="price" name="price">
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Discount </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="discount" name="discount">
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Description </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="description" name="description">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Brand </label>
                                    <div class="col-sm-10">
                                      
                    <select class="custom-select" name="brand">
                    <option selected>Choose Brand</option>
                    <?php 
                    $sql="SELECT * FROM brands";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute();
                    $rows=$stmt->fetchAll();

                    foreach ($rows as $row ) {
                        $id=$row['id'];
                        $name=$row['name'];

                        ?>
                        <option value="<?php echo $id; ?>">
                            <?php echo $name; ?>
                        </option>

                    <?php   }   ?>

                </select>   
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Subcategory </label>
                                    <div class="col-sm-10">
                                      
                    <select class="custom-select" name="subcategory">
                    <option selected>Choose Subcategory</option>
                    <?php 
                    $sql="SELECT * FROM subcategories";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute();
                    $rows=$stmt->fetchAll();

                    foreach ($rows as $row ) {
                        $id=$row['id'];
                        $name=$row['name'];

                        ?>
                        <option value="<?php echo $id; ?>">
                            <?php echo $name; ?>
                        </option>

                    <?php   }   ?>

                </select>   
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icofont-save"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
 </main>

<?php 
include('Backend_Footer.php');
 ?>