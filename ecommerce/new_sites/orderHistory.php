<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/settings.css">
        <title>Order History History</title>
    </head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;

        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <body>
        <div class="wrapper">
            <nav class="navbar">
                <div class="navbar-container">
                    <a href="orderHistory.php"> <b>Order History</b> </a> &nbsp; &nbsp;&nbsp; &nbsp;
                    <a href="products.php"> Products </a> &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                    <a href="settings.html">Account</a> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                    <a href="shoppingcart.php"> View Shopping Cart </a> &nbsp;&nbsp;&nbsp;
                    <a href="history.php"> History </a> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                    <a href="customercare.html"> Customer Care &nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a class="logout-link" href="index1.html">Logout</a>

                </div>
            </nav>
            <div style="padding-left:30px;padding-top:30px;padding-right:200px">

                <?php

                try {

                    echo "<fieldset>";
                    echo "<legend> &nbsp; Order History &nbsp;</legend>";

                    session_start();

                    $custId = $_SESSION['customerNo'];


                    mysql_connect("localhost", "root", "sesame");
                    mysql_select_db("pioneers");

                    $query1 = mysql_query("select product.name , product.price, orders.quantity ,(price * quantity) AS Total_Cost, orders.orderDate from product INNER JOIN orders on product.productId = orders.productId where customerId=$custId ORDER BY orders.orderDate DESC");
                    if (mysql_num_rows($query1)) {
                        $p = '<p style="padding-left:100px">';

                        echo "<table>";
                        echo "<tr>";
                        echo "<th> Product Name </th>";
                        echo "<th>Price </th>";
                        echo "<th>Quantity</th>";
                        echo "<th>Total Cost</th>";
                        echo "<th>Order Date</th>";
                        echo "</tr>";
                        while ($rs = mysql_fetch_array($query1)) {
                            echo "<tr>";
                            echo "<td>$rs[name]</td>";
                            echo "<td>$rs[price]</td>";
                            echo "<td>$rs[quantity]</td>";
                            echo "<td>$rs[Total_Cost]</td>";
                            echo "<td>$rs[orderDate]</td>";
                            echo "</tr>";

                        }
                    }

                    echo " <br><br>";
                    echo " <br><br>";

                    echo "</fieldset";
                    echo "</form>";

                } catch (PDOException $ex) {
                    echo 'ERROR : ' . $ex->getMessage();
                }


                ?>
            </div>
        </div>
    </body>
</html>


