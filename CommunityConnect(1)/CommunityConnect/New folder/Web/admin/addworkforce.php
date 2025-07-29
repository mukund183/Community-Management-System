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
    $user = $_POST["username"];
    $pass = $_POST["passcode"];
    $namee = $_POST["name"];
    $phone= $_POST["phone-number"];
    $field = $_POST["field"];

    // Prepare and execute the SQL statement to insert data into the loginids table
    $sql_loginids = "INSERT INTO loginids (email, passcode, designation) VALUES (?, ?, ?)";
    $stmt_loginids = $conn->prepare($sql_loginids);
    $workforce = "workforce"; // Designation
    $stmt_loginids->bind_param("sss", $user, $pass, $workforce); // 's' indicates string

    // Prepare and execute the SQL statement to insert data into the mem_residents table
    $sql_mem_workforce = "INSERT INTO mem_workforce (worker_name,phone,field) VALUES (?, ?, ?)";
    $stmt_mem_workforce = $conn->prepare($sql_mem_workforce);
    $stmt_mem_workforce->bind_param("sss",$namee, $phone, $field); // 'i' indicates integer, 's' indicates string

    // Execute both SQL statements
    $loginids_success = $stmt_loginids->execute();
    $mem_workforce_success = $stmt_mem_workforce->execute(); // corrected typo here

    // Check if both insertions are successful
    if ($loginids_success && $mem_workforce_success) {
        // If both insertions are successful, redirect back to the dashboard
        header("Location: /CommunityConnect(1)/CommunityConnect/New folder/Web/admin/admin.php");
        exit();
    } else {
        echo "Error: " . $sql_loginids . "<br>" . $conn->error;
        echo "Error: " . $sql_mem_workforce . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
