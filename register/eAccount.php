<?php
session_start();
//print_r( $_SESSION['registration_data']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data (you should perform more robust validation)
    $username = $_POST['username'];
    $password = $_POST['password'];

    //check if username exists in database
    if (checkUsername($username)) {
        echo "<h1>username:$username exists</h1>";
    } else {
        // Perform validation (you can add more validation rules)
        if (empty($username) || empty($password)) {
            $errors[] = "All fields are required.";
        }
  
     
    // Additional validation for username and password
   $usernameLength = strlen($username);
    $passwordLength = strlen($password);

    $errors = [];

    if ($usernameLength < 6 || $usernameLength > 13) {
        $errors[] = "<h1>Username should be between 6 and 13 characters.</h1>";
    }

    if ($passwordLength < 8 || $passwordLength > 12) {
        $errors[] = "<h1>Password should be between 8 and 12 characters.</h1>";
    }

    // If validation is successful, store the additional data in the session
    if (empty($errors)) {
        $_SESSION['e_account_data'] = [
            'username' => $username,
            'password' => $password,
        ];

        // Redirect to the confirmation step
        header('Location: confirmation.php');
        exit;
    
  } 
}
}

function checkUsername($username1){
  require_once('../database/dbconfig.in.php');



    $sql = "SELECT * FROM customerinformation WHERE Username = :username";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':username', $username1);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
    if ($result) {
        return true;
    } else {
        return false;
    }
}



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Account Creation</title>
    <link rel="stylesheet" href="../styles/register.css"> <!-- Link to your external style sheet -->
</head>
<body>

    <h2>STEP TWO:E-Account Creation</h2>

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
        <label for="username">Username (between 6-13 characters):</label>
        <input type="text" id="username" class="form-input" name="username" required>

        <br><br>

        <label for="password">Password (between 8-12 characters):</label>
        <input type="password" id="password" class="form-input" name="password" required>

        <br><br>

        <input type="submit" class="submit-button" value="Next Step">
    </form>

</body>
</html>
