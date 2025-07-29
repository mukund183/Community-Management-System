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
    $sec_id = $_POST["security_id"];
    $namee = $_POST["name"];
    $phone = $_POST["phone-number"];
    $place = $_POST["assigned_place"];

    // Prepare and execute the SQL statement to delete matching rows from loginids table
    $sql_delete_loginids = "DELETE FROM loginids WHERE email = ? AND passcode = ?";
    $stmt_delete_loginids = $conn->prepare($sql_delete_loginids);
    $stmt_delete_loginids->bind_param("ss", $user, $pass);
    if (!$stmt_delete_loginids->execute()) {
        die("Error deleting record from loginids: " . $stmt_delete_loginids->error);
    }

    // Prepare and execute the SQL statement to delete matching rows from mem_security table
    $sql_delete_mem_security = "DELETE FROM mem_security WHERE security_id = ? AND sec_name = ? AND phone = ? AND assigned_place = ?";
    $stmt_delete_mem_security = $conn->prepare($sql_delete_mem_security);
    $stmt_delete_mem_security->bind_param("ssss", $sec_id, $namee, $phone, $place);
    if (!$stmt_delete_mem_security->execute()) {
        die("Error deleting record from mem_security: " . $stmt_delete_mem_security->error);
    }

    // Check if both deletions are successful
    if ($stmt_delete_loginids->affected_rows > 0 || $stmt_delete_mem_security->affected_rows > 0) {
        // If both deletions are successful, redirect back to the dashboard
        header("Location: /CommunityConnect(1)/CommunityConnect/New folder/Web/admin/admin.php");
        exit();
    } else {
        // If deletion fails in any table, provide an error message
        echo "Deletion failed or no records matched the criteria.";
    }
}

// Close connection
$conn->close();
?>
