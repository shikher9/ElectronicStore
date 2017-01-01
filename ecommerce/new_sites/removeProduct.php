<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/settings.css">
        <title>Remove products</title>
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar">
                <div class="navbar-container">

                    <a style="float:left;" class="addProduct-link" href="admin.php">Add a Product</a>

                    <a style="padding:10px 5px 15px 30px;" class="removeProduct-link" href="remove.php">Remove a
                        Product</a>

                    <a style="padding:10px 5px 15px 30px;" class="removeProduct-link" href="admin/manageAccount.php">Manage
                        Account</a>

                    <a style="padding:10px 5px 15px 30px;" class="addProduct-link"
                       href="admin/analytics/Analytics.html">Analytics</a>

                    <a style="float:right;margin-left: 10px;" class="logout-link" href="index1.html">Logout</a>

                </div>
            </nav>
            <div class="remove-box">

                <p>
                    <?php

                    try {

                        echo "<form action=\"remove.php\" method=\"post\">";
                        echo "<span><b>REMOVE A PRODUCT FROM THE DATABASE</b></span><br><br>";


                        echo "</select><br><br>";

                        echo "<label for=\"productId-input\">Product ID &nbsp; &nbsp; &nbsp; </label>";
                        mysql_connect("localhost", "root", "sesame");
                        mysql_select_db("pioneers");

                        $query1 = mysql_query("SELECT productId,name FROM product");
                        if (mysql_num_rows($query1)) {
                            $select = '<select name="productId">';
                            while ($rs = mysql_fetch_array($query1)) {
                                $select .= '<option value="' . $rs['productId'] . '">' . $rs['productId'] . " - " . $rs['name'] . '</option>';
                            }
                        }
                        $select .= '</select>';
                        echo $select;
                        echo " <br><br>";
                        echo " <br><br>";
                        echo "<input type=\"submit\" value=\"Remove\">";
                        echo "</form>";

                    } catch (PDOException $ex) {
                        echo 'ERROR : ' . $ex->getMessage();
                    }


                    ?>

                </p>
            </div>
        </div>
    </body>
</html>


