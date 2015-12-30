<!DOCTYPE html>
<!-- home.php
		First page on load
-->
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
		if($_POST)
		{
			if(isset($_POST['username']))
			{
				$username = $_POST['username'];
				$password = $_POST['password'];

				//query for adding the user
				$query = "SELECT * FROM Users WHERE User_Name ='$username' AND User_Password='$password'; ";

				// Perform Query
				$result = mysqli_query($DBConnect, $query)
					Or die("<p>Unable to execute query. user not logged in</p>"
						 . "<p>Error code " .mysqli_connect_errno()
						 . ": " . mysqli_connect_error() . "</p>");
				if($result->num_rows >0)
				{

					$query = "INSERT INTO Log (Comments, User_Name, Date_Time) VALUES ('User Login', '$username', now());";
						// Perform logging
						$result = mysqli_query($DBConnect, $query)
							Or die("<p>Unable to post user login to log.</p>"
								 . "<p>Error code " .mysqli_connect_errno()
								 . ": " . mysqli_connect_error() . "</p>");
								 

					$_SESSION["account_type"] = "user";
					$_SESSION['username'] = $username;
					mysqli_close($DBConnect);
					?>
					<script type="text/javascript">
						window.location.href = 'home.php';
					</script>
					<?php		echo("");		
				}
				else
				{
					$query = "SELECT * FROM Admin WHERE Admin_Name ='$username' AND Admin_Password='$password'; ";

					// Perform Query
					$result = mysqli_query($DBConnect, $query)
						Or die("<p>Unable to execute query. admin not logged in</p>"
							 . "<p>Error code " .mysqli_connect_errno()
							 . ": " . mysqli_connect_error() . "</p>");
			
					if($result->num_rows >0)
					{

						$query = "INSERT INTO Log (Comments, User_Name, Date_Time) VALUES ('Admin Login', '$username', now());";
						// Perform logging
						$result = mysqli_query($DBConnect, $query)
							Or die("<p>Unable to post admin login to log.</p>"
								 . "<p>Error code " .mysqli_connect_errno()
								 . ": " . mysqli_connect_error() . "</p>");


						$_SESSION["account_type"] = "admin";
						$_SESSION['username'] = $username;
						mysqli_close($DBConnect);	
						?>
						<script type="text/javascript">
							window.location.href = 'home.php';
						</script><?php		echo("");
					}
				}
			}
		}
		
		echo"<script type=\"text/javascript\">	alert(\"You must enter a valid username and password. Please try again, or create a new account.\");window.location.href = 'login.php';</script>";
	 mysqli_close($DBConnect);
?>