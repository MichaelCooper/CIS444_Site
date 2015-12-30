<!DOCTYPE html>
<!--edit_user.php-->

<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xphp" lang="en">
	<head>
		<title>Edit User</title>
		<meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="stylesheet" type="text/css" href="search_results_style.css" />
    </head>

	<body>
        <div id="header">
			<div class="logo_holder">
				<img class="logo" src="logo.png" alt="Company Logo"/>
				<span class="company_name">gpuMELTDOWN</span>
			</div>
			<div class="button_holder">
				<?php
						if($_SESSION["account_type"] == "admin" || $_SESSION["account_type"] == "user")
						{
							echo "<b>Hello ".$_SESSION['username']."   </b>";
							echo "<button class=\"header_button\" type=\"submit\" onclick=\"location.href='logout.php'\">Logout</button>";
						}
						else
						{
							echo "<button class=\"header_button\" type=\"submit\" onclick=\"location.href='login.php'\">Login</button>";
						}
				?>
				<button class="header_button" type="submit" onclick="location.href='shopping_cart.php'">Shopping Cart</button>
			</div>
		</div>

		<div id="section">
			<ol class="breadcrumb">
				<li><a href="home.php">Home</a></li>
				<li><a href="edit_user.php">Edit My Account</a></li>
			</ol>
	    </div>
	<?php

	$servername = "localhost";
	$username = "groupb";
	$password = "d67G8PKE";
	$dbname = "groupb";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed to server: " . $conn->connect_error);
	 }

		//If post for delete user, delete from database
		if(isset($_POST['delete_user']))
		{
			$user_to_delete = $_POST['user_to_delete'];
			$sql = "DELETE FROM Users WHERE User_Name='$user_to_delete'";
			$result = $conn->query($sql)
				Or die("<p>Unable to execute query.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");

			if($result)
			{
				$sql = "INSERT INTO Log (Comments, User_Name, Date_Time) VALUES ('User $user_to_delete deleted their account', '$user_to_delete', now());";
						// Perform logging
						$result = mysqli_query($conn, $sql)
							Or die("<p>Unable to post log of deleting user</p>"
								 . "<p>Error code " .mysqli_connect_errno()
								 . ": " . mysqli_connect_error() . "</p>");
 			}
			
			$conn->close();
			?>
			<script type="text/javascript">
				alert("Your account was deleted.");
				window.location.href = 'home.php';
			</script>
			<?php  echo("");

		}//endif post delete

		//if post to edit user, show edit functionality
		if(isset($_POST['edit_user']))
		{
			$user_to_edit = $_POST['user_to_edit'];
			$sql = "SELECT * FROM Users WHERE User_Name='$user_to_edit'";
			$result = $conn->query($sql)
				Or die("<p>Unable to execute query.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");
			
			//only execute if the search returned something
			if ($result->num_rows > 0) 
			{
				echo "<div class=\"admin_search_results_container\">";
				echo "<table border= '1'><caption> <h2> Users </h2> </caption>";
				echo  "<tr align = 'center'>";
				echo "<th>User Password</th> <th>User Email</th> <th>save</th></tr>";

				$result_row = mysqli_fetch_row($result);
				// output data of each row
				do
				{
					echo "<tr><form method=\"post\" action=\"edit_user.php\" >";
					echo "<td><input type=\"text\" name=\"user_password\" value=\"$result_row[2]\"/></td>";
					echo "<td><input type=\"text\" name=\"user_email\" value=\"$result_row[3]\"/></td>";
					echo "<td> <input type='submit' name=\"save_user\" class='edit_user_button' value=\"Save\" /><input type='hidden' name=\"user_to_save\" value=\"$user_to_edit\"/></td></form></tr>";
					$result_row = mysqli_fetch_row($result);
				}while($result_row);

				  echo "</table></div>";
			}
		}//endif post edit

		if(isset($_POST['save_user']))
		{
			$user_to_save = $_POST['user_to_save'];
			$user_password = $_POST['user_password'];
			$user_email = $_POST['user_email'];
			$sql = "UPDATE Users SET User_Password='$user_password', User_Email='$user_email' WHERE User_Name='$user_to_save';"; 
			
			//echo"<script type=\"text/javascript\">	alert(\"$sql\");</script>";
			

			$result = $conn->query($sql)
				Or die("<p>Unable to execute query.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");

			if($result)
			{
				$sql = "INSERT INTO Log (Comments, User_Name, Date_Time) VALUES ('User $user_to_save edited their information', '$user_to_save', now());";
						// Perform logging
						$result = mysqli_query($conn, $sql)
							Or die("<p>Unable to post log of deleting user</p>"
								 . "<p>Error code " .mysqli_connect_errno()
								 . ": " . mysqli_connect_error() . "</p>");
 			}		 

			echo"<script type=\"text/javascript\">	alert(\"Information updated.\");window.location.href = 'home.php';</script>";

		}//endif post save

		//if statement checks for a any other posts, otherwise displays default edit page
		if (!(isset($_POST['save_user'])||(isset($_POST['edit_user']))||(isset($_POST['delete_user']))))
		{
			
			$my_username = $_SESSION['username'];
			$sql = "SELECT * FROM Users WHERE User_Name='$my_username'";
			
			$result = $conn->query($sql);
			
			//only execute if the search returned something
			if ($result->num_rows > 0) 
			{
				echo "<div class=\"admin_search_results_container\">";
				echo "<table border= '1'><caption> <h2> Users </h2> </caption>";
				echo  "<tr align = 'center'>";
				echo "<th>My Id</th> <th>My Name</th> <th>My Email</th> <th>Delete Account</th>  <th>Edit My Info</th></tr>";

				$result_row = mysqli_fetch_row($result);
				// output data of each row
				do
				{
					echo "<tr><td>". $result_row[0] . "</td>";
					echo "<td>" . $result_row[1] . "</td>";
					echo "<td>" . $result_row[3]  . "</td>";
					echo "<form method=\"post\" action=\"edit_user.php\" ><td> <input type='submit' name=\"delete_user\" class='edit_user_button' value=\"Delete\" /><input type='hidden' name=\"user_to_delete\" value=\"$result_row[1]\"/></td>";
					echo "<td> <input type='submit' name=\"edit_user\" class='edit_user_button' value=\"Edit\" /><input type='hidden' name=\"user_to_edit\" value=\"$result_row[1]\"/></td></form></tr>";
					$result_row = mysqli_fetch_row($result);
				}while($result_row);

				  echo "</table></div>";
			}
			else 
			{	//no user found in database, tell the user
				echo"<script type=\"text/javascript\">alert(\"Sorry, an error occured\"); window.location.href=\"404.php\"</script>";
			}
			
			
		}//endif find user data	
			
		  $conn->close();
		?>    
	</body>
</html>
