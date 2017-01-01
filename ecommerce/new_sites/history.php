<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/settings.css">
        <style>
            #historyLink {
                display: inline-block;
                margin: 10px 0px 10px 40px;
                text-decoration: none;
                color: black;
                transition-property: color, transform;
                transition-duration: 0.5s;
            }

            #historyLink:hover {
                color: #2a73cb;
                transform: scale(1.005, 1.1);
            }
        </style>
        <title>Search History</title>
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar">
                <div class="navbar-container">

                    <a href="history.php"> <b>Search History</b> </a> &nbsp; &nbsp;&nbsp; &nbsp;
                    <a href="products.php"> Products </a> &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                    <a href="settings.html">Account</a> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                    <a href="shoppingcart.php"> View Shopping Cart </a> &nbsp;&nbsp;&nbsp;
                    <a href="customercare.html"> Customer Care</a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="logout-link" href="index1.html">Logout</a>

                </div>
            </nav>
            <div style="padding-left:30px;padding-top:30px;padding-right:30px">

                <p>
                    <?php

                    try {

                        echo "<form action=\"remove.php\" method=\"post\">";
                        echo "<fieldset>";
                        echo "<legend> &nbsp; Search History &nbsp;</legend><br><br>";

                        session_start();

                        $custId = $_SESSION['customerNo'];

                        echo "</select><br><br>";


                        $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
                        $con->setAttribute(PDO::ATTR_ERRMODE,
                            PDO::ERRMODE_EXCEPTION);


                        //store value into search history
                        $query1 = "SELECT searchTerm FROM searchhistory where customerId=$custId order by searchOrder DESC";
                        $result = $con->query($query1);
                        echo "<ul style='display: flex;flex-direction: column;'>";
                        foreach ($result as $row) {

                            $searchText = $row['searchTerm'];
                            $_SESSION['search'] = $searchText;
                            echo "<a id='historyLink' href='search.php'><li>$searchText</li></a>";
                        }
                        echo "</ul>";


                    } catch (PDOException $ex) {
                        echo 'ERROR : ' . $ex->getMessage();
                    }


                    ?>

                </p>
            </div>
        </div>
    </body>
</html>


