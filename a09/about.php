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

        <!-- start page content *************** -->

        <p class="pageTitle">Site Features</p>
        <ul>
            <li>Site created by Cole as a class project for <a href="http://yorktown.cbe.wwu.edu/sandvig/mis314/">MIS
                    314</a> at Western Washington University.
            </li>
            <li>All product information is dynamically generated using PHP and mySQL.</li>
            <li>Product, customer and order information is stored in a mySQL database.</li>
            <li>Include files are used for all code that is used more
                than once (i.e. search/browse menu, ListAuthor function,
                header and footer).
            </li>
            <li><span class="subHead">mySQL Database</span>
                <ul>
                    <li>Normalized to 3rd normal form (or greater). Tables include:
                        <ul>
                            <li>book details</li>
                            <li>book categories</li>
                            <li>relationship details-books (many-to-many)</li>
                            <li>authors</li>
                            <li>relationship authors-books (many-to-many)</li>
                            <li>customers</li>
                            <li>orders</li>
                            <li>order items (one-to-many)</li>
                        </ul>
                    </li>
                    <li>Database is located on a separate database server for greater security and speed.</li>
                </ul>
            </li>
            <li><span class="subHead">Home page</span>
                <ul>
                    <li>Selects three random items from from the
                        database using a SQL statement.
                    </li>
                    <li>Generates the browse menu dynamically from the database using a SQL query that shows
                        only the book categories that currently contain books.
                    </li>
                    <li>Truncates book descriptions as close to 200 characters, while still on a full word.</li>
                </ul>
            </li>
            <li><span class="subHead">Search page</span>
                <ul>
                    <li>Cleans user entered data to protect against SQL Injection attacks and cross-site scripting.</li>
                    <li>Searches book title, description, author and
                        category fields in the database.
                    </li>
                    <li>The mysql_num_rows() function is used
                        to count the number of books found by the search.
                    </li>
                    <li>Responds gracefully to searches that return no matches.</li>
                </ul>
            </li>
            <li><span class="subHead">Shopping cart page</span>
                <ul>
                    <li>Uses a cookie to store the ISBNs of items in the
                        cart.
                    </li>
                </ul>
            </li>
            <li><span class="subHead">Checkout pages</span>
                <ul>
                    <li>Searches the database for email addresses of existing
                        customer accounts and writes their shipping information in
                        the form on the order confirmation page.
                    </li>
                    <li>Customer ID is encrypted using Rijndael encryption algorithm
                    </li>
                </ul>
            </li>
            <li><span class="subHead">Order Confirmation Page</span>
                <ul>
                    <li>Checks for shopping cart and prompts user if cart is
                        empty.
                    </li>
                    <li>All fields are checked to make sure that they contain
                        information.
                    </li>
                    <li>Checks email address in database and prompts user to try
                        again user if address not found.
                    </li>
                    <li>Modifications made to customer information are updated in
                        the database.
                    </li>
                    <li>Order information are written to the database.</li>
                    <li>An email is sent to the customer with the order
                        information.
                    </li>
                    <li>The shopping cart is emptied by setting ItemCount to zero in the ShoppingCart cookie.</li>
                </ul>
            </li>
            <li><span class="subHead">Order History Page</span>
                <ul>
                    <li>Searches the database for all orders associated with
                        e-mail address
                    </li>
                    <li>If no matching email address is found user is prompted to
                        try again.
                    </li>
                </ul>
            </li>
            <li><span class="subHead">Enhancements</b></span>
                <ul>
                    <li>Book descriptions cut only on full words and append eclipses.</li>
                    <li>Categories displays how many products each has.</li>
                    <li>The site has been re-styled to a theme around darker blues and light greens.</li>
                    <ul style="font-size: 80%">
                        <li>The stylesheet has been changed to fit the theme.</li>
                        <li>Some of the pictures have been edited to fit the theme.</li>
                        <li>A bit of html was added to extend the site to the bottom of the page.</li>
                    </ul>
                    <br>
                    <li>Html emails are sent after a user has changed info or ordered a book.</li>
                    <li>When an image of a book is clicked it will show the user a bigger image of the book without
                        redirecting, using <a href="http://jslightbox.felixhagspiel.de/" >jsOnlyLightbox</a>.
                    </li>
                    <li>Email addresses are saved in a cookie and autofilled on checkout01.</li>
                    <li>Number of items in cart is shown throughout the website.</li>
                    <li>If only one book is returned from a search, it will redirect to that page.</li>
                    <li>It will also let the user know if there is only one book in a resulting search.</li>

                </ul>
            </li>
            <li>Thanks to Amazon.com for the use of its
                icons, book images and book descriptions.
            </li>
            <li>
                Also thanks to <a href="https://commons.wikimedia.org/wiki/File:Shopping_cart_font_awesome.svg">Font
                    Awesome</a> and <a
                    href="https://commons.wikimedia.org/wiki/File:Ic_account_circle_48px.svg">Github</a> for their icons
            </li>
        </ul>

        <!-- end page content *************** -->
    </section>

    <?php include("template/footer.php") ?>
</div>
</body>
</html>