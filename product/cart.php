<?php
session_start();
require_once('../database/dbconfig.in.php');

//if method is post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //check if remove button is clicked
    if (isset($_POST['remove'])) {
        //remove product from cart
        if(!$_SESSION['cart'][$_POST['name']] == 0){
          $_SESSION['cart'][$_POST['name']] -= 1;
          $stmt = $pdo->prepare("UPDATE products SET Size = Size + 1 WHERE Name = :productID");
        $stmt->bindParam(':productID', $_POST['name']);
        $stmt->execute();
        }
        
    }

    //check if checkout button is clicked
   else if (isset($_POST['checkoutButton'])) {
      echo "checkout";
      $currentDate = date('Y-m-d');
      $processing = 'processing';
      $sql = "INSERT INTO ordertable (customerId , date, orderstate) VALUES (:customerId , :date, :orderstate)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':customerId', $_SESSION['id']);
      $stmt->bindParam(':date', $currentDate);
      $stmt->bindParam(':orderstate', $processing);

      
      
      $stmt->execute();
      $lastInsertedId = $pdo->lastInsertId();
      echo $lastInsertedId;
        //redirect to checkout page
         foreach ($_SESSION['cart'] as $productName => $quantity) {
          
          $sql = "INSERT INTO orderitem (productName, quantity, orderid) VALUES (:productName, :quantity, :orderid)";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
          $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
          $stmt->bindParam(':orderid', $lastInsertedId, PDO::PARAM_INT);
          $stmt->execute();
      } 
      $_SESSION['cart'] = array();
}
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Cart</title>
    <link rel="stylesheet" href="../styles/product.css">
</head>

<main>
<header>
  <?php require("./header.php") ?>
</header>

<body >
<div style=" display: flex; height: 820px; ">
<nav style="width:15%;"> <?php require("./navigation.html") ?></nav>
  

<div style="width: 100%;"><?php
if (!isset($_SESSION['id'])) {
  echo '<div class="error-div"><h2> Please login to view your cart </h2></div>';
 header("refresh:3;url=../login/login.php");
}else if(empty($_SESSION['cart'])){
    echo "<h1>Cart is empty</h1>";
  }else{

echo '<table border="1">';
echo '<tr><th>Product Name</th><th>Quantity</th> <th>Remove Item</th></tr>';
foreach ($_SESSION['cart'] as $productName => $quantity) {
    echo '<tr>';
    echo '<td>' . $productName . '</td>';
    echo '<td>' . $quantity . '</td>';
    //echo form
    echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
    echo '<td> <button type="submit" name="remove"> remove one </button></td>';
    //echo hidden input field
    echo '<input type="hidden" name="name" value="' . $productName . '">';
    echo '</tr>';
    echo '</form>';
}
echo '</table>';
echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
echo '<button class="checkoutButton" name="checkoutButton" type="submit">Checkout</button>';
echo '</form>';
}


?></div>
</div>

</body>

<?php require("../footer.html") ?>




</main>