<?php

$page_title = "Available Houses";

require_once('includes/header.php');
require_once('includes/database.php');

//select statement
$query_str1 = "SELECT * FROM $tblHouses";

//execute the query
$result = mysqli_query($conn,$query_str1);

// fetch all houses as associative array
$houses = mysqli_fetch_all($result, MYSQLI_ASSOC);

//Handle selection errors
if (!$result) {
	$errno = $conn->errno;
	$errmsg = $conn->error;
	echo "Selection failed with: ($errno) $errmsg<br/>\n";
	$conn->close();
	exit;
}

?>

	<div class="container wrapper">

		<h1 class="text-center my-4">Houses Available For Sale</h1>

	<!-- When Houses Available-->
	<?php if(count($houses) > 0) { ?>

		<!-- Search Box -->
		<div class="row my-2">
			<div class="col-xs-4 col-xs-offset-8">
				<form action="searchhouses.php" method="get" class="form-inline search-form" role="form">
					<div class="input-group">
						<input type="text" name="location" placeholder="Search Houses by location" id="houseSearch" class="form-control"/>
						<button type="submit" class="btn btn-warning">Go!</button>
					</div>
				</form>
			</div>
		</div>
		<!-- End of Search Box -->


		<div class="house-list">
			<div class="row mx-auto">
				<?php	foreach( $houses as $house): ?>
					<div class="col my-4 md-3">		
						
					<!-- House Card -->
							<div class="card" style="width: 20rem;">
								<img src="<?php echo $house['img']?>" class="card-img-top img-thunbnail" alt="house image">
								<div class="card-body">
									<!-- <h5 class="card-title"></h5> -->
									<p class="card-text">
										<strong>Location:</strong> <?php echo $house['location']?> <br />
										<strong>Area (in sq.m.):</strong> <?php echo $house['area']?> <br />
										<strong>Description:</strong> <?php echo $house['description']?> <br />
										<strong>Price (in Rs):</strong> <?php echo $house['price']?> <br />
										<strong>Owner Name:</strong> 
										<?php 
										// retrieve owner id (uid)
										$ownerId = $house['uid'];
										$query_str2 = "SELECT * FROM $tblUsers WHERE uid = '$ownerId'";
										$result = mysqli_query($conn, $query_str2);
										$owner = mysqli_fetch_assoc($result);
										echo $owner['name'];
										
										?> <br />
									</p>
									<a href="mailto:<?php echo $owner['email'];?>" class="btn btn-warning">Email Now</a>
									<a href="tel:<?php echo $owner['phone'];?>" class="btn btn-warning">Call Now</a>
								</div>
							</div>
					<!-- End of House Card -->

					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- When not even a single House Available -->
		<?php }else { ?>
			<div class="container-fluid lead text-center text-danger my-4">
				<p>No Houses Available at the moment <br> Please try again later.</p>
			</div>
		<?php } ?>	

	</div>

<?php
// included footer at the end of the page
	include_once('includes/footer.php');
?>