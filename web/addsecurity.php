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
    $sec_id= $_POST["security_id"];
    $namee = $_POST["name"];
    $phone= $_POST["phone-number"];
    $place = $_POST["assigned_place"];

    // Prepare and execute the SQL statement to insert data into the loginids table
    $sql_loginids = "INSERT INTO loginids (email, passcode, designation) VALUES (?, ?, ?)";
    $stmt_loginids = $conn->prepare($sql_loginids);
    $security = "security"; // Designation
    $stmt_loginids->bind_param("sss", $user, $pass, $security); // 's' indicates string

    // Prepare and execute the SQL statement to insert data into the mem_residents table
    $sql_mem_security = "INSERT INTO mem_security (security_id,sec_name, phone, assigned_place) VALUES (?, ?, ?, ?)";
    $stmt_mem_security = $conn->prepare($sql_mem_security);
    $stmt_mem_security->bind_param("ssss", $sec_id, $namee, $phone, $place); // 'i' indicates integer, 's' indicates string

    // Execute both SQL statements
    $loginids_success = $stmt_loginids->execute();
    $mem_security_success = $stmt_mem_security->execute(); // corrected typo here

    // Check if both insertions are successful
    if ($loginids_success && $mem_security_success) {
        // If both insertions are successful, redirect back to the dashboard
        header("Location: /CommunityConnect(1)/CommunityConnect/New folder/Web/admin/admin.php");
        exit();
    } else {
        echo "Error: " . $sql_loginids . "<br>" . $conn->error;
        echo "Error: " . $sql_mem_security . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
