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
    <h2>Summary of Products</h2>
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
    <a class="btn btn-success mb-3" href="/myshop/inventorysum.php" role="button">Inventory Summary</a>
    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Delivered</th>
                <th>Branch</th> <!-- New column for SupplierBranch -->
                <th>Actions</th> <!-- Actions column -->
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

        // Read data from both tables using UNION with COALESCE to set default branch
        $sql_union = "
    SELECT 
        sp.ProductID,
        sp.Product,
        sp.PricePerProduct,
        sp.SupplierName,
        sp.Quantity,
        sp.DeliveredAt,
        COALESCE(sb.SupplierBranch, 'Home Branch') AS SupplierBranch
    FROM 
        supplierproducts sp
    LEFT OUTER JOIN 
        supplierbranch sb ON sp.ProductID = sb.ProductID
    UNION
    SELECT 
        ProductID, 
        Product, 
        PricePerProduct, 
        SupplierName, 
        Quantity, 
        DeliveredAt, 
        COALESCE(SupplierBranch, 'Default Branch') AS SupplierBranch 
    FROM 
        supplierbranch
    UNION
    SELECT 
        ProductID, 
        Product, 
        PricePerProduct, 
        SupplierName, 
        Quantity, 
        DeliveredAt, 
        SupplierBranch 
    FROM 
        returnedgoods
";


        $result = $connection->query($sql_union);

        if (!$result) {
            die("Invalid query: " . $connection->error);
        }

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>{$row['ProductID']}</td>
                <td>{$row['Product']}</td>
                <td>{$row['PricePerProduct']}</td>
                <td>{$row['SupplierName']}</td>
                <td>{$row['Quantity']}</td>
                <td>{$row['DeliveredAt']}</td>
                <td>{$row['SupplierBranch']}</td> <!-- Display the SupplierBranch value -->
                <td>
                    <a class='btn btn-danger btn-sm' href='/myshop/delete.php?id={$row['ProductID']}'>Delete</a>
                </td>
            </tr>
            ";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            var found = false;
            var tds = tr[i].getElementsByTagName("td");
            for (var j = 1; j < tds.length - 1; j++) { 
                td = tds[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    var index = txtValue.toUpperCase().indexOf(filter);
                    if (index > -1) {
                        found = true;
                        var highlighted = txtValue.substring(0, index) + "<span class='highlight'>" + txtValue.substring(index, index + filter.length) + "</span>" + txtValue.substring(index + filter.length);
                        td.innerHTML = highlighted;
                    } else {
                        // Remove existing highlighting
                        td.innerHTML = txtValue;
                    }
                }
            }
            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    });

    // Function to handle "Generate Report" button click
    document.getElementById("generateReportBtn").addEventListener("click", function() {
        // Add your functionality here
        // For example, redirect to the report generation page
        window.location.href = "/myshop/generate_report.php";
    });
</script>
</body>
</html>
