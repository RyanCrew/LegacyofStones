<?php

// Connect to the database
$servername = 'localhost';
$username = 'username';
$password = 'password';
$dbname = 'database';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Prepare the SQL query
$searchTerm = $conn->real_escape_string($_GET['query']);
$sql = "SELECT * FROM item_proto WHERE item_name LIKE '%" . $searchTerm . "%'";
$result = $conn->query($sql);

$items = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($items);

$conn->close();
?>