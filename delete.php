<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Check if the "confirm" parameter is set to "true"
    if (isset($_GET["confirm"]) && $_GET["confirm"] === "true") {
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

        // Delete product from the database
        $sql = "DELETE FROM supplierproducts WHERE ProductID=$id";
        $connection->query($sql);

        $sql = "DELETE FROM supplierbranch WHERE ProductID=$id";
        $connection->query($sql);

        $sql = "DELETE FROM returnedgoods WHERE ProductID=$id";
        $connection->query($sql);

        // Redirect to index.php after deletion
        header("Location: /myshop/index.php");
        exit;
    } else {
        // Display the confirmation HTML page
        echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Confirm Deletion</title>
                <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'>
            </head>
            <body>
                <div class='container my-5'>
                    <div class='alert alert-warning'>
                        <h4 class='alert-heading'>Confirm Deletion</h4>
                        <p>Are you sure you want to delete this product?</p>
                        <hr>
                        <div class=''>
                            <a href='/myshop/delete.php?id=$id&confirm=true' class='btn btn-danger'>Yes, Delete</a>
                            <a href='/myshop/index.php' class='btn btn-secondary'>Cancel</a>
                        </div>
                    </div>
                </div>
            </body>
            </html>
        ";
    }
} else {
    // If ID is not provided, redirect back to index.php
    header("Location: /myshop/index.php");
    exit;
}
?>
