<?php
$servername = "localhost";
$username = "groupb";
$password = "d67G8PKE";
$dbname = "groupb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed to server: " . $conn->connect_error);
 }

// Escape user inputs for security
$FirstName = mysqli_real_escape_string($conn, $_POST['FirstName']);
$LastName = mysqli_real_escape_string($conn, $_POST['LastName']);
$Address = mysqli_real_escape_string($conn, $_POST['Billing_Address']);
$AddressLine2 = mysqli_real_escape_string($conn, $_POST['Billing_Address2']);
$City = mysqli_real_escape_string($conn, $_POST['City']);
$State = mysqli_real_escape_string($conn, $_POST['State']);
$ZipCode = mysqli_real_escape_string($conn, $_POST['ZipCode']);
$PaymentMethod = mysqli_real_escape_string($conn, $_POST['credit_card']);
$CardNumber = mysqli_real_escape_string($conn, $_POST['card_number']);
$ExpirMonth = mysqli_real_escape_string($conn, $_POST['Expir_Month']);
$ExpirYear = mysqli_real_escape_string($conn, $_POST['Expir_Year']);
$CardCode = mysqli_real_escape_string($conn, $_POST['card_code']);
$Price = mysqli_real_escape_string($conn, $_POST['DB_Total_Price']);

// attempt insert query execution
$sql = "INSERT INTO Payment_Info (FirstName, LastName, Address, AddressLine2, City, State, ZipCode, PaymentMethod, CardNumber, ExpirMonth, ExpirYear, CardCode, Price)
VALUES ('$FirstName', '$LastName', '$Address','$AddressLine2','$City','$State','$ZipCode','$PaymentMethod','$CardNumber','$ExpirMonth','$ExpirYear','$CardCode','$Price')";
if(mysqli_query($conn, $sql)){
    echo "Payment Records Added Successfully! Thank you!";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

// close connection
mysqli_close($conn);
?>
