<header>
    <div id="fillSpace"></div>
    <div class="logo">
        <a href="index.php">
            <img border="0" src="img/logo.png"
                 width="346" height="86" alt="GeekBooks"></a>
    </div>
    <div class="utilities">
        <a href="ShoppingCart.php"><img src="img/cart.png" width="20px" style="position: relative;top: 5px">
            Your Cart (<? if (!isset($totalbooks)) {
                $totalbooks = $_COOKIE["BookCount"];
            }
            echo $totalbooks;
            ?>)</a>
        <a href="checkout01.php"><img src="img/account.png" width="20px" style="position: relative;top: 5px">
            Account</a>
        <!--        <img border="0" src="img/shoppingcart.png"-->
        <!--             usemap="#utilities" width="216" height="22" alt="shopping cart"/>-->

        <a href="about.php" style="text-decoration:none;">
            <img border="0" src="/sandvig/mis314/assignments/bookstore/images/exclamation-clear.gif"
                 alt="About this site" style="margin-left:25px; width: 20px; height: 20px;"/>
            <span style="font-size: x-small; position:relative;top:-5px;left:-2px;">About this Site</span></a>
    </div>
</header>
