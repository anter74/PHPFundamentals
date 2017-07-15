<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Sign-in - GeekBooks</title>
    <link rel="stylesheet" href="style/newStyle.css"
          type="text/css"/>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <?php

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
    include("template/header.php");


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
                //TODO change checout actiuon
                ?></p>

            <form method="post" action="checkout02.php" autocomplete="on" name="myForm" class="myForm">
                <div class="cartIcons">
                    <div class="formGroup">
                        <label for="email">Email:</label>
                        <? $email = $_COOKIE["email"];
                        if (strlen($email) > 4) {
                            echo "<input type='email' name='email' id='email' autofocus required placeholder = 'Email' value='$email' />";
                        } else {
                            echo "<input type='email' name='email' id='email' autofocus required placeholder = 'Email' value='' />";
                        }


                        ?>
                    </div>

                    <div class="formGroup">
                        <label> </label>
                        <script>
                            function check() {
                                if (grecaptcha.getResponse() == "") {
                                    document.getElementById("Capcha").innerText = "Please try the captcha again.";
                                } else {
                                    document.getElementById("Capcha").innerText = "Thanks!";
                                    document.myForm.submit();
                                }
                            }
                        </script>
                        <div style="text-align: center">

                            <div style="margin:  auto ; width: 50%" class="g-recaptcha" data-sitekey="6Le99iETAAAAAJD5jstc1zoWQE5H-TMvFggPzwvq"></div>
                        </div>
                        <br>
                        <img src="img/proceed-to-checkout.gif"
                             alt="Proceed to checkout" id="formsubmit" class="inputImage" onclick="check()"/>

                        <br>
                        <div id="Capcha" style="color: darkred"></div>
                    </div>
                </div>
            </form>
        </div>

        <?php include("template/footer.php") ?>


    </div>
    </body>
</html>


