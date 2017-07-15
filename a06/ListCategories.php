<!DOCTYPE html>
<html>
<head><title>Product Categories</title>
    <link rel="stylesheet" type="text/css" href="/sandvig/mis314/assignments/Style.css">
</head>
<body>
<?php
//include database connection
include("../utilities/databaseConnection.php");

//connect to database
$link = fConnectToDatabase();

$category = fCleanString($link, $_GET['category'], 35);

//List records
$sql = "select DISTINCT  catname from geekcategories order by catname;";
//$result is an array containing query results
$result = mysqli_query($link, $sql)
or die('SQL syntax error: ' . mysqli_error($link));

?>

<div class="pageContainer">
    <div class="centerText">
        <h3>Product Categories</h3>
        <hr>
    </div>
    <div class='equalColumnWraper'>
        <div class='leftColumn'>
            <div class="centerText">
                <h3>Categories</h3>
            </div>
            <?php
            // iterate through the retrieved records
            while ($row = mysqli_fetch_array($result)) {
                //Field names are case sensitive and must match
                //the case used in sql statement
                $catname = $row['catname'];
                echo "<a class='menuLink' href='?category=$catname'>$catname</a>";
            }
            ?>

        </div>
        <div class="centerColumn">
            <?php
            if ($category){
                echo "<h3>You selected $category </h3></div>";
            } else {
                echo"<h3>Please select a product category</h3></div>";
            }?>
        </div>
    </div>
</body>
</html>
