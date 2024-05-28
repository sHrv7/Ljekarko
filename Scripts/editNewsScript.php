<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $oldTitle = $_POST["oldTitle"];
    $title = $_POST["title"];
    $image = $_POST["image"];
    $text = $_POST["text"];
    $link = $_POST["link"];
    $date = date("Y-m-d"); // Current date

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
    $sql = "UPDATE news SET Title=?, Image=?, Text=?, Date=?, Link=? WHERE Title=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $title, $image, $text, $date, $link, $oldTitle);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../news.php");
    } else {
        // Redirect with error message
        header("Location: ../userPage.php?error=Error occurred while updating news.");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed without POST method
    header("Location: ../news.php");
}
?>
