<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

// create connection
$connection = new mysqli($servername, $username, $password, $database);

$ProductID = "";
$Product = "";
$PricePerProduct = "";
$SupplierName = "";
$Quantity = "";
$DeliveredAt = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET METHOD

    if (!isset($_GET["id"])) {
        header("location: /myshop/supplierorders.php");
        exit;
    }
    
    $ProductID = $_GET["id"];

    // read the row of the selected product from returnedgoods table
    $sql = "SELECT * FROM supplierproducts WHERE ProductID=$ProductID";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /myshop/supplierorders.php");
        exit;
    }

    $Product = $row["Product"];
    $PricePerProduct = $row["PricePerProduct"];
    $SupplierName = $row["SupplierName"];
    $Quantity = $row["Quantity"];
    $DeliveredAt = $row["DeliveredAt"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ProductID = $_POST["ProductID"];
    $Product = $_POST["Product"];
    $PricePerProduct = $_POST["PricePerProduct"];
    $SupplierName = $_POST["SupplierName"];
    $Quantity = $_POST["Quantity"];
    $DeliveredAt = $_POST["DeliveredAt"];

    if (empty($ProductID) || empty($Product) || empty($PricePerProduct) || empty($SupplierName) || empty($Quantity) || empty($DeliveredAt)) {
        $errorMessage = "All the fields are required";
    } else {
        $sql_supplierproducts = "UPDATE supplierproducts " .
            "SET Product = '$Product', PricePerProduct = '$PricePerProduct', SupplierName = '$SupplierName', Quantity = '$Quantity', DeliveredAt = '$DeliveredAt' " .
            "WHERE ProductID = $ProductID";
        
      
        $result_supplierproducts = $connection->query($sql_supplierproducts);

        if ($result_supplierproducts) {
            $successMessage = "Product updated correctly";
            header("Location: /myshop/supplierorders.php");
            exit;
        } else {
            $errorMessage = "Invalid query: " . $connection->error;
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
    <h2>Edit Returned Product</h2>

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
        <input type="hidden" name="ProductID" value="<?php echo $ProductID; ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Product</label>
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
            <label class="col-sm-3 col-form-label">Supplier Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="SupplierName" value="<?php echo $SupplierName; ?>">
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
                <input type="text" class="form-control" name="DeliveredAt" value="<?php echo $DeliveredAt; ?>">
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
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/myshop/supplierorders.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
