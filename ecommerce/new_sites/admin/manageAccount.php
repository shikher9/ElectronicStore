<!DOCTYPE html>
<html lang="en" xmlns:10px xmlns:10px>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/main.css">
        <link rel="stylesheet" href="../../css/settings.css">
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
        <title>Admin add products</title>
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar">
                <div class="navbar-container">


                    <a style="float:left;" class="addProduct-link" href="../admin.php">Add a Product</a>

                    <a style="padding:10px 5px 15px 30px;" class="removeProduct-link" href="../removeProduct.php">Remove
                        a
                        Product</a>
                    <a style="padding:10px 5px 15px 30px;" class="removeProduct-link" href="manageAccount.php">Manage
                        Account</a>

                    <a style="padding:10px 5px 15px 30px;" class="addProduct-link" href="analytics/Analytics.html">Analytics</a>

                    <a style="float:right;margin-right: 10px" class="logout-link" href="../index1.html">Logout</a>

                </div>
            </nav>
            <br>
            <div>
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

                            $updateQuery = "update admin,address,userdata set admin.lastName=\"" . $lastName . "\"" .
                                ",admin.firstName=\"" . $firstName . "\"" .
                                ",admin.contactNo=" . $contactnumber .
                                ",address.addressLine=\"" . $addressLine . "\"" .
                                ",address.city=\"" . $city . "\"" .
                                ",address.state=\"" . $state . "\"" .
                                ",address.zip=\"" . $zip . "\"" .
                                " where admin.addressId = address.addressId" .
                                " and userdata.adminId = admin.adminId" .
                                " and userdata.email =" . $email;

                            $con->query($updateQuery);
                        }

                        $query = "select admin.firstName,admin.lastName,admin.contactNo,address.addressLine,address.city,address.state,address.zip from admin,address,userdata where admin.addressId = address.addressId and userdata.adminId = admin.adminId and userdata.email =" . $email;


                        // So the query and fetch the results
                        $data = $con->query($query);
                        $data->setFetchMode(PDO::FETCH_ASSOC);

                        foreach ($data as $row) {
                            echo "<form id=\"saveForm\" action=\"manageAccount.php\" method=\"post\">";
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
                            echo "<form id=\"editForm\" action=\"manageAccount.php\" method=\"post\" style='display: none'>";
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

                            $updateQuery = "update admin,address,userdata set admin.lastName=\"" . $lastName . "\"" .
                                ",admin.firstName=\"" . $firstName . "\"" .
                                ",admin.contactNo=" . $contactnumber .
                                ",address.addressLine=\"" . $addressLine . "\"" .
                                ",address.city=\"" . $city . "\"" .
                                ",address.state=\"" . $state . "\"" .
                                ",address.zip=\"" . $zip . "\"" .
                                " where admin.addressId = address.addressId" .
                                " and userdata.adminId = admin.adminId" .
                                " and userdata.email =" . $email;

                            $con->query($updateQuery);
                        }
                        ?>
                    </div>
                </div>

            </div>
    </body>
</html>


