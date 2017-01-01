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

        <title>Products searched</title>
    </head>
    <body>
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
        echo "<a class=\"navbar-brand\" href=\"shoppingcart.php\">Search</a>";
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
        echo "<a href=\"customercare.php\">Customer Care</a>";
        echo "</li>";
        echo "</ul>";

        echo "<ul class=\"nav navbar-nav navbar-right\">";
        echo "<li><a href=\"index1.html\">Logout</a></li>";
        echo "</ul>";


        echo "</div>";
        echo "<!-- /.navbar-collapse -->";
        echo "</div>";
        echo "<!-- /.container -->";
        echo "</nav>";
        session_start();
        $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
        $con->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
        $search = $_SESSION['search'];
        $queryGetAllProducts = "select p.imageUrl,p.name,p.type,p.price, d.perc from product p, discount d where p.discountId = d.discountId and p.name like \"%" . $search . "%\" order by p.name;";

        $dataProducts = $con->query($queryGetAllProducts);
        $dataProducts->setFetchMode(PDO::FETCH_ASSOC);
        $cols = $dataProducts->rowCount();


        if ($cols > 0) {
            foreach ($dataProducts as $row) {

                echo "<div class=\"col-sm-4 col-lg-4 col-md-4\">";
                echo "<div class=\"thumbnail\">";
                echo "<img src=\"$row[imageUrl]\" style='width: 200px;height: 200px;margin: 20px;margin: 0 auto;'>";
                echo "<div class=\"caption\">";
                echo "<h4 class=\"pull-right\">$$row[price]</h4>";
                echo "<h4><a href=\"#\">$row[name]</a></h4>";
                echo "<p><b>Discount</b> $row[perc] %</p>";


                echo "<form action=\"\" method=\"post\">";
                echo "<span style='font-size: smaller;'>Enter Quantity</span> <input type=\"text\" name=\"quantity\" value=\"1\" style='margin: 10px 0px 10px 0px;width: 100px;'>";
                echo "<input type=\"hidden\" name=\"product\" value=\"$row[name]\" style='margin: 10px 0px 10px 0px;width: 100px;'>";
                echo "<input type=\"hidden\" name=\"productprice\" value=\"$row[price]\" style='margin: 10px 0px 10px 0px;width: 100px;'>";
                echo "<input type=\"submit\" name=\"submit\" value=\"Add to cart\" class=\"pull-right\" style='border: none;margin: 10px'>";
                echo "</form>";


                //echo "<span style='font-size: smaller;'> Quantity</span> <input type=\"text\" name=\"quantity\" value=\"1\">";
                echo "</div>";
                echo "<div class=\"ratings\">";
                $rcount = rand(1, 100);
                echo "<p class=\"pull-right\">$rcount reviews</p>";
                $fscount = rand(1, 5);
                echo "<p>";
                for ($x = 0; $x < $fscount; $x++) {
                    echo "<span class=\"glyphicon glyphicon-star\"></span>";
                }
                for ($x = $fscount; $x < 5; $x++) {
                    echo "<span class=\"glyphicon glyphicon-star-empty\"></span>";
                }
                echo "</p>";

                echo "</div>";
                echo "</div>";
                echo "</div>";

            }
        } else {
            echo "<h2 align=\"center\">Sorry no products found !</h2>";
        }
        ?>
    </body>
</html>
