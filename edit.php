<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$product_name = "";
$description = "";
$price = "";
$supplier_name = "";
$quantity = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET METHOD

    if (!isset($_GET["id"])) {
        header("location: /myshop/index.php");
        exit;
    }

    $id = $_GET["id"];

    // Read the row of the selected product from the database table
    $sql = "SELECT * FROM Products WHERE product_id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /myshop/index.php");
        exit;
    }

    $product_name = $row["product_name"];
    $description = $row["description"];
    $price = $row["price"];
    $supplier_name = $row["supplier_name"];
    $quantity = $row["quantity"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $product_name = $_POST["product_name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $supplier_name = $_POST["supplier_name"];
    $quantity = $_POST["quantity"];

    if (empty($id) || empty($product_name) || empty($description) || empty($price) || empty($supplier_name) || empty($quantity)) {
        $errorMessage = "All fields are required";
    } else {
        $sql = "UPDATE Products " .
            "SET product_name = '$product_name', description = '$description', price = '$price', supplier_name = '$supplier_name', quantity = '$quantity' " .
            "WHERE product_id = $id";

        $result = $connection->query($sql);

        if ($result) {
            $successMessage = "Product updated successfully";
        } else {
            $errorMessage = "Error updating product: " . $connection->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop - Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Edit Product</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "<div class='alert alert-danger'>$errorMessage</div>";
    } elseif (!empty($successMessage)) {
        echo "<div class='alert alert-success'>$successMessage</div>";
    }
    ?>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name" value="<?php echo $product_name; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Supplier Name</label>
            <input type="text" class="form-control" name="supplier_name" value="<?php echo $supplier_name; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/myshop/index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
