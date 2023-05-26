<?php require('../db/db.php');
session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Roles</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>

    <div class="container">

        <h1>Manage Roles</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Name And Current Role:</label>
                <select class="form-control" id="id" name="id">
                    <?php
                    $role = $_SESSION['role'];
                    $sql = $conn->query("SELECT users.*, role_table.rolename FROM users 
                     LEFT JOIN role_table ON users.roleid = role_table.roleid WHERE role_table.rolename != '$role'");
                    $roleid = "";

                    foreach ($sql as $row) {
                        ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo $row['name'] . "  And Role is: " . $row['rolename']; ?>
                    </option>
                    <?php
                    }
                    ?>
                </select>

            </div>
            <div class="form-group">
                <label for="role">Select A Role:</label>

                <select class="form-control" id="role" name="role">
                    <?php
                    foreach ($conn->query("SELECT roleid, rolename, context FROM role_table WHERE rolename != 'SUPER ADMIN' 
                                    and status = 0 ") as $getRoleName) {
                        ?>
                    <option value="<?php echo $getRoleName['roleid']; ?>">
                        <?php echo $getRoleName['rolename'] . "  And Role Permissions are: " . $getRoleName['context']; ?>
                    </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <input type="submit" name="assign" class="btn btn-primary" value="ASSIGN">
        </form>
        <div class="addRoles">
            <h1>ADD ROLES</h1>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="role_name">Add A New Role:</label>
                    <input type="text" class="form-control" id="role_name" name="role_name" required>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="context[]" value="Home"> Home<br>
                    <input type="checkbox" name="context[]" value="Product"> Product<br>
                    <input type="checkbox" name="context[]" value="Contact"> Contact<br>
                </div>
                <input type="submit" name="addRoles" class="btn btn-primary" value="ADD ROLES">

            </form>
        </div>
    </div>


</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" and (isset($_POST['assign']))) {
    $id = $_POST['id'];
    $newRole = $_POST['role'];

    $update = $conn->query("UPDATE users SET roleid = '$newRole' WHERE id = '$id'");
    header("Location: " . $_SERVER['PHP_SELF']);

}
if ($_SERVER["REQUEST_METHOD"] == "POST" and (isset($_POST['addRoles']))) {

    $roleName = $_POST['role_name'];
    $contexts = $_POST['context'];

    $context = implode(", ", $contexts);

    $conn->query("INSERT INTO role_table (rolename, context) VALUES ('$roleName', '$context')");

    header("Location: " . $_SERVER['PHP_SELF']);

}

?>