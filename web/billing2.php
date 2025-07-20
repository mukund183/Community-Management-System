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
    $flatNumber = intval($_POST["flat-number"]); // Convert to integer
    $tower = intval($_POST["tower"]); // Convert to integer
    $mont = $_POST["mont"];
    $amount = intval($_POST["Amount"]); // Convert to integer

    // Prepare and execute the SQL statement to insert data into the table
    $sql = "INSERT INTO maintanencebills (flatno, towerno, mon, dueamt) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $flatNumber, $tower, $mont, $amount); // 'i' indicates integer
    
    if ($stmt->execute()) {
        // If insertion is successful, redirect back to the dashboard
        header("Location: /CommunityConnect(1)/CommunityConnect/New folder/Web/admin/admin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Close connection
$conn->close();
?>
