`<?php
ob_start();
session_start();
require('./database/dbconfig.in.php');

setcookie('sortOrder', "ASC");
setcookie('sort', "ProductID");

//check if post
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['shipOrder'])) {
    $orderId = $_POST['orderid'];
    $sql = "UPDATE orderTable SET orderState = 'shipped' WHERE orderId = :orderId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':orderId', $orderId);
    $stmt->execute();
  }
}


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
 require("navigationEmp.html");
 echo '</nav>';
echo '    <div style="width: 100%;"> ';
//start
if (!isset($_SESSION['id'])) {
  echo '<div class="error-div"><h2> Please login to view your orders </h2></div>';
 header("refresh:3;url=login/login.php");
}else{
    // Get the user id from the session
$userId = $_SESSION['id'];

    // SQL query to select order details for the given user id
    $sql = "SELECT * FROM orderTable";

    // Prepare the query
    $stmt = $pdo->prepare($sql);
    // Bind parameters
  
    // Execute the query
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->rowCount() > 0) {
        // Output the table header
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>Order ID</th>';
        echo '<th>Date</th>';
        echo '<th>State</th>';
        echo '</tr>';

        // Fetch each row as an associative array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Access the order details
            $orderId = $row['orderId'];
            $orderDate = $row['date'];
            $orderState = $row['orderState'];

            // Output each row as a table row
            echo '<tr>';
            echo '<td><a href="orderDetails.php?orderid=' . $orderId . '">' . $orderId . '</a></td>';
            echo '<td>' . $orderDate . '</td>';
            if($orderState == 'shipped'){
            echo '<td><div class="shipped">' . $orderState . '</div></td>';}
            else{
              echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
              echo '<td><button type="submit" name="shipOrder">Processing</td>';
              echo '<input type="hidden" name="orderid" value="' . $orderId . '">';
              echo '</form>';
            }
            echo '</tr>';
        }

        // Close the table
        echo '</table>';
    } else {
        // Handle the case when no rows are returned
        echo "No orders found for the user.";
    }





  }


//finish
 echo '</div>';
echo '</div>';

echo '</main>';

 require("footer.html") ;

echo '</body>';
echo '</html>';
?>
<style>
    .shipped {
        background-color: #4CAF50;
        color: #fff;
        padding: 5px;
    }
</style>
`