<?php 
require 'dbconnect.php';
include('Backend_Header.php');

$id=$_GET['id'];

    //draw out query from db
$sql="SELECT * FROM items WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':id',$id);
$stmt->execute();

$item=$stmt->fetch(PDO::FETCH_ASSOC);

$itemid = $item['id'];
$name = $item['name'];
$codeno = $item['codeno'];
$photo = $item['photo'];
$price = $item['price'];
$discount = $item['discount'];
$description = $item['description'];
$subid = $item['subcategory_id'];
$brandid = $item['brand_id'];


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
                    <form action="itemupdate.php?id=<?= $itemid?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="codeno" value="<?= $codeno?>">
                        <input type="hidden" name="oldPhoto" value="<?= $photo?>">

                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="name_id" class="col-sm-2 col-form-label"> Photo </label>
                        <div class="col-sm-10">
                          <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-old" role="tab" aria-controls="nav-home" aria-selected="true">Old Photo</a>
                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-new" role="tab" aria-controls="nav-profile" aria-selected="false">New Photo</a>

                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-old" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                       <img src="<?= $photo; ?>" class="img-fluid w-25">  
                                   </div>
                               </div>

                           </div>
                           <div class="tab-pane fade" id="nav-new" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="file" id="photo_id" name="photo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label"> Price </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="price" name="price" value="<?= $price; ?>">
              </div>
          </div>
          <div class="form-group row">
                <label for="discount" class="col-sm-2 col-form-label"> Discount </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="discount" name="discount" value="<?= $discount; ?>">
              </div>
          </div>
      </div>
      <div class="form-group row">
        <label for="name_id" class="col-sm-2 col-form-label"> Description </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="description" name="description" value="<?= $description; ?>">
      </div>
  </div>

  <div class="form-group row">
    <label for="photo_id" class="col-sm-2 col-form-label"> Brand </label>
    <div class="col-sm-10">

        <select class="custom-select" name="brand_id">
            <option selected>Choose Brand</option>
            <?php 
            $sql="SELECT * FROM brands ";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $brands=$stmt->fetchAll();
            foreach ($brands as $brand ):
                $id=$brand['id'];
                $name=$brand['name'];
                ?>
                <option <?php if ($id == $brandid){
                   echo "selected";  
                }  ?> value="<?php echo $id; ?>" >
                <?php echo $name; ?>
            </option>
    <?php   endforeach;   ?>

</select>   
</div>
</div>

<div class="form-group row">
    <label for="photo_id" class="col-sm-2 col-form-label"> Subcategory </label>
    <div class="col-sm-10">

        <select class="custom-select" name="subcategory_id">
            <option selected>Choose Subcategory</option>
            <?php 
            $sql="SELECT * FROM subcategories ";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $rows=$stmt->fetchAll();
            foreach ($rows as $row ) {
                $id=$row['id'];
                $name=$row['name'];
                ?>
                <option <?php
                if ($id == $subid) { echo "selected"; ?> value="<?php echo $id; ?>" >
                <?php echo $name; ?>
            </option>
            <?php
        }
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
            Update
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