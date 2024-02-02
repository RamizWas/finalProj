<?php
// reate a PDO connection
//require './database/dbconfig.in.php';
require './database/dbconfig.in.php';


// Fetch the products from the database and sort them based on the selected column and order
$sortColumn = isset($_COOKIE['sort']) ? $_COOKIE['sort'] : 'ProductID';
$sortOrder = isset($_COOKIE['sortOrder']) ? $_COOKIE['sortOrder'] : 'ASC';
global $products;
if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = array();
 
}




if ($sortOrder === 'ASC' && isset($_GET['sort'] ) && $_GET['sort'] === $sortColumn) {
  $sortOrder = 'DESC';
} else if ($sortOrder === 'DESC' && isset($_GET['sort'] )&& $_GET['sort'] === $sortColumn ){
  $sortOrder = 'ASC';
}



//check if sortOrder is set
if (isset($_GET['sortOrder'])) {
  $sortOrder = $_GET['sortOrder'];
  setcookie('sortOrder', $sortOrder);
}



// Set the new sorting order cookie
if(isset($sortOrder)){


setcookie('sortOrder', $sortOrder);
}
setcookie('sort', $sortColumn);

//check if sort is set
if (isset($_GET['sort'])) {
  
  $sortColumn = $_GET['sort'];
  setcookie('sort', $sortColumn);
}


if ($_SERVER["REQUEST_METHOD"] === "GET" ) {
  if(isset($_GET['minPrice']) || isset($_GET['maxPrice']) || isset($_GET['productName'])){
   
  
  $minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : null;
  $maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : null;
  $productName = isset($_GET['productName']) ? $_GET['productName'] : null;

  // Build the SQL query based on the provided parameters
  $sql = "SELECT * FROM products WHERE ";
  $conditions = [];

  if (!empty($minPrice) && !empty($maxPrice)) {
      $conditions[] = "price BETWEEN :minPrice AND :maxPrice";
  } elseif (!empty($minPrice)) {
      $conditions[] = "price >= :minPrice";
  } elseif (!empty($maxPrice)) {
      $conditions[] = "price <= :maxPrice";
  }

  if (!empty($productName)) {
      $conditions[] = "name LIKE :productName";
  }

  if (!empty($conditions)) {
      $sql .= implode(" AND ", $conditions);
  } else {
      $sql .= "1"; // Default condition to fetch all products if no filters are applied
  }

  $stmt = $pdo->prepare($sql);

  // Bind parameters
  if (!empty($minPrice)) {
      $stmt->bindValue(':minPrice', $minPrice, PDO::PARAM_INT);
  }

  if (!empty($maxPrice)) {
      $stmt->bindValue(':maxPrice', $maxPrice, PDO::PARAM_INT);
  }

  if (!empty($productName)) {
      $stmt->bindValue(':productName', '%' . $productName . '%', PDO::PARAM_STR);
  }

  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Output the results or handle them as needed
}else{
  $products = fetchProducts($pdo, $sortColumn, $sortOrder);
}

}//check if method is post
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if(isset($_POST['changeQuantity'])){
   
        $stmt = $pdo->prepare("UPDATE products SET Size = Size + 1 WHERE ProductID = :productID");
        $stmt->bindParam(':productID', $_POST['cartprodid']);
        $stmt->execute();
    
   $products = fetchProducts($pdo, $sortColumn, $sortOrder);

  }

  //check if shortlist is set
  if (isset($_POST['shortlist'])) {
  
    //get shortlist
    $shortlist = $_POST['shortlist'];
   
 
    //check if shortlist is empty
    if (!empty($shortlist)) {
      $productIds = '';
      //loop through shortlist
      foreach ($shortlist as $products) {
        //concatenate productID
        $productIds .=  $products. ',';
      
      }
  
     //remove last comma
      $productIds = rtrim($productIds, ',');
      

    
      $stmt = $pdo->prepare("SELECT * FROM products WHERE productID IN($productIds) ORDER BY $sortColumn $sortOrder");
      $stmt->execute();
       $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
    }else{
      
      $products = fetchProducts($pdo, $sortColumn, $sortOrder);
    }
  }
}else{

// Fetch products and sort them
$products = fetchProducts($pdo, $sortColumn, $sortOrder);
}


// Function to fetch products from the database and apply sorting
function fetchProducts($pdo, $sortColumn, $sortOrder) {


    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY $sortColumn $sortOrder");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">


    <title>Sortable Products</title>
    
</head>
<body style="display:flexbox;">

<form class="search-form" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label class="form-label" for="minPrice">Minimum Price:</label>
    <input class="form-input" type="number" name="minPrice" id="minPrice">

    <label class="form-label" for="maxPrice">Maximum Price:</label>
    <input class="form-input" type="number" name="maxPrice" id="maxPrice">

    <label class="form-label" for="productName">Product Name:</label>
    <input class="form-input" type="text" name="productName" id="productName">

    <button class="search-button" type="submit">Search</button>
</form>

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      
    <table>
      
        <thead>
            <tr>
            <th><button type="submit"> Shortlist </button></th>
                <th><a href="?sort=ProductID">Product ID</a></th>
                <th><a href="?sort=Name">Name</a></th>
                <th><a href="?sort=Category">Category</a></th>
                <th><a href="?sort=Price">Price</a></th>
                <th><a href="?sort=Size">Quantity</a></th>
                <th><a href="?sort=Remarks">Remarks</a></th>
                <?php if(isset($_SESSION['id']) ){
                  echo '<th><button>add or remove</button></th>';
                } ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): 
          
          if($product['Size'] > 0){
            echo '<tr class="' . $product['Category'] . '">'; 
            echo '<td><input type="checkbox" name="shortlist[]" value="' . $product['ProductID'] . '"></td>'; 
           echo '<td><a href="./product/productPage.php?id=' . $product['ProductID'] . '">' . $product['ProductID'] . '</a></td>'; 
           echo '<td>' . $product['Name'] . '</td>'; 
            echo '<td>' . $product['Category'] . '</td>'; 
            echo '<td>' . $product['Price'] . '</td>'; 
            echo '<td>' . $product['Size'] . '</td>'; 
           echo '<td>' . $product['Remarks'] . '</td>'; 
           echo ' </form>';
           
           if(isset($_SESSION['id'])){
             echo '<form class="search-form" method="post" action="'.$_SERVER['PHP_SELF'].'">';
             echo '<td><button type="submit" name="changeQuantity">add item</button></td>';
             echo '<input type="hidden" name="cartprodid" value="' . $product['ProductID'] . '">';
             //echo '<input type="hidden" name="cartprod" value="' . $product . '">';
             echo '</form>';
           }
           echo "</tr>";
          }
         
        
endforeach; ?>
        </tbody>
        
    </table>
   
   
</body>