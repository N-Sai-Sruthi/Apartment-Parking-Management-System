<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database credentials
$servername = "localhost";
$username = "root";
$password = "N.saisruthi20"; // Replace with your actual MySQL password
$dbname = "carparkingwebsite";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmpassword = $_POST['confirmpassword'] ?? '';

// Check if passwords match
if ($password !== $confirmpassword) {
    die("Passwords do not match.");
}

// Prepare and bind
$stmt = $conn->prepare("SELECT emailid FROM userdetails WHERE emailid = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

// Check if email already exists
if ($stmt->num_rows > 0) {
    die("An account with this email already exists.");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new user into the database
$stmt = $conn->prepare("INSERT INTO userdetails (emailid, password) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $hashed_password);

if ($stmt->execute()) {
    echo "Registration successful!";
    // Optionally redirect to another page
     header("Location: bookingparkingslot.html");
    // exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
