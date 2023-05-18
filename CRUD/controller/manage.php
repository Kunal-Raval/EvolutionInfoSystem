<?php
session_start();
require("db.php");
$pid = "";
if (isset($_GET['did'])) {
    $pid = $_GET['did'];
    $conn->query("UPDATE product_details SET p_status = 1 WHERE pid = '$pid'");
    header('location: ../product.php');
}

if (isset($_GET['uid'])) {
    $pid = $_GET['uid'];
    $_SESSION['updateForm'] = $pid;
    $row = mysqli_fetch_array($conn->query("SELECT * FROM product_details WHERE pid = '$pid'"), MYSQLI_ASSOC);
    ?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    .error {
        color: red;
        font-weight: bold;
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="../js/validation.js"></script>


</head>

<body>
    <div class="container">
        <h1>Update Product</h1>
        <form id="myForm" method="post" action="update.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pname">Product Name:</label>
                <input type="text" class="form-control" placeholder="Enter Product Name" id="pname" name="pname"
                    value="<?php echo $row['p_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="sku">Product SKU:</label>
                <input type="text" class="form-control" placeholder="Enter Product SKU" id="sku" name="sku"
                    value="<?php echo $row['p_sku']; ?>" required>
            </div>
            <div class="form-group">
                <label for="details">Product Details:</label>
                <textarea class="form-control" placeholder="Enter Product Details" id="details" name="details" rows="4"
                    required><?php echo $row['p_details']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Product Price:</label>
                <input type="text" class="form-control" placeholder="Enter Product Price" id="price" name="price"
                    value="<?php echo $row['p_price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Product Quantity:</label>
                <input type="text" class="form-control" placeholder="Enter Product Quantity" id="quantity"
                    name="quantity" value="<?php echo $row['p_quantity']; ?>" required>
            </div>
            <div class="form-group">
                <img src="<?php echo "../" . $row['img']; ?>" width="250">
            </div>
            <div class="form-group">
                <label for="category_name">Upload or Change Image:</label>

                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>

</html>
<?php
} else {
    header('location: ../product.php');
}
?>