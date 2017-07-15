<div class="menuContainer">
    <div class="menuSearch">
<!--        <img border="0" src="img/search_heading.gif" class="menuHeader"-->
<!--             alt="search">-->
        <style>    #menuTitles{
                margin: 0 0 2px 0;
                text-align: left;
                background-color: #B6CA91;
                color: #fdfdfd;
                padding:3px 6px 1px 10px;
                font-size: 90%;
                font-weight: 500;
                -webkit-touch-callout: none; /* iOS Safari */
                -webkit-user-select: none;   /* Chrome/Safari/Opera */
                -moz-user-select: none;      /* Firefox */
                -ms-user-select: none;       /* Internet Explorer/Edge */
                cursor: default;
            }</style>
        <p id="menuTitles">SEARCH</p>
        <div class="menuBorder">
            <form action="SearchBrowse.php">
                <input type="text" name="search" autofocus/>
                <input type="submit" value="Search" class="button" class="fullWidth"/>
            </form>
        </div>
    </div>

    <nav>
        <p id="menuTitles">BROWSE</p>
        <div class="menuBorder">

            <?php
            //connect to database
            $link = fConnectToDatabase();

            //List records
            $sql = "select CategoryName, a.CategoryID, COUNT(CategoryName) AS number from bookCategories a,bookCategoriesbooks ab WHERE a.CategoryID = ab.CategoryID GROUP BY CategoryName order by CategoryName;";
            //$result is an array containing query results
            $result = mysqli_query($link, $sql)
            or die('SQL syntax error: ' . mysqli_error($link));

            // iterate through the retrieved records
            while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
                $CategoryName = $row['CategoryName'];
                $CategoryID = $row['CategoryID'];
                $number = $row['number'];
            echo "<a href=SearchBrowse.php?catID=$CategoryID&catName=" . urlencode($CategoryName) .  " class='menuitem' >$CategoryName ($number)</a><br />";}
            ?>

        </div>
    </nav>
</div>

