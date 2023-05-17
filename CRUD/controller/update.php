<?php
require("db.php");
session_start();
if (isset($_POST['update'])) {
    $pname = $sku = $details = $price = $quantity = "";

    $pid = $_SESSION['updateForm'];



    $pname = $_POST["pname"];
    $sku = $_POST["sku"];
    $details = $_POST["details"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $updateProduct = $conn->query("UPDATE product_details SET
                p_name = '$pname',  p_sku = '$sku', p_details = '$details', p_quantity = '$quantity', 
                p_price = '$price' WHERE pid = '$pid'");

    // echo "UPDATE product_details SET
    //     p_name = '$pname',  p_sku = '$sku', p_details = '$details', p_quantity = '$quantity', 
    //     p_price = '$price' WHERE pid = '$pid'";
    header('location: ../product.php');

}


?>