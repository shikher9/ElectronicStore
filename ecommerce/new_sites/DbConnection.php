<?php

class Query1Result {


    private $email;
    private $quantity;
    
    public function getEmail() { return $this->email; }
    public function getQuantity() { return $this->quantity; }
    
}


class Query2Result {


    private $productId;
    private $name;
    
    public function getProductId() { return $this->productId; }
    public function getName() { return $this->name; }
    
}


class Query3Result {


    private $customerId;
    private $rating;
    private $feedbackcomment;
    
    public function getCustomerId() { return $this->customerId; }
    public function getRating() { return $this->rating; }
    public function getFeebackComment() { return $this->feedbackcomment;}
    
}


class Query4Result {

    private $customerId;
    private $firstName;
    private $lastName;
    private $countO;
    
    public function getCustomerId() { return $this->customerId; }
    public function getFirstName() { return $this->firstName; }
    public function getLastName() { return $this->lastName; }
    public function getCount() { return $this->countO; }    
}

class Query5Result {

    private $orderId;
    private $name;
    private $quantity;
    private $firstName;
    private $lastName;
    
    public function getOrderId() { return $this->orderId; }
    public function getName() { return $this->name; }
    public function getQuantity() { return $this->quantity; }
    public function getFirstName() { return $this->firstName; }
    public function getLastName() { return $this->lastName; }
}


abstract class DbConnection {

        public function createTableRowQuery1(Query1Result $query1result) {
            print "        <tr>\n";
            print "            <td>" . $query1result->getEmail()     . "</td>\n";
            print "            <td>" . $query1result->getQuantity()  . "</td>\n";
            print "        </tr>\n";
        }
        public function createTableRowQuery2(Query2Result $query2result) {
            print "        <tr>\n";
            print "            <td>" . $query2result->getProductId()     . "</td>\n";
            print "            <td>" . $query2result->getName()  . "</td>\n";
            print "        </tr>\n";
        }
        public function createTableRowQuery3(Query3Result $query3result) {
            print "        <tr>\n";
            print "            <td>" . $query3result->getCustomerId()     . "</td>\n";
            print "            <td>" . $query3result->getRating()  . "</td>\n";
            print "            <td>" . $query3result->getFeebackComment()  . "</td>\n";
            print "        </tr>\n";
        }
        public function createTableRowQuery4(Query4Result $query4result) {
            print "        <tr>\n";
            print "            <td>" . $query4result->getCustomerId()     . "</td>\n";
            print "            <td>" . $query4result->getFirstName()  . "</td>\n";
            print "            <td>" . $query4result->getLastName()     . "</td>\n";
            print "            <td>" . $query4result->getCount()  . "</td>\n";
            print "        </tr>\n";
        }
        public function createTableRowQuery5(Query5Result $query5result) {
            print "        <tr>\n";
            print "            <td>" . $query5result->getOrderId()     . "</td>\n";
            print "            <td>" . $query5result->getName()  . "</td>\n";
            print "            <td>" . $query5result->getQuantity()     . "</td>\n";
            print "            <td>" . $query5result->getFirstName()  . "</td>\n";
            print "            <td>" . $query5result->getLastName()     . "</td>\n";
            print "        </tr>\n";
        }

    	/*
            $query - this refers to the query string
            $queryNumber - this refers to the query number, can be 1,2,3,4 or 5.
            This will help in choosing the query class
        */
        public function getConnectionToQueries($query,$queryNumber){

		    try {

		    $con = new PDO("mysql:host=localhost;dbname=pioneers", "root", "sesame");
		    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $ps = $con->prepare($query);
		    $ps->execute();

            print "   <center> <table border='1'>\n";

            if($queryNumber == 1) 
            {
                $ps->setFetchMode(PDO::FETCH_CLASS, "Query1Result");

                print "        <tr>\n";
                print "            <td>Email</td>\n";
                print "            <td>Quantity</td>\n";
                print "        </tr>\n";

                // Construct the HTML table row by row.
                while ($query1result = $ps->fetch()) {
                    $this->createTableRowQuery1($query1result);
                }
            } else if($queryNumber == 2) {
                $ps->setFetchMode(PDO::FETCH_CLASS, "Query2Result");

                print "        <tr>\n";
                print "            <td>Product Id</td>\n";
                print "            <td>Name</td>\n";
                print "        </tr>\n";

                // Construct the HTML table row by row.
                while ($query2result = $ps->fetch()) {
                     $this->createTableRowQuery2($query2result);                        
                }

            } else if($queryNumber == 3) {
                $ps->setFetchMode(PDO::FETCH_CLASS, "Query3Result");


                print "        <tr>\n";
                print "            <td>Customer Id</td>\n";
                print "            <td>Rating</td>\n";
                print "            <td>Feedback Comment</td>\n";
                print "        </tr>\n";

                // Construct the HTML table row by row.
                while ($query3result = $ps->fetch()) {
                     $this->createTableRowQuery3($query3result);                        
                }

            } else if($queryNumber == 4) {
                $ps->setFetchMode(PDO::FETCH_CLASS, "Query4Result");

                print "        <tr>\n";
                print "            <td>Customer Id</td>\n";
                print "            <td>First Name</td>\n";
                print "            <td>Last Name</td>\n";
                print "            <td>Count</td>\n";
                print "        </tr>\n";

                // Construct the HTML table row by row.
                while ($query4result = $ps->fetch()) {
                     $this->createTableRowQuery4($query4result);
                }

            } else if($queryNumber == 5) {
                $ps->setFetchMode(PDO::FETCH_CLASS, "Query5Result");

                print "        <tr>\n";
                print "            <td>Order Id</td>\n";
                print "            <td>Name</td>\n";
                print "            <td>Quantity</td>\n";
                print "            <td>First Name</td>\n";
                print "            <td>Last Name</td>\n";
                print "        </tr>\n";

                // Construct the HTML table row by row.
                while ($query5result = $ps->fetch()) {
                     $this->createTableRowQuery5($query5result);
                }
            }

            print "    </center></table>\n";
            } catch(PDOException $ex) {
		          echo 'ERROR: '.$ex->getMessage();
		    } catch(Exception $ex) {
		          echo 'ERROR: '.$ex->getMessage();
		    }
 
        }
        
}
?>


