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


    // Prepare and execute the SQL statement to select data from complaints table
    $sql_current_complaints = "SELECT * FROM complaints";
    $result_current_complaints = mysqli_query($conn, $sql_current_complaints);

    // Prepare and execute the SQL statement to select data from past complaints table
    $sql_past_complaints = "SELECT * FROM pastcomplaints";
    $result_past_complaints = mysqli_query($conn, $sql_past_complaints);

    // Check for SQL errors
    if (!$result_current_complaints || !$result_past_complaints) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Output the data for current complaints
    if (mysqli_num_rows($result_current_complaints) > 0) {
        echo "<style>";
        echo "
            /* Style for table */
            .table {
              width: 100%;
              border-collapse: collapse;
              border: 1px solid #ddd;
              margin-bottom: 20px;
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
        ";
        echo "</style>";

        echo "<h2>Current Complaints</h2>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Place</th><th>Time Slot</th><th>Problem</th><th>Flat Number</th><th>Tower Number</th></tr></thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result_current_complaints)) {
            echo "<tr>";
            echo "<td>" . $row['place'] . "</td>";
            echo "<td>" . $row['timeslot'] . "</td>";
            echo "<td>" . $row['problem'] . "</td>";
            echo "<td>" . $row['flatno'] . "</td>";
            echo "<td>" . $row['towerno'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No current complaints found for the specified flatno and towerno.</p>";
    }

    // Output the data for past complaints
    if (mysqli_num_rows($result_past_complaints) > 0) {
        echo "<h2>Past Complaints</h2>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Place</th><th>Time Slot</th><th>Problem</th><th>Flat Number</th><th>Tower Number</th><th>Time of Resolution</th></tr></thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result_past_complaints)) {
            echo "<tr>";
            echo "<td>" . $row['place'] . "</td>";
            echo "<td>" . $row['timeslot'] . "</td>";
            echo "<td>" . $row['problem'] . "</td>";
            echo "<td>" . $row['flatno'] . "</td>";
            echo "<td>" . $row['towerno'] . "</td>";
            echo "<td>" . $row['timeofresolution'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No past complaints found for the specified flatno and towerno.</p>";
    }
}

// Close connection
$conn->close();
?>
