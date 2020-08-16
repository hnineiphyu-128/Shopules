<?php
require 'dbconnect.php';
require 'frontEnd_header.php';
$id = $_GET['id'];
$sql = "SELECT users.*,roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE users.id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id',$id);
$stmt->execute();

$user = $stmt->fetch(PDO:: FETCH_ASSOC);

?>

<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Edit Account </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container my-5">

		<div class="row justify-content-center">
			<div class="col-8">
				<form action="signup.php" method="POST">
		      		<div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="small mb-1" for="inputName"> Name</label>
                              <input class="form-control py-4" id="inputName" type="text" placeholder="Enter Name" name="name" value="<?= $user['name']?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="small mb-1" for="phone">Phone Number</label>
                              <input class="form-control py-4" id="phone" type="text" placeholder="Enter Phone Number" name="phone" value="<?= $user['phone']?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                      	<label class="small mb-1" for="inputEmailAddress">Email</label>
                      	<input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" value="<?= $user['email']?>"  />
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <input type="checkbox"  id="changepassword" name="changepassword">
                              <label class="small mb-1" for="changepassword">Change Your Password</label>
                              
                            </div>
                        </div>
                        <div class="col-md-12" id="password">
                            <div class="form-group">
                              <label class="small mb-1" for="inputPassword">Password</label>
                              <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" name="password"  value="<?= $user['password']?>"  />
                              <font id="error" color="red"></font>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                              <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                              <input class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm password" name="confirm" />
                              <font id="cerror" color="red"></font>

                            </div>
                        </div> -->
                    </div>

                    <div class="form-group">
                      	<label class="small mb-1" for="address"> Address </label>
                      	<textarea class="form-control" name="address"><?= $user['name']?></textarea>
                    </div>
		      		
		      		<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
		        		
		        		<button type="submit" class="btn btn-secondary mainfullbtncolor btn-block"> Update Account </button>
		      		</div>
		  		</form>

		  		
			</div>
		</div>	

	</div>

  

<?php
	require 'frontEnd_footer.php';

?>