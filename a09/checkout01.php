<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Sign-in - GeekBooks - MIS 314 Sample Bookstore</title>
    <link rel="stylesheet" href="style/newStyle.css"
          type="text/css"/>
</head>
<body>
<?php include("template/header.php");

$cookieName = "myCart2";
// retrieve cookie and unserialize into $bookArray
if (isset($_COOKIE[$cookieName])) {
    $bookArray = unserialize($_COOKIE[$cookieName]);
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

?>

<div class="pageContainer">
    <div class="checkoutContent">
        <div class="pageTitle">Your Account</div>
        <p class="pageTitle2">Buying online is quick and easy!</p>
        <p class="pageTitle2">
            <?php
            echo "There are " . $totalbooks . " item";
            if ($totalbooks != 1)
                echo 's';
            echo ' in your cart'
            ?></p>
        <form method="post" action="checkout02.php" autocomplete="on" class="myForm">
            <div class="cartIcons">
                <div class="formGroup">
                    <label for="email">Email:</label>
                    <? $email = $_COOKIE["email"];
                    if(strlen($email) > 4){
                    echo "<input type='email' name='email' id='email' autofocus required placeholder = 'Email' value='$email' />";
                    }else{
                        echo "<input type='email' name='email' id='email' autofocus required placeholder = 'Email' value='' />";
                    }
                    ?>
                </div>
                <div class="formGroup">
                    <label> </label>
                    <input type="image" src="img/proceed-to-checkout.gif"
                           alt="Proceed to checkout" class="inputImage"/>
                </div>
            </div>
        </form>
    </div>

    <?php include("template/footer.php") ?>


</div>


<!-- Browse menu and footer removed from checkout pages to minimize distractions. -->

<!-- Sample site uses a MasterPage-like template for page layout. -->
<!-- This is not required. It may be used as an enhancement. -->
<!-- Source: http://spinningtheweb.blogspot.com/2006/07/approximating-master-pages-in-php.html -->
</body>
</html>


