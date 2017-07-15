<html>
<head>
    <title>PHP Clock</title>
    <link rel="stylesheet" type="text/css" href="http://yorktown.cbe.wwu.edu/sandvig/mis314/lectures/style.css">
</head>
<body>
<div class="bodyContainer">
    <h1>Example 1: PHP clock</h1>
    <hr/>
    <?php
    $i = 10;
    while ($i > 0) {
    ?>
    <div class="clockBorder">
                <span class="clockFont">
                    <?php
                    //echo current time
                    //Format parameters: g hour, i minutes
                    //s seconds
                    echo date("G:i:s");
                    ?>
                </span>
    </div>
    <h3>Today is
        <?php
        //add format string to produce date format
        //"January 12, 2015";
        echo date("F j, Y");
        $i--;
        }
        ?>
    </h3>
</div>
</body>
</html>