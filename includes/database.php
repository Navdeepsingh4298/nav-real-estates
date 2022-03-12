<?php
	//define parameters
	$hostname = "localhost";
	$port;
	$username = "real_estate_admin";
	$password = "admin12345";
	$database = "real_estate_db";
	$tblUsers = "users";
	$tblHouses = "houses";
  
	//Connect to the mysql server
	$conn = mysqli_connect($hostname, $username, $password, $database);

	//Handle connection errors 
	if (mysqli_connect_errno() != 0) {
		$errno = mysqli_connect_errno();
		$errmsg = mysqli_connect_error();
		die("Connect Failed with: ($errno) $errmsg<br/>\n");
	}
?>

