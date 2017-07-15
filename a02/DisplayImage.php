<html>
<head>
    <title>Display Image</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">

    <h2>Display Image</h2>
    <hr />

    <form>
        <p>Please enter a value between 1-6:</p>
        <input type="text" name="val" autofocus>
        <input type="submit" value="Display">
    </form>

    <?php
    //Retrieve name from querystring. Check that parameter
    //is in querystring or may get "Undefined index" error
    if (isset($_GET['val']))
    {
        $number = $_GET['val'];
        echo "You Entered $number <br>";
        echo "<img src='/sandvig/images/dice/$number.gif'>";
    }
    ?>
</div>
</body>
</html>    