<?php


header("Content-Type:application/json");
//session_start();
//$email = $_SESSION['email'];
$con = new PDO("mysql:host=localhost;dbname=pioneersanalytics", "root", "sesame");
$con->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);

function deliverResponse($response)
{
    //header("HTTP/1.1 $status $statusMessage");
    $jsonRes = json_encode($response);
    echo $jsonRes;
}


$queryNumber = $_GET['queryNumber'];

$description;
$detail;

$query1 = "SELECT p.name, p.productType, p.price, p.discountPercent FROM PRODUCT p, ORDERS o WHERE p.Productkey =o.Productkey AND p.discountPercent>=5 ORDER BY p.price, p.discountPercent;";

$query2 = "SELECT p.name, f.rating, p.discountPercent, c.MonthinYear, c.YearNumber FROM product p, calendar c, feedback f WHERE p.Productkey = f.Productkey and c.Calendarkey = f.Calendarkey and p.discountPercent > 2 and f.rating >= 1 ORDER BY p.discountPercent, c.MonthinYear, c.YearNumber;";

$query3 = "Select p.name, o.revenue,l.state,c.MonthinYear from Location l, Calendar c, Orders o,Product p where o.Productkey = p.Productkey AND o.Locationkey = l.Locationkey AND o.Calendarkey = c.Calendarkey ORDER BY o.revenue;";

$query4 = "Select DISTINCT(p.name), o.revenue,l.state,c.MonthinYear from Location l, Calendar c, Orders o,Product p where o.Productkey = p.Productkey AND o.Locationkey = l.Locationkey AND o.Calendarkey = c.Calendarkey AND l.state='CA' AND c.MonthinYear='Oct' ORDER BY o.revenue;";

$query5 = "select c.MonthinYear, sum(o.revenue) as revenue from Orders o, Calendar c where c.Calendarkey=o.Calendarkey group by c.MonthinYear ORDER BY revenue;";

$query6 = "select c.MonthinYear, sum(o.revenue) as revenue from Orders o, Calendar c where c.Calendarkey=o.Calendarkey and c.MonthinYear = \"July\" group by c.MonthinYear ORDER BY revenue;";

$query7 = "Select l.state, sum(o.revenue) as revenue from Location l, Calendar c, Orders o, Product p where o.Productkey = p.Productkey AND o.Locationkey = l.Locationkey AND o.Calendarkey = c.Calendarkey group by l.state ORDER BY revenue;";

$query8 = "Select l.city, l.state, sum(o.revenue) as revenue from Location l, Calendar c, Orders o, Product p where o.Productkey = p.Productkey AND o.Locationkey = l.Locationkey AND o.Calendarkey = c.Calendarkey and l.state=\"CA\" group by l.city ORDER BY revenue;";

$query9 = "Select l.state, sum(o.revenue) as revenue from Location l, Calendar c, Orders o, Product p where o.Productkey = p.Productkey AND o.Locationkey = l.Locationkey AND o.Calendarkey = c.Calendarkey group by l.state ORDER BY revenue;";

$query10 = "Select l.country, sum(o.revenue) as revenue from Location l, Calendar c, Orders o, Product p where o.Productkey = p.Productkey AND o.Locationkey = l.Locationkey AND o.Calendarkey = c.Calendarkey group by l.country ORDER BY revenue;";

if ($queryNumber == 1) {
    $description = "Analytical Query";
    $detail = "Query all list of products which have a discount of at least 5% and ordered at least once.";
    $query = $query1;
} else if ($queryNumber == 2) {
    $description = "Analytical Query";
    $detail = "Query all products who have a discount greater than 2% and rating greater than or equal to one.";
    $query = $query2;
} else if ($queryNumber == 3) {
    $description = "Before Dice Operation";
    $detail = "Query revenue of products sold in different states for different months in a year.";
    $query = $query3;
} else if ($queryNumber == 4) {
    $description = "After Dice Operation on State column and Month column";
    $detail = "Query revenue of products sold in California in the month of October.";
    $query = $query4;
} else if ($queryNumber == 5) {
    $description = "Before Slice Operation";
    $detail = "Get revenue of products grouped by month for all years";
    $query = $query5;
} else if ($queryNumber == 6) {
    $description = "After Slice Operation on Month column";
    $detail = "Get revenue of products in the month of July for all years";
    $query = $query6;
} else if ($queryNumber == 7) {
    $description = "Before Drill Down Operation - State Level";
    $detail = "Get revenue of products by different states";
    $query = $query7;
} else if ($queryNumber == 8) {
    $description = "After Drill Down Operation - City Level";
    $detail = "Get revenue of products for different cities in the state of california";
    $query = $query8;
} else if ($queryNumber == 9) {
    $description = "Before Drill Up Operation - State Level";
    $detail = "Get revenue of products by different states";
    $query = $query9;
} else if ($queryNumber == 10) {
    $description = "After Drill Up Operation - Country Level";
    $detail = "Get revenue of products by countries";
    $query = $query10;
}

$data = $con->query($query);
$data->setFetchMode(PDO::FETCH_ASSOC);
$responseData = array();
$response;
$doHeader = true;
$count = 0;
$responseDataName;


// Construct the JSON
foreach ($data as $row) {

    if ($doHeader) {
        $responseDataName = array();
    }

    foreach ($row as $name => $value) {
        if ($doHeader) {
            array_push($responseDataName, $name);
        }
    }

    if ($doHeader) {
        array_push($responseData, $responseDataName);
    }

    $doHeader = false;
    $responseDataValue = array();


    $count++;
    foreach ($row as $name => $value) {
        array_push($responseDataValue, $value);
    }
    array_push($responseData, $responseDataValue);
}

$response['query'] = $query;
$response['data'] = $responseData;
$response['count'] = $count;
$response['description'] = $description;
$response['detail'] = $detail;

deliverResponse($response);


?>