<?php

$page_title = "Search House";

require_once ('includes/header.php');
require_once('includes/database.php');

$location = $_GET['location'];

//select statement
$query_str = "SELECT * FROM $tblHouses WHERE location LIKE '%" .$location. "%' OR description LIKE '%" .$location. "%'";

//execut the query
$result = $conn->query($query_str);

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

	// free result from memory 
	mysqli_free_result($result);

	// Close database connection
	mysqli_close($conn);

?>

	<div class="container wrapper">
		
		<h1 class="text-center my-2">Search Results</h1>
		
		<!-- Search Box -->
		<div class="row">
			<div class="col-xs-4 col-xs-offset-8">
				<form action="<?=$_SERVER['PHP_SELF']?>" class="form-inline search-form" method="get" role="form">
					<div class="input-group">
						<input type="text" name="location" placeholder="Search Houses by location" id="houseSearch" class="form-control"/>
						<button type="submit" class="btn btn-warning">Go!</button>
					</div>
				</form>
			</div>
		</div>
		<!-- End of Search Box -->
    
    <?php 
			if (count($houses) == 0) {
				echo "<p class='lead text-center'>No results found for <strong>". $location . "</strong>. Please search again.</p>";
			} else { 
        //insert a row into the table for each row of data
		?>

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
										$query_str2 = "SELECT name FROM $tblUsers WHERE uid = '$ownerId'";
										$result = mysqli_query($conn, $query_str2);
										$owner = mysqli_fetch_assoc($result);
										echo $owner['name'];										
										?> <br />
									</p>
                    <a href="edithouse.php?id=<?php echo $house['hid']; ?>" class="btn btn-warning">EDIT</a>
                    <a href="deletehouse.php?id=<?php echo $house['hid']; ?>" class="btn btn-danger">DELETE</a>
								</div>
							</div>
					<!-- End of House Card -->

							</div>
						<?php endforeach; ?>
					</div>
				</div>
		<?php } ?>
	</div>

<?php
// include footer at the end of the page
	require_once('includes/footer.php');
?>