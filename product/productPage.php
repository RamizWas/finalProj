<?php
session_start();
require_once('../database/dbconfig.in.php');
//check if method is get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  
    //check if product id is set
    
    if (isset($_GET['id'])) {

        //get product id
        //get product details
        $product = fetchProduct($pdo, $_GET['id']);
    }else {
        //redirect to product table
       // header('Location: productTable.php');
       // exit;
    }
  }
    // Function to fetch product details from the database
    function fetchProduct($pdo, $productID) {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE productID = :productID");
        $stmt->bindParam(':productID', $productID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<head>

  <link rel="stylesheet" href="../styles/productsPage.css">
</head>

    <main>
<header>
  <?php require("./header.php") ?>
</header>

<body >
<div style=" display: flex; height: 820px; ">
<nav style="width:15%;"> <?php require("navigation.html") ?></nav>
  
<div style="width: 100%;" class="card">
<!-- show product -->
<div class="product">
    <div class="product-image">
       <!-- <img src="../images/<?php echo $product['Image']; ?>" alt="<?php echo $product['Name']; ?>"> -->
    </div>
    <div class="product-details">
        <h1><?php echo $product['Name']; ?></h1>
        <h2><?php echo $product['Price']; ?></h2>
        <p><?php echo $product['Description']; ?></p>
       
    </div>

</div>
</div>

</body>

<?php require("../footer.html") ?>




</main>
