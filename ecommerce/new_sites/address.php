<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Manage Address</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/settings.css">
        <style>
            #saveForm, #editForm {
                padding: 20px;
                margin: 20px;
                background-color: #2a73cb;
                color: white;
                width: auto;
                font-size: 1rem;
            }

            #editForm span {
                display: inline-block;
                width: 20%;
            }
        </style>

    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar">
                <div class="navbar-container">
                    <a href="address.php"><b>Manage Address</b></a> &nbsp; &nbsp;&nbsp; &nbsp;
                    <a href="products.php">Products </a> &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                    <a href="settings.html">Account</a> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                    <a href="shoppingcart.php"> View Shopping Cart </a> &nbsp;&nbsp;&nbsp;
                    <a href="customercare.html"> Customer Care</a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="logout-link" href="index1.html">Logout</a>
                </div>
            </nav>
            <div style="display:flex;">
                <div style="margin-right: 50px;">
                    <?php

                    session_start();
                    $email = "\"" . $_SESSION["email"] . "\"";
                    // Connect to the database.
                    $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                    $con->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);


                    if (isset($_POST["saveFormButton"])) {
                        echo "<script>";
                        echo "document.getElementById(\"editForm\").style.display = \"none\";";
                        echo "document.getElementById(\"saveForm\").style.display = \"block\";";
                        echo "</script>";

                        $firstName = filter_input(INPUT_POST, "firstName");
                        $lastName = filter_input(INPUT_POST, "lastName");
                        $contactnumber = filter_input(INPUT_POST, "contactnumber");
                        $addressLine = filter_input(INPUT_POST, "addressLine");
                        $city = filter_input(INPUT_POST, "city");
                        $state = filter_input(INPUT_POST, "state");
                        $zip = filter_input(INPUT_POST, "zip");

                        $updateQuery = "update customer,address,userdata set customer.lastName=\"" . $lastName . "\"" .
                            ",customer.firstName=\"" . $firstName . "\"" .
                            ",customer.contactNo=" . $contactnumber .
                            ",address.addressLine=\"" . $addressLine . "\"" .
                            ",address.city=\"" . $city . "\"" .
                            ",address.state=\"" . $state . "\"" .
                            ",address.zip=\"" . $zip . "\"" .
                            " where customer.addressId = address.addressId" .
                            " and userdata.customerId = customer.customerId" .
                            " and userdata.email =" . $email;

                        $con->query($updateQuery);
                    }

                    $query = "select customer.firstName,customer.lastName,customer.contactNo,address.addressLine,address.city,address.state,address.zip from customer,address,userdata where customer.addressId = address.addressId and userdata.customerId = customer.customerId and userdata.email =" . $email;


                    // So the query and fetch the results
                    $data = $con->query($query);
                    $data->setFetchMode(PDO::FETCH_ASSOC);

                    foreach ($data as $row) {
                        echo "<form id=\"saveForm\" action=\"address.php\" method=\"post\">";
                        echo "<h3 style='margin-bottom: 40px;'>Current Account Details</h3>";
                        echo "<span>First Name => $row[firstName]</span><br><br>";
                        echo "<span>Last Name => $row[lastName]</span><br><br>";
                        echo "<span>Contact Number => $row[contactNo]</span><br><br>";
                        echo "<span>Address Line => $row[addressLine]</span><br><br>";
                        echo "<span>City => $row[city]</span><br><br>";
                        echo "<span>State => $row[state]</span><br><br>";
                        echo "<span>Zip => $row[zip]</span><br><br>";
                        echo "<input name=\"editFormButton\"  type=\"submit\" value=\"EDIT\" style=\"padding-left: 10px;padding-right: 10px;font-weight: bold\">";
                        echo "</form>";
                        echo "</div>";
                        echo "<form id=\"editForm\" action=\"address.php\" method=\"post\" style='display: none'>";
                        echo "<h3 style='margin-bottom: 40px;'>Modify Account Details</h3>";
                        echo "<span>First Name</span><input type=\"text\" name=\"firstName\" value='$row[firstName]'><br><br>";
                        echo "<span>Last Name </span ><input type = \"text\" name=\"lastName\" value='$row[lastName]'><br><br>";
                        echo "<span>Contact Number</span><input type=\"text\" name=\"contactnumber\" value='$row[contactNo]'><br><br>";
                        echo "<span>Address Line</span><input type=\"text\" name=\"addressLine\" value='$row[addressLine]'><br><br>";
                        echo "<span>City</span><input type=\"text\" name=\"city\" value='$row[city]'><br><br>";
                        echo "<span>State</span><input type=\"text\" name=\"state\" value='$row[state]'><br><br>";
                        echo "<span>Zip</span><input type=\"text\" name=\"zip\" value='$row[zip]'><br><br>";
                        echo "<input name=\"saveFormButton\" type=\"submit\" value=\"SAVE\" style=\"padding-left:10px;padding-right:10px;font-weight:bold\">";
                        echo "</form>";
                        break;
                    }
                    ?>

                    <?php

                    if (isset($_POST["editFormButton"])) {
                        echo "<script>";
                        echo "document.getElementById(\"editForm\").style.display = \"block\";";
                        echo "document.getElementById(\"saveForm\").style.display = \"none\";";
                        echo "</script>";
                    }

                    if (isset($_POST["saveFormButton"])) {
                        echo "<script>";
                        echo "document.getElementById(\"editForm\").style.display = \"none\";";
                        echo "document.getElementById(\"saveForm\").style.display = \"block\";";
                        echo "</script>";
                        $firstName = filter_input(INPUT_POST, "firstName");
                        $lastName = filter_input(INPUT_POST, "lastName");
                        $contactnumber = filter_input(INPUT_POST, "contactnumber");
                        $addressLine = filter_input(INPUT_POST, "addressLine");
                        $city = filter_input(INPUT_POST, "city");
                        $state = filter_input(INPUT_POST, "state");
                        $zip = filter_input(INPUT_POST, "zip");

                        $updateQuery = "update customer,address,userdata set customer.lastName=\"" . $lastName . "\"" .
                            ",customer.firstName=\"" . $firstName . "\"" .
                            ",customer.contactNo=" . $contactnumber .
                            ",address.addressLine=\"" . $addressLine . "\"" .
                            ",address.city=\"" . $city . "\"" .
                            ",address.state=\"" . $state . "\"" .
                            ",address.zip=\"" . $zip . "\"" .
                            " where customer.addressId = address.addressId" .
                            " and userdata.customerId = customer.customerId" .
                            " and userdata.email =" . $email;

                        $con->query($updateQuery);
                    }
                    ?>
                </div>
            </div>

        </div>
    </body>
</html>