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
    $email = $_POST["email"];
    $passcode = $_POST["passcode"];
    $towerno = intval($_POST["towerno"]);
    $flatno = intval($_POST["flatno"]);

    // Prepare and execute the SQL statement to check if email and passcode match in user_res table
    $sql_user_res = "SELECT * FROM user_res WHERE email = ? AND passcode = ? AND towerno = ? AND flatno = ?";
    $stmt_user_res = $conn->prepare($sql_user_res);
    $stmt_user_res->bind_param("ssii", $email, $passcode, $towerno, $flatno);
    $stmt_user_res->execute();
    $result_user_res = $stmt_user_res->get_result();

    // Check if any row is returned
    if ($result_user_res->num_rows > 0) {
        // Prepare and execute the SQL statement to select passcodes for the current user
        $sql_passcodes = "SELECT visiname, visidate, otp FROM passcodes WHERE towerno = ? AND flatno = ?";
        $stmt_passcodes = $conn->prepare($sql_passcodes);
        $stmt_passcodes->bind_param("ii", $towerno, $flatno);
        $stmt_passcodes->execute();
        $result_passcodes = $stmt_passcodes->get_result();

        // Check if any row is returned
        if ($result_passcodes->num_rows > 0) {
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

            echo "<h2>Expected Visitors:</h2>";
            echo "<table class='table'>";
            echo "<thead><tr><th>Visitor Name</th><th>Visit Date</th><th>OTP</th></tr></thead>";
            echo "<tbody>";
            while ($row_passcodes = $result_passcodes->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_passcodes['visiname'] . "</td>";
                echo "<td>" . $row_passcodes['visidate'] . "</td>";
                echo "<td>" . $row_passcodes['otp'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
            // Prepare and execute the SQL statement to select past visitors for the current user
            

            // Additional code for displaying active and past visitors...
        } else {
            echo "No expected visitors found for the provided details.";
        }
        $sql_past_visitors = "SELECT visname, visdate, otp FROM pastvisitors WHERE towerno = ? AND flatno = ?";
            $stmt_past_visitors = $conn->prepare($sql_past_visitors);
            $stmt_past_visitors->bind_param("ii", $towerno, $flatno);
            $stmt_past_visitors->execute();
            $result_past_visitors = $stmt_past_visitors->get_result();
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

            // Check if any row is returned
            if ($result_past_visitors->num_rows > 0) {
                // Output the data in HTML format
                echo "<h2>Past Visitors:</h2>";
                echo "<table class='table'>";
                echo "<thead><tr><th>Visitor Name</th><th>Visit Date</th><th>OTP</th></tr></thead>";
                echo "<tbody>";
                while ($row_past_visitors = $result_past_visitors->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_past_visitors['visname'] . "</td>";
                    echo "<td>" . $row_past_visitors['visdate'] . "</td>";
                    echo "<td>" . $row_past_visitors['otp'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No past visitors found for the specified flatno and towerno.";
            }

        // Close the result sets and statements
        $result_passcodes->close();
        $stmt_passcodes->close();
    } else {
        echo "Invalid email, passcode, towerno, or flatno."; // If no match found for the provided details
    }

    // Close the statement
    $stmt_user_res->close();
}

// Close the connection
$conn->close();
?>
