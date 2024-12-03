<?php
// Database connection
$servername = "localhost";
$username = "root";  // Adjust if necessary
$password = "";      // Adjust if necessary
$dbname = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from uploads table
$sql = "SELECT id, name, ai_percentage, file_path, upload_time FROM uploads";
$result = $conn->query($sql);

// Get total number of students
$total_students = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student File Analysis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .table-container {
            width: 80%;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background-color: #3a77b8;
            color: white;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            font-size: 16px;
        }
        tbody tr:nth-child(even) {
            background-color: #e9f2fb;
        }
        tbody tr:hover {
            background-color: #cce4f7;
            cursor: pointer;
        }
        .ai-percentage {
            font-weight: bold;
            color: #3a77b8;
        }
        .heading {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #3a77b8;
        }
        .total-students {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>

<div>
    <!-- Heading for Student Data -->
    <div class="heading">Student Data for AI</div>

    <!-- Total Students Display -->
    <div class="total-students">
        <strong>Total Students:</strong> <?php echo $total_students; ?>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>AI Percentage</th>
                    <th>File Path</th>
                    <th>Upload Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any results
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td class='ai-percentage'>" . $row["ai_percentage"] . "%</td>
                                <td>" . $row["file_path"] . "</td>
                                <td>" . $row["upload_time"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Close connection
$conn->close();
?>

</body>
</html>
