<?php
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
$email = $_POST['email'];
$slot_number = $_POST['slot_number'];

// Check if slot is available
$stmt = $conn->prepare("SELECT is_booked FROM parking_slots WHERE slot_number = ?");
$stmt->bind_param("i", $slot_number);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($is_booked);
$stmt->fetch();

if ($is_booked) {
    die("Slot is already booked.");
}

// Book the slot
$stmt = $conn->prepare("UPDATE parking_slots SET is_booked = 1 WHERE slot_number = ?");
$stmt->bind_param("i", $slot_number);
$stmt->execute();

// Save booking details
$stmt = $conn->prepare("INSERT INTO slot_booking (emailid, slot_number) VALUES (?, ?)");
$stmt->bind_param("si", $email, $slot_number);
$stmt->execute();

echo "Slot booked successfully!";

$stmt->close();
$conn->close();
?>
