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
				$email = $_POST['email'];

				//query for adding the user
				$query = "SELECT * FROM Users WHERE User_Name ='$username' OR User_Email='$email'; ";
				echo("$query");
				// Perform Query
				$result = mysqli_query($DBConnect, $query)
					Or die("<p>Unable to execute query.</p>"
						 . "<p>Error code " .mysqli_connect_errno()
						 . ": " . mysqli_connect_error() . "</p>");
				if($result->num_rows >0)
				{
					mysqli_close($DBConnect);
					exit("<p>User already in database.\nPlease use your browser's back button and try again.</p>");		
				}
				else
				{
					$query = "INSERT INTO Users (User_Name, User_Password, User_Email) VALUES ('$username', '$password', '$email');";

					echo("<p>$query</p>");
				}
							// Perform Query
					$result = mysqli_query($DBConnect, $query)
						Or die("<p>Unable to execute query.</p>"
							 . "<p>Error code " .mysqli_connect_errno()
							 . ": " . mysqli_connect_error() . "</p>");
							 echo("$result");
					$_SESSION["account_type"] = "user";
					$_SESSION["username"] = $username;
					mysqli_close($DBConnect);
					?> 
						<script type="text/javascript">
							window.location.href = 'home.php';
						</script>
					<?php  echo("");
				}
				else
				{
					mysqli_close($DBConnect);
					exit ("<p>You must enter a valid username and password.\nPlease use your browser's back button and try again.</p>");
				}


			}
			else
			{
				mysqli_close($DBConnect);
				exit ("<p>You must enter a valid username and password.\nPlease use your browser's back button and try again.</p>");
			}
			
?>