<?php
$page_title = "Delete a House";

require_once ('includes/header.php');
require_once('includes/database.php');

$error = '';

//retrieve user id from a querystring
$house_id = $_GET['id'];

if($isLoggedIn){

  $sql = "SELECT uid FROM $tblHouses WHERE hid = '$house_id'";
  $result = mysqli_query($conn,$sql);
  $house = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  $owner_id = $house['uid'];

  if($uid == $owner_id || $role == 1){

    //the delete statement
    $query_str = "DELETE FROM $tblHouses WHERE hid = '$house_id'";
    
    //execut the query
    $result = $conn->query($query_str);
    
    //Handle selection errors
    if (!$result) {
      $errno = $conn->errno;
      $errmsg = $conn->error;
      echo "Selection failed with: ($errno) $errmsg<br/>\n";
      $conn->close();
      exit;
    }
  }
}else{
  $error = "You can't Delete House. <br> Please Log In to Delete this House.";
}
?>

<div class="container wrapper text-center text-danger display-6 my-5">
  <?php if(!$error){ ?>
  <p>Your House Record has been Deleted. <br> Redirecting back to your houses.... </p>
  <?php }else{ echo $error; }?>
</div>

<?php
// close the connection.
$conn->close();
header( "Refresh:2; url=myhouses.php", true, 303);
include ('includes/footer.php');
?>

