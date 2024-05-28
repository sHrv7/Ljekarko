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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if username or password is empty
    if (empty($username) || empty($password)) {
        header("Location: ../login.php?error=Username and password cannot be empty.");
        exit();
    } else {
        // Check if username exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $storedPassword = $row["Password"];
            // Verify password
            if (password_verify($password, $storedPassword)) {
                // Store username in session
                $_SESSION['username'] = $username;
                $_SESSION['admin'] = $row["Admin"];
                // Redirect to home page
                header("Location: ../home.php");
                exit();
            } else {
                header("Location: ../login.php?error=Incorrect password.");
                exit();
            }
        } else {
            header("Location: ../login.php?error=Username does not exist.");
            exit();
        }
    }

    $stmt->close();
    $conn->close();
}
