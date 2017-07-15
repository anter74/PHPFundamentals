<html>
<head>
    <title>Select Color</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">
    <?php
    //must arrive from order02.php
    $referrer = $_SERVER['HTTP_REFERER'];
    if (stripos($referrer, 'order01.php') == false) header("location:order01.php");

    $fname = $_REQUEST['fname'];
    $model = $_REQUEST['model'];
    include 'validationUtilities.php';
    if (fIsValidLength($fname, 1, 30) && ($model == "Mustang" || $model == "Subaru" || $model == "Corvette")) {
        setcookie('fname', $fname);
        setcookie('model', $model);
    } else {
        exit();
    }
    ?>


    <p></p>
    <h2 class="centerText">Select Color</h2>


    <div class="pageContainer">
        <form action="Order03.php" class="formLayout">
            <div class="formGroup">
                <label>Car color:</label>
                <div class="formElements">
                    <select name="color" required>
                        <option value=""></option>
                        <option style="background-color: blue; color:white;" value="blue">Blue</option>
                        <option style="background-color: red" value="red">Red</option>
                        <option style="background-color: yellow" value="yellow">Yellow</option>
                    </select>

                </div>
            </div>
            <div class="formGroup">
                <label></label>
                <button type="submit"> >> Next >></button>
            </div>
            <div class="centerText vertGap55">
                <button type="submit" formnovalidate>Submit without validation</button>
                <br><br>
                <a href="?">Reload page</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>