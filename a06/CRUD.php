<?php
//include database connection
include("../utilities/databaseConnection.php");

//connect to database
$link = fConnectToDatabase();

//Retrieve parameters from querystring and sanitize
$nameF = fCleanString($link, $_GET['nameF'], 30);
$nameL = fCleanString($link, $_GET['nameL'], 30);
$strLName3 = fCleanString($link, $_GET['strLName'], 30);
$strFName3 = fCleanString($link, $_GET['strFName'], 30);
$deleteID = fCleanNumber($_GET['deleteID']);
$updateID = fCleanNumber($_GET['updateID']);

$sql = "SELECT custID, nameF, nameL
                FROM tblCustomers WHERE custID = '$updateID'";

$result = mysqli_query($link, $sql)
or die('SQL syntax error: ' . mysqli_error($link));
$row = mysqli_fetch_array($result);
$strFName2 = $row['nameF'];
$strLName2 = $row['nameL'];
//I have far too many variables..
?>
<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
<head>
    <title>CRUD (Create, Read, Update & Delete) Database</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>CRUD (Create, Read, Update & Delete) Database</h3>
    <hr>
    <form class="formLayout">
        <div class="formGroup">
            <label>First name:</label>
            <input type="text" name="strFName" value="<? echo $strFName2; ?>">
        </div>
        <div class="formGroup">
            <label>Last name:</label>
            <input type="text" name="strLName" value="<? echo $strLName2; ?>">
        </div>
        <input type="hidden" name="updateID2" value="<? echo $updateID; ?>">
        <div class="formGroup">
            <label> </label>
            <?php
            if ($updateID) {
                echo "<button> Update</button>";
            } else {
                echo "<button> Submit</button>";
            }
            ?>
        </div>
    </form>
    <?php
    if ($_GET['updateID2']) {
        $updateID2 = $_GET['updateID2'];
        $sql = "UPDATE tblCustomers SET namef='$strFName3', namel='$strLName3' where custID = $updateID2";
        mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
    }
    //Insert
    if (!empty($strLName3) && !empty($strFName3) && empty($_GET['updateID2'])) {
        $sql = "Insert into tblCustomers (nameL, nameF)
                VALUES ('$strLName3', '$strFName3')";
        mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
    }

    //Delete
    if (!empty($deleteID)) {
        $sql = "Delete from tblCustomers WHERE CustID=$deleteID";
        mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
    }
    //List records
    $sql = 'SELECT custID, nameF, nameL
                FROM tblCustomers order by CustID';

    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
    or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>Cust. ID</th>
            <th>F. Name</th>
            <th>L. Name</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $custID = $row['custID'];
            echo "<tr>
                     <td>$custID</td>
                     <td>$row[nameF]</td>
                     <td>$row[nameL]</td>
                     <td><a href='?deleteID=$custID'>delete</a></td>
                     <td><a href='?updateID=$custID'>Update</a></td>
                 </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>