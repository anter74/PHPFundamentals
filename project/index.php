<?php include_once("utilities/databaseConnection.php") ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Home - GeekBooks</title>
    <link rel="stylesheet" href="style/newStyle.css"
          type="text/css"/>
    <script>
        function checkBooks() {
            var hideMe = document.getElementsByClassName('hidebook');
            var checkbox = document.getElementById('more').checked;
            var item;

            if (!checkbox) {
                for (i = 0; i < hideMe.length; ++i) {
                    item = hideMe[i];
                    item.style.display = "none";
                }
                document.getElementById('moreLabel').innerText = "More content?";
            } else if (checkbox) {
                for (i = 0; i < hideMe.length; ++i) {
                    item = hideMe[i];
                    item.style.display = "inline";
                }
                document.getElementById('moreLabel').innerText = "Less content?";

            }
        }
    </script>
    <?php include("template/header.php") ?>

    <div class="pageContainer">
        <div class="leftColumn">

            <?php include("template/menu.php") ?>
            <div style="white-space: nowrap">
                <input type="checkbox" name="more" id="more" onclick="checkBooks()" checked
                       style="width:15px !important;">
                <label for="more" id="moreLabel"
                       style="-webkit-touch-callout: none;  -webkit-user-select: none;  -moz-user-select: none; -ms-user-select: none;">Less
                    content?</label></div>

        </div>
        <section>

            <?php
            function checkComma($string)
            {

                if (substr($string, -1) == ',') {
                    return substr($string, 0, -1);
                }
                return $string;
            }

            $link = fConnectToDatabase();
            $sql = "select title,description,isbn from bookdescriptions order by rand() limit 6;";
            $result = mysqli_query($link, $sql)
            or die('SQL syntax error: ' . mysqli_error($link));
            $bookNum = 0;
            while ($row = mysqli_fetch_array($result)) {
                $title = $row['title'];
                $description = $row['description'];
                $isbn = $row['isbn'];
                if ($bookNum <= 2) {
                    echo '
            <div class="bookSimple">
                <a class="booktitle" href="ProductPage.php?isbn=' . $isbn . '">' . $title . '</a> <br/>
                <span style="font-size:80%">br ' . fListAuthors($link, $isbn) . '</span><br>
                <a href="ProductPage.php?isbn=' . $isbn . '">
                    <img class="Book" alt="' . $title . '"
                         src="/sandvig/mis314/assignments/bookstore/bookimages/' . $isbn . '.01.THUMBZZZ.jpg">
                </a>
                ' . checkComma(trim(substr($description, 0, strpos($description, ' ', 200)))) . "... " . '<a href="old/ProductPage.php?isbn=' . $isbn . '">See more...</a>
            </div>
        ';
                } else {
                    echo '
            <div class="bookSimple hidebook">
                <a class="booktitle" href="ProductPage.php?isbn=' . $isbn . '">' . $title . '</a> <br/>
                <span style="font-size:80%">br ' . fListAuthors($link, $isbn) . '</span><br>
                <a href="ProductPage.php?isbn=' . $isbn . '">
                    <img class="Book" alt="' . $title . '"
                         src="/sandvig/mis314/assignments/bookstore/bookimages/' . $isbn . '.01.THUMBZZZ.jpg">
                </a>
                ' . checkComma(trim(substr($description, 0, strpos($description, ' ', 200)))) . "... " . '<a href="old/ProductPage.php?isbn=' . $isbn . '">See more...</a>
            </div>
        ';
                }
                $bookNum += 1;
            }
            ?>

        </section>
        <div style="height: 630px"></div>
        <?php include("template/footer.php") ?>

    </div>
    </body>
</html>
