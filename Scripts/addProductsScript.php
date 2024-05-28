<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $image = $_POST["image"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    // Validate form data
    if (empty($name) || empty($image) || empty($description) || empty($price) || empty($quantity)) {
        // Redirect with error message
        header("Location: ../UserPage.php?error=All fields are required.");
        exit(); // Terminate script execution
    }

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

    // Prepare SQL statement to insert news into the database
    $sql = "INSERT INTO products (Name, Image, Description, Price, Quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $image, $description, $price, $quantity);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../Shop.php");
    } else {
        header("Location: ../UserPage.php?error=Error occurred while adding products.");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
