<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product ID from the form submission
    $product_id = $_POST["product_id"];

    // Initialize the cart array in the session if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the product ID to the cart array or increase its quantity if it already exists
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += 1; // Increase quantity by 1
    } else {
        $_SESSION['cart'][$product_id] = 1; // Add new product with quantity 1
    }

    // Redirect back to the shop page or any other page you prefer
    header("Location: ../Cart.php");
    exit();
} else {
    // Redirect if accessed without POST method
    header("Location: ../Shop.php");
    exit();
}
?>
