<?php
// Start session to use session variables
session_start();

// Database connection 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "placement";

// Create connection
$database = new mysqli($servername, $username, $password);

// Check connection
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

// Create the database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($database->query($sql_create_db) === FALSE) {
    echo "Error creating database: " . $database->error;
}

// Add your PHP code for creating tables or other database operations here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
            background-color: #73a3d7;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            margin: 0;
            font-family: Georgia, 'Times New Roman', Times, serif;
            padding: 10px;
        }

        main {
            padding: 20px;
        }

        .placement_img_div {
            background-color: white;
            height: 60vh;
            width: 45vw;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            border-radius: 20px;
            margin-top: 40px;
        }

        .placement_img {
            width: 40vw;
            height: 40vh;
            border-radius: 20px;
        }

        button {
            background-color: #73a3d7;
            border-radius: 10px;
            color: #fff;
            border: 0px;
            height: 40px;
            width: 120px;
            cursor: pointer;
            margin-inline: 20px;
            margin-top: 20px;
            font-weight: bold;
        }

        main h2 {
            margin-top: 0;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
            height: 30px;
            text-align: right;
        }
    </style>
</head>
<body>
<header>
    <h1>Placement Management System</h1>
</header>
<main>
    <center>
        <div class="placement_img_div">
            <img class="placement_img" src="images/homepage_img.webp">
            <div>
                <button onclick="window.location.href='student/student_login.php';">Student login</button>
                <button onclick="window.location.href='Company/company_login.php';">Company login</button>
            </div>
        </div>
    </center>
</main>
<footer>
    <p>&copy; 2024 Placement Management System. All rights reserved.</p>
</footer>
</body>
</html>

