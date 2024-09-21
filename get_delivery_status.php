<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query to get delivery status for each product
$sql_delivery_status = "SELECT ProductID, DeliveredAt FROM supplierproducts";
$result_delivery_status = $connection->query($sql_delivery_status);

if ($result_delivery_status) {
    $delivery_status = array();

    while ($row = $result_delivery_status->fetch_assoc()) {
        $delivery_status[$row['ProductID']] = $row['DeliveredAt'];
    }

    // Output delivery status data as JSON
    header('Content-Type: application/json');
    echo json_encode($delivery_status);
} else {
    // Error handling
    echo json_encode(array('error' => 'Failed to fetch delivery status'));
}

$connection->close();
?>
