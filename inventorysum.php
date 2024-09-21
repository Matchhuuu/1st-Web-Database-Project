<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-3">
    <a class="btn btn-primary mb-3" href="/myshop/index.php" role="button">Back to Inventory</a>
    <h2>Inventory Summary</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Total Quantity</th>
                <th>Price Per Product</th>
                <th>Total Value</th>
            </tr>
        </thead>
        <tbody>
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

        // Calculate total quantity, price per product, and total value
        $sql_summary = "
            SELECT Product, SUM(Quantity) AS TotalQuantity, PricePerProduct, SUM(PricePerProduct * Quantity) AS TotalValue
            FROM (
                SELECT Product, Quantity, PricePerProduct FROM supplierproducts
                UNION ALL
                SELECT Product, Quantity, PricePerProduct FROM supplierbranch
                UNION ALL
                SELECT Product, Quantity, PricePerProduct FROM returnedgoods
            ) AS combined
            GROUP BY Product, PricePerProduct
        ";

        $result_summary = $connection->query($sql_summary);

        if (!$result_summary) {
            die("Invalid query: " . $connection->error);
        }

        // Output data of each row
        $grandTotalQuantity = 0;
        $grandTotalValue = 0;
        while ($row = $result_summary->fetch_assoc()) {
            echo "
            <tr>
                <td>{$row['Product']}</td>
                <td>{$row['TotalQuantity']}</td>
                <td>{$row['PricePerProduct']}</td>
                <td>{$row['TotalValue']}</td>
            </tr>
            ";
            $grandTotalQuantity += $row['TotalQuantity'];
            $grandTotalValue += $row['TotalValue'];
        }
        // Output grand total row
        echo "
        <tr>
            <td><strong>Grand Total</strong></td>
            <td><strong>{$grandTotalQuantity}</strong></td>
            <td></td>
            <td><strong>{$grandTotalValue}</strong></td>
        </tr>
        ";
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
