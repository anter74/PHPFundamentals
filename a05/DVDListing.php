<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
<head>
    <title>Movie Actors Titles</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>Movie Listings</h3>
    <hr>

    <?php
    //include database connection
    include("../utilities/databaseConnection.php");

    //connect to database
    $link = fConnectToDatabase();

    //List records
    $sql = "SELECT  a.ASIN, a.title, a.price, b.actorID, b.fname, b.lname FROM dvdtitles a, dvdactorstitles ab, dvdactors b  WHERE a.ASIN = ab.ASIN AND b.actorID = ab.actorID ORDER BY ASIN;";



    //$result is an array containing query results
//    echo "SQL: $sql <br>";
    $result = mysqli_query($link, $sql)
    or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>ASIN</th>
            <th>Title</th>
            <th>Price</th>
            <th>Actors</th>
            <th>Cover</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $ASIN = $row['ASIN'];
            echo "<tr>
                     <td>$row[ASIN]</td>
                     <td>$row[title]</td>
                     <td>$row[price]</td>
                     <td>$row[fname] $row[lname]</td>
                     <td><img src='http://images.amazon.com/images/P/$ASIN.01.MZZZZZZZ.jpg'> </td>
                 </tr>";
        }

        ?>
    </table>
</div>
</body>
</html>