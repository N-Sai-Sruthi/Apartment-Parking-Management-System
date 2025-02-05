<?php
$servername = "localhost";
$username = "root";
$password = "N.saisruthi20";
$databasename = "carparkingwebsite";

// Create a new mysqli connection
$conn = new mysqli($servername, $username, $password, $databasename);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$emailid = $_POST['emailid'];
$password = $_POST['password'];

// Prepare and execute statement to get hashed password
$stmt = $conn->prepare("SELECT password FROM userdetails WHERE emailid = ?");
$stmt->bind_param("s", $emailid);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashedpassword);
    $stmt->fetch();

    // Verify the password
    if (password_verify($password, $hashedpassword)) {
        // Prepare and execute statement to get slot numbers
        $stmt2 = $conn->prepare("SELECT slot_number FROM slot_booking WHERE emailid = ?");
        $stmt2->bind_param("s", $emailid);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($slot_number);

        if ($stmt2->num_rows > 0) {
            while ($stmt2->fetch()) {
                // Output each slot number as a button
                echo "<button class='slot-button slotbutton1' data-slot='$slot_number'>Slot $slot_number</button>";
            }
        } else {
            echo "<p>No slots booked</p>";
        }

        // Close the second statement
        $stmt2->close();
    } else {
        echo "<p>Invalid password</p>";
    }

    // Close the first statement
    $stmt->close();
} else {
    echo "<p>No user found with that email</p>";
}

// Close the connection
$conn->close();
?>
