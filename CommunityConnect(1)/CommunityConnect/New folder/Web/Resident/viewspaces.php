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
    $flatno = intval($_POST["flatno"]);
    $towerno = intval($_POST["towerno"]);
    $email = $_POST["email"];
    $passcode = $_POST["passcode"];

    // Prepare and execute the SQL statement to check user authentication
    $sql_authenticate_user = "SELECT * FROM user_res WHERE email = ? AND passcode = ? AND towerno = ? AND flatno = ?";
    $stmt_authenticate_user = $conn->prepare($sql_authenticate_user);
    $stmt_authenticate_user->bind_param("ssii", $email, $passcode, $towerno, $flatno);
    $stmt_authenticate_user->execute();
    $result_authenticate_user = $stmt_authenticate_user->get_result();

    // Check if user is authenticated
    if ($result_authenticate_user->num_rows > 0) {
        // Get the current date
        $current_date = date('Y-m-d');

        // Prepare and execute the SQL statement to select booked spaces after today
        $sql_booked_spaces = "SELECT * FROM bookings WHERE flatno = ? AND towerno = ? AND datey >= ?";
        $stmt_booked_spaces = $conn->prepare($sql_booked_spaces);
        $stmt_booked_spaces->bind_param("iis", $flatno, $towerno, $current_date);
        $stmt_booked_spaces->execute();
        $result_booked_spaces = $stmt_booked_spaces->get_result();

        // Check if any row is returned
        if ($result_booked_spaces->num_rows > 0) {
            // Output the data in HTML format
            echo "<style>";
            echo "
                /* Style for table */
                .table {
                    width: 100%;
                    border-collapse: collapse;
                    border: 1px solid #ddd;
                }

                /* Style for table headers */
                .table th {
                    padding: 12px 15px;
                    text-align: left;
                    background-color: #f2f2f2;
                    border: 1px solid #ddd;
                }

                /* Style for table rows */
                .table td {
                    padding: 12px 15px;
                    border: 1px solid #ddd;
                }

                /* Style for alternate table rows */
                .table tbody tr:nth-child(even) {
                    background-color: #f9f9f9;
                }

                /* Hover effect for table rows */
                .table tbody tr:hover {
                    background-color: #f2f2f2;
                }

                h2 {
                    text-align: center;
                }
            ";
            echo "</style>";

            echo "<h2>Booked Spaces</h2>";
            echo "<table class='table'>";
            echo "<thead><tr><th>Area</th><th>Date</th><th>Time Slot</th></tr></thead>";
            echo "<tbody>";

            // Loop through each row of the result set
            while ($row = $result_booked_spaces->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['area'] . "</td>";
                echo "<td>" . $row['datey'] . "</td>";
                echo "<td>" . $row['timeslot'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "No booked spaces found for the specified flat number and tower number after today.";
        }

        // Close the result sets and statements
        $stmt_booked_spaces->close();
        $stmt_authenticate_user->close();
    } else {
        echo "Invalid email, passcode, towerno, or flatno."; // If no match found for the provided details
    }
}

// Close the connection
$conn->close();
?>
