<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);


$product_id = "";
$product_name = "";
$description = "";
$price = "";
$supplier_id = "";
$quantity = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $supplier_id = $_POST["supplier_id"];
    $quantity = $_POST["quantity"];

    // Check for duplicates
    $sql = "SELECT * FROM products WHERE product_name='$product_name' OR supplier_id='$supplier_id'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $errorMessage = "Product with the same name or supplier ID already exists.";
    } else {
        // Add new product to the database
        $sql = "INSERT INTO products (product_id, product_name, description, price, supplier_id, quantity) " .
            "VALUES ('$product_id', '$product_name', '$description', '$price', '$supplier_id', '$quantity')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $product_id = "";
            $product_name = "";
            $description = "";
            $price = "";
            $supplier_id = "";
            $quantity = "";

            $successMessage = "Product added correctly";

            header("Location: /myshop/index.php");
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
    <a class="btn btn-primary mb-3" href="/myshop/index.php" role="button">Product List</a>
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
                <input type="text" class="form-control" name="product_id" value="<?php echo $product_id; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Product Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="product_name" value="<?php echo $product_name; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Price</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Supplier ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="supplier_id" value="<?php echo $supplier_id; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Quantity</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
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
                <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
