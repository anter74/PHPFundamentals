<?php
if ($_REQUEST['password'] == 'guest' && strlen($_REQUEST['username']) > 0) {
    session_start();
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = $_REQUEST['username'];
    echo $_SESSION['username'];
    header("location: protected.php");
    exit(); //stops page execution
}

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$postback = $_REQUEST['postback'];
if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
?>
<html>
<head>
    <title>Login</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="pageContainer centerText">
    <h2>Login</h2>
    <form method="post" class="formLayout">
        <div class="formGroup">
            <label>First name:</label>
            <input type="text" name="username"
                   class="formElement"
                   placeholder="first name"
                   title="first name" required autofocus value="<?php echo $username ?>"/><br>
        </div>
        <?php
        if ($postback && strlen($username) < 1) {
            echo "<p class=\"errormsg\">Please enter your name.</p>";
        }
        ?>
        <div class="formGroup">
            <label>Password:</label>
            <input type="password" name="password" class="formElement"
                   placeholder="password"
                   title="password" required value="<?php echo $password ?>"/><br>
            <label></label>(Password is 'guest')<br>
        </div>
        <?php
        if ($postback && (strlen($password) < 1 || $password != 'guest')) {
            echo "<p class=\"errormsg\">Please enter password 'guest'.</p>";
        }
        ?>
        <div class="formGroup">
            <label> </label>
            <input type="hidden" name="postback" value="true">
            <button type="submit">Login</button>
        </div>
        <div class="formGroup">
            <label></label>
            <button type="submit" formnovalidate>Login without HTML5 validation</button>
        </div>

        <div class="vertGap55 centerText">
            <a href="protected.php">Try going to protected.php without logging on.</a>
        </div>
    </form>

</div>
</body>
</html>