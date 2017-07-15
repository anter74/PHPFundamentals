<?php include_once("utilities/databaseConnection.php");
include("template/ListAuthors.php");

//makes numbers into dollars,
//money_format() doesn't work on windows servers
//http://stackoverflow.com/questions/21507977/
function asDollars($value)
{
    return '$' . number_format($value, 2);
}

include_once("utilities/encryption.php"); ?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Order History - GeekBooks - MIS 314 Sample Bookstore</title>
    <link rel="stylesheet" href="style/newStyle.css"
          type="text/css"/>
</head>
<body>

<?php include("template/header.php") ?>

<div class="pageContainer">
    <div class="leftColumn">

        <?php include("template/menu.php") ?>

    </div>
    <section>
        <div class="pageTitle">Your Order History</div>
        </br>
        <?php
        $link = fConnectToDatabase();
        $custID = decrypt(fCleanString($link, $_GET["custIDe"], 300), $myPassword);
        $sql = "SELECT b.ISBN, b.qty, b.price, a.orderdate ,a.custID , a.orderID, b.orderID, c.ISBN, c.title FROM bookorders a, bookorderitems b, bookdescriptions c WHERE a.custID = '$custID' AND a.orderID = b.orderID AND b.ISBN = c.ISBN ORDER BY a.orderdate DESC";
        $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));
        echo " <div class='pageTitle2'>You have ordered " . mysqli_num_rows($result) . " books
                     </div> <br/>";

        while ($row = mysqli_fetch_array($result)) {
            $isbn = $row['ISBN'];
            $qty = $row['qty'];
            $price = $row['price'];
            $orderID = $row['orderID'];
            $orderDate = $row['orderdate'];
            $title = $row['title'];
            $author = fListAuthors($link, $isbn);
            echo "<div class=\"bookHistory\">
                    <a href=\"ProductPage.php?isbn=$isbn\"><img class=\"History\" src=\"/sandvig/mis314/assignments/bookstore//bookimages/$isbn.01.THUMBZZZ.jpg\" alt=\"L\">
                  </a>                 
                 <b>Order ID: $orderID</b>&nbsp;&nbsp;
                   " . date('  F j Y g:i A', $orderDate) . "
                 <br> 
 		         <a class=\"booktitle\" href=\"ProductPage.php?isbn=$isbn\">$title</a><br>
                  <span class=\"authors\">by $author</span><br>
                  Qty: $qty  Price: " . asDollars($price * $qty) . "
         </div>";
        }
        ?>
    </section>

    <?php include("template/footer.php") ?>
</div>
</body>
</html>


