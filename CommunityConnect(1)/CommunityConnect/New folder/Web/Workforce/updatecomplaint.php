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
    $flatno = intval($_POST["flatno"]);
    $towerno = intval($_POST["towerno"]);
    $place = $_POST["place"];
    $timeslot = $_POST["timeslot"];
    $problem = $_POST["problem"];

    // Prepare and execute the SQL statement to delete the row from the complaints table
    $sql_delete_complaint = "DELETE FROM complaints WHERE flatno = ? AND towerno = ? AND place = ? AND timeslot = ? AND problem = ?";
    $stmt = $conn->prepare($sql_delete_complaint);
    $stmt->bind_param("iisss", $flatno, $towerno, $place, $timeslot, $problem);
    if ($stmt->execute()) {
        echo "Complaint deleted successfully!";
    } else {
        echo "Error deleting complaint: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
mysqli_close($conn);
?>
