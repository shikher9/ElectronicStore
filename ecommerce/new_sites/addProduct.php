<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Add Product Information</title>
    </head>

    <body>
        <p>

            <?php

            $con = mysqli_connect("localhost", "root", "sesame", "pioneers");
            $type = filter_input(INPUT_POST, "productType");
            $price = filter_input(INPUT_POST, "price");
            $name = filter_input(INPUT_POST, "name");
            $image = filter_input(INPUT_POST, "image");
            $availability = filter_input(INPUT_POST, "availability");
            $discount = filter_input(INPUT_POST, "discount");
            $discountadd = filter_input(INPUT_POST, "discountadd");
            if (!($discountadd)) {


                $query1 = "SELECT discountId from discount where perc='$discount'";
                $result1 = $con->query($query1);
                while ($row = $result1->fetch_assoc()) {
                    $discounts = $row['discountId'];
                }
                $query = " INSERT INTO product VALUES(NULL, '$type', '$price', '$name', '$image', '$availability', '$discounts')";
                $result = $con->query($query);
                if ($result != false) {
                    echo '<script language="javascript">';

                    echo 'alert("Product is successfully updated !")';
                    echo '</script>';
                    include("admin.php");
                } else {
                    echo '<script language="javascript">';
                    echo 'alert("One of the fields you entered is wrong.Please enter the correct details!!")';
                    echo '</script>';
                    include("admin.php");
                }
            } else {


                $query1 = "INSERT INTO discount VALUES(NULL, '$discountadd')";
                $result1 = $con->query($query1);
                $query2 = "SELECT discountId from discount where perc='$discountadd'";
                $result2 = $con->query($query2);
                while ($row = $result2->fetch_assoc()) {
                    $discounts = $row['discountId'];
                }
                $query = " INSERT INTO product VALUES(NULL, '$type', '$price', '$name', '$image', '$availability', '$discounts')";
                $result = $con->query($query);
                if ($result != false) {
                    echo '<script language="javascript">';
                    echo 'alert("New discount added !")';
                    echo '</script>';
                    echo '<script language="javascript">';
                    echo 'alert("Product is successfully updated !")';
                    echo '</script>';
                    include("admin.php");
                } else {
                    echo '<script language="javascript">';
                    echo 'alert("One of the fields you entered is wrong.Please enter the correct details!!")';
                    echo '</script>';
                    include("admin.php");
                }
            }
            ?>
        </p>
    </body>
</html>