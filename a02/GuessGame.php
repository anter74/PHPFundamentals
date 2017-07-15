<html>
<head>
    <title>Guess Game</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">

    <h2>Guess Game</h2>
<!--    <hr />-->

    <form>
        <p>Please guess a number:</p>
        <input type="text" name="guess" autofocus>
        <input type="submit" value="Give Hint">
    </form>

    <?php
    //Retrieve name from querystring. Check that parameter
    //is in querystring or may get "Undefined index" error
    if (is_numeric($_GET['guess']))
    {
        $guess = $_GET['guess'];
        if ($guess < 4)
            echo 'Very Low.';
        elseif($guess < 7)
            echo 'Low.';
        elseif ($guess > 10)
            echo 'Very High.';
        elseif ($guess > 7)
            echo 'High.';
        else
            echo "Correct!";
    }
    ?>
</div>
</body>
</html>    