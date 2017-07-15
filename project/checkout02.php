<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Shipping Information - GeekBooks</title>
    <link rel="stylesheet" href="style/newStyle.css"
          type="text/css"/>

<?php  ?>
<?php include_once("utilities/databaseConnection.php"); ?>
<?php include_once("utilities/encryption.php"); ?>
<?php include("utilities/validationUtilities.php"); ?>
<?php

//Retrieve inputs (using helper function)
$email = $_REQUEST['email'];

setcookie("email",$email, time() + 60 * 60 * 24 * 180);
//set validation flag
$IsValid = true;
include("template/header.php");
echo "<div class='pageContainer'>
         <div class='checkoutContent'>
          <div class='pageTitle'>Shipping Information</div>
            <p class='centeredNotice'>";


//email
if (!fIsValidEmail($email)) {
    echo "Please provide a valid email address.<br>";
    $IsValid = false;
}

if (!$IsValid) {
    //at least one element not valid. Echo a message and stop execution
    echo "<br>
            <p  class='centeredNotice'> <input type='button'  style='width: 200px' class='button' value='<< Go Back <<' onClick='history.back()'><br></p>";
    //stop execution.

    echo "</p>";
    include("template/footer.php");
    exit();
}

$link = fConnectToDatabase();
$isbn = fCleanString($link, $_REQUEST['isbn'], 10);
$sql = "SELECT email, fname, lname,street,city,state,zip,custID
                FROM bookCustomers
                WHERE email = '$email'";
$result = mysqli_query($link, $sql)
or die('SQL syntax error: ' . mysqli_error($link));

if (mysqli_num_rows($result) == 0) {
    echo "New Customer - Please provide your shipping address.";
} else {
    echo "Returning Customer - Please confirm your mailing and e-mail addresses.";
    $row = mysqli_fetch_array($result);
    $email = $row['email'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $street = $row['street'];
    $state = $row['state'];
    $zip = $row['zip'];
    $city = $row['city'];
    $custID = $row['custID'];
    $custIDe = encrypt($custID, $myPassword);
} ?>
<form method="post" action="checkout03.php" autocomplete="on" class="myForm">

    <div class="formGroup">
        <label for="email">
            Email: </label>

        <input type="email" name="email" value="<? echo $email ?>" required placeholder="Enter Email"
               maxlength="50"/>
    </div>

    <div class="formGroup">
        <label for="fname">
            First name: </label>
        <input type="text" name="fname" value="<? echo $fname ?>" autofocus required
               placeholder="First name" title="first name" maxlength="20" pattern="[A-Za-z'-]{2,20}"/>
    </div>
    <div class="formGroup">
        <label for="lname">
            Last name: </label>
        <input type="text" name="lname" value="<? echo $lname ?>" required
               placeholder="Last name" title="last name" maxlength="20" pattern="[A-Za-z'-]{2,20}"/>
    </div>
    <div class="formGroup">
        <label for="street">
            Street: </label>
        <input type="text" name="street" value="<? echo $street ?>" required
               placeholder="Street address" title="street address" maxlength="25"/>
    </div>
    <div class="formGroup">
        <label for="city">
            City:</label>
        <input type="text" name="city" value="<? echo $city ?>" required
               placeholder="City" title="city" maxlength="30" pattern="[A-Za-z'-]{2,30}"/>
    </div>
    <div class="formGroup">
        <label for="state">
            State:</label>
        <td>
            <input type="text" name="state" style="width:40px" value="<? echo $state ?>" required
                   placeholder="ST" title="2-character state abbreviation" max length="2"
                   pattern="[A-Za-z]{2}"/>
    </div>
    <div class="formGroup">
        <label for="zip">
            Zip: </label>
        <input type="text" name="zip" style="width:80px;" value="<? echo $zip ?>" required
               placeholder="Zip" title="zip" maxlength="5" pattern="[0-9]{5}"/>
    </div>
    <div class="formGroup">
        <label></label>
        <!-- sample site uses mcrypt encryption enhancement for custID -->
        <!-- source: //source: http://stackoverflow.com/questions/2448256/php-mcrypt-encrypting-decrypting-file -->
        <input type="hidden" name="custIDe"
               value="<? echo $custIDe ?>">
        <input class="inputImage" type="image" src="img/buy-now.gif">
    </div>
</form>
<br>
<p align='center'>
    <?if (mysqli_num_rows($result) == 0){?>
    <a href='OrderHistory.php?custIDe=<? echo $custIDe ?>'>View
        Your Order History</a></p><?}?>
<!-- end page content *************** -->
</div>

<?php include("template/footer.php"); ?>

</div>
</body>
</html>


