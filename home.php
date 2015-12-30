<!DOCTYPE html>
<!-- home.php
		First page on load
-->
<?php 
	session_start(); 
	
	if(!isset($_SESSION['cart']))
	{
		$shop_array= array();
		$_SESSION['cart'] = $shop_array;
	}
?>

<?php
		$host = "localhost";
		$username = "groupb";
		$password = "d67G8PKE";
		$database = "groupb";
			
		$DBConnect = @mysqli_connect($host, $username, $password, $database)
			Or die("<p>The Database server was not availble.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");


		if(!isset($_SESSION["account_type"]))
		{
			$_SESSION["account_type"] = "temp";
			echo "Logged in as temp";
		}


		$query = "SELECT * FROM Games";

		// Perform Query
		$result = mysqli_query($DBConnect, $query)
			Or die("<p>Unable to execute query.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");
	
		
		$result_row = mysqli_fetch_row($result);	
		$keys = array_keys($result_row);

		mysqli_close($DBConnect);			
?>


<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title> Home </title>
		<meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="stylesheet" type="text/css" href="home_style.css"/>
		
	</head>
	
	<body class="body">
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
					if($_SESSION["account_type"] == "user")
					{
						echo "<button class=\"header_button\" type=\"submit\" onclick=\"location.href='edit_user.php'\">Edit My Account</button>";
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
			<div class="search_box_container">
				<form method = 'post' action="search_results.php">
					<p>
						<input type = 'text' name = 'SearchGenre' id = 'SearchGenre' size = '15' value="Search by Genre" onfocus="if(this.value == 'Search by Genre') { this.value = ''; }"></input>
					</p>
					<p>
						<input type = 'submit' value = 'Search' class = 'button' />
					</p>
				</form>
			</div>
			<div class="nav_bar">		
			  <?php 
			  	include 'nav_bar.php';
			  ?>
			</div>
			<div class="highlighted_game_container" id="highlighted_game_container">
				<?php 
						echo"<img src=\"{$result_row[3]}\" class=\"focused_game_image\" alt=\"Game Picture\" name=\"{$result_row[1]}\" id=\"{$result_row[1]}\" onclick=\"location.href='game.php?game={$result_row[1]}'\" />";
					    $result_row = mysqli_fetch_row($result);
				?>
			</div>
			<div class="list_of_games_container" id="list_of_games_container">
				<?php 
					do{
						echo"<img src=\"{$result_row[3]}\" class=\"game_image\" alt=\"Game Picture\" name=\"{$result_row[1]}\" id=\"{$result_row[1]}\" onclick=\"location.href='game.php?game={$result_row[1]}'\" />";
					    $result_row = mysqli_fetch_row($result);
					  }while($result_row);
				?>
			</div>
			
		</div>
		
	</body>
</html>
