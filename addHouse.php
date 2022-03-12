<?php
$page_title = "Add House for Sale";

require_once('includes/database.php');
require_once ('includes/header.php');

$error = $house_location = $house_area = $house_description = $house_price = $house_img = '';

if($isLoggedIn){

  if(isset($_POST['submit'])){

    $house_location = $_POST['location'];
    $house_area = $_POST['area'];
    $house_description = $_POST['description'];
    $house_price = $_POST['price'];
    $house_img = ($_POST['img']);
    
    $sql_query1 = "INSERT INTO $tblHouses (location,area,description,price,img,uid) VALUES ('$house_location','$house_area','$house_description', '$house_price','$house_img','$uid')";
    
    //execute the query
    $error =  !mysqli_query($conn,$sql_query1) && "There was an error";
    
    header("Location:showhouses.php");
  } 
}else{
  $error = "There's an error. You're not Logged in. <br /> Please Log In to add your house for sale.";
  header( "Refresh:4; url=login.php", true, 303);
}
	
?>

<div class="container-fluid d-flex p-0">

<!-- Include Sidebar -->
<?php include('includes/sidebar.php') ?>


<!-- Right Side Content -->
	<div class="container wrapper my-5 d-flex align-items-center flex-column justify-content-center">

  <h1 class="text-center my-3">Add HOUSE For Sale</h1>
  <?php if($error){ ?>
    <p class="lead text-center text-danger my-5"><?php echo $error; ?></p>
    <?php } else{ ?>

    <p class="lead text-center">Please add your house</p>
    <div class="col-xs-8 col-xs-offset-2 w-75">
    <!-- Add House Form -->
    <form class="form-horizontal" role="form" action="" method="POST">
      <div class="form-group my-2">
        <label for="location" class="control-label">Location (State & Country)</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="area" class="control-label">Area of the house (in sq.ft)</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="area" name="area" placeholder="Enter Area" required>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="house_price" class="control-label">Price of House</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="house_price" name="price" placeholder="Price" required>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="desc" class="control-label">Description</label>
        <div class="col-sm-9 w-100">
          <textarea type="text" class="form-control" id="desc" name="description" rows="5" placeholder="Enter Description of the House" required></textarea>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="newImage" class="control-label">House Image URL</label>
        <div class="col-sm-9 w-100">
          <input type="text" id="newImage" class="form-control" name="img" placeholder="Enter URL" required>
        </div>
      </div>
      <div class="form-group my-3">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" name='submit' class="btn btn-warning">Add House</button>
        </div>
      </div>
    </form>
    <!-- End of Add house form -->
    </div>
    <?php } ?>  
</div>
<!-- End of Right Side Content -->

</div>

<?php
// included footer at the end of the page
	include_once('includes/footer.php');
?>