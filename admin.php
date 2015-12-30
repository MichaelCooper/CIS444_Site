<!DOCTYPE html>
<!--admin.php-->

<?php
session_start();


	if(!($_SESSION["account_type"] == "admin"))
	{
		?>
			<script type="text/javascript">
				alert("Please log in to an admin account first.");
				window.location.href = 'home.php';
			</script>
		<?php  echo("");
	}
?>
<html xmlns="http://www.w3.org/1999/xphp" lang="en">
	<head>
		<title>Admin</title>
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
					echo "<b>Hello ".$_SESSION['username']."   </b>";
					echo "<form action=\"admin.php\" method=\"post\">
						  <button class=\"header_button\" type=\"submit\">View Log</button>
						  <input type=\"hidden\" name=\"view_log\"></input>
						 </form>";
					echo "<button class=\"header_button\" type=\"submit\" onclick=\"location.href='logout.php'\">Logout</button>";
				?>
				<button class="header_button" type="submit" onclick="location.href='shopping_cart.php'">Shopping Cart</button>
			</div>
		</div>

		<div id="section">
			<ol class="breadcrumb">
				<li><a href="home.php">Home</a></li>
				<li><a href="admin.php">Admin Page</a></li>
			</ol>
	    </div>

      <div class="search_page_box_container">
				<form method = 'post' action="admin.php">
					<p>
						<input type = 'text' name = 'search_users' id = 'search_users' size = '15' value="Search Users" onfocus="if(this.value == 'Search Users') { this.value = ''; }"></input>
					</p>
					<p>
						<input type = 'submit' value = 'Search' class = 'button' />
					</p>
				</form>
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



	if ($_POST) 
	{
		
		//if statement checks for a submission of a search
		if (isset($_POST['search_users'])) 
		{
			if($_POST['search_users'] == '')
			{
				$sql = "SELECT * FROM Users;";
			}
			else
			{
				$search_users = $_POST['search_users'];
				$sql = "SELECT * FROM Users WHERE User_Name='$search_users'";
			}
			$result = $conn->query($sql);
			
			//only execute if the search returned something
			if ($result->num_rows > 0) 
			{
				echo "<div class=\"admin_search_results_container\">";
				echo "<table border= '1'><caption> <h2> Search Users </h2> </caption>";
				echo  "<tr align = 'center'>";
				echo "<th>User Id</th> <th>User Name</th> <th>User Email</th> <th>Delete User</th>  <th>Edit User Info</th></tr>";

				$result_row = mysqli_fetch_row($result);
				// output data of each row
				do
				{
					echo "<tr><td>". $result_row[0] . "</td>";
					echo "<td>" . $result_row[1] . "</td>";
					echo "<td>" . $result_row[3]  . "</td>";
					echo "<form method=\"post\" action=\"admin.php\" ><td> <input type='submit' name=\"delete_user\" class='edit_user_button' value=\"Delete\" /><input type='hidden' name=\"user_to_delete\" value=\"$result_row[1]\"/></td>";
					echo "<td> <input type='submit' name=\"edit_user\" class='edit_user_button' value=\"Edit\" /><input type='hidden' name=\"user_to_edit\" value=\"$result_row[1]\"/></td></form></tr>";
					$result_row = mysqli_fetch_row($result);
				}while($result_row);

				  echo "</table></div>";
			}
			else 
			{	//no user found in database, tell the admin
				echo"<script type=\"text/javascript\">alert(\"Sorry there are no users by that name.\");</script>";
			}
			
		}//endif post search

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
				$sql = "INSERT INTO Log (Comments, User_Name, Date_Time) VALUES ('Admin ".$_SESSION['username']." deleted user $user_to_delete', '".$_SESSION['username']."', now());";
				// Perform logging
				$result = mysqli_query($conn, $sql)
					Or die("<p>Unable to post log of deleting user</p>"
							 . "<p>Error code " .mysqli_connect_errno()
							 . ": " . mysqli_connect_error() . "</p>");
			}
			
			$conn->close();
			?>
			<script type="text/javascript">
				alert("User Deleted.");
				window.location.href = 'admin.php';
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
				echo "<table border= '1'><caption> <h2> Edit Users </h2> </caption>";
				echo  "<tr align = 'center'>";
				echo "<th>User Id</th> <th>User Name</th> <th>User Password</th> <th>User Email</th> <th>save</th></tr>";

				$result_row = mysqli_fetch_row($result);
				// output data of each row
				do
				{
					echo "<tr><form method=\"post\" action=\"admin.php\" ><td><input type=\"text\" name=\"user_id\" value=\"$result_row[0]\"/></td>";
					echo "<td><input type=\"text\" name=\"user_name\" value=\"$result_row[1]\"/></td>";
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
			$user_id = $_POST['user_id'];
			$user_name = $_POST['user_name'];
			$user_password = $_POST['user_password'];
			$user_email = $_POST['user_email'];
			$sql = "UPDATE Users SET User_Id='$user_id', User_Name='$user_name', User_Password='$user_password', User_Email='$user_email' WHERE User_Name='$user_to_save';";  

			$result = $conn->query($sql)
				Or die("<p>Unable to execute query.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");

			if($result)
			{
				$sql = "INSERT INTO Log (Comments, User_Name, Date_Time) VALUES ('Admin ".$_SESSION['username']." edited user $user_name', '".$_SESSION['username']."', now());";
						// Perform logging
						$result = mysqli_query($conn, $sql)
							Or die("<p>Unable to post log of deleting user</p>"
								 . "<p>Error code " .mysqli_connect_errno()
								 . ": " . mysqli_connect_error() . "</p>");
 			}	 

			echo"<script type=\"text/javascript\">	alert(\"User saved to database.\");window.location.href = 'admin.php';</script>";

		}//endif post save	
			
		if(isset($_POST['view_log']))
		{
			$sql = "SELECT * FROM Log;";  
			
			//echo"<script type=\"text/javascript\">	alert(\"$sql\");</script>";
			

			$result = $conn->query($sql)
				Or die("<p>Unable to execute query.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");


			if($result)
			{
				echo "<div class=\"admin_search_results_container\">";
				echo "<table border= '1'><caption> <h2> Log </h2> </caption>";
				echo  "<tr align = 'center'>";
				echo "<th>Log Id</th> <th>User Name</th> <th>Comment</th> <th>Date Time</th></tr>";
				$result_row = mysqli_fetch_row($result);
				do{
					echo "<tr><td>". $result_row[0] . "</td>";
					echo "<td>" . $result_row[2] . "</td>";
					echo "<td style=\"max-width:200px;\">" . $result_row[1]  . "</td>";
					echo "<td>" . $result_row[3]  . "</td></tr>";
					$result_row = mysqli_fetch_row($result);
				}while($result_row);
			}	 
		}//endif view log
	
		$conn->close();
	}
	?>
         
	</body>
</html>
