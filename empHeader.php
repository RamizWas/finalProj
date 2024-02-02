<?php
// Assuming $userId is a variable representing the user's ID

//link style sheet
echo '<link rel="stylesheet" href="./styles/header.css">';
echo '<body class="main-body">';
if (isset($_SESSION['id'])) {
    // User is logged in
    echo '<header class="header loggedin-header">';
    echo '<div class="header-content">';
    echo '<a href="./about-us.php" class="nav-link">About Us</a>';
    echo '<div>';
    echo '<img src="./images/logo.png" alt="logo" class="logoimg">';
    echo '<h1 id="storeName" class="store-name">The E-Store</h1>';
    echo '</div>';
    echo '<div>';
    echo '  Welcome, <span id="userName" class="user-name">' . $_SESSION['username'] . '</span>';
    echo ' | <a href="./login/logout.php" class="nav-link">Logout</a>';
    echo '</div>';
    echo '</div>';
    echo '</header>';
} else {
    // User is not logged in
    echo '<header class="header loggedout-header">';
    echo '<div class="header-content">';
    echo '<a href="./about-us.php" class="nav-link1">About Us</a>';
    echo '<div>';
    echo '<img src="./images/logo.png" alt="logo" class="logoimg">';
    echo '<h1 id="storeName" class="store-name">The E-Store</h1>';
    echo '</div>';
    echo '<div>';
    echo ' <a href="./login/login.php" class="nav-link">Login</a>';
    echo ' | <a href="./register/register.php" class="nav-link">Register</a>';
    echo '</div>';
    echo '</div>';
    echo '</header>';
}

echo '</body>';
?>
