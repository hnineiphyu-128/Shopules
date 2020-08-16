<?php 
    require 'dbconnect.php';
    include ('BackEnd_header.php');
    $id=$_GET['id'];

    //draw out query from db
    $sql="SELECT * FROM brands WHERE id=:id";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    $brand=$stmt->fetch(PDO::FETCH_ASSOC);

 ?>

 <main class="app-content">
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Brand Form </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="brandlist.php" class="btn btn-outline-primary">
                <i class="icofont-double-left"></i>
            </a>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form action="brandupdate.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?= $brand['id'] ?>">
                        <input type="hidden" name="oldLogo" value="<?= $brand['logo'] ?>">


                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="name" value="<?= $brand['name'] ?>">
                          </div>
                      </div>

                      <div class="form-group row">
                        <label for="photo_id" class="col-sm-2 col-form-label"> Logo </label>
                        
                        <div class="col-sm-10">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-old" role="tab" aria-controls="nav-home" aria-selected="true">Old Logo</a>
                                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-new" role="tab" aria-controls="nav-profile" aria-selected="false">New Logo</a>

                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-old" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                         <img src="<?= $brand['logo']?>" class="img-fluid w-25">  
                                     </div>
                                 </div>

                             </div>
                             <div class="tab-pane fade" id="nav-new" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="file" id="photo_id" name="logo">
                                    </div>
                                </div>
                            </div>
                        </div>
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

<?php include ('BackEnd_footer.php'); ?> 