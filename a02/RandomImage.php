<html>
<head>
    <title>Random Image</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">

    <h2>Random Image</h2>
    <hr/>
    <?php
    $number1 = rand(1, 6);
    $number2 = rand(1, 6);
    echo "<img src='/sandvig/images/dice/$number1.gif'>";
    echo "<img src='/sandvig/images/dice/$number2.gif'><br>";
    echo "The sum of the dice is: " . ($number1 + $number2);

    ?>
    <br>
    <br>
    <a href="?">Reload Page</a>
</div>
</body>
</html>    