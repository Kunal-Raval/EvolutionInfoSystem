<?php
require("./db/db.php");
session_start();
$Home = $Product = $Contact = "";
if (isset($_SESSION['role'])) {


    $rolename = $_SESSION['role'];
    $checkContext = $conn->query("SELECT context from role_table WHERE rolename = '$rolename'");

    $contexts = mysqli_fetch_assoc($checkContext);
    $context = explode(", ", $contexts['context']);

    $Home = ((in_array("Home", $context)) || (in_array("ALL", $context))) ? "home.php" : "#";
    $Product = ((in_array("Product", $context)) || (in_array("ALL", $context))) ? "product.php" : "#";
    $Contact = ((in_array("Contact", $context)) || (in_array("ALL", $context))) ? "contact.php" : "#";
}
?>

<head>
    <title>My Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $Home; ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $Contact; ?>">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $Product; ?>">Products</a>
            </li>

            <?php
            if (!isset($_SESSION['id'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <?php
            } else {
                if ($_SESSION['role'] == "SUPER ADMIN") {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="module/manageRoles.php">MANAGE ROLES</a>
                    </li>
                    <?php
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <?php echo $_SESSION['name']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signout.php">SIGNOUT</a>
                </li>
                <?php
            }
            ?>

        </ul>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>