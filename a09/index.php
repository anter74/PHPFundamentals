<?php include_once("utilities/databaseConnection.php") ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>GeekBooks - MIS 314 Sample Bookstore</title>
    <link rel="stylesheet" href="style/newStyle.css"
          type="text/css"/>
</head>
<body>

<?php include("template/header.php") ?>

<div class="pageContainer">
    <div class="leftColumn">

        <?php include("template/menu.php") ?>

    </div>
    <section>

        <?php
        $link = fConnectToDatabase();
        $sql = "select title,description,isbn from bookdescriptions order by rand() limit 3;";
        $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));

        while ($row = mysqli_fetch_array($result)) {
            $title = $row['title'];
            $description = $row['description'];
            $isbn = $row['isbn'];

            echo '
            <div class="bookSimple">
                <a class="booktitle" href="ProductPage.php?isbn=' . $isbn . '">' . $title . '</a> <br/>
                <a href="ProductPage.php?isbn=' . $isbn . '">
                    <img class="Book" alt="' . $title . '"
                         src="/sandvig/mis314/assignments/bookstore/bookimages/' . $isbn . '.01.THUMBZZZ.jpg">
                </a>
                ' . trim(substr($description, 0, strpos($description, ' ', 200))) . "... " . '<a href="ProductPage.php?isbn=' . $isbn . '">See more...</a>
            </div>
        ';
        }
        ?>

    </section>
    <div style="height: 630px"></div>
    <?php include("template/footer.php") ?>

</div>
</body>
</html>
