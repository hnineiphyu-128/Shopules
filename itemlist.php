<?php 
require 'Backend_Header.php';
require 'dbconnect.php';
?>
<main class="app-content">
 <div class="app-title">
  <div>
    <h1> <i class="icofont-list"></i> Items </h1>
  </div>
  <ul class="app-breadcrumb breadcrumb side">
    <a href="itemnew.php" class="btn btn-outline-primary">
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
                <th>Price</th>
                <!-- <th>Discount</th> -->
                <th>Brand_name</th>
                <th>subcategory_name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $sql = "SELECT items.id as item_id, items.photo as item_photo,
              items.name as item_name, items.price as item_price, items.discount as item_discount,
              brands.name as brand_name,
              subcategories.name as subcategory_name 
              FROM items 
              INNER JOIN brands
              ON items.brand_id=brands.id
              INNER JOIN subcategories
              ON items.subcategory_id = subcategories.id";
                   // $sql = "SELECT items.id as item_id,
                   //       items.name as item_name, items.price as item_price, items.discount as item_discount,
                   //       brands.name as brand_name

                   //  FROM items 
                   //  INNER JOIN brands
                   //  ON items.brand_id=brands.id
                   //  ";

              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $rows=$stmt->fetchAll();
              // print_r($rows);

                  // print("<pre>".print_r($rows,true)."</pre>");
              $j=1;

              foreach ($rows as $item ):

                $id=$item['item_id'];
                $photo=$item['item_photo'];
                $name=$item['item_name'];
                $price=$item['item_price'];                   
                $discount=$item['item_discount'];
                // if($discount>0){
                //   $unitprice=$price-$discount;
                // }else{
                //   $unitprice=$price;
                // }
                $brand_name=$item['brand_name'];
                $subcategory_name = $item['subcategory_name'];                   

                ?> 
                <tr>
                 <td><?php echo $j++ ?></td>                    
                 <td>
                    <img src="<?php echo $photo ?>" width="50" height="50">
                    <?php echo $name ?>
                    
                  </td>
                 <td><?php echo $price ?></td>                    
                 <!-- <td><?php echo $discount ?></td> -->
                 <td><?php echo $brand_name ?></td>
                 <td><?php echo $subcategory_name ?></td>
                 <td>
                  <a href="itemdetail.php?id=<?= $id ?>" class="btn btn-outline-info">
                    <i class="icofont-info"></i>
                  </a>

                  <a href="itemedit.php?id=<?= $id ?>" class="btn btn-outline-warning">
                    <i class="icofont-ui-settings"></i>
                  </a>

                  <a href="itemdelete.php?id=<?= $id ?>" class="btn btn-outline-danger">
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

<?php 
require 'Backend_Footer.php';
?>