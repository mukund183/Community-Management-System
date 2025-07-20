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
    $notice = $_POST["notice"];
    $startdate = $_POST["startdate"];
    $enddate = $_POST["enddate"];

    // Prepare and execute the SQL statement to insert data into the notices table
    $sql = "INSERT INTO notices (notice, startdate, enddate) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $notice, $startdate, $enddate);

    if ($stmt->execute()) {
        echo "Notice added successfully!";
    } else {
        echo "Error adding notice: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
mysqli_close($conn);
?>
