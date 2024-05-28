<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["id"];
    $kolicina = $_POST["kolicina"] + $_POST["quantity"];

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
    $sql = "UPDATE products SET Quantity=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $kolicina, $id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../shop.php");
    } else {
        // Redirect with error message
        header("Location: ../userPage.php?error=Error occurred while ordering products.");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed without POST method
    header("Location: ../shop.php");
}
