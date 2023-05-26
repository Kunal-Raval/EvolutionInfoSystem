<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="./js/registerValidation.js"></script>

</head>

<body>
    <?php include('header.php') ?>

    <div class="container">
        <h1>Registration</h1>
        <form id="myForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <?php
            if (isset($_SESSION['userExists'])) {
                ?>
            <span id='message'>User Already Exists.</span>
            <script>
            setTimeout(function() {
                document.getElementById("message").style.display = 'none';
            }, 3000);
            </script>
            <?php
                unset($_SESSION['userExists']);
            }

            ?>
            <div class="form-group">
                <label>Role:</label>
                <select class="form-control" id="role" name="role">

                    <?php
                    foreach ($conn->query("SELECT roleid, rolename FROM role_table") as $role) {
                        ?>
                    <option value="<?php echo $role['roleid']; ?>"><?php echo $role['rolename']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password">Confirm Password:</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>


</body>

</html>


<?php

$name = $email = $phone = $pass = $role = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $roleid = test_input($_POST["role"]);
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $password = test_input($_POST["password"]);
    $role = test_input($_POST["role"]);

    $insert = $conn->query("INSERT INTO users (roleid, name, email, phn, password) 
    VALUES ( '$role','$name', '$email','$phone','$password')");

    header('location: login.php');



}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>