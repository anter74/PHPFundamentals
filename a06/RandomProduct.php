
<!DOCTYPE html>
<html>
<head><title>Random Product</title>
    <link rel="stylesheet" type="text/css" href="/sandvig/mis314/assignments/Style.css">
</head>
<body>
<div class="pageContainer" style="min-height:400px;">

    <div class="centerText"
    <h2>Random Product</h2>
</div>
<hr>
<?php
    //include database connection
    include("../utilities/databaseConnection.php");

    //connect to database
    $link = fConnectToDatabase();

    //List records
    $sql = "select name,price,Image,longdesc from geekproducts order by rand() limit 1;";
    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
    or die('SQL syntax error: ' . mysqli_error($link));

    ?>

        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $price = $row['price'];
            $name = $row['name'];
            $desc = $row['longdesc'];
            echo "
                    <img src='/sandvig/mis314/assignments/a06/images/m_$row[Image]' class=\"geekImageFloat\">
                     <h3>$name</h3>
                    <b>Price: $$price</b><br><br>
                       <p>$desc</p>
";
        }
        ?>
    </table>
</div>
</body>
</html>