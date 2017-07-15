<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
<head>
    <title>Movie Titles</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>Movie Titles</h3>
    <hr>
    <form class="formLayout">
        <div class="formGroup">
            <label>ASIN:</label>
            <input name="ASIN" type="text" autofocus>
        </div>
        <div class="formGroup">
            <label>Title:</label>
            <input name="title" type="text">
        </div>
        <div class="formGroup">
            <label>Price:</label>
            <input name="price" type="text">
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
    $title = fCleanString($link, $_GET['title'], 30);
    $deleteID = fCleanString($link, $_GET['deleteID'], 10);

    //Insert
    if (!empty($ASIN) && !empty($title) && !empty($price)) {
        $sql = "Insert into dvdtitles (ASIN, title, price)
                VALUES ('$ASIN', '$title', '$price')";
        mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
    }

    //Delete
    if (!empty($deleteID)) {
        $sql = "Delete from dvdtitles WHERE ASIN='$deleteID'";
        mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
    }

    //List records
    $sql = 'SELECT ASIN, title, price
                FROM dvdtitles order by ASIN';

    //$result is an array containing query results
//    echo "SQL: $sql <br>";
    $result = mysqli_query($link, $sql)
    or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>ASIN</th>
            <th>TITLE</th>
            <th>PRICE</th>
            <th>IMAGE</th>
            <th>DELETE</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $ASIN = $row['ASIN'];
            echo "<tr>
                     <td>$ASIN</td>
                     <td>$row[title]</td>
                     <td>$row[price]</td>
                     <td><img src='http://images.amazon.com/images/P/$ASIN.01.MZZZZZZZ.jpg'> </td>
                     <td><a href='?deleteID=$row[actorID]'>delete</a></td>
                 </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>