<?php
  session_start();
  require("navigationEmp.html");
  require_once('./database/dbconfig.in.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = $_POST["name"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $size = $_POST["size"];
    $remarks = $_POST["remarks"];

    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO products (Name, Description, Category, Price, Size, Remarks) 
                           VALUES (:name, :description, :category, :price, :size, :remarks)");

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':size', $size);
    $stmt->bindParam(':remarks', $remarks);

    // Execute the statement
    $stmt->execute();

    header("Location: empIndex.php");

}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="./styles/addproduct.css"> <!-- Link to your stylesheet if applicable -->
</head>

<body>
    <h1>Add Product</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="product-form">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="category">Category:</label>
        <select name="category">
            <option value="new_arrival">New Arrival</option>
            <option value="on_sale">On Sale</option>
            <option value="featured">Featured</option>
            <option value="high_demand">High Demand</option>
            <option value="normal">Normal</option>
        </select><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label for="size">Size:</label>
        <input type="number" name="size"><br>

        <label for="remarks">Remarks:</label>
        <input type="text" name="remarks"><br>

        <input type="submit" value="Add Product">
    </form>
</body>

</html>
