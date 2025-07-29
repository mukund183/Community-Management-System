<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard | Admin</title>
    <title>Notices</title>
<style>
    .scrolling-notice {
        position: fixed;
        top: 0;
        width: 100%;
        background-color: #f5f5f5;
        overflow-x: scroll;
        white-space: nowrap;
        padding: 10px 20px;
    }
    .notice-item {
        display: inline-block;
        margin-right: 20px;
    }
</style>
</head>

<body>
    <div class="container">
        <div class="menu">
            <div class="menu-header">
                Dashboard Menu
            </div>
            <ul>
                <li><a href="#" onclick="redirectToPage('Add_Bills.html')">Add Bills</a></li>
                <li><a href="#" onclick="redirectToPage('AorR_residents.html')">Add or Remove Residents</a></li>
                <li><a href="#" onclick="redirectToPage('AorR_Security.html')">Add or Remove Security</a></li>
                <li><a href="#" onclick="redirectToPage('AorR_WorkForce.html')">Add or Remove Workfoce</a></li>
                <li><a href="#" onclick="redirectToPage('AorR_Complaint.html')">Add or View Complaints</a></li>
                <li><a href="#" onclick="redirectToPage('ViewMembers.html')">View Members</a></li>
                <li><a href="#" onclick="redirectToPage('Addnotice.html')">Add Notice</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="scrolling-notice">
                <h2>Notices: </h2>
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

    // Retrieve notices with end date after current date
    $currentDate = date('Y-m-d');
    $sql = "SELECT notice FROM notices WHERE enddate >= '$currentDate' and startdate<='$currentDate'";
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Display notices
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="notice-item">' . $row['notice'] . '</div>';
        }
    } else {
        echo "No notices at the moment.";
    }

    // Close connection
    mysqli_close($conn);
?>

            </div>

            <div class="info-box">
                <h2>Welcome to Community Connect</h2>

            </div>
            <div class="logout-btn">
                <button><a href="#" onclick="redirectToPage('/CommunityConnect(1)/CommunityConnect/New folder/Web/login.html')">Logout</a></button>            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>