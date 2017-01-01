<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/settings.css">
        <title>Admin add products</title>
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar">
                <div class="navbar-container">

                    <a style="float:left;" class="addProduct-link" href="admin.php">Add a Product</a>

                    <a style="padding:10px 5px 15px 30px;" class="removeProduct-link" href="removeProduct.php">Remove a
                        Product</a>

                    <a style="padding:10px 5px 15px 30px;" class="removeProduct-link" href="admin/manageAccount.php">Manage
                        Account</a>

                    <a style="padding:10px 5px 15px 30px;" class="addProduct-link"
                       href="admin/analytics/Analytics.html">Analytics</a>

                    <a style="float:right;margin-right: 10px" class="logout-link" href="index1.html">Logout</a>

                </div>
            </nav>
            <div class="signup-box">

                <p>
                    <?php

                    try {

                        echo "<form action=\"addProduct.php\" method=\"post\">";
                        echo "<span><b>ADD A PRODUCT INTO THE DATABASE</b></span><br><br>";
                        echo "<label for=\"type-input\">Product Type</label>";
                        echo "<select name=\"productType\" id=\"productType\">";
                        echo "<option value=\"Mobile\">Mobile</option>";
                        echo "<option value=\"SmartPhone\">SmartPhone</option>";
                        echo "<option value=\"Laptop\">Laptop</option>";
                        echo "<option value=\"Tablet\">Tablet</option>";
                        echo "<option value=\"Computer\">Computer</option>";

                        echo "</select><br><br>";
                        echo " <label for=\"price-input\">Price</label><br>";
                        echo "<input id=\"price-input\" type=\"text\" name=\"price\" required><br>";
                        echo "<label for=\"name-input\">Name</label><br>";
                        echo "<input id=\"name-input\" type=\"text\" name=\"name\" required><br>";
                        echo "<label for=\"image-input\">Image URL</label><br>";
                        echo "<input id=\"image-input\" type=\"text\" name=\"image\"><br>";
                        echo "<label for=\"availability-input\">Availability</label><br>";
                        echo "<input id=\"availability-input\" type=\"text\" name=\"availability\"><br>";
                        echo "<label for=\"discount-input\">Discount</label>";

                        mysql_connect("localhost", "root", "sesame");
                        mysql_select_db("pioneers");
                        $query = mysql_query("SELECT perc FROM discount");

                        if (mysql_num_rows($query)) {
                            $select = '<select name="discount">';
                            while ($rs = mysql_fetch_array($query)) {
                                $select .= '<option value="' . $rs['perc'] . '">' . $rs['perc'] . '</option>';
                            }
                        }
                        $select .= '</select>';
                        echo $select;


                        echo " <br><br>";
                        echo "<label>Don't like the above discount? Want to change it?</label><br>";
                        echo "<input id=\"discountadd-input\" type=\"text\" name=\"discountadd\"><br>";
                        echo "<input type=\"submit\" value=\"Save\">";
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


