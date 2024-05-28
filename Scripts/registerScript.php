<?php

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
        header("Location: ../register.php?error=Username and password cannot be empty.");
        exit();
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            header("Location: ../register.php?error=Username already exists.");
            exit();
        } else {
            // Check if the username is "Admin"
            if ($username === "Admin" || $username == "admin") {
                $isAdmin = true;
            } else {
                $isAdmin = false;
            }

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (Username, Password, Admin) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $username, $hashedPassword, $isAdmin);
            if ($stmt->execute()) {
                // Login user after successful registration
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['admin'] = $isAdmin;
                header("Location: ../Home.php");
                exit();
            } else {
                header("Location: ../register.php?error=Error occurred while registering user.");
                exit();
            }
        }
    }

    $stmt->close();
    $conn->close();
}
