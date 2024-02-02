<?php
// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'onlinestore';

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
