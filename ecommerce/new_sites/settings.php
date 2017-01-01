<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Login Information</title>
</head>

<body>
<p>
    <?php
    // Connect to the database.
    $con = mysqli_connect("localhost", "root", "sesame", "pioneers");
    $name = filter_input(INPUT_POST, "username");
    $email = filter_input(INPUT_POST, "email");
    $oldp = filter_input(INPUT_POST, "oldpassword");
    $newp = filter_input(INPUT_POST, "password2");
    $pword = filter_input(INPUT_POST, "password");
    $gender = filter_input(INPUT_POST, "gender");


    $query = " UPDATE customers SET password='$pword' WHERE username='$name' AND password = '$oldp'";

    $result = $con->query($query);

    if ($con->affected_rows == 0) {
        echo '<script language="javascript">';
        echo 'alert("One of the fields you entered is wrong.Please enter the correct details!!")';
        echo '</script>';
        include("settings.html");
    } else {

        echo '<script language="javascript">';
        echo 'alert("Password is successfully updated. Going back to Index page")';
        echo '</script>';
        include("index1.html");

    }
    ?>
</p>
</body>
</html>