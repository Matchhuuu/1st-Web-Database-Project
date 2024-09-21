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
    <a class="btn btn-primary mb-3" href="/myshop/home.php" role="button">Back to Homepage</a>
    <h2>Supplier Branches</h2>
    <a class="btn btn-success mb-3" href="/myshop/createsupplierbranch.php" role="button">Add Transfer</a>
    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th> <!-- Added Product ID column -->
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Delivered</th>
                <th>SupplierBranch</th>
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

// Read data from the Supplierbranch table
$sql_supplier_branch = "SELECT ProductID, Product, PricePerProduct,SupplierBranch, SupplierName, Quantity, DeliveredAt FROM Supplierbranch";
$result_supplier_branch = $connection->query($sql_supplier_branch);

if (!$result_supplier_branch) {
    die("Invalid query: " . $connection->error);
}

// Output data of each row from the Supplierbranch table
while ($row = $result_supplier_branch->fetch_assoc()) {
    echo "
    <tr>
        <td>{$row['ProductID']}</td>
        <td>{$row['Product']}</td>
        <td>{$row['PricePerProduct']}</td>
        <td>{$row['SupplierName']}</td>
        <td>{$row['Quantity']}</td>
        <td>{$row['DeliveredAt']}</td>
        <td>{$row['SupplierBranch']}</td>
        <td>
        <a class='btn btn-primary btn-sm' href='/myshop/editsupplierbranch.php?id={$row['ProductID']}'>Edit</a>
        <a class='btn btn-danger btn-sm' href='/myshop/deletebranchtransfer.php?id={$row['ProductID']}'>Delete</a>
        </td>

    </tr>
    ";
}
?>
        </tbody>
    </table>
</div>
</body>
</html>
