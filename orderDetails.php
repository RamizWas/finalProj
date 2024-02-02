<?php
ob_start();
session_start();
setcookie('sortOrder', "ASC");
setcookie('sort', "ProductID");
require('./database/dbconfig.in.php');

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
try {
  $order_id = $_GET['orderid'];
  $stmt = $pdo->prepare("SELECT * FROM orderitem WHERE orderId = :order_id");
  $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
  $stmt->execute();
  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}


if (count($orders) > 0) {
  echo '<table border="1">';
  echo '<tr><th>Order ID</th><th>Product</th><th>Quantity</th></tr>';
  foreach ($orders as $order) {
      echo '<tr>';
      echo '<td>' . $order['orderId'] . '</td>';
      echo '<td>' . $order['productName'] . '</td>';
      echo '<td>' . $order['quantity'] . '</td>';
   
      echo '</tr>';
  }
  echo '</table>';
} else {
  echo '<p>No orders found for Order ID ' . $order_id . '</p>';
}



 echo '</div>';
echo '</div>';

echo '</main>';

 require("footer.html") ;

echo '</body>';
echo '</html>';
