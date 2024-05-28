<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Validate the quantity
    if ($quantity > 0) {
        // Update the quantity in the session cart
        $_SESSION['cart'][$product_id] = $quantity;
    } else {
        // Remove the item from the cart if quantity is 0 or less
        unset($_SESSION['cart'][$product_id]);
    }
}

// Redirect back to the cart page
header("Location: ../Cart.php");
exit();
