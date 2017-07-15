<?php
session_start();
$abandon = $_REQUEST['abandon'];
if($abandon){
    session_unset();
    header("location: login.php");
    exit();
}
if (!isset($_SESSION["username"])) {
    echo "no user" .  $_SESSION["username"];
    header("location: login.php");
}

$username = $_SESSION["username"];
?>
<html>
<head>
    <title>Password Protected Page</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pageContainer centerText">
    <h2>Password Protected Page</h2>
    <hr>
    <h2>Welcome, <?php echo $username ?></h2>
    <img src="/sandvig/mis314/assignments/images/vault.jpg" style="width:400px;height:auto;"/>
    <br>
    Your session will timeout
    after 24 minutes of inactivity.<br><br>

    <form method="post" class="formLayout">
        <div class="formGroup">
            <input type="hidden" name="abandon" value="true">
            <label> </label>
            <button type="submit">Logout</button>
        </div>
    </form>

</div>
</body>
</html>