<!DOCTYPE html>
<!-- 404.php
		Web page indicating a broken or dead link.

		Version 8
		Validation Completed using Total Validator Basic & W3C Validation Service
		Validation Date: 10/25/2015
-->
<?php
 session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title> 404 </title>
		<meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="stylesheet" type="text/css" href="404_style.css"/>
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
							echo "<button class=\"header_button\" type=\"submit\" onclick=\"\">Admin</button>";
						}
						echo "<button class=\"header_button\" type=\"submit\" onclick=\"location.href='logout.php'\">Logout</button>";
					}
					else
					{
						echo "<button class=\"header_button\" type=\"submit\" onclick=\"location.href='login.php'\">Login</button>";
					}
				?>
				<button class="header_button" type="submit" onclick="location.href='login.php'">Login</button>
				<button class="header_button" type="submit" onclick="location.href='shopping_cart.php'">Shopping Cart</button>
			</div>
		</div>
		<div id="section">
			<div class="nav_bar">		
			  <?php 
			  	include 'nav_bar.php';
			  ?>
			</div>
			<div class="error_image"><img src="404.jpg" alt="Error 404 - Not Found"/></div>
			
		</div>
	</body>
</html>