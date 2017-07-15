<html>
<head>
    <title>For Loop Nested</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">

    <h2>For Loop Nested</h2>
    <hr />

    <form>
        <a>Rows: </a><input type="text" name="Rows" size="5" autofocus value="5"><br><br>
        <a>Columns: </a><input type="text" name="Columns" size="5" autofocus value="5"><br> <br><input type="submit" value="Loop">
    </form>
    <table class="simpleTable">

    <?php
    if (isset($_GET['Rows']) && isset($_GET['Columns']))
    {
        $rows = $_GET['Rows'];
        $columns = $_GET['Columns'];
        for($i = 0;$i < $rows; $i++){
           echo "<tr>";
            for($j = 0;$j < $columns; $j++){            // columns
                 echo "<td>Row: $i, Column: $j	</td>";
            }
            echo "</tr>";
        }
    }
    ?>

    </table>
</div>
</body>
</html>    