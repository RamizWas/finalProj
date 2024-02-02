<?php
session_start();

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




?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link rel="stylesheet" href="../styles/register.css"> <!-- Link to your external style sheet -->
</head>
<body>

    <h2>User Information</h2>

    <!-- Combined Information Form -->
    <form>
        <label for="registrationName">Name:</label>
        <input type="text" id="registrationName" class="form-input" value="<?php echo htmlspecialchars($registrationName); ?>" readonly>

        <br><br>

        <label for="registrationAddress">Address:</label>
        <input type="text" id="registrationAddress" class="form-input" value="<?php echo htmlspecialchars($registrationAddress); ?>" readonly>

        <br><br>

        <label for="registrationDateOfBirth">Date of Birth:</label>
        <input type="text" id="registrationDateOfBirth" class="form-input" value="<?php echo htmlspecialchars($registrationDateOfBirth); ?>" readonly>

        <!-- Repeat similar lines for other registration fields -->

        <br><br>

        <label for="eAccountUsername">Username:</label>
        <input type="text" id="eAccountUsername" class="form-input" value="<?php echo htmlspecialchars($eAccountUsername); ?>" readonly>

        <br><br>

        <label for="eAccountPassword">Password:</label>
        <input type="text" id="eAccountPassword" class="form-input" value="<?php echo htmlspecialchars($eAccountPassword); ?>" readonly>

        <br><br>

        <label for="registrationNationalID">National ID:</label>
        <input type="text" id="registrationNationalID" class="form-input" value="<?php echo htmlspecialchars($registrationNationalID); ?>" readonly>

        <br><br>

        <label for="registrationEmail">Email:</label>
        <input type="text" id="registrationEmail" class="form-input" value="<?php echo htmlspecialchars($registrationEmail); ?>" readonly>

        <br><br>

        <label for="registrationTelephone">Telephone:</label>
        <input type="text" id="registrationTelephone" class="form-input" value="<?php echo htmlspecialchars($registrationTelephone); ?>" readonly>

        <br><br>

        <label for="registrationCreditCardNumber">Credit Card Number:</label>
        <input type="text" id="registrationCreditCardNumber" class="form-input" value="<?php echo htmlspecialchars($registrationCreditCardNumber); ?>" readonly>

        <br><br>

        <label for="registrationExpirationDate">Expiration Date:</label>
        <input type="text" id="registrationExpirationDate" class="form-input" value="<?php echo htmlspecialchars($registrationExpirationDate); ?>" readonly>

        <br><br>

        <label for="registrationCardHolderName">Card Holder Name:</label>
        <input type="text" id="registrationCardHolderName" class="form-input"  value="<?php echo htmlspecialchars($registrationCardHolderName); ?>" readonly>

        <br><br>

        <label for="registrationIssuingBank">Issuing Bank:</label>
        <input type="text" id="registrationIssuingBank" class="form-input" value="<?php echo htmlspecialchars($registrationIssuingBank); ?>" readonly>
      

    </form>
    <form action="confirmationMessage.php">
        <input type="submit" value="Confirm"  class="submit-button">
        </form>

</body>
</html>
