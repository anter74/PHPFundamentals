<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
<head>
    <title>Movie Actors</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>Movie Actors</h3>
    <hr>
    <form class="formLayout">
        <div class="formGroup">
            <label>First Name:</label>
            <input name="fname" type="text" autofocus>
        </div>
        <div class="formGroup">
            <label>Last Name:</label>
            <input name="lname" type="text">
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
    $fname = fCleanString($link, $_GET['fname'], 15);
    $lname = fCleanString($link, $_GET['lname'], 30);
    $actorID = fCleanString($link, $_GET['actorID'], 10);

    //Insert
    if (!empty($fname) && !empty($lname)) {
        $sql = "INSERT INTO `dvdactors` (`actorID`, `fname`, `lname`) VALUES (NULL, '$fname', '$lname');";

        mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
    }

    //Delete
    if (!empty($actorID)) {
        $sql = "Delete from dvdActors WHERE actorID='$actorID'";
        mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
    }

    //List records
    $sql = 'SELECT actorID, fname, lname
                FROM dvdActors order by actorID';

    //$result is an array containing query results
//    echo "SQL: $sql <br>";
    $result = mysqli_query($link, $sql)
    or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>actorID</th>
            <th>fname</th>
            <th>lname</th>
            <th>DELETE</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $actorID = $row['actorID'];
            echo "<tr>
                     <td>$actorID</td>
                     <td>$row[fname]</td>
                     <td>$row[lname]</td>
                     <td><a href='?actorID=$actorID'>delete</a></td>
                 </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>