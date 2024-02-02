<?php
      session_start();
        // PHP login validation script
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validate against your database (Replace this with your actual validation logic)
            if (checkuser()) {
              require('../database/dbconfig.in.php');
              $sql = "SELECT * FROM customerinformation WHERE Username = :username AND Password = :password";
        
              $stmt = $pdo->prepare($sql);
          
              $stmt->bindParam(':username', $_POST['username']);
              $stmt->bindParam(':password', $_POST['password']);
              $stmt->execute();
              $result = $stmt->fetch(PDO::FETCH_ASSOC);
              //check user type if employee or cutomer
              if($result['type'] == 'employee'){
                $_SESSION['username'] = $result['name'];
                $_SESSION['UserType'] = 'employee';
                $_SESSION['id'] = $result['ID'];
              
                header('Location: ../empIndex.php');
              } else if($result['type'] == 'customer'){
                $_SESSION['username'] = $result['name'];
                $_SESSION['UserType'] = 'customer';
                $_SESSION['id'] = $result['ID'];
          
                header('Location: ../index.php');
              }

              //set session variable
           
              //check user type if employee or cutomer
              
                echo '<p class="success-message">Login successful!</p>';
                //add header to redirect to home page
            } else {

              $usernameLength = strlen($username);
              $passwordLength = strlen($password);

              $errors = [];

          if ($usernameLength < 6 || $usernameLength > 13) {
        $errors[] = "<h1>Username should be between 6 and 13 characters.</h1>";
    }

    if ($passwordLength < 8 || $passwordLength > 12) {
        $errors[] = "<h1>Password should be between 8 and 12 characters.</h1>";
    }



                echo '<p class="error-message">Invalid username or password. Please try again.</p>';
            }
        }


        function checkuser(){
          require_once('../database/dbconfig.in.php');
        
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            $sql = "SELECT * FROM customerinformation WHERE Username = :username AND Password = :password";
        
            $stmt = $pdo->prepare($sql);
        
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

        
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
    <title>Final Project</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<main>
<header>
  <?php require("./header.php") ?>
</header>

<body >
<div style=" display: flex; height: 820px; ">
<nav style="width:15%;"> <?php require("./navigation.html") ?></nav>
  

<div style="width: 100%;">
<div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>

    </div></div>
</div>

</body>

<?php require("../footer.html") ?>





