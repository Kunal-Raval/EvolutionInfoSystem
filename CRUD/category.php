<?php

require("./controller/db.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Category Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script src="js/category.js"></script>
    <script>
    $(document).ready(function() {
        $("#uploadCategories").click(function() {

            $("#uploadCat").show();
        });
    });
    </script>
    <style>
    .error {
        color: red;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Category Form</h1>
        <form id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            enctype="multipart/form-data">
            <div class="form-group">
                <label for="category_name">Category Name:</label>
                <input type="text" class="form-control" placeholder="Enter a Category Name" id="category_name"
                    name="category_name" required>
            </div>
            <div class="form-group">
                <button id="add" type="submit" name="submit" class="btn btn-primary">Add</button>
            </div>

        </form>
        <div class="form-group">
            <button id="uploadCategories" name="uploadCategories" class="btn btn-primary">UPLOAD CATEGORIES</button></a>
        </div>
        <div class="form-group">
            <a href="product.php"><button class="btn btn-primary">Add Product</button></a>
        </div>

        <div class="upload">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                enctype="multipart/form-data">
                <div id="uploadCat" style="display:none;">
                    <div class="form-group">
                        <label for="category_name">Upload Data:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <button name="uploadExcelSheet" class="btn btn-primary">SUBMIT</submit>
                    </div>
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
</body>

</html>

<?php
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['uploadExcelSheet'])) {
    $fileName = $_FILES['fileToUpload']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['fileToUpload']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();


        foreach ($data as $column) {
            $cname = $column['0'];
            $date = date("y-m-d");
            $uploadData = $conn->query("INSERT INTO category (c_name, created_date) VALUES ('$cname', '$date')");
        }
        if ($uploadData) {
            $_SESSION['dataUploaded'] = 1;
        }
    }
}
$categoryName = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['submit'])) {
    $categoryName = test_input($_POST["category_name"]);
    $date = date("y-m-d");
    if (isset($_POST["submit"])) {
        $check = $conn->query("SELECT c_name FROM category WHERE c_name = '$categoryName'");
        if (mysqli_fetch_assoc($check)) {
            // echo "Category Already Exists";
        } else {
            $addCategory = $conn->query("INSERT INTO category (c_name, created_date) VALUES ('$categoryName', '$date')");
            $_SESSION['dataUploaded'] = 1;
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


// include("category_list.php");
?>