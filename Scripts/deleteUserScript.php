<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "Ljekarko";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['username'])) {
    // Prepare and execute the delete query
    $sql = "DELETE FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();


header("Location: logoutScript.php");
