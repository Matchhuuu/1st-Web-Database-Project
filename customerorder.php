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
    <h2>List of Orders</h2>
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
    <table class="table"> 
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Supplier ID</th>
                <th>Quantity</th>
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

            // Read all rows from the database table
            $sql = "SELECT * FROM Products ORDER BY product_id ASC";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['supplier_id']}</td>
                    <td>{$row['quantity']}</td>
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
