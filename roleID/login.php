<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php include('header.php') ?>

    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <?php
        if (isset($_SESSION['invaliUser'])) {
            ?>
        <span id='message'>Invalid Credentials.</span>
        <script>
        setTimeout(function() {
            document.getElementById("message").style.display = 'none';
        }, 3000);
        </script>
        <?php
            unset($_SESSION['invaliUser']);
        }

        ?>
        <a href="register.php">Create an Account?</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

<?php
$email = $pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

    $check = $conn->query("SELECT users.*, role_table.rolename FROM users
        LEFT JOIN role_table ON users.roleid = role_table.roleid WHERE email = '$email' AND password= '$password'");
    $result = mysqli_fetch_assoc($check);
    if ($result) {
        $_SESSION['role'] = $result['rolename'];
        $_SESSION['name'] = $result['name'];
        $_SESSION['id'] = $result['id'];

        header('location: index.php');
    } else {
        $_SESSION['invaliUser'] = 1;
        header('location: login.php');
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