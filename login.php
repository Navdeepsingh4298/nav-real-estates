<?php
$page_title = "Log In";

//include the header
require_once('includes/header.php');
//include the code from database.php
require_once('includes/database.php');

$emailorphone = $password = '';

//0 - By Default
//1 - Login Successfully
//2 - Login Failure
$login_status = 0;

// If User is not logged in then show login page
if(!$isLoggedIn){

	if(isset($_POST['login'])){

		$emailorphone = mysqli_real_escape_string($conn,trim($_POST['emailorphone']));
    $password = mysqli_real_escape_string($conn,trim($_POST['password']));
		
		// If user Entered email to login
		if (filter_var($emailorphone, FILTER_VALIDATE_EMAIL)) {
			//The SQL select statement
			$query_stry = "SELECT * FROM $tblUsers WHERE email='$emailorphone' AND password='$password'";
			
			//Execute the query
			$result = mysqli_query($conn,$query_stry);
			
			$result_row = mysqli_fetch_assoc($result);
			
			if($result -> num_rows){
				//It is a valid user. Need to store the user in Session Variables
        
        $_SESSION['role'] = $result_row['role'];
				$_SESSION['name'] = $result_row['name'];
        $_SESSION['uid'] = $result_row['uid'];
				$_SESSION['isLoggedIn'] = true;
        //update the login status to success
        $login_status = 1;
				$isLoggedIn = true;
        
			}else if($result -> num_rows == 0) {
				// Either User Credentials are wrong or User not found in Database
				// if we want to know exactly whether user not found or credentials are wrong then we need to alter the query accordingly.(SELECT * FROM $tblUsers WHERE name='$username')
        $login_status = 2;
			}
		}
		// If User entered phone number to login
		else{
			//The SQL select statement
			$query_stry = "SELECT * FROM $tblUsers WHERE phone='$emailorphone' AND password='$password'";
			
			//Execute the query
			$result = mysqli_query($conn,$query_stry);
			
			$result_row = mysqli_fetch_assoc($result);
			
			if($result -> num_rows){
				//It is a valid user. Need to store the user in Session Variables
        
        $_SESSION['role'] = $result_row['role'];
        $_SESSION['uid'] = $result_row['uid'];
				$_SESSION['isLoggedIn'] = true;
        //update the login status to success
        $login_status = 1;
				$isLoggedIn = true;
        
			}else if($result -> num_rows == 0) {
				// Either User Credentials are wrong or User not found in Database
				// if we want to know exactly whether user not found or credentials are wrong then we need to alter the query accordingly.(SELECT * FROM $tblUsers WHERE name='$username')
        $login_status = 2;
			}
		}
		
		$conn->close();
	}

} else{
		// If user already logged in then redirect to dashboard page
		header("Location:dashboard.php");
	}  
	
?>

<div class="container wrapper my-5 d-flex align-items-center flex-column justify-content-center">

	<!-- User not logged in yet -->
	<?php if ($login_status == 0 && !$isLoggedIn) { ?>
	<h1 class="text-center my-2">LOG IN</h1>
	<p class="lead text-center">Please login to your account</p>

	<div class="col-xs-6 col-xs-offset-2 col-md-6">

		<!-- Login Form -->
		<form class="form-horizontal my-5 mb-5" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group my-3">
						<label for="emailorphone" class="col-sm-2 control-label w-100">Email or Phone</label>
						<div class="col-sm-10 w-100">
								<input type="text" class="form-control" id="emailorphone" name="emailorphone" value="<?php echo $emailorphone; ?>" placeholder="Enter Email od Phone" required>
						</div>
				</div>
				<div class="form-group my-3">
						<label for="password" class="col-sm-2 control-label w-100">Password</label>
						<div class="col-sm-10 w-100">
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
						</div>
				</div>
				<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" name='login' class="btn btn-warning">LOG IN</button>
						</div>
				</div>
		</form>
		<!-- End of log in form -->

		<!-- User Logged in Successfully -->
		<?php } else if($login_status == 1 && $isLoggedIn){ ?>
		<div class="container-fluid text-center my-5">
				<p class='lead display-5'>You are logging in, Please Wait. <br>	Redirecting To Dashboard....
			</p>
				<?php header( "Refresh:3; url=dashboard.php", true, 303);?>
		</div>

		<!-- User Credentials are wrong or User not found in Database -->
		<?php }else if($login_status == 2 && !$isLoggedIn){ ?>
		<div class="container text-center my-5">
				<p class='lead text-danger display-5'>You Entered Wrong Credentials.<br> Or</p>
				<p class='lead text-danger display-5'>No Such User was found. Try Again later.</p>
				<?php header( "Refresh:3; url=login.php", true, 303);?>
		</div>
		<?php } ?>
		<!-- End of login if else ladder -->


	</div>
</div>



<?php
// included footer at the end of the page
	include_once('includes/footer.php');
?>
