<?php
header('Content-Type: application/json');

// connect to the database
$conn = new mysqli('localhost', 'root', 'password', 'ros_e');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sqlQuery = "SELECT temp FROM data ORDER BY timestamp";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>