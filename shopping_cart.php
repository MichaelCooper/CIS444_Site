<!DOCTYPE html>
<!-- shopping_cart.php

		User shopping cart contents displayed here.

		Version 2
		Validation Completed using Total Validator Basic & W3C Validation Service
		Validation Date: 10/25/2015

		Version 6
		Validation Completed using Total Validator Basic & W3C Validation Service
		Validation Date: 11/11/2015
-->
<?php
session_start();

	if(isset($_SESSION["account_type"]))
	{
		if($_SESSION["account_type"] == "Admin")
		{
			//call the php file that adds admin capabilities
		}
		else
		{
			//user is basic user
		}
	}
	else
	{
		$_SESSION["account_type"] = "temp";
	}
?>
<html xmlns="http://www.w3.org/1999/xphp" lang="en">

	<head>
		<title> Shopping Cart </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="stylesheet" type="text/css" href="shopping_cart_style.css" />
		<script type="text/javascript" src="login_script.js" ></script>
	</head>
	<body style="background-color: #6699FF">
	<div id="header">
			<div class="logo_holder">
				<img class="logo" src="logo.png" alt="Company Logo"/>
				<span class="company_name">gpuMELTDOWN</span>
			</div>
			<div class="button_holder">
				<?php
					if($_SESSION["account_type"] == "admin" || $_SESSION["account_type"] == "user")
					{
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
				<li><a href="shopping_cart.php">Shopping Cart</a></li>
			</ol>

			<div class="shopping_cart_container">
		        <div class="create_cart_container">

							<?php

							$servername = "localhost";
							$username = "groupb";
							$password = "d67G8PKE";
							$dbname = "groupb";

							$conn = new mysqli($servername, $username, $password, $dbname);

							if ($conn->connect_error) {
								die("Connection failed to server: " . $conn->connect_error);
							 }

							 $sql = "SELECT * FROM Games WHERE Game_Name IN (SELECT Cart_Game FROM Cart)";
							 $result = $conn->query($sql);

							 if ($result->num_rows > 0) {


			 			    // output data of each row
			 			    while($row = mysqli_fetch_array($result))
			 			      {

								echo"<div class=\"shopping_game_container\">";
								echo"<img class=\"game_image_cart\" src=" . $row['Game_Image'] . " alt=\"Game Picture\" />";
								echo"<div class=\"game_title\">";
								echo"<p style=\"font-size: 25px\">" . $row['Game_Name'] . "</p>";
								echo"</div>";

								echo"<div class=\"game_price_container\">";
								echo"<div class=\"game_cart_price\">";
								echo"<p class=\"game_price_p\">" . $row['Game_Price'] . "</p>";
								echo								"</div>";
								echo						"</div>";
								echo "<form method=\"post\" action=\"shopping_cart.php\" ><input type='submit' name=\"Delete_Cart_Game\" class='Cart_Game_Delete' value=\"Delete\" /><input type='hidden' name=\"game_to_delete\" value=\"$row[1]\"/></form>";
								echo		"</div>";

								$item_price =  $row['Game_Price'];
								@$subtotal_price = $subtotal_price + $item_price;

								  }

			 			  }
							else {
								echo "<h3> There is nothing in your cart! </h3>";
							}

							if(isset($_POST['Delete_Cart_Game']))
							{
								$game_to_delete = $_POST['game_to_delete'];
								$sql = "DELETE FROM Cart WHERE Cart_Game='$game_to_delete'";
								$result = $conn->query($sql)
									Or die("<p>Unable to execute query.</p>"
									 . "<p>Error code " .mysqli_connect_errno()
									 . ": " . mysqli_connect_error() . "</p>");

									 mysqli_close($conn);
?>
									 <script type="text/javascript">
									 	alert("Game Deleted.");
									 	window.location.href = 'shopping_cart.php';
									 </script>

<?php
							}
	?>
<?php
						echo "<div class =\"cart_subtotal_p\">";
            echo "<p> Subtotal: </p>";
						echo "</div>";

						@$subtotal_rounded = (round($subtotal_price, 2));

						echo "<div class=\"subtotal_container\">";
            echo "<div class=\"subtotal_cart_price\">";
            echo "<p class=\"subtotal_price_p\"> $subtotal_rounded </p>";
            echo "</div>";
            echo "</div>";

		?>


<div class = "billing_container_main_background">

							<div class = "billing_container_background">

                <div class="billing_container">

                    <p class="Payment_Method_header"> Payment Method </p>

                    <div class="Payment_method">

					 	<form class="" id="form1" action = "insert_payment_info.php" method="post" >


						  <label> Please Select a Payment Method: </label><br/>

								<select name="credit_card">
	  						<option name="credit_card" value="visa">Visa</option>
	  						<option name="credit_card" value="mastercard">MasterCard</option>
	  						<option name="credit_card" value="americanExpress">American Express</option>
								</select>

						  <br/><br/>
                          <br/><br/>
						  <label> Card Number: </label><br/>
							<input type="text" name ="card_number" id="card_number" size="30" />
						  <br/><br/>
                          <br/><br/>
						  <label> Expiration Month: </label><br/>
								<select name="Expir_Month" size="1" class="expiration">
								<option name="Expir_Month" value="1">01</option>
								<option name="Expir_Month" value="2">02</option>
								<option name="Expir_Month" value="3">03</option>
								<option name="Expir_Month" value="4">04</option>
								<option name="Expir_Month" value="5">05</option>
								<option name="Expir_Month" value="6">06</option>
								<option name="Expir_Month" value="7">07</option>
								<option name="Expir_Month" value="8">08</option>
								<option name="Expir_Month" value="9">09</option>
								<option name="Expir_Month" value="10">10</option>
								<option name="Expir_Month" value="11">11</option>
								<option name="Expir_Month" value="12">12</option>
								</select>
						  <p>
						  <label> Expiration Year: </label><br/>
								<select name="Expir_Year" size="1" class="expiration">
								<option name="Expir_Year" value="2026">2026</option>
								<option name="Expir_Year" value="2025">2025</option>
								<option name="Expir_Year" value="2024">2024</option>
								<option name="Expir_Year" value="2023">2023</option>
								<option name="Expir_Year" value="2022">2022</option>
								<option name="Expir_Year" value="2021">2021</option>
								<option name="Expir_Year" value="2020">2020</option>
								<option name="Expir_Year" value="2019">2019</option>
								<option name="Expir_Year" value="2018">2018</option>
								<option name="Expir_Year" value="2017">2017</option>
								<option name="Expir_Year" value="2016">2016</option>
								<option name="Expir_Year" value="2015">2015</option>
								</select>
						  <br/><br/>
                          <br/><br/>
						  <label> Security Code: </label><br/>
							<input type="password" name="card_code" id="card_code"  size="6" />
						  <br/><br/>
					</div>

					<p class="Billing_Information_header"> Billing Information </p>

					<div class="Billing_Information">

					<label> First Name: </label><br/>
					<input type="text" name="FirstName" id="FirstName" size="20" />
					<br/><br/>
					<label> Last Name: </label><br/>
					<input type="text" name="LastName" id="LastName" size="20" />
					<br/><br/>
					<label> Billing Address: </label><br/>
					<input type="text" name="Billing_Address" id="Billing_Address" size="30" />
					<br/><br/>
					<label> Billing Address Line 2: </label><br/>
					<input type="text" name="Billing_Address2" id="Billing_Address2"  size="30" />
					<br/><br/>
					<label> City: </label><br/>
					<input type="text" name="City" id="City" size="10" />
								 <br/><br/>
								<label> State: <br/>
					<input type="text" name="State" id="State" size="10" />
					</label>
									<br/><br/>
								<label> Zip Code: </label><br/>
					<input type="text" name="ZipCode" id="ZipCode" size="10" />
					<br/><br/>

					</div>

<input class="Submit_Payment_Button" type="submit" value="Submit Payment Info">




                <p class="cart_total_p"> Total: </p>
<?php
                echo"<div class=\"total_container\">";
                        echo"<div class=\"total_cart_price\">";
													@$total_price = $subtotal_price * 1.08;
													$total_rounded = (round($total_price, 2));
                            echo"<p class=\"total_price_p\"> $total_rounded </p>";
														echo"<input type=\"hidden\" name=\"DB_Total_Price\" id=\"DB_Total_Price\" value=\"$total_rounded\" />";
                        echo"</div>";
                echo"</div>";
?>
</form>
									</div>
								</div>
							</div>
						</div>

                </div>

	    </div>


	</body>
</html>
