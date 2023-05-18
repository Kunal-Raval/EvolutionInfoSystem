<?php
require("db.php");
session_start();
if (isset($_POST['update']) || (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK)) {
    $pname = $sku = $details = $price = $quantity = $imagePath = "";

    $pid = $_SESSION['updateForm'];



    $pname = $_POST["pname"];
    $sku = $_POST["sku"];
    $details = $_POST["details"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);



    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        $imagePath = $targetFile;
    }
    $updatedPath = ltrim($imagePath, ".");

    $getImagepath = $conn->query("SELECT img FROM product_details WHERE pid = '$pid' ");

    $CompareImgPath = mysqli_fetch_assoc($getImagepath);

    // if (mysqli_fetch_assoc($getImagepath)['img'] == $updatedPath || $updatedPath == "") {
    //     $updatedPath = $CompareImgPath['img'];
    // }

    if ($CompareImgPath['img'] == $updatedPath || $updatedPath == "") {
        $updatedPath = $CompareImgPath['img'];
    }

    $updateProduct = $conn->query("UPDATE product_details SET
                p_name = '$pname',  p_sku = '$sku', p_details = '$details', p_quantity = '$quantity', 
                p_price = '$price', img = '$updatedPath' WHERE pid = '$pid'");

    // echo "UPDATE product_details SET
    //     p_name = '$pname',  p_sku = '$sku', p_details = '$details', p_quantity = '$quantity', 
    //     p_price = '$price', img = '$updatedPath' WHERE pid = '$pid'";
    header('location: ../product.php');

}


?>