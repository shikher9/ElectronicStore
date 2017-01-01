<!DOCTYPE html>
<html lang="en-US">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Browse Products</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/shop-homepage.css" rel="stylesheet">
</head>

<body style="width: 100%;height: 100%">
<div>
    <p>
        <?php

            echo "<nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">";
            echo "<div class=\"container\">";
                echo "<!-- Brand and toggle get grouped for better mobile display -->";
                echo "<div class=\"navbar-header\">";
                    echo "<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">";
                        echo "<span class=\"sr-only\">Toggle navigation</span>";
                        echo "<span class=\"icon-bar\"></span>";
                        echo "<span class=\"icon-bar\"></span>";
                        echo "<span class=\"icon-bar\"></span>";
                    echo "</button>";
                    echo "<a class=\"navbar-brand\" href=\"shoppingcart.php\">Shopping Cart</a>";
                echo "</div>";
                echo "<!-- Collect the nav links, forms, and other content for toggling -->";
                echo "<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">";
                    echo "<ul class=\"nav navbar-nav\">";
                        echo "<li>";
                            echo "<a href=\"products.php\">Products</a>";
                        echo "</li>";
                        echo "<li>";
                            echo "<a href=\"settings.html\">Account</a>";
                        echo "</li>";
                        echo "<li>";
                            echo "<a href=\"shoppingcart.php\">View Shopping Cart</a>";
                        echo "</li>";
                        echo "<li>";
                            echo "<a href=\"history.php\">History</a>";
                        echo "</li>";
                        echo "<li>";
                            echo "<a href=\"customercare.html\">Customer Care</a>";
                        echo "</li>";
                    echo "</ul>";

                    echo "<ul class=\"nav navbar-nav\">";
                        echo "<li><a href=\"index1.html\">Logout</a></li>";
                    echo  "</ul>";


                echo "</div>";
                echo "<!-- /.navbar-collapse -->";
            echo "</div>";
            echo "<!-- /.container -->";
        echo "</nav>";
        
        error_reporting(E_ERROR);
        if (isset($_POST['submit'])) {
            try {
                // Connect to the database.
                $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);

                $remove_cartId = $_POST['remove'];
                $query = " DELETE FROM `carthistory` WHERE `productId` = $remove_cartId ";

                // Fetch the database field names.
                $result = $con->query($query);
                // $row = $result->fetch(PDO::FETCH_ASSOC);

            } catch (PDOException $ex) {
                echo 'ERROR : ' . $ex->getMessage();
            }
        }
        session_start();
        $new_variable = $_POST['product'];
        $variable = $_POST['quantity'];
        $email = $_SESSION["email"];
        //variable to calculate total price
        $total = 0.0;
        $queryGetAllProducts = "select p.productId, p.name,p.imageUrl,p.price,c.productquantity, c.cartId from carthistory c, product p where c.email = '$email' and p.productId = c.productId order by p.productId";

        try {
            // Connect to the database.
            $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);

            // We're going to construct an HTML table.

            print "<table border='1'>\n";

            $dataProducts = $con->query($queryGetAllProducts);
            $dataProducts->setFetchMode(PDO::FETCH_ASSOC);

            //echo "<h1 style='text-align: center;'>Hello, $email. Browse our electronic products.</h1>\n";
            $products = array(array());
            $counter = 0;
            
            foreach ($dataProducts as $row) {
                if (array_key_exists($row[productId],$products))
                {
                    $quantity = $products[$row[productId]]['quantity'];
                    $quantity++;
                    $products[$row[productId]]['quantity'] = $quantity;
                    $products[$row[productId]]['imageUrl'] = $row[imageUrl];
                    $products[$row[productId]]['name'] = $row[name];
                    $products[$row[productId]]['price'] = $row[price];
                }
                else
                {
                    $products[$row[productId]]['quantity'] = $row[productquantity];
                    $products[$row[productId]]['imageUrl'] = $row[imageUrl];
                    $products[$row[productId]]['name'] = $row[name];
                    $products[$row[productId]]['price'] = $row[price];
                }                               
            }
            
            echo "<div class=\"row\">";
            foreach($products as $key => $value){
                if($key == 0){
                    continue;
                }
                $image = $products[$key]['imageUrl'];
                $name  = $products[$key]['name'];
                $quantity = $products[$key]['quantity'];
                $price    = $products[$key]['price'];
                $total += ($price * $quantity);
                $quantityprice = ($price * $quantity);


                        echo "<div class=\"col-sm-4 col-lg-4 col-md-4\">";
                            echo "<div class=\"thumbnail\">";
                                echo "<img src=\"$image\" style='width: 200px;height: 200px;margin: 20px;margin: 0 auto;'>";
                                echo "<div class=\"caption\">";
                                 echo "<h4 class=\"pull-right\">$$quantityprice</h4>";
                                    echo "<h4><a href=\"#\">$name</a></h4>";
                                    echo "<p><b>Quantity</b> $quantity</p>";

                                    echo "<form action=\"\" method=\"post\" style=\"margin:3px;padding: 0px;\" class=\"pull-right\"> 
                                        <input type=\"submit\" name=\"submit\" value=\"Remove\"> <input type=\"hidden\" name=\"remove\" value=\"$key\" class=\"pull-right\">";
                                    echo "</form>";

                                echo "</div>";

                            echo "</div>";
                        echo "</div>";
            }
             echo "</div>";
            echo "<h3 style=\"margin:20px;padding: 0px;\">Total Price:   $$total</h3>";
            echo "<form action=\"payment.html\" method=\"post\"> 
            <input type=\"submit\" name=\"Checkout\" value=\"Checkout\" style=\"margin:20px;width: 10%;height: 40px;font-weight: bold\">";

           
        } catch
        (PDOException $ex) {
            echo 'ERROR : ' . $ex->getMessage();
        }

        ?>

    </p>
</div>
</body>
</html>


