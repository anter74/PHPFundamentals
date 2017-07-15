<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
<head>
    <title>Movie Actors Titles</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>Movie Actors Titles</h3>
    <hr>
    <form class="formLayout">
        <div class="formGroup">
            <label>ASIN:</label>
            <input name="ASIN" type="text" autofocus>
        </div>
        <div class="formGroup">
            <label>Actor ID:</label>
            <input name="actorID" type="text">
        </div>

        <div class="formGroup">
            <label> </label>
            <button>Submit</button>
        </div>
    </form>
    <?php
    //include database connection
    include("../utilities/databaseConnection.php");

    //connect to database
    $link = fConnectToDatabase();

    //Retrieve parameters from querystring and sanitize
    $ASIN = fCleanString($link, $_GET['ASIN'], 15);
    $actorID = fCleanString($link, $_GET['actorID'], 15);
    $deleteID = fCleanString($link, $_GET['deleteID'], 30);

    //Insert
    if (!empty($ASIN) && !empty($actorID)) {
        $sql = "INSERT INTO dvdactorstitles (`ASIN`, `actorid`) VALUES ('$ASIN', '$actorID');";
        mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
    }

    //Delete
    if (!empty($ASIN) && !empty($deleteID)) {
        $sql = "Delete from dvdactorstitles WHERE actorID='$deleteID' AND ASIN='$ASIN'";
        mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
    }

    //List records
    $sql = "SELECT a.title, a.ASIN, b.actorID FROM dvdtitles a, dvdactorstitles ab, dvdactors b  WHERE a.ASIN = ab.ASIN AND b.actorID = ab.actorID ORDER BY ASIN;";



    //$result is an array containing query results
    //echo "SQL: $sql <br>";
    $result = mysqli_query($link, $sql)
    or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>ASIN</th>
            <th>ActorID</th>
            <th>DELETE</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $actorID = $row['actorID'];
            echo "<tr>
                     <td>$row[ASIN]</td>
                     <td>$actorID</td>
                     <td><a href='?deleteID=$actorID&ASIN=$row[ASIN]'>delete</a></td>
                 </tr>";
        }

        ?>
    </table>
</div>
</body>
</html>