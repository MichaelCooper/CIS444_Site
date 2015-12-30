<!DOCTYPE html>
<!--search_results.php

		Version 3
		Validation Completed using Total Validator Basic & W3C Validation Service
		Validation Date: 10/26/2015
-->

<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xphp" lang="en">
	<head>
		<title>Search Results</title>
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
						if($_SESSION["account_type"] == "admin")
						{
							echo "<button class=\"header_button\" type=\"submit\" onclick=\"location.href='admin.php'\">Admin</button>";
						}
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
				<li><a href="search_results.php">Search Results</a></li>
			</ol>
	    </div>

      <div class="search_page_box_container">
				<form method = 'post' action="search_results.php">
					<p>
						<input type = 'text' name = 'SearchGenre' id = 'SearchGenre' size = '15' value="Search by Genre" onfocus="if(this.value == 'Search by Genre') { this.value = ''; }"></input>
					</p>
					<p>
						<input type = 'submit' value = 'Search' class = 'button' />
					</p>
				</form>
        </div>


<div class="search_results_container">

	<?php

	$servername = "localhost";
	$username = "groupb";
	$password = "d67G8PKE";
	$dbname = "groupb";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed to server: " . $conn->connect_error);
	 }

@$genre = $_GET['genre'];

@$SearchGenre = $_POST['SearchGenre'];

if (isset($genre)) {
if (isset($SearchGenre)) {
	//do nothing if there has been a search placed
}
else {
if($genre != null) {
	$sql = "SELECT * FROM Games WHERE Game_Genre='$genre'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo "<table border= '1'><caption> <h2> Games </h2> </caption>";
		echo  "<tr align = 'center'>";
		echo "<th>Game Id</th> <th>Game Name</th> <th>Game Genre</th> <th>Game Image</th> <th>Game Description</th>
	<th>Game Price</th> </tr>";

		// output data of each row
		while($row = mysqli_fetch_array($result))
			{
	echo "<tr><td>" . $row['Game_Id'] . "</td>";
	echo "<td>" . $row['Game_Name'] . "</td>";
	echo "<td>" . $row['Game_Genre'] . "</td>";
	echo "<td> <img src = " . $row['Game_Image'] . " /> </td>";
	echo "<td>" . $row['Game_Description'] . "</td>";
	echo "<td>" . $row['Game_Price'] . "</td>";
			}
		echo "</table>";
	}
	else {echo "<h3> Sorry there are no games with that genre. </h3>";}
}
}
}
	//if statement checks for a submission of a search
			 if (isset($SearchGenre)) {


			  $sql = "SELECT * FROM Games WHERE Game_Genre='$SearchGenre'";
			  $result = $conn->query($sql);

			  if ($result->num_rows > 0) {
			    echo "<table border= '1'><caption> <h2> Games </h2> </caption>";
			    echo  "<tr align = 'center'>";
					echo "<th>Game Id</th> <th>Game Name</th> <th>Game Genre</th> <th>Game Image</th> <th>Game Description</th>
				<th>Game Price</th> <th>Select</th></tr>";

			    // output data of each row
			    while($row = mysqli_fetch_array($result))
			      {
				echo "<tr><td>" . $row['Game_Id'] . "</td>";
				echo "<td>" . $row['Game_Name'] . "</td>";
				echo "<td>" . $row['Game_Genre'] . "</td>";
				echo "<td> <img src = " . $row['Game_Image'] . "/></td>";
				echo "<td>" . $row['Game_Description'] . "</td>";
				echo "<td>" . $row['Game_Price'] . "</td>";
			
			      }
			    echo "</table>";
			  }
			  else {
			    die("Sorry there are no games with that genre.");
			  }

			  $conn->close();
			 }


			?>


        </div>

	</body>
</html>
