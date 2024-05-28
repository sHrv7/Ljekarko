<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve title from post data
    $name = $_POST["name"];

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

    // Prepare SQL statement to delete news from the database
    $sql = "DELETE FROM products WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../shop.php");
    } else {
        header("Location: ../UserPage.php?error=Error occurred while deleting products.");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
