<?php
include 'frontEnd_header.php';
include 'frontEnd_nav.php';

require 'dbconnect.php';

?>

<div class="jumbotron jumbotron-fluid subtitle">
	<div class="container">
		<h1 class="text-center text-white"> Order Received! </h1>
	</div>
</div>

<div class="container mt-5">


	<div class="row">
		<div class="col">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pt-5">
				<div class="shadow p-3 mb-5 bg-white rounded text-center">
					<br>
					<h1>Your order is complete</h1>
					<p>Your order will be delivered in 4 days</p>
					<br><br>
				</div>
			</div>
		</div>
	</div>

</div>

<?php
include 'frontEnd_footer.php';

?>