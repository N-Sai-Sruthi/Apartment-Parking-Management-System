<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "N.saisruthi20";
$dbname = "carparkingwebsite";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT password FROM userdetails WHERE emailid = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

// Check if email exists
if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        echo "Login successful!";
        // Redirect to another page or dashboard
        header("Location: bookingparkingslot2.html");
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No account found with that email.";
    header("Location: createaccount.html");
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
