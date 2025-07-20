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
    $flatnum = intval($_POST["flat-number"]);
    $towernum = intval($_POST["tower"]);
    $namee = $_POST["name"];
    $gend = $_POST["gender"];
    $phone = $_POST["phone-number"];

    // Prepare and execute the SQL statement to delete matching rows from loginids table
    $sql_delete_loginids = "DELETE FROM loginids WHERE email = ? AND passcode = ?";
    $stmt_delete_loginids = $conn->prepare($sql_delete_loginids);
    $stmt_delete_loginids->bind_param("ss", $user, $pass);
    if (!$stmt_delete_loginids->execute()) {
        die("Error deleting record from loginids: " . $stmt_delete_loginids->error);
    }

    // Prepare and execute the SQL statement to delete matching rows from mem_residents table
    $sql_delete_mem_residents = "DELETE FROM mem_residents WHERE flatno = ? AND towerno = ? AND resi_name = ? AND gender = ? AND phone = ?";
    $stmt_delete_mem_residents = $conn->prepare($sql_delete_mem_residents);
    $stmt_delete_mem_residents->bind_param("iisss", $flatnum, $towernum, $namee, $gend, $phone);
    
    if (!$stmt_delete_mem_residents->execute()) {
        die("Error deleting record from mem_residents: " . $stmt_delete_mem_residents->error);
    }
    
    $sql_delete_user_res = "DELETE FROM user_res WHERE email = ? AND passcode = ? AND towerno = ? AND flatno = ?";
    $stmt_delete_user_res = $conn->prepare($sql_delete_user_res);
    $stmt_delete_user_res->bind_param("ssii", $user, $pass, $towernum, $flatnum);
    
    if (!$stmt_delete_user_res->execute()) {
        die("Error deleting record from user_res: " . $stmt_delete_user_res->error);
    }

    // Check if both deletions are successful
    if ($stmt_delete_loginids->affected_rows > 0 && $stmt_delete_mem_residents->affected_rows > 0 && $stmt_delete_user_res->affected_rows > 0) {
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
