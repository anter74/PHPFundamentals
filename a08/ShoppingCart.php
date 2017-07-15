<?php include_once("utilities/databaseConnection.php");
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$link = fConnectToDatabase();
//Shopping cart uses cookies to store cart items.
//PHP script uses an array for adding, removing and displaying the cart items.
//Cookies can contain only string data so array must be serialized.

$cookieName = "myCart2";
// retrieve cookie and unserialize into $bookArray
if (isset($_COOKIE[$cookieName])) {
    $bookArray = unserialize($_COOKIE[$cookieName]);
}
// Add items to cart
$addISBN = fCleanString($link, $_GET['addISBN'], 10);
if (strlen($addISBN) > 0) {
    if (isset($addISBN, $bookArray)) {
        // Increment by +1
        $bookArray[$addISBN] += 1;
    } else {
        // Add new item to cart
        $bookArray[$addISBN] = 1;
    }
}
// Remove items from cart
$deleteISBN = fCleanString($link, $_GET['deleteISBN'], 10);
if (strlen($deleteISBN) > 0) {
    if (isset($bookArray[$deleteISBN])) {
        // Deincrement by 1
        $bookArray[$deleteISBN] -= 1;
        // remove ISBN from array if qty==0
        if ($bookArray[$deleteISBN] == 0) {
            unset($bookArray[$deleteISBN]);
        }
    }
}
if (isset($bookArray)) {
    // Write cookie
    setcookie($cookieName, serialize($bookArray), time() + 60 * 60 * 24 * 180);

    //Count total books in cart
    $totalbooks = 0;
    foreach ($bookArray as $isbn => $qty) {
        $totalbooks += $qty;
    }
    setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);
}

//***************************************************
//You do not need to modify any code above this point
//***************************************************
?>
<!DOCTYPE html>
<html>
<head>
    <title>Basic Shopping Cart -- GeekBooks.com</title>
    <link rel="stylesheet" href="/sandvig/mis314/assignments/bookstore/styleSheet.css" type="text/css">
</head>
<body>

<?php
include_once("template/header.php");
?>

<div class="pageContainer">
    <div class="leftColumn">
        <?php include "template/menu.php" ?>
    </div>
    <section>
        <div class="content">
            <p class="centeredText">
                <?php
                echo $totalbooks . " item";
                if ($totalbooks != 1)
                    echo 's';
                echo ' in your cart'
                ?>
            </p>

            <?php
            $sql = "SELECT isbn, title, price
                FROM bookdescriptions
                WHERE";

            foreach ($bookArray as $isbn => $qty) {
                $sql .= " isbn = '$isbn' OR";
            }
            $sql = substr($sql, 0, -3);
            //        echo "SQL: " . $sql . " BOOKARRAY:" . "<pre>" . var_dump($bookArray) . "</pre>";
            if (strlen($sql) > 87) {
                $result = mysqli_query($link, $sql)
                or die('SQL syntax error: ' . mysqli_error($link));
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
                <td><a class='booktitle' href='ProductPage.php?isbn=$isbn'> $title </a></td>
                <td>$qty</td>
                <td class='bookPrice'>$price</td>
                <td class='bookPrice'>" . $price * $qty . "</td>
                <td align='center'>
                    <a href='?addISBN=$isbn''>Add</a><br>
                    <a href='?deleteISBN=$isbn''>Remove</a>
                </td>
            </tr>";
                }

                echo "</tbody> </table>";
                echo "<table class='cartTotal'>
                      <tbody><tr>
                        <td> Sub-Total:</td>
                        <td align='right'> $$subtotal </td>
                      </tr>
                          <tr>
                        <td> Shipping:*</td>
                        <td align='right'> $";
                if(!$noBooks){
                echo 5 + (3 * ($totalbooks - 1));}
               else {
                   echo 0;
               }
                echo ".00 </td>
          </tr>
          <tr>
            <td><b>Total:</b></td>
            <td align='right'><b> $";
                echo ($subtotal + 5) + (3 * ($totalbooks - 1));
                echo "</b></td> </tr> </tbody></table>";
                ?>
                <div class="cartIcons">
                    <a href="index.php"> <img border="0"
                                              src="/sandvig/mis314/assignments/bookstore/images/continue-shopping.gif"
                                              width="121" height="19" alt="Continue shopping"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="checkout01.php"> <img border="0"
                                                   src="/sandvig/mis314/assignments/bookstore/images/proceed-to-checkout.gif"
                                                   width="183" height="31" alt="Proceed to checkout"></a>

                </div>
                <p id="shipping">* Shipping is $3.49 for the first book and $.99 for each additional book. To assure
                    reliable delivery and to keep your costs low we send all books via UPS ground. </p>
    </section>

    <?php include("template/footer.php") ?>
</div>
</div>
</body>
</html>