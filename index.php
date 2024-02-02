<?php
ob_start();
session_start();
setcookie('sortOrder', "ASC");
setcookie('sort', "ProductID");

echo '<link rel="stylesheet" href="./styles/product.css">';

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '    <meta charset="UTF-8">';
echo '    <title>Final Project</title>';
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
 include("product/productTable.php");
 echo '</div>';
echo '</div>';

echo '</main>';

 require("footer.html") ;

echo '</body>';
echo '</html>';
