<?php

require("./controller/db.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Category Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Category Form</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="category_name">Category Name:</label>
                <input type="text" class="form-control" placeholder="Enter a Category Name" id="category_name"
                    name="category_name" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
        <div class="form-group">
            <a href="product.php"><button class="btn btn-primary">Add Product</button></a>
        </div>


    </div>
</body>

</html>

<?php

$categoryName = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = test_input($_POST["category_name"]);
    $date = date("y-m-d");
    if (isset($_POST["submit"])) {
        $check = $conn->query("SELECT c_name FROM category WHERE c_name = '$categoryName'");
        if (mysqli_fetch_assoc($check)) {
            // echo "Category Already Exists";
        } else {
            $addCategory = $conn->query("INSERT INTO category (c_name, created_date) VALUES ('$categoryName', '$date')");
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


include("category_list.php");
?>