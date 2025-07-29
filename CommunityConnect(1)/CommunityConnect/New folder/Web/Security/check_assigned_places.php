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
    $place = $_POST["place_name"];

    // Prepare and execute the SQL statement to select data from mem_security table
    $sql = "SELECT * FROM mem_security WHERE assigned_place = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $place);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check for SQL errors
    if (!$result) {
        die("Error executing query: " . $conn->error);
    }

    // Check if any row is returned
    if ($result->num_rows > 0) {
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

        echo "<h2>Security Details</h2>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Security ID</th><th>Name</th><th>Phone</th><th>Assigned Place</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['security_id'] . "</td>";
            echo "<td>" . $row['sec_name'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['assigned_place'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No security details found in the specified Place.";
    }

    // Close statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
