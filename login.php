<!DOCTYPE html>
<!--login.php-->
<?php
 session_start();

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title> Login </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="stylesheet" type="text/css" href="login_style.css"/>
		<script type="text/javascript" src="login_script.js" ></script>
	</head>
	<body>
	<div id="header">
			<div class="logo_holder">
				<img class="logo" src="logo.png" alt="Company Logo"/>
				<span class="company_name">gpuMELTDOWN</span>
			</div>
			<div class="button_holder">
				<button class="header_button" type="submit" onclick="location.href='shopping_cart.php'">Shopping Cart</button>	
			</div>
		</div>
		<div id="section">
			<ol class="breadcrumb">
				<li><a href="home.php">Home</a></li>
				<li><a href="login.php">Login</a></li>
			</ol>
			<div class="login_container">
				<div class="login_form_container">
					<div class="login_label"> Login </div>
					 <div class="login_form">
					 	<form class="" action = "validate_user.php" method="post">
						  <label> User Name: <br/>
							<input type= "text" id="username" name="username" size="30" onfocusout=""/>
						  </label>
						  <br/><br/>
						  <label> Password: <br/>
							<input type = "password" id="password" name="password"  size="30" />
						  </label>
						  <br/><br/>
						  <input class="login_button" type="submit" value="Login"/>						  
						</form>
					</div>
				</div>
				<div class="join_cotainer">
					<div class="login_label"> Create User Login </div>
						<p class="create_user_text">
							Create a new free <br/>
							account by clicking<br/>
							the "Join" button<br/>
							below:
						</p>
						<input type="button" class="join_button" value="Join" onclick="location.href='registration.php'" />
				</div>
			</div>
		</div>
	</body>
</html>