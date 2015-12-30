<!DOCTYPE html>
<!-- registration.html -->

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title> Registration </title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="stylesheet" type="text/css" href="registration_style.css"/>
		<script type="text/javascript" src="registration_script.js" >
</script>
	</head>
	<body>
	<div id="header">
			<div class="logo_holder">
				<image class="logo" src="logo.png" alt="Company Logo"></image>
				<span class="company_name" type="text">gpuMELTDOWN</span>
			</div>
			<div class="button_holder">
				<button class="header_button" type="submit" onclick="location.href='shopping_cart.php'">Shopping Cart</button>
			</div>
		</div>
		<div id="section">
			<ol class="breadcrumb">
				<li><a href="home.php">Home</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="registration.php">Create User Account</a></li>
			</ol>
			<div class="registartion_container">
				<div class="create_account_container">
					<div class="login_label"> Create Account </div>
					 <div class="create_account_form">
					 	<form class="" action = "new_user.php" method="post">
						  <label> Create an Account Name: <br/>
							<input type= "text" id="username" name="username" size="30"/>
						  </label>
						  <br/><br/>
						  <label> Enter Email Address: <br/>
							<input type="eamil" id="email" name="email" size="30" />
						  </label>
						  <br/><br/>
						  <label> Re-Enter Email Address: <br/>
							<input type="email" id="email_check" onfocusout="checkEmails()" size="30" />
						  </label>
						  <br/><br/>
						  <label> Password: <br/>
							<input type="password" id="password" name="password" size="30" />
						  </label>
						  <br/><br/>
						  <label> Re-Enter Password: <br/>
							<input type="password" id="password_check" onfocusout="checkPasswords()" size="30" />
						  </label>
						  <br/><br/>
                            <input class="create_account_button" type="submit" value="Create Account"/>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
