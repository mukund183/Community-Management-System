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
function generateOTP($conn) {
    do {
        $otp = mt_rand(100000, 999999); // Generate random 6-digit OTP
        // Check if the OTP already exists in the table
        $sql1 = "SELECT * FROM passcodes WHERE otp = $otp";
        $sql2 = "SELECT * FROM activevisitors WHERE otp = $otp";
        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);
    } while ($result1 && $result2 && $result1->num_rows > 0 && $result2->num_rows > 0); // Repeat until a unique OTP is generated
    return $otp;
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $visitorName = $_POST["visitorName"];
    $visitDate = $_POST["visitDate"];
    $flatno = intval($_POST["flatno"]);
    $towerno = intval($_POST["towerno"]);

    // Generate a random unique 6-digit OTP
    $otp = generateOTP($conn);

    // Prepare and execute the SQL statement to insert data into the passcodes table
    $sql = "INSERT INTO passcodes (visiname, visidate, flatno, towerno, otp) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiii", $visitorName, $visitDate, $flatno, $towerno, $otp); 

    // Execute the SQL statement
    $success = $stmt->execute();

    // Check if insertion is successful
    if ($success) {
        // Display the OTP
        echo "Visitor added successfully! OTP: $otp";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Function to generate a random unique 6-digit OTP


// Close connection
$conn->close();
?>
