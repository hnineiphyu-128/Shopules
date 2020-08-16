<?php
require 'dbconnect.php';
 include ('BackEnd_header.php');

 $sql="SELECT * FROM users";
 $stmt=$conn->prepare($sql);
 $stmt->execute();

 $users=$stmt->fetchAll();


  ?>

    <main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> User Lists </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    
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
                                            foreach ($users as $user): 
                                                $id=$user['id'];
                                                $name=$user['name'];
                                                $photo=$user['profile'];   
                                                $status=$user['status'];   
                                                $role_id=$user['role_id'];   
                                                // if($status==1){
                                                //     $status="Block User";
                                                // }
                                        ?>
                                        <tr>
                                            <td> 
                                                <?php echo $i++; ?> 
                                            </td>
                                            <td> 
                                                <img src="<?=$photo ?>" class="img-fluid w-25"> 
                                                 
                                                <?php if($status == 0):?>
                                                    <?= $name ?>
                                                <?php else:?>
                                                    <strike><?= $name ?></strike>
                                                    <span class="text-danger">Block Customer</span>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <?php if($role_id == 1):?>
                                                    <a href="userdetail.php?id=<?= $id ?>" class="btn btn-outline-info">
                                                        <i class="icofont-eye"></i>
                                                        Admin
                                                    </a>
                                                <?php else:?>
                                                    <?php if($status==0): ?>

                                                        <a href="userdetail.php?id=<?= $id ?>" class="btn btn-outline-info">
                                                            <i class="icofont-eye"></i>
                                                        </a>

                                                        <a href="userdelete.php?id=<?= $id ?>" class="btn btn-outline-danger">
                                                            <i class="icofont-close"></i>
                                                        </a>
                                                    <?php else:?>
                                                        <a href="userdetail.php?id=<?= $id ?>" class="btn btn-outline-info">
                                                            <i class="icofont-eye"></i>
                                                        </a>
                                                        <a href="userundelete.php?id=<?= $id ?>" class="btn btn-outline-warning">
                                                            Undo
                                                        </a>
                                                    <?php endif;?>
                                                <?php endif;?>
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