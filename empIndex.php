<?php
session_start();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee page</title>
<link rel="stylesheet" href="./styles/product.css">';

    <link rel="stylesheet" href="css/style.css">
</head>

<main>
<header>
  <?php require("header.php") ?>
</header>

<body >

<h1>Employee</h1>
<div style=" display: flex; height: 820px; ">
<nav style="width:15%;"> <?php require("navigationEmp.html") ?></nav>
  

<div style="width: 100%;"><?php include("product/empProductTable.php") ?></div>
</div>

</body>

<?php require("footer.html") ?>




</main>