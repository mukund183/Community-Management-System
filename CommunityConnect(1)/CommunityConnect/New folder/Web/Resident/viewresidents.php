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
    $tower = intval($_POST["tower"]);
    $flat_number = intval($_POST["flat-number"]);

    // Prepare and execute the SQL statement to select data from mem_residents table
    $sql = "SELECT * FROM mem_residents WHERE towerno = ? AND flatno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $tower, $flat_number);
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

        echo "<h2>Residents</h2>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Name</th><th>Flat Number</th><th>Tower Number</th><th>Gender</th><th>Phone</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['resi_name'] . "</td>";
            echo "<td>" . $row['flatno'] . "</td>";
            echo "<td>" . $row['towerno'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No residents found for the specified tower and flat number.";
    }

    // Close statement
    $stmt->close();
}
?>
