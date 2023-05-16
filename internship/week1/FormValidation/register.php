<!DOCTYPE HTML>
<html>

<head>
    <style>
        table,
        th,
        td {
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
            width: auto;

        }
    </style>
</head>

<body>
    <center>
        <?php

        session_start();
        $_SESSION['email_exists'] = null;
        // define variables and set to empty values
        
        $name = $email = $gender = $pass = $cpass = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $pass = test_input($_POST["pass"]);
            $cpass = test_input($_POST["cpass"]);

            // $hash_pass = test_input(password_hash($_POST["pass"], PASSWORD_DEFAULT));
            // $hash_cpass = test_input(password_hash($_POST["cpass"], PASSWORD_DEFAULT));
            $gender = test_input($_POST["gender"]);
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>


        <?php
        // echo $name."<br>";
        // echo $email."<br>";
        require("db.php");


        if (isset($_POST['submit'])) {
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {

                $_SESSION['name_not_proper'] = 1;

            } else if (($pass != $cpass)) {
                $_SESSION['pass_do_not_match'] = 1;

            } else {

                $check = $conn->query("SELECT email FROM users WHERE email = '$email'");

                if (mysqli_fetch_array($check, MYSQLI_ASSOC)) {
                    $_SESSION['email_exists'] = 1;
                } else
                    $insert = $conn->query("Insert into users (name, email, gender, password) VALUES ('$name', '$email', '$gender', '$pass')");

            }

        }

        ?>

        <h2>PHP Form Validation</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Name: <input type="text" name="name" required>
            <?php if (isset($_SESSION['name_not_proper'])) {
                echo "Only letters and white space allowed";
                unset($_SESSION['name_not_proper']);
            } ?>

            <br><br>
            E-mail: <input type="email" name="email" required>
            <?php if (isset($_SESSION['email_exists'])) {
                echo "Email Already Rergistered.";
                unset($_SESSION['email_exists']);
            } ?>
            <br><br>
            Password: <input type="password" name="pass" required>
            <br><br>
            Confirm Password: <input type="password" name="cpass" required>
            <?php if (isset($_SESSION['pass_do_not_match'])) {
                echo "password do not match";
                unset($_SESSION['pass_do_not_match']);
            } ?>
            <br><br>
            Gender:
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="other">Other
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </form>
        <table>
            <tr>
                <th>SRNO</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>GENDER</th>
            </tr>
            <?php
            $i = 1;
            foreach ($conn->query("SELECT name, email, gender FROM users") as $row) {
                ?>
                <tr>
                    <td>
                        <?php echo $i ?>
                    </td>

                    <td>
                        <?php echo $row['name'] ?>
                    </td>
                    <td>
                        <?php echo $row['email'] ?>
                    </td>
                    <td>
                        <?php echo $row['gender'] ?>
                    </td>
                </tr>

                <?php
                $i++;
            }
            echo '<table>';
            ?>
    </center>
</body>

</html>