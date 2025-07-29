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
    // Retrieve the passcode entered by security
    $passcode = $_POST["passcode"];

    // Sanitize the passcode input to prevent SQL injection
    $passcode = mysqli_real_escape_string($conn, $passcode);

    // Check if the passcode exists in passcodes table
    $sql_check_passcode = "SELECT * FROM passcodes WHERE otp = '$passcode'";
    $result_check_passcode = mysqli_query($conn, $sql_check_passcode);

    if (!$result_check_passcode) {
        echo "Error: " . mysqli_error($conn);
    } elseif (mysqli_num_rows($result_check_passcode) > 0) {
        // Passcode exists, delete the row from passcodes table
        $sql_delete_passcode = "DELETE FROM passcodes WHERE otp = '$passcode'";
        if (mysqli_query($conn, $sql_delete_passcode)) {
            echo "Visitor added successfully!";
        } else {
            echo "Error deleting passcode: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid passcode! Please try again.";
    }
}

// Close connection
mysqli_close($conn);
?>
