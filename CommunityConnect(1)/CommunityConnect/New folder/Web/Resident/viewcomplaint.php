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

    // Prepare and execute the SQL statement to select data from complaints table
    $sql_current_complaints = "SELECT * FROM complaints WHERE towerno = ? AND flatno = ?";
    $stmt_current_complaints = $conn->prepare($sql_current_complaints);
    $stmt_current_complaints->bind_param("ii", $towerno, $flatno);
    $stmt_current_complaints->execute();
    $result_current_complaints = $stmt_current_complaints->get_result();

    // Prepare and execute the SQL statement to select data from past complaints table
    $sql_past_complaints = "SELECT * FROM pastcomplaints WHERE towerno = ? AND flatno = ?";
    $stmt_past_complaints = $conn->prepare($sql_past_complaints);
    $stmt_past_complaints->bind_param("ii", $towerno, $flatno);
    $stmt_past_complaints->execute();
    $result_past_complaints = $stmt_past_complaints->get_result();

    // Check for SQL errors
    if (!$result_current_complaints || !$result_past_complaints) {
        die("Error executing query: " . $conn->error);
    }

    // Output the data for current complaints
    if ($result_current_complaints->num_rows > 0) {
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
        echo "<thead><tr><th>Place</th><th>Time Slot</th><th>Problem</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result_current_complaints->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['place'] . "</td>";
            echo "<td>" . $row['timeslot'] . "</td>";
            echo "<td>" . $row['problem'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No current complaints found for the specified flatno and towerno.</p>";
    }

    // Output the data for past complaints
    if ($result_past_complaints->num_rows > 0) {
        echo "<h2>Past Complaints</h2>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Place</th><th>Time Slot</th><th>Problem</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result_past_complaints->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['place'] . "</td>";
            echo "<td>" . $row['timeslot'] . "</td>";
            echo "<td>" . $row['problem'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No past complaints found for the specified flatno and towerno.</p>";
    }

    // Close statements
    $stmt_current_complaints->close();
    $stmt_past_complaints->close();
}

// Close connection
$conn->close();
?>
