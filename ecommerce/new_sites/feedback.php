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
                    <a href="products.php"> Products </a> &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                    <a href="settings.html">Account</a> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                    <a href="shoppingcart.php"> View Shopping Cart </a> &nbsp;&nbsp;&nbsp;
                    <a href="history.php"> History </a> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                    <a href="customercare.html"> Customer Care &nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a class="logout-link" href="index1.html">Logout</a>
                </div>
            </nav>
            <div>

                <div id="container" style="margin: 20px;width: 35%">
                    <div id="left"><br><br>
                        <form action="feedback.php" method="post">
                            <fieldset>
                                <br><br>
                                <legend> &nbsp; Your feedback is important to us!! &nbsp;</legend>
                                <label for="username-input" style="padding-left:30px">Enter your feedback</label><br>
                                <br> &nbsp; &nbsp;
                                <textarea rows="4" cols="50" name="feedbackComment"></textarea><br>
                                <br>
                                <label style="padding-left:30px">Choose Rating:</label>
                                <select name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select><br><br>
                                <input type="submit" value="Save" name="submitFeedbackAndRating"
                                       style="display: inline-block;padding: 10px 20px;margin-left: 5%">
                                <br>

                                <br>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php

        session_start();
        if (isset($_POST['submitFeedback'])) {
            $_SESSION['feedbackProductId'] = $_POST['productId'];
        }

        if (isset($_POST['submitFeedbackAndRating'])) {
            $feedbackComment = $_POST['feedbackComment'];
            $rating = $_POST['rating'];
            $customerId = $_SESSION['customerNo'];
            $productId = $_SESSION['feedbackProductId'];
            submitFeedback($productId, $customerId, $feedbackComment, $rating);
        }

        function submitFeedback($productId, $customerId, $feedbackComment, $rating)
        {

            $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);

            $query3 = "SELECT COUNT(*) as count FROM `feedbackinfo` WHERE `productId` = $productId and `customerId` = $customerId";
            $feedbackExists = $con->query($query3);
            $feedbackExists->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($feedbackExists as $row) {
                if($row['count'] == 1){
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Your feedback was already added to the following product.')
                    window.location.href='./products.php';
                    </SCRIPT>");
                }
            }

            $query1 = "insert into feedback(feedbackcomment,rating,dateOfFeedback) values('$feedbackComment',$rating,CURDATE())";
            $con->query($query1);

            $feedbackIdQuery = "SELECT LAST_INSERT_ID() as lastId;";

            $feedbackIdResult = $con->query($feedbackIdQuery);
            $feedbackIdResult->setFetchMode(PDO::FETCH_ASSOC);

            foreach ($feedbackIdResult as $row) {
                $feedbackId = $row['lastId'];
                $query2 = "insert into feedbackinfo(productId,customerId,feedbackId) values($productId,$customerId,$feedbackId);";
                $con->query($query2);
                break;
            }
            echo '<script type="text/javascript">alert("Your valuable feedback has been added, Thank you so much.");</script>';
        }

        ?>
        </div>
    </body>
</html>
