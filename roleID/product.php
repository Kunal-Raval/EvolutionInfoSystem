<?php

$categoriesList = "";
$role = "";

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Products</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    table,
    th,
    td {
        text-align: center;

    }

    .error {
        color: red;
        font-weight: bold;
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script src="js/productValidation.js"></script>
    <script src="js/viewProduct.js"></script>
    <script>
    $(document).ready(function() {
        $("#uploadProducts").click(function() {

            $("#uploadProdcts").show();
        });
    });
    </script>
</head>

<body>
    <?php include('header.php') ?>

    <div class="container">
        <?php if ($role == "SUPER ADMIN" or $role == "ADMIN") {
            ?>
        <div id="add_products">
            <h1>Add Products</h1>
            <form id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
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
                    <input type="text" class="form-control" placeholder="Enter Product's SKU" id="sku" name="sku"
                        required>
                </div>
                <div class="form-group">
                    <label for="category_name">Product Details:</label>
                    <textarea class="form-control" placeholder="Enter Product details" id="details" name="details"
                        rows="4" required></textarea>
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
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>

            <!-- UPLOAD PRODUCTS -->
            <div class="form-group">
                <button id="uploadProducts" class="btn btn-primary">Upload Products</button>
            </div>
            <div id="uploadProdcts" style="display:none;">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    enctype="multipart/form-data">
                    <label for="category_name">Upload products only of same selected Category:</label>
                    <select id="categories" name="cid">
                        <?php
                            foreach ($conn->query("SELECT cid, c_name FROM category WHERE `status` = 0") as $row) {
                                ?>
                        <option value="<?php echo $row["cid"]; ?>"><?php echo $row["c_name"]; ?></option>
                        <?php
                            }
                            ?>
                    </select>
                    <div class="form-group">
                        <label for="category_name">Upload Data:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <button name="uploadExcelSheet" class="btn btn-primary">SUBMIT</submit>
                    </div>
                </form>
                <?php
                    if (isset($_SESSION['dataUploaded'])) {
                        ?>
                <span id='message'>Data Uploaded Successfully</span>
                <script>
                setTimeout(function() {
                    document.getElementById("message").style.display = 'none';
                }, 3000);
                </script>
                <?php
                        unset($_SESSION['dataUploaded']);
                    }

                    ?>
            </div>
        </div>
        <?php } ?>
        <!-- VIEW PRODUCT LIST -->
        <div class="form-group">
            <button id="view_products" class="btn btn-primary">View Products</button>
        </div>
        <div class="container">

            <div id="product_list" style="display:none;">


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
                        $pageSize = 5;
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        $temp = ($currentPage - 1) * $pageSize;

                        $sql = $conn->query("SELECT product_details.*, category.c_name as cname FROM product_details
                                        LEFT JOIN category ON product_details.cid = category.cid
                                        WHERE product_details.p_status = 0 LIMIT " . $temp . "," . $pageSize);
                        $productsCount = [];

                        if ($sql->num_rows > 0) {
                            while ($data = $sql->fetch_assoc()) {
                                $productsCount[] = $data;
                            }
                        }

                        $j = $temp + 1;
                        foreach ($productsCount as $pList) {

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
                                <img src="<?php echo "./" . $pList['img'] ?>" width="100"
                                    alt="<?php echo $pList['img'] ?>">
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
                                    <button id="delete" class="btn btn-primary">DELETE</button></a>
                            </td>
                        </tr>
                        <?php
                            $j++;

                        }
                        ?>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php


                        $countResult = $conn->query("SELECT COUNT(*) FROM product_details WHERE p_status = 0");
                        $totalRecords = $countResult->fetch_row()[0];

                        $totalPages = ceil($totalRecords / $pageSize);

                        for ($i = 1; $i <= $totalPages; $i++) {
                            ?>
                        <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                            <a id="pagination" class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
</body>

</html>

<?php

// require './vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// if (isset($_POST['uploadExcelSheet'])) {
//     $fileName = $_FILES['fileToUpload']['name'];
//     $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

//     $allowed_ext = ['xls', 'csv', 'xlsx'];

//     if (in_array($file_ext, $allowed_ext)) {
//         $inputFileNamePath = $_FILES['fileToUpload']['tmp_name'];
//         $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
//         $data = $spreadsheet->getActiveSheet()->toArray();


//         foreach ($data as $column) {
//             $cid = $_POST['cid'];
//             $pname = $column['0'];
//             $details = $column['1'];
//             $sku = $column['2'];
//             $quantity = $column['3'];
//             $price = $column['4'];

//             $uploadData = $conn->query("INSERT INTO product_details (cid, p_name, p_sku, p_details, p_quantity, p_price) 
//             VALUES ('$cid', '$pname', '$sku', '$details', '$quantity', '$price')");
//         }
//         if ($uploadData) {
//             $_SESSION['dataUploaded'] = 1;
//         }
//     }
// }
// $cid = $pname = $sku = $details = $price = $quantity = $imagePath = "";


// if ((isset($_POST['submit'])) or (isset($_FILES["fileToUpload"]) and $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK)) {

//     $cid = test_input($_POST["cid"]);
//     $pname = test_input($_POST["pname"]);
//     $sku = test_input($_POST["sku"]);
//     $details = test_input($_POST["details"]);
//     $price = test_input($_POST["price"]);
//     $quantity = test_input($_POST["quantity"]);

//     $targetDir = "./uploads/";
//     $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
//         $imagePath = $targetFile;
//     }

//     if (isset($_POST["submit"])) {
//         $check = $conn->query("SELECT p_name FROM product_details WHERE p_name = '$pname' AND p_sku = '$sku'");


//         if (mysqli_fetch_assoc($check)) {
//             $_SESSION['productExists'] = 1;
//         } else {
//             $addProduct = $conn->query("INSERT INTO product_details (cid, p_name, p_sku, p_details, p_quantity, p_price, img) 
//                         VALUES ('$cid', '$pname', '$sku', '$details', '$quantity', '$price', '$imagePath')");
//         }
//     }
// }

// function test_input($data)
// {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }
?>