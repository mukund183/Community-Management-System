<?php
// Database connection parameters
$servername = 'localhost';
$username = 'debian-sys-maint';
$password = 'K4T6WgsyiTj09wY7';
$database = 'dbms_proj';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $selectDate = $_POST["selectDate"];
    $selectTimeSlot = $_POST["selectTimeSlot"];
    $selectArea = $_POST["selectArea"];
    $flatno = $_POST["flatno"];
    $towerno = $_POST["towerno"];

    // Check if the selected slot is available
    $sql_check = "SELECT * FROM bookings WHERE datey = '$selectDate' AND timeslot = '$selectTimeSlot' AND area = '$selectArea'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        echo "Slot not available. Please choose another slot.";
    } else {
        // Slot is available, insert into bookings table
        $sql_insert = "INSERT INTO bookings (datey, timeslot, area, flatno, towerno) VALUES ('$selectDate', '$selectTimeSlot', '$selectArea', '$flatno', '$towerno')";
        if (mysqli_query($conn, $sql_insert)) {
            echo "Booking successful!";
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    }
}

// Close connection
mysqli_close($conn);
?>
