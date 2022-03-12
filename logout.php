<?php
$page_title = "Log Out";

include('includes/header.php');

// 0 - By Default (false)
// 1 - Confirm Log Out (true)

$logout_status = 0;

if(isset($_POST['logout'])){
    
    //destroy the session data on disk
    session_destroy();

    //delete the session cookie
    setcookie(session_name(), '', time()-3600);

    //destroy the $_SESSION array
    $_SESSION = array();

    // delete the session
    session_unset();
    
    $isLoggedIn = false;
    $logout_status = 1;

    header( "Refresh:2; url=index.php", true, 303);
}

?>

<div class="container wrapper my-5 text-center">
    
    <h1 class="text-center my-2">LOG OUT</h1>
    <?php if($logout_status == 1){ ?>
        <p class="lead text-center text-danger display-4 my-5">You are now logging out.</p>
    <?php } else{ ?>
        <p class="lead text-center text-danger display-5 my-5">Are you sure, you wanna Log Out?</p>
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <button name="logout" class="btn btn-lg btn-danger">LOG OUT</button>
            <a href="dashboard.php" class="btn btn-lg btn-warning">Cancel</a>
        </form>
    <?php } ?>

</div>

<?php
include('includes/footer.php'); 

?>

