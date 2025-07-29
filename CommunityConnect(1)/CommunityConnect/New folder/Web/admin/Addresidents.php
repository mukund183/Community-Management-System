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
    $flatnum = $_POST["flat-number"];
    $towernum = $_POST["tower"];
    $namee = $_POST["name"];
    $gend = $_POST["gender"];
    $phone = $_POST["phone-number"];

    // Prepare and execute the SQL statement to insert data into the loginids table
    $sql_loginids = "INSERT INTO loginids (email, passcode, designation) VALUES (?, ?, ?)";
    $stmt_loginids = $conn->prepare($sql_loginids);
    $resident = "resident"; // Designation
    $stmt_loginids->bind_param("sss", $user, $pass, $resident); // 's' indicates string

    // Prepare and execute the SQL statement to insert data into the mem_residents table
    $sql_mem_residents = "INSERT INTO mem_residents (flatno, towerno, resi_name, gender, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt_mem_residents = $conn->prepare($sql_mem_residents);
    $stmt_mem_residents->bind_param("iissi", $flatnum, $towernum, $namee, $gend, $phone); // 'i' indicates integer, 's' indicates string
    
    $sql_user_res = "INSERT INTO user_res (email,passcode,towerno,flatno) VALUES (?, ?, ?, ?)";
    $stmt_user_res = $conn->prepare($sql_user_res);
    $stmt_user_res->bind_param("ssii", $user, $pass, $towernum, $flatnum); // 'i' indicates integer, 's' indicates string

    // Execute both SQL statements
    $loginids_success = $stmt_loginids->execute();
    $mem_residents_success = $stmt_mem_residents->execute();
    $user_res_success = $stmt_user_res->execute();

    // Check if both insertions are successful
    if ($loginids_success && $mem_residents_success && $user_res_success) {
        // If both insertions are successful, redirect back to the dashboard
        header("Location: /CommunityConnect(1)/CommunityConnect/New folder/Web/admin/admin.php");
        exit();
    } else {
        echo "Error: " . $sql_loginids . "<br>" . $conn->error;
        echo "Error: " . $sql_mem_residents . "<br>" . $conn->error;
        echo "Error: " . $sql_user_res . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
