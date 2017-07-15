<html>
<head>
    <title>Simple Calculator</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">

    <h2>Simple Calculator</h2>
    <hr />

    <form >
        <p></p>
        <label>Value 1:</label>
        <input type="text" name="value1" autofocus><br><br>
        <label>Value 2:</label>
        <input type="text" name="value2" autofocus><br><br>
        <input type="submit" value="Add">
    </form>

    <?php
    //Retrieve name from querystring. Check that parameter
    //is in querystring or may get "Undefined index" error
    if (is_numeric($_GET['value1'])&& is_numeric($_GET['value2']))
    {
        $value1 = $_GET['value1'];
        $value2 = $_GET['value2'];
        echo 'Sum is: ' . ($value1 + $value2);
    }
    ?>
</div>
</body>
</html>    