<?php
ob_start();
session_start();
setcookie('sortOrder', "ASC");
setcookie('sort', "ProductID");


echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '    <meta charset="UTF-8">';
echo '    <title>Final Project</title>';
echo '    <link rel="stylesheet" href="./styles/product.css">';
echo '</head>';

echo '<body>';

echo '<main>';
echo '<header>';
 require("header.php");
echo '</header>';

echo '<div style="display: flex; height: 820px;">';
echo '    <nav style="width:15%;">';
 require("navigation.html");
 echo '</nav>';
echo '    <div style="width: 100%;"> ';
 echo ' <main class="about-us-content">
 <div class="section">
     <h2>Welcome to The E-Store</h2>
     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac libero sed orci faucibus auctor.
         Mauris
         at
         augue vel leo tristique cursus. Nulla facilisi. Proin euismod vestibulum elit, eget bibendum ipsum
         fermentum non.</p>
 </div>

 <div class="section">
     <h2>Our Mission</h2>
     <p>Our mission is to provide high-quality products and excellent service to our customers. We aim to create
         a
         seamless online shopping experience and become a trusted destination for all your needs.</p>
 </div>

 <div class="section">
     <h2>Meet Our Team</h2>
     <p>We have a dedicated team of professionals committed to ensuring your satisfaction. From customer
         support
         to product management, our team works together to make The E-Store a great place to shop.</p>
 </div>



</main>';
 echo '</div>';
echo '</div>';

echo '</main>';

 require("footer.html") ;

echo '</body>';
echo '</html>';
?>

<style>
  
      
        .logoimg {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        #storeName {
            margin: 0;
            font-size: 1.5em;
            display: inline;
        }

        .nav {
            margin-top: 20px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        .nav-link.active {
            background-color: #555;
        }

        .about-us-content {
            padding: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            color: #3498db;
        }
</style>