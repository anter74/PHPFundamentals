<!DOCTYPE html>
<html>
<head><title>Product Categories items</title>
    <link rel="stylesheet" type="text/css" href="/sandvig/mis314/assignments/Style.css">
</head>
<body>
<?php
//include database connection
include("../utilities/databaseConnection.php");

//connect to database
$link = fConnectToDatabase();
$category = fCleanString($link, $_GET['CatID'], 35);
//List records
$sql = "select DISTINCT CatID, catname from geekcategories order by catname;";
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
            while ($row = mysqli_fetch_array($result)) {
                $CatID = $row['CatID'];
                $catname = $row['catname'];
                echo "<a class='menuLink' href='?CatID=$CatID'>$catname</a>";
            }
            echo "</div><div class=\"centerColumn\">";
            ?>


            <?php
            if ($category) {

                //List records
                $sql = "select distinct name, price, shortdesc, image FROM geekcategories a, geekproductcategories ab, geekproducts b WHERE a.CatID = ab.CatID AND b.ItemID = ab.ItemID and ab.CatID = $category order by name";

                //$result is an array containing query results
                $result = mysqli_query($link, $sql)
                or die('SQL syntax error: ' . mysqli_error($link));

                echo '<div class="itemCount"> ' . mysqli_num_rows($result) . ' item(s) in Category</div>';
                while ($row = mysqli_fetch_array($result)) {
                    //Field names are case sensitive and must match
                    //the case used in sql statement
                    $price = $row['price'];
                    $shortdesc = $row['shortdesc'];
                    $name = $row['name'];
                    $image = $row['image'];
                    echo '
                        <div class="productItem">
                            <img src=" /sandvig/mis314/assignments/a06/images/m_' . $image . '" class="productImage">
                            <div class="productName">' . $name . '</div>
                            <div class="productPrice">Price: $' . $price . '</div>
                            <div class="productDesc">' . $shortdesc . '</div>
                        </div> ';
                }
            } else {
                echo "<h3>Please select a product category</h3> </div>";
            }
            echo '</div><br><br><br>';
            ?>
</body>
</html>
