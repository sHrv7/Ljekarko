<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve title from post data
    $title = $_POST["title"];


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
    $sql = "DELETE FROM news WHERE Title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../news.php");
    } else {
        header("Location: ../UserPage.php?error=Error occurred while deleting news.");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
