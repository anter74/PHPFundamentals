<html>
<head>
    <title>ForLoopTable</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">

    <h2>For Loop Table</h2>
    <hr />

    <form>
        <a>Iterations: </a><input type="text" name="i" size="5" autofocus value="5"> <input type="submit" value="Loop">
    </form>
    <table class="simpleTable">

    <?php
    if (isset($_GET['i']))
    {
        $i = $_GET['i'];
        for($j = 0;$j < $i; $j++){
            echo "<tr><td>Iteration: " . ($j+1) . "</td></tr>";
        }
    }
    ?>

    </table>
</div>
</body>
</html>    