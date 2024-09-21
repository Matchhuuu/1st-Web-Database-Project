<?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "myshop";

            // Create connection
            $connection = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Sales Report</title>
</head>
<body>
    <h1>Monthly Sales Report</h1>

    <div class="report-content">
        <?php
        // Array containing sales data for each day of the month
        $salesData = array(
            1 => 100,   // Sales on day 1
            2 => 200,   // Sales on day 2
            // Add more sales data for each day as needed
        );

        // Calculate total sales for the month
        $totalSales = array_sum($salesData);

        // Display total sales
        echo "<p>Total Sales: $totalSales</p>";

        // Display daily sales data
        echo "<p>Daily Sales:</p>";
        echo "<ul>";
        foreach ($salesData as $day => $sales) {
            echo "<li>Day $day: $sales</li>";
        }
        echo "</ul>";
        ?>
    </div>
</body>
</html>