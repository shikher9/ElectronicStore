<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="stylesheet" href="main.css">
    <title>Browse Products</title>
</head>

<body>
<div class="wrapper">
    <p>
        <?php
        if (isset($_POST['login_form'])) {
            $email = $_POST['email'];
            $pass = $_POST['password'];

            try {
                // Connect to the database.
                $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);

                session_start();

                // We're going to construct an HTML table.
                print "<table border='1'>\n";

                $query = " select customerId from userdata where email='$email' and password='$pass' ";

                // Fetch the database field names.
                $data = $con->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                $cols = $data->rowCount();
                $userId=$data->fetchColumn();
                // If the SQL query is succesfully performed, data not false
                

                $_SESSION['customerNo'] = $userId;

                if ($data != false && $cols > 0) {

                    echo "<nav class=\"nav\">";
                    echo " <a href=\"Query1.html\">QUERY 1</a>";
                    echo " <a href=\"Query2.html\">QUERY 2</a>";
                    echo " <a href=\"Query3.html\">QUERY 3</a>";
                    echo " <a href=\"Query4.html\">QUERY 4</a>";
                    echo " <a href=\"Query5.html\">QUERY 5</a>";
                    echo "<a style=\"float:right;\" class=\"logout-link\" href=\"index1.html\">Logout</a>";
                    echo "</nav>";
                    echo "<br><a style=\"padding-left:1000px\" class=\"settings-link\" href=\"settings.html\">Account Settings</a>";

                    print "<br><br><br><h1><center>Hello, $email welcome to the login page!</center></h1>\n";
                    print "<br><h4><center>Click on \"Account settings\" hyperlink to enter your card details.</center></h1>\n";


                } else {
                    echo '<script language="javascript">';
                    echo 'alert("User name and passwor not found.Please register to continue !!")';
                    echo '</script>';
                    include("index1.html");
                }


            } catch (PDOException $ex) {
                echo 'ERROR : ' . $ex->getMessage();
            }

        }
        ?>

        <?php
        if (isset($_POST['submit_form'])) {

            $firstname = $_POST['firstName'];
            $lastname = $_POST['lastName'];
            $emailid = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $gender = $_POST['gender'];
            $selected_val = $_POST['select'];  // Storing Selected Value In Variable
//echo "You have selected :" .$selected_val;  // Displaying Selected Value


            try {
                // Connect to the database.
                $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);

                // We're going to construct an HTML table.
                print "<table border='1'>\n";

                $query = " INSERT INTO customers VALUES( '$firstname','$lastname','$emailid','$username','$password','$gender', '$selected_val ') ";


                // Fetch the database field names.
                $result = $con->query($query);
                // $row = $result->fetch(PDO::FETCH_ASSOC);

                if ($result != false) {
                    echo "<div class=\"navbar\">";
                    echo " <div class=\"navbar-container\">";
                    echo "<a style=\"float:right;\" class=\"logout-link\" href=\"index1.html\">Logout</a>";
                    echo "</div>";
                    echo "</div>";

                    print "<br><bcompiler_read(filehandle)><h1><center>Hello, $firstname you are registered !</center></h1>\n";
                } else {
                    print "<h1>Hello, $firstname could not be registered!</h1>\n";
                }


            } catch (PDOException $ex) {
                echo 'ERROR : ' . $ex->getMessage();
            }

        }
        ?>
    </p>
</div>
</body>
</html>


