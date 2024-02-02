<?php
// registration.php

session_start();

// Initialize variables to hold form data and errors
$name = $address = $dateOfBirth = $nationalID = $email = $telephone = $creditCardNumber = $expirationDate = $cardHolderName = $issuingBank = '';
$errors = [];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data (you should perform more robust validation)
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['date_of_birth'];
    $nationalID = $_POST['national_id'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $creditCardNumber = $_POST['credit_card_number'];
    $expirationDate = $_POST['expiration_date'];
    $cardHolderName = $_POST['card_holder_name'];
    $issuingBank = $_POST['issuing_bank'];

    // Perform validation (you can add more validation rules)
    if (empty($name) || empty($address) || empty($dateOfBirth) || empty($nationalID) || empty($email) || empty($telephone) || empty($creditCardNumber) || empty($expirationDate) || empty($cardHolderName) || empty($issuingBank)) {
        $errors[] = "All fields are required.";
    }

    // Check if the form data is valid
    if (empty($errors)) {
        // Store data in session
        $_SESSION['registration_data'] = [
            'name' => $name,
            'address' => $address,
            'date_of_birth' => $dateOfBirth,
            'national_id' => $nationalID,
            'email' => $email,
            'telephone' => $telephone,
            'credit_card_number' => $creditCardNumber,
            'expiration_date' => $expirationDate,
            'card_holder_name' => $cardHolderName,
            'issuing_bank' => $issuingBank,
        ];

        // Redirect to the next step
        header('Location: eAccount.php');
        exit;
    }
}
?>
<!-- HTML form for registration -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/register.css">


    <title>Registration</title>
</head>
<body>

    <h2>STEP ONE:Registration Form</h2>

    <?php
    // Display errors, if any
    if (!empty($errors)) {
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Add input fields for each piece of user information -->

        <!-- Example: -->
        <label for="name">Name:</label>
        <input placeholder="enter Name" type="text" id="name" class="form-input" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

        <br><br>

        <label for="address">Address:</label>
        <input  placeholder="address" type="text" id="address" name="address" class="form-input" value="<?php echo htmlspecialchars($address); ?>" required>

        <br><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input placeholder="date of birth" type="date" id="date_of_birth" name="date_of_birth"  class="form-input" value="<?php echo htmlspecialchars($dateOfBirth); ?>" required>

        <br><br>

        <label for="national_id">National ID:</label>
        <input placeholder="id" type="text" id="national_id" name="national_id" class="form-input" value="<?php echo htmlspecialchars($nationalID); ?>" required>

        <br><br>

        <label for="email">Email:</label>
        <input placeholder="email" type="email" id="email" name="email" class="form-input" value="<?php echo htmlspecialchars($email); ?>" required>

        <br><br>

        <label for="telephone">Telephone:</label>
        <input placeholder="telephone" type="tel" id="telephone" name="telephone" class="form-input" value="<?php echo htmlspecialchars($telephone); ?>" required>

        <br><br>

        <label for="credit_card_number">Credit Card Number:</label>
        <input placeholder="card number" type="text" id="credit_card_number"  class="form-input" name="credit_card_number" value="<?php echo htmlspecialchars($creditCardNumber); ?>" required>

        <br><br>

        <label for="expiration_date">Expiration Date:</label>
        <input placeholder="expiration date" type="date" id="expiration_date" class="form-input" name="expiration_date" value="<?php echo htmlspecialchars($expirationDate); ?>" required>

        <br><br>

        <label for="card_holder_name">Card Holder Name:</label>
        <input placeholder="card holder name" type="text" id="card_holder_name" class="form-input" name="card_holder_name" value="<?php echo htmlspecialchars($cardHolderName); ?>" required>

        <br><br>

        <label for="issuing_bank">Issuing Bank:</label>
        <input placeholder="issuing_bank" type="text" id="issuing_bank" class="form-input" name="issuing_bank" value="<?php echo htmlspecialchars($issuingBank); ?>" required>

        <br><br>

        <!-- Repeat similar lines for other fields -->

        <input type="submit" class="submit-button" value="Next Step">
    </form>
</body>
</html>
