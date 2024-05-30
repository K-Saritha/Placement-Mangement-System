<?php
session_start();

// Check if the company is logged in
if (!isset($_SESSION['companyname'])) {
    // If not logged in, redirect to the login page
    header('Location: company_login.html');
    exit; // Make sure to exit after redirection
}

// Retrieve the company name from the session
$companyname = $_SESSION['companyname'];

// Establish a connection to the database
$database = new mysqli('localhost', 'root', '', 'placement');

// Check for errors in connection
if ($database->connect_error) {
    die("Connection failed: ". $database->connect_error);
}

// Prepare SQL statement with a parameter
$sql = "SELECT j.application_date, s.firstname, s.lastname, v.title, j.student_id, j.job_id
        FROM job_applications j
        INNER JOIN student_details s ON j.student_id = s.id
        INNER JOIN company_details c ON j.company_id = c.id
        INNER JOIN vacancies v ON j.job_id = v.id
        WHERE c.companyname = ?";
$statement = $database->prepare($sql);

// Check for errors in preparing the statement
if (!$statement) {
    die("Error preparing statement: ". $database->error);
}

// Bind parameter
$statement->bind_param("s", $companyname);

// Execute the statement
$result = $statement->execute();

// Check for errors in execution
if (!$result) {
    die("Error executing statement: ". $statement->error);
}

// Get the result set
$resultSet = $statement->get_result();

// Close the statement
$statement->close();

// Close the database connection
$database->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applicants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #73a3d7;
            color: #fff;
        }

        table tbody tr:hover {
            background-color: #f2f2f2;
        }

        table tbody tr td a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #73a3d7;
            transition: background-color 0.3s, color 0.3s;
        }

        table tbody tr td a:hover {
            background-color: #555;
            color: #fff;
        }
    </style>
</head>
<body>
    <h2>View Applicants</h2>
    <table>
        <thead>
            <tr>
                <th>Applied Date</th>
                <th>Student Name</th>
                <th>Job Title</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultSet->fetch_assoc()):?>
                <tr>
                    <td><?php echo $row['application_date'];?></td>
                    <td><?php echo $row['firstname']. ' '. $row['lastname'];?></td>
                    <td><?php echo $row['title'];?></td>
                    <td><a href="job_applied_student_application.php?student_id=<?php echo $row['student_id'];?>&job_id=<?php echo $row['job_id'];?>">View application</a></td>
                </tr>
            <?php endwhile;?>
        </tbody>
    </table>
</body>
</html>
