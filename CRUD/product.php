<?php

require("./controller/db.php");
session_start();
$categoriesList = "";


?>
<!DOCTYPE html>
<html>

<head>
    <title>Products Form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    table,
    th,
    td {
        text-align: center;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#view_products").click(function() {
            $("#add_products").hide();
        });
        $("#view_products").click(function() {
            $("#product_list").show();
        });
    });
    </script>
</head>

<body>
    <div class="container" id="add_products">
        <h1>Add Products</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            enctype="multipart/form-data">
            <div class="form-group">
                <label for="category_name">Select Category:</label>

                <select id="categories" name="cid">
                    <?php
                    foreach ($conn->query("SELECT cid, c_name FROM category WHERE `status` = 0") as $row) {
                        ?>
                    <option value="<?php echo $row["cid"]; ?>"><?php echo $row["c_name"]; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="category_name">Product Name:</label>
                <input type="text" class="form-control" placeholder="Enter Product Name" id="pname" name="pname"
                    required>
            </div>
            <div class="form-group">
                <label for="category_name">Product SKU:</label>
                <input type="text" class="form-control" placeholder="Enter Product's SKU" id="sku" name="sku" required>
            </div>
            <div class="form-group">
                <label for="category_name">Product Details:</label>
                <textarea class="form-control" placeholder="Enter Product details" id="details" name="details" rows="4"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="category_name">Product Price:</label>
                <input type="text" class="form-control" placeholder="Enter Product Price" id="price" name="price"
                    required>
            </div>
            <div class="form-group">
                <label for="category_name">Product Quantity:</label>
                <input type="text" class="form-control" placeholder="Enter Quantity" id="quantity" name="quantity"
                    required>
            </div>
            <div class="form-group">
                <label for="category_name">Upload Image:</label>

                <input type="file" name="fileToUpload" id="fileToUpload" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
            </div>
        </form>
        <div class="form-group">
            <button type="submit" id="view_products" class="btn btn-primary">View Products</button>
        </div>
    </div>
</body>

</html>

<?php

$cid = $pname = $sku = $details = $price = $quantity = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {

    $cid = test_input($_POST["cid"]);
    $pname = test_input($_POST["pname"]);
    $sku = test_input($_POST["sku"]);
    $details = test_input($_POST["details"]);
    $price = test_input($_POST["price"]);
    $quantity = test_input($_POST["quantity"]);

    $targetDir = "./uploads/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        $imagePath = $targetFile;
    }

    if (isset($_POST["submit"])) {
        $check = $conn->query("SELECT p_name FROM product_details WHERE p_name = '$pname' AND p_sku = '$sku'");


        if (mysqli_fetch_assoc($check)) {
            $_SESSION['productExists'] = 1;
        } else {
            $addProduct = $conn->query("INSERT INTO product_details (cid, p_name, p_sku, p_details, p_quantity, p_price, img) 
                        VALUES ('$cid', '$pname', '$sku', '$details', '$quantity', '$price', '$imagePath')");
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div id="product_list" style="display:none;">

    <div class="container">
        <h1>List Of Products</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Product Details</th>
                    <th>SKU</th>
                    <th>PHOTO</th>
                    <th>Product Price</th>
                    <th>QNT.</th>
                    <th rowspan="2">MANAGE</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $j = 1;
                foreach ($conn->query("SELECT product_details.*, category.c_name as cname FROM product_details
                                LEFT JOIN category ON product_details.cid = category.cid
                            WHERE product_details.p_status = 0") as $pList) {
                    ?>
                <tr>
                    <td>
                        <?php echo $j ?>
                    </td>
                    <td>
                        <?php echo $pList['cname'] ?>
                    </td>
                    <td>
                        <?php echo $pList['p_name'] ?>
                    </td>
                    <td>
                        <?php echo $pList['p_details'] ?>
                    </td>
                    <td>
                        <?php echo $pList['p_sku'] ?>
                    </td>
                    <td>
                        <embed src="<?php $pList['img'] ?>" />
                    </td>
                    <td>
                        <?php echo $pList['p_price'] ?>
                    </td>
                    <td>
                        <?php echo $pList['p_quantity'] ?>
                    </td>
                    <td>
                        <a href="./controller/manage.php?uid=<?php echo $pList['pid'] ?>">
                            <button id="update" class="btn btn-primary">UPDATE</button></a>
                    </td>
                    <td>
                        <a href="./controller/manage.php?did=<?php echo $pList['pid'] ?>">
                            <button class="btn btn-primary">DELETE</button></a>
                    </td>
                </tr>
                <?php
                    $j++;

                }
                ?>
            </tbody>
        </table>
    </div>
</div>