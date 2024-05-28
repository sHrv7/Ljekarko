<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $oldName = $_POST["oldName"];
    $name = $_POST["name"];
    $image = $_POST["image"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    // Validate form data (you may add more validation as needed)

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

    // Prepare SQL statement to update news in the database
    $sql = "UPDATE products SET Name=?, Image=?, Description=?, Price=?, Quantity=? WHERE Name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $image, $description, $price, $quantity, $oldName);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../shop.php");
    } else {
        // Redirect with error message
        header("Location: ../userPage.php?error=Error occurred while updating products.");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed without POST method
    header("Location: ../shop.php");
}
