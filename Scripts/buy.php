<?php
session_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "Ljekarko";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Iterate through each product in the cart and update its quantity in the database
foreach ($_SESSION['cart'] as $product_id => $quantityInCart) {
    // Retrieve the current quantity of the product from the database
    $sql_select = "SELECT Quantity FROM products WHERE ID=?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $product_id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $row = $result->fetch_assoc();
    $currentQuantity = $row['Quantity'];

    // Calculate the new quantity after subtracting the quantity in the cart
    $newQuantity = $currentQuantity - $quantityInCart;

    if($newQuantity<0){
        $newQuantity=0;
    }

    // Prepare SQL statement to update product quantity in the database
    $sql_update = "UPDATE products SET Quantity=? WHERE ID=?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ii", $newQuantity, $product_id);
    $stmt_update->execute();
}

// Clear the cart
$_SESSION['cart'] = [];

// Redirect back to Home page
header("Location: ../Home.php");
exit();
