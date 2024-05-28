<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $image = $_POST["image"];
    $text = $_POST["text"];
    $date = date("Y-m-d"); // Current date
    $link = $_POST["link"];

    // Validate form data
    if (empty($title) || empty($image) || empty($text) || empty($link)) {
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
    $sql = "INSERT INTO news (Title, Image, Text, Date, Link) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $image, $text, $date, $link);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../news.php");
    } else {
        header("Location: ../UserPage.php?error=Error occurred while adding news.");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
