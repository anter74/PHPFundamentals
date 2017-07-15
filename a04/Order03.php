<html>
<head>
    <title>Order Confirmation</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">

    <p></p>
    <h2>Order Confirmation</h2>
    <?php
    //must arrive from order02.php
    $referrer = $_SERVER['HTTP_REFERER'];
    if (stripos($referrer, 'order02.php') == false) header("location:order01.php");
    
    $color = $_REQUEST['color'];
    if(!($color == 'red' || $color == 'blue' || $color == 'yellow')){
        exit();
    } else{
        echo"<h3> Congratulations " . $_COOKIE['fname'] . " you
        have ordered a  $color ". $_COOKIE['model'] . "!</h3>";
        echo "<img src='/sandvig/mis314/assignments/a04/images/".$_COOKIE['model'] . $color . ".jpg' />";
    }
    ?>

    <br>
    <a href="Order01.php">Place another order</a>

</div>
</body>
</html>