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

// Fetch available slots
$sql = "SELECT slot_number FROM parking_slots WHERE is_booked = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output each slot as a button
    while ($row = $result->fetch_assoc()) {
        $slot_number = $row['slot_number'];
        echo "<button class='slot-button slotbutton1' data-slot='$slot_number'>Slot $slot_number</button>";
    }
} else {
    echo "No slots available.";
}

$conn->close();
?>
