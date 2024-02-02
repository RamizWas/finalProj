<?php
session_start();
require_once('../database/dbconfig.in.php');
// Retrieve data from $_SESSION['registration_data'] array
$registrationName = $_SESSION['registration_data']['name'];
$registrationAddress = $_SESSION['registration_data']['address'];
$registrationDateOfBirth = $_SESSION['registration_data']['date_of_birth'];
$registrationNationalID = $_SESSION['registration_data']['national_id'];
$registrationEmail = $_SESSION['registration_data']['email'];
$registrationTelephone = $_SESSION['registration_data']['telephone'];
$registrationCreditCardNumber = $_SESSION['registration_data']['credit_card_number'];
$registrationExpirationDate = $_SESSION['registration_data']['expiration_date'];
$registrationCardHolderName = $_SESSION['registration_data']['card_holder_name'];
$registrationIssuingBank = $_SESSION['registration_data']['issuing_bank'];


// Retrieve data from $_SESSION['e_account_data'] array
$eAccountUsername = $_SESSION['e_account_data']['username'];
$eAccountPassword = $_SESSION['e_account_data']['password'];


try {

  $columns = "name, address, DateOfBirth, NationalID, Email, Telephone, CreditCardNumber, ExpirationDate, CardHolderName, IssuingBank, Username, Password, type";

  // Replace the following with placeholders corresponding to the columns
  $placeholders = ":name, :address, :date_of_birth, :national_id, :email, :telephone, :credit_card_number, :expiration_date, :card_holder_name, :issuing_bank, :username, :password, :type";
  
  // Registration Data
  $registrationData = [
      'name' => $registrationName,
      'address' => $registrationAddress,
      'date_of_birth' => $registrationDateOfBirth,
      'national_id' => $registrationNationalID,
      'email' => $registrationEmail,
      'telephone' => $registrationTelephone,
      'credit_card_number' => $registrationCreditCardNumber,
      'expiration_date' => $registrationExpirationDate,
      'card_holder_name' => $registrationCardHolderName,
      'issuing_bank' => $registrationIssuingBank,
      'username' => $eAccountUsername,  // Use e-account username as well
      'password' => $eAccountPassword,  // Use e-account password as well
      'type' => 'customer',
  ];  
  
  $sql = "INSERT INTO customerinformation ($columns) VALUES ($placeholders)";
  
  $stmt = $pdo->prepare($sql);
  
  // Bind parameters
  $stmt->bindParam(':name', $registrationData['name']);
  $stmt->bindParam(':address', $registrationData['address']);
  $stmt->bindParam(':date_of_birth', $registrationData['date_of_birth']);
  $stmt->bindParam(':national_id', $registrationData['national_id']);
  $stmt->bindParam(':email', $registrationData['email']);
  $stmt->bindParam(':telephone', $registrationData['telephone']);
  $stmt->bindParam(':credit_card_number', $registrationData['credit_card_number']);
  $stmt->bindParam(':expiration_date', $registrationData['expiration_date']);
  $stmt->bindParam(':card_holder_name', $registrationData['card_holder_name']);
  $stmt->bindParam(':issuing_bank', $registrationData['issuing_bank']);
  $stmt->bindParam(':username', $registrationData['username']);
  $stmt->bindParam(':password', $registrationData['password']);
  $stmt->bindParam(':type', $registrationData['type']);

  
  $stmt->execute();


} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}


?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="../styles/register.css">
    <link rel="stylesheet" href="../styles/confirmationmsg.css"> <!-- Link to your external style sheet -->
     <!-- Link to your external style sheet -->
</head>
<body>

    <!-- Button to return to homepage -->
   
    <?php 
 $username = $registrationData['username'];

 // Use a placeholder in the SQL query
 $sql = "SELECT * FROM customerinformation WHERE Username = :username"; 
 
 // Prepare the statement
 $stmt = $pdo->prepare($sql);

 // Bind the value to the placeholder
 $stmt->bindParam(':username', $username);
 echo $username;
 // Execute the statement

 $stmt->execute();

 $result1=$stmt->fetch(PDO::FETCH_ASSOC);
 


 // Fetch the results

  
  echo "<div class='confirm-div'><br>";
  echo "<h1>Thank you for registering!</h1><br>";
  echo "<h2>Your Customer ID is: " . $result1['ID'] . "</h2>";

    ?>
    <a href="../index.php"><button class="confirm-button">Return to Homepage</button></a>
</div>
</body>
</html>


