<?php include_once("utilities/databaseConnection.php");
include("template/ListAuthors.php") ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

    <link rel="stylesheet" href="style/newStyle.css"
          type="text/css"/>

    <link rel="stylesheet" href="style/lightbox.min.css">

<?php include("template/header.php") ?>

<div class="pageContainer">
    <div class="leftColumn">

        <?php include("template/menu.php") ?>

    </div>
    <section>
        <?
        $link = fConnectToDatabase();
        $comment = fCleanString($link, $_REQUEST['comment'], 350);
        $title = fCleanString($link, $_REQUEST['title'], 100);
        $isbn = fCleanString($link, $_REQUEST['isbn'], 10);
        if (isset($comment) && isset($title) && $comment != "" && $title != "") {
            $sql = "INSERT INTO  `behrndc`.`bookComments` (`isbn` ,`comment` ,`title` ,`commentID`)VALUES ('$isbn',  '$comment',  '$title', NULL);";
            $result = mysqli_query($link, $sql)
            or die('SQL syntax error: ' . mysqli_error($link));
        }
        ?>

        <?php
        $result = $_GET['result'];
        if (isset($result)) {
            echo "We could only find this book. <br><br>";
        }

        $sql = "select title,description,isbn,price,publisher,pages,edition from bookdescriptions WHERE isbn = '$isbn';";
        $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));

        while ($row = mysqli_fetch_array($result)) {
            $title = $row['title'];
            $description = $row['description'];
            $isbn = $row['isbn'];
            $price = $row['price'];
            $publisher = $row['publisher'];
            $pages = $row['pages'];
            $edition = $row['edition'];

            echo "
<span class='bookTitle'> $title </span><br />

        <span>by  " . fListAuthors($link, $isbn) . "</span><br />
       
            <img class='Book '
                 src='/sandvig/mis314/assignments/bookstore/bookimages/$isbn.01.MZZZZZZZ.jpg' alt='thumbnail' data-jslghtbx='/sandvig/mis314/assignments/bookstore/bookimages/$isbn.01.LZZZZZZZ.jpg'>
         <br />

        <span class='priceLabel'>List Price: </span>
				<span class='bookPriceB'>
					<span style='text-decoration:line-through'> $$price </span>
				</span> <br />

        <span class='priceLabel'>Our Price:</span>
				<span class='bookPriceB'>
                $" . number_format($price * .8, 2) . " </span> <br />

        <span class='priceLabel'>You Save:</span>
				<span class='bookPriceB'>
                $" . number_format($price - ($price * .8), 2) . " (20%)</b></span><br />
        <br />

                <span class='bookDetails'>
                <b>ISBN:</b> $isbn <br />
                <b>Publisher:</b> $publisher <br />
                <b>Pages:</b> $pages <br />
                <b>Edition:</b> $edition              </span>

        <a href='ShoppingCart.php?addISBN=$isbn'>
            <img border='0' src='/sandvig/mis314/assignments/bookstore/images/add-to-cart-small.gif' align='right'></a>
        <br /><br />
        <p> $description </p>                <a href='ShoppingCart.php?addISBN=$isbn'>
            <img border='0' src='img/add-to-shopping-cart-blue.gif' align='right'>
        </a>
        ";
        }
        ?>
        <br>
        <br>
        <?
        $sql = "select title,comment,isbn,commentID from bookComments WHERE isbn = '$isbn';";
        $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));
        while ($row = mysqli_fetch_array($result)) {
            $reviewText = $row['comment'];
            $reviewTitle = $row['title'];
            echo "<div id='comment'><h4>$reviewTitle</h4>
                <p>$reviewText</p></div><br>";
        }

        ?>
        <style>
            h4, p {
                margin: 0;
            }

            #comment p {
                padding-top: 10px;
            }

            #comment {
                border: solid 1px #DDDDDD;
                padding: 20px;
            }
        </style>
        <form>
            <h3>Review this book</h3>
            <input maxlength="100" type="hidden" value="<? echo $isbn ?>" name="isbn">
            <label>Title:</label> <br> <input type="input" name="title">
            <label>Comment:</label> <br>
            <textarea maxlength="350" name="comment" rows="5"></textarea>
            <input type="submit">
        </form>
    </section>

    <?php include("template/footer.php") ?>
</div>

<? echo "<title>GeekBooks - " . $title . "</title>" ?>
<script src="lightbox.min.js" type="text/javascript"></script>
<script>
    var lightbox = new Lightbox();
    lightbox.load();
</script>
</body>
</html>