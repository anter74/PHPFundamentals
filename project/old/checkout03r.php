<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Shipping Information - GeekBooks - MIS 314 Sample Bookstore</title>
    <link rel="stylesheet" href="/sandvig/mis314/assignments/bookstore/styleSheet.css" type="text/css">
</head>
<body>
<?php
include("template/header.php");
?>
<?php
include_once("utilities/databaseConnection.php");
?>
<?php
include_once("utilities/encryption.php");
?>
<?php
include("utilities/validationUtilities.php");
function asDollars($value)
{
    return '$' . number_format($value, 2);
}

$link = fConnectToDatabase();
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$street = $_POST['street'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$city = $_POST['city'];
$custIDe = $_POST['custIDe'];

echo $custIDe . " decrypted " ;
?>


<div class="pageContainer">
    <div class="checkoutContent">
        <p class='centeredNotice'>
            <?php

            $IsValid = true;
            if (!fIsValidEmail($email)) {
                echo "Invalid email<br>";
                $IsValid = false;
            }
            if (!fIsValidLength($fname, 2, 20)) {
                echo "Enter first name (2-20 characters)<br>";
                $IsValid = false;
            }
            if (!fIsValidLength($lname, 2, 20)) {
                echo "Enter last name (2-20 characters)<br>";
                $IsValid = false;
            }
            if (!fIsValidAddr($street, 2, 150)) {
                echo "Enter valid address (ex: 1010 address dr)<br>";
                $IsValid = false;
            }
            if (!fIsValidStateAbbr($state)) {
                echo "Enter valid 2-character state abbreviation<br>";
                $IsValid = false;
            }
            if (!fIsValidZipcode($zip)) {
                echo "Enter a valid 5-digit Zip Code<br>";
                $IsValid = false;
            }
            if (!fIsValidLength($city, 2, 50)) {
                echo "Enter a valid city<br>";
                $IsValid = false;
            }
            if (!$IsValid) {
                //at least one element not valid. Echo a message and stop execution
                echo "<p class=\"centeredNotice\" ><input type='button' class='button' style='width:200px;' value='<< Go Back <<' onClick='history.back()'><br></p>";

                include("template/footer.php");
                //stop execution.
                exit();
            }
            ?>
        </p>
        <div class='pageTitle'>Order Confirmation</div>
        <br>
        <?

        if (!isset($custIDe)) {
            $sql = "INSERT INTO bookcustomers VALUES (NULL, '$fname','$lname','$email','$street','$city','$state','$zip')";
            $custID = mysqli_insert_id($link);
        } else {
            $custID = decrypt($custIDe, $myPassword);
            $sql = "UPDATE bookcustomers SET fname='$fname',lname='$lname',email='$email',street='$street',city='$city',state='$state',zip='$zip' WHERE custID='$custID'";
        }
        $result = mysqli_query($link, $sql) or die('SQL syntax error: ' . mysqli_error($link));
        $cookieName = "myCart2";
        // retrieve cookie and unserialize into $bookArray
        if (isset($_COOKIE[$cookieName])) {
            $bookArray = unserialize($_COOKIE[$cookieName]);
        }
        //echo $custID . "</br>";
        //echo $sql . "</br>";
        //echo var_dump($bookArray) . "</br>";

        setcookie($cookieName, null, time() - 60000);
        if(count($bookArray) > 0){
        $time = time();
        $sql = "INSERT INTO `bookorders` (`orderID`,`custID`,`orderdate` ) VALUES (NULL, '$custID', '$time')";
        // echo "sql 1 :::   " . $sql . "</br>";
        $result = mysqli_query($link, $sql) or die('SQL syntax error: ' . mysqli_error($link));
        $discount = 0.8;
        $orderID = mysqli_insert_id($link);

        foreach ($bookArray as $isbn => $qty) {
            $sql = "INSERT INTO bookorderitems (orderID, isbn, qty, price) VALUES ($orderID, '$isbn', $qty, (select (price * $discount) from bookdescriptions where ISBN = '$isbn'))";
            //echo "sql 2 :::   " . $sql;
        }
        $result = mysqli_query($link, $sql) or die('SQL syntax error: ' . mysqli_error($link));}
        ?>

        <table id='cart'>
            <tr>
                <td class='boldLabel'>
                    Order Number:
                </td>
                <td>
                    <? if(count($bookArray) > 0) echo $orderID; ?>
                </td>
            </tr>

            <tr>
                <td valign='top' class='boldLabel'>
                    Shipping Address:
                </td>
                <td>
                    <?php
                    echo "$fname $lname </br>$street </br>$city, $state $zip";
                    ?>
                </td>
            </tr>
            <? //Count total books in cart
            $totalbooks = 0;
            if(count($bookArray) > 0){
            foreach ($bookArray as $isbn => $qty) {
                $totalbooks += $qty;
            }
            ?>
            <tr>
                <td valign='top' class='boldLabel'>
                    Books Shipped:
                </td>
                <td>

        </table>


        <?
        $sql = "SELECT isbn, title, price
                FROM bookdescriptions
                WHERE";
        foreach ($bookArray as $isbn => $qty) {
            $sql .= " isbn = '$isbn' OR";
        }
        $sql = substr($sql, 0, -3);
        //        echo "SQL: " . $sql . " BOOKARRAY:" . "<pre>" . var_dump($bookArray) . "</pre>";
        if (strlen($sql) > 87) {
            $result = mysqli_query($link, $sql) or die('SQL syntax error: ' . mysqli_error($link));
        } else {
            $noBooks = true;
        }

        ?>
        <table id="cart">
            <tbody>
            <tr>
                <th>Title</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th></th>
            </tr>
            <?php
            $subtotal = 0;
            $total = 0;
            while ($row = mysqli_fetch_array($result)) {
                $title = $row['title'];
                $isbn = $row['isbn'];
                $price = $row['price'];
                $qty = $bookArray["$isbn"];
                $subtotal += $price * $qty;
                echo "<tr>
                                  <td><a class='booktitle' href='../ProductPage.php?isbn=$isbn'> $title </a></td>
                                  <td>$qty</td>
                                  <td class='bookPrice'>" . asDollars($price * 0.8) . "</td>
                                  <td class='bookPrice'>" . asDollars(($price * $qty) * 0.8) . "</td>
                                  <td align='center'></td></tr>";
            }

            echo "</tbody> </table>";
            echo "<table class='cartTotal'>
                      <tbody><tr>
                        <td> Sub-Total:</td>
                        <td align='right'> " . asDollars($subtotal * 0.8) . " </td>
                      </tr>
                          <tr>
                        <td> Shipping:*</td>
                        <td align='right'> $";
            if (!$noBooks) {
                echo 5 + (3 * ($totalbooks - 1));
            } else {
                echo 0;
            }
            echo ".00 </td></tr><tr><td><b>Total:</b></td><td align='right'><b>";
            echo asDollars((($subtotal * 0.8) + 5) + (3 * ($totalbooks - 1)));
            echo "</b></td></tr></tbody></table>";} else{
                echo "<p class='centeredNotice'>Your shipping information has been updated.</p>";
            }
            ?>
</td></tbody>
        </table>
        <div class='cartIcons'>
            A confirmation has been sent to your email address.<br>
            Thank you for shopping with GeekBooks.com.
            <br>
            <a href='../index.php'>
                <img border='0' src='/sandvig/mis314/assignments/bookstore/images/continue-shopping.gif'
                     width='121'
                     height='19'></a><br>
            <br>
            <a href='/sandvig/mis314/assignments/bookstore/OrderHistory.php?custIDe=<?
            echo $custIDe;
            ?>'>View
                Your Order History</a>
        </div>


        <?php
        include("template/footer.php");
        ?>
    </div>
</div>
</body>
</html>

