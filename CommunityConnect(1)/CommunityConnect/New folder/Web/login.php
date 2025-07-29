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
    // Retrieve the credentials from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare SQL statement to fetch user credentials
    $sql = "SELECT * FROM loginids WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();
        // Verify password
        if ($password === $row["passcode"]) {
            // Redirect based on the role
            switch ($row["designation"]) {
                case "admin":
                    header("Location: /CommunityConnect(1)/CommunityConnect/New%20folder/Web/admin/admin.php");
                    exit();
                case "resident":
                    header("Location: /CommunityConnect(1)/CommunityConnect/New%20folder/Web/Resident/Resident.php");
                    exit();
                case "security":
                    header("Location: /CommunityConnect(1)/CommunityConnect/New%20folder/Web/Security/Security.php");
                    exit();
                case "workforce":
                    header("Location: /CommunityConnect(1)/CommunityConnect/New%20folder/Web/Workforce/Workforce.php");
                    exit();
                default:
                    echo "Invalid designation";
                    exit();
            }
        } else {
            // If password is incorrect, display an error message
            echo "Invalid password";
        }
    } else {
        // If user does not exist, display an error message
        echo "User not found";
    }
}

// Close connection
mysqli_close($conn);
?>

