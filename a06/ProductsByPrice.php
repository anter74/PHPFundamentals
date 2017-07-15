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

    List Products under $:

    <form class="formLayout">
        <div class="formGroup">
            <label>Price:</label>
            <input name="price" type="text" placeholder="price" required autofocus>
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
    $price = fCleanString($link, $_GET['price'], 15);
    if ($price > 0){

    //List records
    $sql = "SELECT price, name, Image
            FROM geekproducts
            WHERE price <= '$price'
            order by price";

    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
    or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p> We sell " . mysqli_num_rows($result) . " items under $$price </p>";
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