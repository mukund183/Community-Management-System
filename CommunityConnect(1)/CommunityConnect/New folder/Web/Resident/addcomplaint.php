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
    
    $place = $_POST["place"];
    $timeslot = $_POST["time"]; 
    $problem = $_POST["problem"];
    $flatno=intval($_POST["flatno"]);
    $towerno=intval($_POST["towerno"]);
   



    // Prepare and execute the SQL statement to insert data into the mem_residents table
    $sql_complaints = "INSERT INTO complaints (place, timeslot, problem,towerno,flatno) VALUES (?, ?, ?, ?, ?)";
    $stmt_complaints = $conn->prepare($sql_complaints); // Corrected variable name
    $stmt_complaints->bind_param("sssii", $place, $timeslot, $problem,$towerno,$flatno); // 'i' indicates integer, 's' indicates string

    // Execute both SQL statements
   
    $complaints_success = $stmt_complaints->execute();

    // Check if the insertion is successful
    if ($complaints_success) {
        // Display a JavaScript popup message
        echo "Complaint is registered successfully";
    } else {
        // Provide an error message
        echo "Error: " . $sql_complaints . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
