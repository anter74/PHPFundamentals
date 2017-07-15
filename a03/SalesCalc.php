<html>
<head>
    <title>Sales Calculation</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">

    <h2>Sales Calculation</h2>
    <h6 style="font-size: .4em;    margin-top: -33px;font-weight: lighter;">*I think the tax algorithm is wrong in the example</h6>
    <hr/>

    <form>
        <a>Item Price: </a><input type="text" name="value" size="5" autofocus value=""><input type="submit"
                                                                                              value="Calculate"><br>
    </form>
    <table class="simpleTable">

        <?php
        $value = $_GET['value'];
        if (!empty($value)) {
            if (is_numeric($value) && $value >= 0) {
                echo "<tr>";
                echo "<td> Price:</td><td>$$value</td></tr>";
                echo "<td> 25% discount:</td><td>-$" . ($value / 4) . "</td></tr>";
                echo "<td> Discounted Price:</td><td>$" . ($value - ($value / 4)) . "</td></tr>";
                echo "<td> Tax(8.4%):</td><td>$" . 8.4 / 100 * $value . "</td></tr>"; // I think the example tax alg is wrong http://www.convertit.com/Go/ConvertIt/Calculators/Finance/Sales_Tax_Calc.ASP
                echo "<td> Total due:</td><td>$" . (($value + (8.4 / 100 * $value)) - ($value / 4)) . "</td></tr>";
                echo "</table><br><br><table  class=\"simpleTable\"><tr>";
                $date = date("M j, o");
                $time = date("g:i:s a");
                echo "<td> Sales Date:</td> <td>$date</td></tr>";
                echo "<td> Sales Time:</td> <td>$time</td></tr>";
                echo "</table>";
                echo "<br><h3>Thank you for shopping at Discount-O-Rama!</h3>";

            }
        }
        ?>
</div>
</body>
</html>    