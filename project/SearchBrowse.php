<?php include_once("utilities/databaseConnection.php");
include("template/ListAuthors.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Book Search - GeekBooks - MIS 314 Sample Bookstore</title>
    <link rel="stylesheet" href="style/newStyle.css"
          type="text/css"/>

    <?php include("template/header.php") ?>

    <div class="pageContainer">
        <div class="leftColumn">

            <? include("template/menu.php"); ?>
        </div>
        <section>

            <?php
            $link = fConnectToDatabase();

            $search = fCleanString($link, $_REQUEST['search'], 35);
            $catID = fCleanString($link, $_REQUEST['catID'], 35);
            $catName = fCleanString($link, $_REQUEST['catName'], 35);
            if (!empty($catName) || !empty($catID)) {
                $sql = "SELECT DISTINCT a.isbn, title, description, price
            FROM bookdescriptions a,
            bookcategoriesbooks ab, bookcategories b
            WHERE a.isbn = ab.isbn and ab.CategoryID = $catID            
            ORDER BY title;";
            } else {
                $sql = "SELECT DISTINCT d.isbn, title, description, price
            FROM bookauthors a, bookauthorsbooks ba, bookdescriptions d,
            bookcategoriesbooks cb, bookcategories c
            WHERE a.AuthorID = ba.AuthorID
            AND ba.ISBN = d.ISBN
            AND d.ISBN = cb.ISBN
            AND c.CategoryID = cb.CategoryID
            AND (CategoryName = '$search'
            OR title LIKE '%$search%'
            OR description LIKE '%$search%'
            OR publisher LIKE '%$search%' 
            OR concat_ws(' ', nameF, nameL, nameF) LIKE '%$search%' )
            ORDER BY title;";
            }
            $result = mysqli_query($link, $sql)
            or die('SQL syntax error: ' . mysqli_error($link));


            if (!empty($catName) || !empty($catID)) {
                echo " <div class='pageTitle2'>
                 " . mysqli_num_rows($result) . " books in <span style='color:#CC0000'>'$catName'</span> category
                     </div> <br/>";
            } else {
                echo " <div class='pageTitle2'>
                 " . mysqli_num_rows($result) . " books contain <span style='color:#CC0000'>'$search'</span> 
                     </div> <br/>";
            }
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $isbn = $row['isbn'];
                echo "<script type='text/javascript'>window.location.href = 'ProductPage.php?isbn=$isbn&result=1';</script>";
            exit();
        }
            while ($row = mysqli_fetch_array($result)) {
                $title = $row['title'];
                $isbn = $row['isbn'];
                $description = $row['description'];
                $price = $row['price'];

                echo "<div class='bookSimple'>
            <a class='booktitle' href='ProductPage.php?isbn=$isbn'>$title </a>
            <br/>
            <span class='authors'>by " . fListAuthors($link, $isbn) . "</span></br>
            <a href='ProductPage.php?isbn=$isbn'>
                <img class='Book'
                     src='/sandvig/mis314/assignments/bookstore/bookimages/$isbn.01.THUMBZZZ.jpg'>
            </a>" . substr($description, 0, strpos($description, ' ', 200)) . "... " . " <a href='old/ProductPage.php?isbn=$isbn'>more...</a>
        </div>";
            }
            ?>
        </section>

        <?php include("template/footer.php") ?>
    </div>
    </body>
</html>


