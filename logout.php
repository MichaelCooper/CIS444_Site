<!DOCTYPE html>
<!--logout.php-->
<?php  
	session_start(); 


		$host = "localhost";
		$username = "groupb";
		$password = "d67G8PKE";
		$database = "groupb";
			
		$DBConnect = @mysqli_connect($host, $username, $password, $database)
			Or die("<p>The Database server was not availble.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");

		$query = "DELETE FROM Cart WHERE Cart_Id > 0; ";

		// Perform cleanup
		$result = mysqli_query($DBConnect, $query)
			Or die("<p>Unable to execute query. Cart not emptied</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");

		$query = "INSERT INTO Log (Comments, User_Name, Date_Time) VALUES ('User/Admin Logout', '".$_SESSION['username']."', now());";
		// Perform Query
		$result = mysqli_query($DBConnect, $query)
			Or die("<p>Unable to execute query. User logout not added to log.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");

	session_destroy();  
	header("Location: home.php");
?>