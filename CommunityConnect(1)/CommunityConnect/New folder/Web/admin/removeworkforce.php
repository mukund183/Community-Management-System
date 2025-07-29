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
    $phone = $_POST["phone-number"];
    $field = $_POST["field"];

    // Prepare and execute the SQL statement to delete matching rows from loginids table
    $sql_delete_loginids = "DELETE FROM loginids WHERE email = ? AND passcode = ?";
    $stmt_delete_loginids = $conn->prepare($sql_delete_loginids);
    $stmt_delete_loginids->bind_param("ss", $user, $pass);
    if (!$stmt_delete_loginids->execute()) {
        die("Error deleting record from loginids: " . $stmt_delete_loginids->error);
    } else {
        echo "Deleted from loginids table.";
    }

    // Prepare and execute the SQL statement to delete matching rows from mem_workforce table
    $sql_delete_mem_workforce = "DELETE FROM mem_workforce WHERE worker_name = ? AND phone = ? AND field = ?";
    $stmt_delete_mem_workforce = $conn->prepare($sql_delete_mem_workforce);
    $stmt_delete_mem_workforce->bind_param("sss", $namee, $phone, $field);
    if (!$stmt_delete_mem_workforce->execute()) {
        die("Error deleting record from mem_workforce: " . $stmt_delete_mem_workforce->error);
    } else {
        echo "Deleted from mem_workforce table.";
    }

    // Check if both deletions are successful
    if ($stmt_delete_loginids->affected_rows > 0 && $stmt_delete_mem_workforce->affected_rows > 0) {
        // If both deletions are successful, redirect back to the dashboard
        ob_start(); // Start output buffering
        header("Location: /CommunityConnect(1)/CommunityConnect/New%20folder/Web/admin/admin.php");
        ob_end_flush(); // Flush output buffer
        exit(); // Ensure no further code execution occurs
    } else {
        // If deletion fails in any table, provide an error message
        echo "Deletion failed or no records matched the criteria.";
    }
}

// Close connection
$conn->close();
?>
