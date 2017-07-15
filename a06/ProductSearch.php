<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
<head>
    <title>Products by Price</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>Products by Price</h3>
    <hr>

    Please enter all or part of a product name:

    <form class="formLayout">
        <div class="formGroup">
            <label>Search:</label>
            <input name="query" type="text" placeholder="" autofocus>
            <input name="postback" type="hidden" value="true">
        </div>
        <div class="formGroup">
            <label> </label>
            <button>Submit</button>
        </div>
    </form>
    (Leave empty to see all products.)
    <?php
    //include database connection
    include("../utilities/databaseConnection.php");

    //connect to database
    $link = fConnectToDatabase();

    //Retrieve parameters from querystring and sanitize
    $query = fCleanString($link, $_GET['query'], 15);
    $postback = fCleanString($link, $_GET['postback'], 15);

    if ($postback == true){
    //List records
    $sql = "SELECT price, name, Image
            FROM geekproducts
            WHERE name LIKE '%$query%'
            order by price";
    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
    or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p> " . mysqli_num_rows($result) . " items contain '$query' </p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>Price</th>
            <th>Item Name</th>
            <th>Thumbnail (click to enlarge)</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $price = $row['price'];
            echo "<tr>
                     <td>$price</td>
                     <td>$row[name]</td>
                     <td>
                         <a href='/sandvig/mis314/assignments/a06/images/l_$row[Image]'>
                             <img src = \"/sandvig/mis314/assignments/a06/images/m_$row[Image]\" class=\"geekImageMed\">
                         </a>
                     </td>
                 </tr>";
        }
        }
        ?>
    </table>
</div>
</body>
</html>