<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$ProductID = "";
$Product = "";
$PricePerProduct = "";
$SupplierName = "";
$SupplierBranch = "";
$Quantity = "";
$DeliveredAt = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ProductID = $_POST["ProductID"];
    $Product = $_POST["Product"];
    $PricePerProduct = $_POST["PricePerProduct"];
    $SupplierName = $_POST["SupplierName"];
    $SupplierBranch = $_POST["SupplierBranch"];
    $Quantity = $_POST["Quantity"];
    $DeliveredAt = $_POST["DeliveredAt"];

    // Check for duplicates
    $sql = "SELECT * FROM returnedgoods WHERE ProductID='$ProductID'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $errorMessage = "Product with the same ID already exists.";
    } else {
        // Add new product to the database
        $sql = "INSERT INTO returnedgoods (ProductID, Product, PricePerProduct, SupplierName, SupplierBranch, Quantity, DeliveredAt) " .
            "VALUES ('$ProductID', '$Product', '$PricePerProduct', '$SupplierName', '$SupplierBranch', '$Quantity', '$DeliveredAt')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $ProductID = "";
            $Product = "";
            $PricePerProduct = "";
            $SupplierName = "";
            $SupplierBranch = "";
            $Quantity = "";
            $DeliveredAt = "";

            $successMessage = "Product added correctly";

            header("Location: /myshop/returnedgoods.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-5">
    <a class="btn btn-primary mb-3" href="/myshop/returnedgoods.php" role="button">Product List</a>
    <h1>Add New Product</h1>
    <p>Please fill out the form below to add a new product:</p>

    <?php
    if (!empty($errorMessage)) {
        echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    }
    ?>
    <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Product ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="ProductID" value="<?php echo $ProductID; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Product Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="Product" value="<?php echo $Product; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Price Per Product</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="PricePerProduct" value="<?php echo $PricePerProduct; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Category</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="SupplierName" value="<?php echo $SupplierName; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Supplier Branch</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="SupplierBranch" value="<?php echo $SupplierBranch; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Quantity</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="Quantity" value="<?php echo $Quantity; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Delivered At</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="DeliveredAt" value="<?php echo $DeliveredAt; ?>">
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissal fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
            ";
        }
        ?>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/myshop/returnedgoods.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
