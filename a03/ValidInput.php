<html>
<head>
    <title>Valid Input</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">

    <h2>Valid Input</h2>
    <hr />

    <form>
        <a>Iterations: </a><input type="text" name="rows" size="5" autofocus value="5"> <input type="submit" value="Loop">
    </form>
    <table class="simpleTable">

    <?php
    $rows = $_GET['rows'];
    if (!empty($rows)) {
        //validate with is_numeric and < > tests
        if(is_numeric($rows) && $rows <= 10 && $rows >= 1){
            echo "Valid Input: <br><br>";
            for($j = 0;$j < $rows; $j++){

                echo "<tr><td>Iteration: " . ($j+1) . "</td></tr>";
            }
        }
        else {
            //invalid entry
            echo "Please enter a number 1-10";
        }
    }

    ?>

    </table>
</div>
</body>
</html>    