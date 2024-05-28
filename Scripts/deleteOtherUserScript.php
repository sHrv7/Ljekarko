<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["username"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Ljekarko";
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the delete query
    $sql = "DELETE FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../userPage.php");
    } else {
        // Redirect with error message
        header("Location: ../userPage.php?error=Error occurred while deleting user.");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed without POST method
    header("Location: ../userPage.php");
}
