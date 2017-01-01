<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Browse Products</title>
        <!-- jQuery -->
        <script src="../js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/shop-homepage.css" rel="stylesheet">

    </head>

    <body style="width: 100%;height: 100%">
        <div>

            <?php
            error_reporting(E_ERROR);
            session_start();
            $count = 0;
            $emailidGlobal = $_SESSION["email"];
            $passidGlobal = $_SESSION["pass"];

            //submit  - for adding to cart
            //search - for search
            //login - for login
            //submit_form - for signup


            function displayProducts($searchText)
            {
                $queryGetAllProducts = "select p.productId,p.imageUrl,p.name,p.type,p.price,d.perc from product p, discount d where p.discountId = d.discountId and p.name like \"%" . $searchText . "%\" order by p.name;";

                // Connect to the database.
                session_start();
                $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);


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
                echo "<a class=\"navbar-brand\" href=\"products.php\">Products</a>";
                echo "</div>";
                echo "<!-- Collect the nav links, forms, and other content for toggling -->";
                echo "<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">";
                echo "<ul class=\"nav navbar-nav\">";
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

                // Search Code Begin
                echo "<div class=\"col-sm-3 col-md-3\">";
                echo "<form class=\"navbar-form\" role=\"search\" action=\"products.php\" method=\"post\" >";
                echo "<div class=\"input-group\">";
                echo "<input type=\"text\" class=\"form-control\" placeholder=\"Search\" name=\"searchText\">";
                echo "<div class=\"input-group-btn\">";
                echo "<button class=\"btn btn-default\" name=\"search\" type=\"submit\"><i class=\"glyphicon glyphicon-search\"></i></button>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
                echo "</div>";
                // Search Code End

                echo "<ul class=\"nav navbar-nav navbar-right\">";
                echo "<li><a href=\"index1.html\">Logout</a></li>";
                echo "</ul>";


                echo "</div>";
                echo "<!-- /.navbar-collapse -->";
                echo "</div>";
                echo "<!-- /.container -->";
                echo "</nav>";

                $dataProducts = $con->query($queryGetAllProducts);
                $dataProducts->setFetchMode(PDO::FETCH_ASSOC);

                echo "<div class=\"row\">";
                echo "<div class=\"col-md-12\">";

                if ($searchText == "") {
                    echo "<div class=\"row carousel-holder\">";
                    echo "<div class=\"col-md-12\">";
                    echo "<div id=\"carousel-example-generic\" class=\"carousel slide\" data-ride=\"carousel\">";
                    echo "<ol class=\"carousel-indicators\">";
                    echo "<li data-target=\"#carousel-example-generic\" data-slide-to=\"0\" class=\"active\"></li>";
                    echo "<li data-target=\"#carousel-example-generic\" data-slide-to=\"1\"></li>";
                    echo "<li data-target=\"#carousel-example-generic\" data-slide-to=\"2\"></li>";
                    echo "</ol>";
                    echo "<div class=\"carousel-inner\">";
                    echo "<div class=\"item active\">";
                    echo "<img class=\"slide-image\" src=\"http://gingerbread.marketing/wp-content/uploads/2016/06/welcome.jpg\" style='height: 400px' alt=\"\">";
                    echo "</div>";
                    echo "<div class=\"item\">";
                    echo "<img class=\"slide-image\" src=\"http://epricestore.com/wp-content/uploads/2015/06/Snapdeal-Electronics-Sale-Discount-Coupon-Code.jpg\" style='height: 400px' alt=\"\">";
                    echo "</div>";
                    echo "<div class=\"item\">";
                    echo "<img class=\"slide-image\" src=\"http://www.calew.com/images/Electronics.png\"  style='height: 400px' alt=\"\">";
                    echo "</div>";
                    echo "</div>";
                    echo "<a class=\"left carousel-control\" href=\"#carousel-example-generic\" data-slide=\"prev\">";
                    echo "<span class=\"glyphicon glyphicon-chevron-left\"></span>";
                    echo "</a>";
                    echo "<a class=\"right carousel-control\" href=\"#carousel-example-generic\" data-slide=\"next\">";
                    echo "<span class=\"glyphicon glyphicon-chevron-right\"></span>";
                    echo "</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }

                foreach ($dataProducts as $row) {


                    echo "<div class=\"col-sm-4 col-lg-4 col-md-4\">";
                    echo "<div class=\"thumbnail\">";
                    echo "<img src=\"$row[imageUrl]\" style='width: 200px;height: 200px;margin: 20px auto;' alt=\"\">";
                    echo "<div class=\"caption\">";
                    echo "<h4 class=\"pull-right\">$$row[price]</h4>";
                    echo "<h4><a href=\"#\">$row[name]</a></h4>";
                    echo "<p><b>Discount</b> $row[perc] %</p>";

                    echo "<form action=\"\" method=\"post\" style='display: flex;justify-content: space-between;align-items: center'>";
                    echo "<span style='font-size: smaller;'>Enter Quantity</span> <input type=\"text\" name=\"quantity\" value=\"1\" style='margin: 10px 0px 10px 0px;width: 100px;'>";
                    echo "<input type=\"hidden\" name=\"productId\" value=\"$row[productId]\" style='margin: 10px 0px 10px 0px;width: 100px;'>";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-default\" name=\"submit\">
                                        <span class=\"glyphicon glyphicon-shopping-cart\" ></span> Add to Cart
                                    </button></td>";


                    echo "</form>";

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
                    echo "<form action=\"feedback.php\" method=\"post\" style='display: flex;justify-content: center'>
                            <input type='hidden' name='productId' value='$row[productId]'>
                            <input type='submit' name='submitFeedback' value='Leave a feedback' class='btn btn-info'>    
                          </form>";
                    echo "</p>";

                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }

            if (isset($_POST['submit'])) {
                try {
                    // Connect to the database.
                    $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                    $con->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);

                    $emailid = $_SESSION["email"];
                    $passid = $_SESSION["pass"];
                    $productquantity = $_POST['quantity'];
                    $productId = $_POST['productId'];
                    $productId = (int)$productId;
                    $display = $_SESSION["login_form"];

                    $query = " INSERT INTO carthistory  (`email`, `productquantity`, `productId`) VALUES( '$emailid',$productquantity, $productId ) ";

                    $count = 1;

                    // Fetch the database field names.
                    $result = $con->query($query);
                    echo '<script type="text/javascript">alert("Your product has been added. Please view shopping cart for more details.");</script>';
                    displayProducts("");

                } catch (PDOException $ex) {
                    echo 'ERROR : ' . $ex->getMessage();
                }
            } else if (isset($_POST['search'])) {
                $searchText = "";
                $searchText = $_POST['searchText'];
                $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);
                $historycount = "SELECT count(*) as count from searchhistory";
                $result = $con->query($historycount);
                $result->setFetchMode(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    $count = $row['count'];
                }
                if ($count == 0){
                    $number = 1;
                }else {
                    $number = $count +1 ;
                }
                //store value into search history
                $historyInsert = "INSERT INTO searchhistory(searchOrder, searchTerm,customerId) VALUES('$number','$searchText',{$_SESSION['customerNo']})";
                $result = $con->query($historyInsert);
                //echo $historyInsert;
                displayProducts($searchText);


            } else if (isset($_POST['login_form'])) {

                $emailid = $_POST["email"];
                $passid = $_POST["password"];
                session_start();
                $_SESSION["email"] = $emailid;
                $_SESSION["pass"] = $passid;

                $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                $con->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);

                $queryCheckCustomer = "select count(*) as count from userdata where email='$emailid' and password='$passid';";
                $result = $con->query($queryCheckCustomer);
                $result->setFetchMode(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    $count = $row['count'];

                    if ($count == 0) {
                        //redirect to login page
                        header("Location: http://localhost/ecommerce/new_sites/index1.html?error=wrongcredentials");
                    } else {
                        //echo  $customerId."    ".$queryCustomerDetails;


                        $queryCustomerDetails = "select customerId,type from userdata where email='$emailid' and password='$passid';";
                        $result = $con->query($queryCustomerDetails);
                        $result->setFetchMode(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            if ($row['type'] == "admin") {
                                header("Location: http://localhost/ecommerce/new_sites/admin/manageAccount.php");
                            }

                            $customerId = $row['customerId'];
                            $_SESSION["customerNo"] = $customerId;
                            displayProducts("");
                        }

                    }
                }

            } else if (isset($_POST['submit_form'])) {

                $firstname = $_POST['firstName'];
                $lastname = $_POST['lastName'];
                $emailid = $_POST['email'];
                $password = $_POST['password'];
                $gender = $_POST['gender'];
                $selected_val = $_POST['select'];


                try {
                    $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                    $con->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);

                    $query1 = "INSERT INTO customer(firstName,lastName,gender,addressId) VALUES('$firstname','$lastname','$gender',null);";
                    $con->query($query1);
                    $customerIdQuery = "SELECT LAST_INSERT_ID();";
                    $customerId = $con->query($customerIdQuery);
                    $query2 = "INSERT INTO userdata(email,password,type,customerId) VALUES('$emailid','$password','customer','$customerId');";

                    $result = $con->query($query2);

                    if ($result != false) {
                        displayProducts("");
                    }
                } catch (PDOException $ex) {
                    echo 'ERROR : ' . $ex->getMessage();
                }

            } else {
                displayProducts("");
            }
            ?>
        </div>
        </div>
    </body>
</html>


