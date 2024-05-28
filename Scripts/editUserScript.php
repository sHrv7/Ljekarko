<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["username"];
    $adminRights = $_POST["admin"];
    $adminRights = 1 - $adminRights;

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
    $sql = "UPDATE users SET Admin=? WHERE Username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $adminRights, $name);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../userPage.php");
    } else {
        // Redirect with error message
        header("Location: ../userPage.php?error=Error occurred while updating user.");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed without POST method
    header("Location: ../userPage.php");
}
