<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/settings.css">
        <title>Payment</title>
    </head>

    <body>
        <div class="wrapper">
            <nav class="navbar">
                <div class="navbar-container">
                    <a style="float:left;" href="products.php">Products</a>
                    <a style="padding-left:20px" href="orderHistory.php"> Order History</a>
                    <a style="padding-left:20px" href="history.php"> Search History</a>
                    <a style="padding-left:20px" href="shoppingCart.php"> Shopping Cart</a>
                    <a style="padding-left:20px" href="customercare.html"> Customer care</a>
                    <a style="float:right;margin-right: 10px" class="logout-link" href="index1.html">Logout</a>
                </div>
            </nav>
            <div style="padding-left:100px;padding-top:100px;padding-right:500px">


                <?php

                session_start();
                $con = mysqli_connect("localhost", "root", "sesame", "pioneers");
                $cardholdername = filter_input(INPUT_POST, "cardholder-name");
                $cardnumber = filter_input(INPUT_POST, "card-number");
                $expdate = date('Y-m-d', strtotime($_POST['expiration-date']));

                $cvv = filter_input(INPUT_POST, "cvv");
                $cardType = filter_input(INPUT_POST, "cardType");

                $email = $_SESSION["email"];
                $userId = $_SESSION['customerNo'];


                if ($cardnumber) {

                    $paymentSuccessful = 0;

                    $resultExits = "SELECT cardNo, customerId from Card where cardNo = $cardnumber and customerId = $userId";
                    $resultTrue = $con->query($resultExits);
                    $row_cnt = $resultTrue->num_rows;

                    if ($row_cnt > 0) {

                        echo '<script language="javascript">';
                        echo 'alert("Payment is successfull.!")';
                        echo '</script>';
                        echo "<fieldset>";
                        echo "<legend> &nbsp; Payment Confirmation &nbsp;</legend><br><br>";

                        print "<h4>&nbsp; &nbsp; Thank you for placing the order with us. We will ship your items immediately</h4>";
                        echo "<br>";
                        echo "</fieldset>";
                        $paymentSuccessful = 1;

                    } else {
                        $query = " INSERT INTO card (`type`, `cardNo`, `expiryDate`, `cvv`, `nameOnCard`, `customerId`) VALUES ('$cardType', '$cardnumber', '$expdate', '$cvv', '$cardholdername', '$userId') ";

                        echo "<fieldset>";
                        echo "<legend> &nbsp; Payment Confirmation &nbsp;</legend><br><br>";

                        print "<h4>&nbsp; &nbsp; Thank you for placing the order with us. We will ship your item immediately.</h4>\n";
                        echo "<br>";
                        echo "</fieldset>";

                        $result = $con->query($query);
                        if ($result != false) {
                            echo '<script language="javascript">';

                            echo 'alert("Payment is successfull. User Detals are stored in the Database!")';
                            echo '</script>';
                            $paymentSuccessful = 1;
                        } else {
                            echo '<script language="javascript">';
                            echo 'alert("One of the fields you entered is wrong.Please enter the correct details!!")';
                            echo '</script>';
                        }


                    }

                    if ($paymentSuccessful == 1) {

                        $query = "SELECT product.productId, product.name, carthistory.productquantity, product.price FROM product INNER JOIN carthistory ON product.productId = carthistory.productId";
                        $result = $con->query($query);


                        // Insert the row from cart History to Orders

                        if ($result) {

                            foreach ($result as $row) {
                                $pid = $row['productId'];
                                $quant = $row['productquantity'];

                                $query2 = "INSERT INTO orders (`orderTime`,`orderDate`,`quantity`,`productId`,`customerId`) VALUES (CURTIME(), CURDATE(),'$quant', '$pid', '$userId')";
                                $result2 = $con->query($query2);

                                // Delete the row inserted form the Cart history

                                $query3 = "TRUNCATE carthistory";
                                $result3 = $con->query($query3);
                            }
                        } else {

                        }

                    }
                }
                ?>
            </div>
    </body>
</html>