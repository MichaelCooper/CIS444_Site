<!DOCTYPE html>
<!-- game.php
		Game Page

		Version 18
		Validation Completed using Total Validator Basic & W3C Validation Service
		Validation Date: 10/25/2015
-->
<?php
	session_start(); 
	
	if(!isset($_SESSION["account_type"]))
	{
		$_SESSION["account_type"] = "temp";
	}

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
		
		if(isset($_POST['game_to_comment']))
		{
			$game = $_POST['game_to_comment'];
			$comment = addslashes($_POST['comment']);

			//query for the game
			$query = "INSERT INTO Comments (Game_Name, Comment)  VALUES ('$game', '$comment');";

			//echo "$query";

			// Perform Query
			$result = mysqli_query($DBConnect, $query)
				Or die("<p>Unable to execute query.</p>"
					 . "<p>Error code " .mysqli_connect_errno()
					 . ": " . mysqli_connect_error() . "</p>");
			if($result)
			{

				$query = "INSERT INTO Log (Comments, User_Name, Date_Time) VALUES ('Comment $comment added to $game by  ".$_SESSION['username']."', '".$_SESSION['username']."', now());";
				//echo"<script type=\"text/javascript\">	alert(\"$query\");</script>";
				// Perform logging
				$result = mysqli_query($DBConnect, $query)
					Or die("<p>Unable to post admin login to log.</p>"
						 . "<p>Error code " .mysqli_connect_errno()
						 . ": " . mysqli_connect_error() . "</p>");
			}
		}
	
	

		if (isset($_POST['game'])) 
		{ 
			$game = $_POST['game'];
			$query = "INSERT INTO Cart (Cart_Game) VALUES('$game');";

			//echo "$query";

			// Perform Query
			mysqli_query($DBConnect, $query)
				Or die("<p>Unable to execute query.</p>"
					 . "<p>Error code " .mysqli_connect_errno()
					 . ": " . mysqli_connect_error() . "</p>");
			if($result)
			{

				$query = "INSERT INTO Log (Comments, User_Name, Date_Time) VALUES ('Game $game added to cart by ".$_SESSION['username']."', '".$_SESSION['username']."', now());";
				//echo"<script type=\"text/javascript\">	alert(\"$query\");</script>";
				// Perform logging
				$result = mysqli_query($DBConnect, $query)
					Or die("<p>Unable to post admin login to log.</p>"
						 . "<p>Error code " .mysqli_connect_errno()
						 . ": " . mysqli_connect_error() . "</p>");
			}
		} 	
	}
	else 
	{
		$game = $_GET['game'];
	}

	//query for the game
	$query = "SELECT * FROM Games WHERE Game_Name='$game';";

	// Perform Query
	$result = mysqli_query($DBConnect, $query)
		Or die("<p>Unable to execute query.</p>"
			 . "<p>Error code " .mysqli_connect_errno()
			 . ": " . mysqli_connect_error() . "</p>");
	
	$result_row = mysqli_fetch_row($result);

	//Add query for comments based on the game and if num_rows > 0
	//query for comments
	$query = "SELECT * FROM Comments WHERE Game_Name='$game';";

	// Perform Query
	$result = mysqli_query($DBConnect, $query)
		Or die("<p>Unable to execute query.</p>"
			 . "<p>Error code " .mysqli_connect_errno()
			 . ": " . mysqli_connect_error() . "</p>");

	$comment_rows = mysqli_fetch_row($result);

	
	mysqli_close($DBConnect);

	
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title> Game </title>
		<meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="stylesheet" type="text/css" href="game_style.css"/>
		<script type="text/javascript" src="game_script.js" ></script>
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
				<li><a href="game.php"><?php echo"$game" ?></a></li>
			</ol>
			<div class="nav_bar">		
			  <?php 
			  	include 'nav_bar.php';
			  ?>
			</div>
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
			<div class="highlighted_game_container">
			 <?php 
						echo"<img src=\"{$result_row[3]}\" class=\"focused_game_image\" alt=\"Game Picture\" name=\"{$result_row[1]}\" id=\"{$result_row[1]}\" />";
			?>
			</div>
			<div class="game_info"> 
				<div class="game_info_container">
					<?php
						//add the game info from the server
						echo"<blockquote><p>$result_row[4]</p></blockquote>";
						
						//print price
						if($result_row[5])
						{						
							echo"<b>Price: $result_row[5]</b>";							
						}//endif
					?>
					<form method="post" action=" <?php echo $_SERVER['PHP_SELF']; ?>">
						<button class="add_to_cart" type="submit" name="submit_to_cart">Add to Cart</button>
						<input type="hidden" name="game" value="<?php echo $result_row[1]; ?>"></input>
					</form>
				</div>
			</div>

				<?php 
					if($result->num_rows > 0)
					{
					do{
						echo"<div class=\"comment_div\">"; 
						echo"<div class=\"comment_container\">";
						echo"<blockquote><p>$comment_rows[2]</p><blockquote>";
					    $comment_rows = mysqli_fetch_row($result);
					    echo"</div></div>";
					  }while($comment_rows);
					  }
					
				?>

			<div class="new_comment_box"> 
				<form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<input type="text" name="comment" value="Enter your comment here" class="new_comment_text_box" <?php echo"onfocus=\"if(this.value == 'Enter your comment here') { this.value = ''; }\"";?>></input>
					<input type="hidden" name="game_to_comment" value="<?php echo $result_row[1]; ?>"></input>
					<button class="reply_button" type="submit" value="Submit">Reply</button>
				</form>
			</div>
		</div>
	</body>
</html> 