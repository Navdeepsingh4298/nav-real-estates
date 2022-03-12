<?php
$page_title = "Edit House Details";

require_once('includes/database.php');
require_once ('includes/header.php');

$error = $house_owner_id = $house_location = $house_area = $house_description = $house_price = $house_img = '';

$house_id = $_GET['id'];

if($isLoggedIn){

    //define the select statement
    $query_str1 = "SELECT * FROM $tblHouses WHERE hid = '$house_id'";
    
    //execute the query
    $result = mysqli_query($conn,$query_str1);
    
    //retrieve the results
    $result_row = mysqli_fetch_assoc($result);
    
    $house_location = $result_row['location'];
    $house_area = $result_row['area'];
    $house_description = $result_row['description'];
    $house_price = $result_row['price'];	
    $house_img = $result_row['img'];	
    $house_owner_id = $result_row['uid'];

    // AND When edit button is clicked
    if(isset($_POST['edit'])){
      
      // if the user is owner of the house then can edit house details
      if($uid === $house_owner_id || $role == 1){
        
        $house_location = $_POST['location'];
        $house_area = $_POST['area'];
        $house_description = $_POST['description'];
        $house_price = $_POST['price'];
        $house_img = ($_POST['img']);

        $sql_query1 = "UPDATE $tblHouses SET location = '$house_location', area = '$house_area', price = '$house_price', description = '$house_description', img = '$house_img' WHERE hid = $house_id";
        
        //execute the query and get the error message if any
        $error =  !mysqli_query($conn,$sql_query1) && "There was an error";
        
        header("Location:showhouses.php");
        
      }else{
        $error = "There's an Error. You can't Edit Someone Else's House Details.";
        header( "Refresh:200; url=index.php", true, 303);
      }
    }


}else{
  $error = "There's an error. You're not Logged in. <br /> Please Log In to Edit your house Details.";
  header( "Refresh:3; url=login.php", true, 303);
}
	
?>

<div class="container-fluid d-flex p-0">

<!-- Include Sidebar -->
<?php include('includes/sidebar.php') ?>


<!-- Right Side Content -->
	<div class="container wrapper my-5 d-flex align-items-center flex-column justify-content-center">

  <h1 class="text-center my-3">Edit House Details</h1>
  <?php if($error){ ?>
    <p class="lead text-center text-danger my-5"><?php echo $error; ?></p>
    <?php } else{ ?>

    <p class="lead text-center">Please edit your house details.</p>
    <div class="col-xs-8 col-xs-offset-2 w-75">

    <!-- Edit House Form -->
    <form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']."?id=".$house_id;?>" method="POST">
      <div class="form-group my-2">
        <label for="location" class="control-label">Location (State & Country)</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="location" name="location" value="<?php echo $house_location; ?>"  required>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="area" class="control-label">Area of the house (in sq.ft)</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="area" name="area" value="<?php echo $house_area; ?>" required>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="price" class="control-label">Price of House</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="price" name="price" value="<?php echo $house_price; ?>" required>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="desc" class="control-label">Description</label>
        <div class="col-sm-9 w-100">
          <textarea class="form-control" id="desc" name="description" value="<?php echo $house_description; ?>" required><?php echo $house_description; ?></textarea>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="newImage" class="control-label">House Image URL</label>
        <div class="col-sm-9 w-100">
          <input type="text" id="newImage" class="form-control" name="img" value="<?php echo $house_img; ?>" required>
        </div>
      </div>
      <div class="form-group my-3">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" name='edit' class="btn btn-warning">Edit House</button>
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