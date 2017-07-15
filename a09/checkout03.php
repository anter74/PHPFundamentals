<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Shipping Information - GeekBooks - MIS 314 Sample Bookstore</title>
    <link rel="stylesheet" href="style/newStyle.css"
          type="text/css"/>
</head>
<body>
<?php
//clear totalbooks before header is sent to page, so that it is 0 when the user sees it..

$totalbooks = 0;
setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);

include("template/header.php");
include_once("utilities/databaseConnection.php");
include_once("utilities/encryption.php");
include("utilities/validationUtilities.php");

$link = fConnectToDatabase();
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$street = $_POST['street'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$city = $_POST['city'];
$custIDe = $_POST['custIDe'];

?>


<div class="pageContainer">
    <div class="checkoutContent">
        <p class='centeredNotice'>
            <?php
            //validates everything from last page
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
                echo "<p class='centeredNotice'><input type='button' class='button' style='width:200px;' value='<< Go Back <<' onClick='history.back()'><br></p>";

                include("template/footer.php");
                //stop execution.
                exit();
            }
            ?>
        </p>
        <div class='pageTitle'>Order Confirmation</div>
        <br>
        <?
        //if custID(encrypted) doesn't exist, insert the customer into the table, else decrypt the id and update that customer
        if (strlen($custIDe) < 1) {
            $sql = "INSERT INTO bookcustomers VALUES (NULL, '$fname','$lname','$email','$street','$city','$state','$zip')";
        } else {
            $custID = decrypt($custIDe, $myPassword);
            $sql = "UPDATE bookcustomers SET fname='$fname',lname='$lname',email='$email',street='$street',city='$city',state='$state',zip='$zip' WHERE custID='$custID'";
        }
        $result = mysqli_query($link, $sql) or die('SQL syntax error: ' . mysqli_error($link));
        //if is new cust, get autoincrement value
        if (strlen($custIDe) < 1) {
            $custID = mysqli_insert_id($link);
        }

        //get cookie, put it in an array, then clear the cookie to clear the cart.
        $cookieName = "myCart2";
        if (isset($_COOKIE[$cookieName])) {
            $bookArray = unserialize($_COOKIE[$cookieName]);
        }
        setcookie($cookieName, null, time() - 60000);

        //if bookarray has books insert an order into table bookorders and insert entries for every book in bookorderitems
        if (count($bookArray) > 0) {
            $time = time();
            $sql = "INSERT INTO `bookorders` (`orderID`,`custID`,`orderdate` ) VALUES (NULL, '$custID', '$time')";
            $result = mysqli_query($link, $sql) or die('SQL syntax error: ' . mysqli_error($link));
            $discount = 0.8;
            $orderID = mysqli_insert_id($link);
            foreach ($bookArray as $isbn => $qty) {
                $sql = "INSERT INTO bookorderitems (orderID, isbn, qty, price) VALUES ($orderID, '$isbn', $qty, (select (price * $discount) from bookdescriptions where ISBN = '$isbn'))";
                $result = mysqli_query($link, $sql) or die('SQL syntax error: ' . mysqli_error($link));
            }

        }

        ?>

        <table id='cart'>
            <tr>
                <td class='boldLabel'>
                    Order Number:
                </td>
                <td>
                    <? if (count($bookArray) > 0) echo $orderID; ?>
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
            if (count($bookArray) > 0){
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
    // code to get info on isbn's in cart
    $sql = "SELECT isbn, title, price
                FROM bookdescriptions
                WHERE";
    foreach ($bookArray as $isbn => $qty) {
        $sql .= " isbn = '$isbn' OR";
    }
    $sql = substr($sql, 0, -3);
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
            //this is the printing of the info to the page,
            //it also puts things in temp arrays for emailing at the end
            $subtotal = 0;
            $total = 0;
            $booktitles[] = "";
            $bookprice[] = "";
            $bookqty[] = "";
            while ($row = mysqli_fetch_array($result)) {
                $title = $row['title'];
                array_push($booktitles, $title);
                $isbn = $row['isbn'];
                $price = $row['price'];
                array_push($bookprice, $price);
                $qty = $bookArray["$isbn"];
                array_push($bookqty, $qty);
                $subtotal += $price * $qty;
                echo "<tr>
                                  <td><a class='booktitle' href='ProductPage.php?isbn=$isbn'> $title </a></td>
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
                        <td> Shipping:</td>
                        <td align='right'> $";
            if (!$noBooks) {
                echo 5 + (3 * ($totalbooks - 1));
            } else {
                echo 0;
            }
            echo ".00 </td></tr><tr><td><b>Total:</b></td><td align='right'><b>";
            echo asDollars((($subtotal * 0.8) + 5) + (3 * ($totalbooks - 1)));
            echo "</b></td></tr></tbody></table>";
            } else {
                echo "<p class='centeredNotice'>Your shipping information has been updated.</p>";
            }
            //this is where the emails start, the first is for an info update the second is for a purchase
            if (count($bookArray) <= 0) {
                $to = $email;
                $subject = "Your info was updated!";

                $message = "<!DOCTYPE html>\n";
                $message .= "<html lang=\"en\">\n";
                $message .= "<head>\n";
                $message .= "<style>\n";
                $message .= "    table, th, td {\n";
                $message .= "        border: 1px solid black;\n";
                $message .= "        border-collapse: collapse;\n";
                $message .= "    }\n";
                $message .= "    th, td {\n";
                $message .= "        padding: 5px;\n";
                $message .= "        text-align: left;\n";
                $message .= "    }\n";
                $message .= "    table tr:nth-child(even) {\n";
                $message .= "        background-color: #eee;\n";
                $message .= "    }\n";
                $message .= "    table tr:nth-child(odd) {\n";
                $message .= "        background-color: #fff;\n";
                $message .= "    }\n";
                $message .= "</style>\n";
                $message .= "</head>\n";
                $message .= "<body>\n";
                $message .= "<img src='http://yorktown.cbe.wwu.edu/students/162/behrndc/a09/img/logo.png'>";
                $message .= "<h1>Your info on GeekBooks was updated.</h1>\n";
                $message .= "<br>\n";
                $message .= "<table>\n";
                $message .= "    <tr>\n";
                $message .= "        <td></td>\n";
                $message .= "        <th>New Info</th>\n";
                $message .= "    </tr>\n";
                $message .= "    <tr>\n";
                $message .= "        <td>Email:</td>\n";
                $message .= "        <td>$email</td>\n";
                $message .= "    </tr>\n";
                $message .= "    <tr>\n";
                $message .= "        <td>First Name:</td>\n";
                $message .= "        <td>$fname</td>\n";
                $message .= "    </tr>\n";
                $message .= "    <tr>\n";
                $message .= "        <td>Last Name:</td>\n";
                $message .= "        <td>$lname</td>\n";
                $message .= "    </tr>\n";
                $message .= "    <tr>\n";
                $message .= "        <td>Address:</td>\n";
                $message .= "        <td>$street</td>\n";
                $message .= "    </tr>\n";
                $message .= "    <tr>\n";
                $message .= "        <td>City:</td>\n";
                $message .= "        <td>$city</td>\n";
                $message .= "    </tr>\n";
                $message .= "    <tr>\n";
                $message .= "        <td>State:</td>\n";
                $message .= "        <td>$state</td>\n";
                $message .= "    </tr>\n";
                $message .= "    <tr>\n";
                $message .= "        <td>Zip:</td>\n";
                $message .= "        <td>$zip</td>\n";
                $message .= "    </tr>\n";
                $message .= "</table>\n";
                $message .= "<p>Something look wrong? <a href=\"http://yorktown.cbe.wwu.edu/students/162/behrndc/a09/checkout01.php\">Change it here!</a> </p>\n";
                $message .= "</body>\n";
                $message .= "</html>";

                $headers = "From: \"Geekbooks\" <behrndc@students.wwu.edu> \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                mail($to, $subject, $message, $headers);
            } else {
                $to = $email;
                $subject = "Your order confirmation!";

                $message = "<!DOCTYPE html>\n";
                $message .= "<html lang=\"en\">\n";
                $message .= "<head>\n";
                $message .= "    <style>\n";
                $message .= "        table, th, td {\n";
                $message .= "            border: 1px solid black;\n";
                $message .= "            border-collapse: collapse;\n";
                $message .= "        }\n";
                $message .= "\n";
                $message .= "        th, td {\n";
                $message .= "            padding: 5px;\n";
                $message .= "            text-align: left;\n";
                $message .= "        }\n";
                $message .= "\n";
                $message .= "        table tr:nth-child(even) {\n";
                $message .= "            background-color: #eee;\n";
                $message .= "        }\n";
                $message .= "\n";
                $message .= "        table tr:nth-child(odd) {\n";
                $message .= "            background-color: #fff;\n";
                $message .= "        }\n";
                $message .= "    </style>\n";
                $message .= "</head>\n";
                $message .= "<body>\n";
                $message .= "<img src='http://yorktown.cbe.wwu.edu/students/162/behrndc/a09/img/logo.png'>";
                $message .= "<h1>Your order on GeekBooks.</h1>\n";
                $message .= "<br>\n";
                $message .= "<table>\n";
                $message .= "    <tr>\n";
                $message .= "        <th>Title</th>\n";
                $message .= "        <th>Qty</th>\n";
                $message .= "        <th>Total</th>\n";
                $message .= "    </tr>";

                $booktitles = array_values($booktitles);
                $bookprice = array_values($bookprice);
                $bookqty = array_values($bookqty);
                for ($i = 1; $i < count($booktitles); $i++) {
                    $message .= " <tr><td>" . (strlen($booktitles[$i]) > 40 ? substr($booktitles[$i], 0, 40) . "..." : $booktitles[$i]) . "</td><td>" . $bookqty[$i] . "</td> <td> " . asDollars($bookprice[$i] * .8) . " </td> </tr>";
                }

                $message .= "<br>\n";
                $message .= "    <tr>\n";
                $message .= "        <td></td>\n";
                $message .= "        <td>Total:</td>\n";
                $message .= "        <td> " . asDollars((($subtotal * 0.8) + 5) + (3 * ($totalbooks - 1))) . "</td>\n";
                $message .= "    </tr>\n";
                $message .= "</table>\n";
                $message .= "<p><a href=\"http://yorktown.cbe.wwu.edu/students/162/behrndc/a09/index.php\">Thanks for shopping with us and come again!</a></p>\n";
                $message .= "</body>\n";
                $message .= "</html>";

                $headers = "From: \"Geekbooks\" <behrndc@students.wwu.edu> \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                mail($to, $subject, $message, $headers);
            }
            ?>
            </td></tbody>
        </table>
        <div class='cartIcons'>
            A confirmation has been sent to your email address.<br>
            Thank you for shopping with GeekBooks.com.
            <br>
            <a href='index.php'>
                <img border='0' src='/sandvig/mis314/assignments/bookstore/images/continue-shopping.gif'
                     width='121'
                     height='19'></a><br>
            <br>
            <a href='OrderHistory.php?custIDe=<? echo urlencode($custIDe); ?>'>View
                Your Order History</a>
        </div>


        <?php include("template/footer.php"); ?>
    </div>
</div>
</body>
</html>

