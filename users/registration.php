<?php
require "../config.php.ini";

header("Content-Type: text/html; charset=utf-8");

session_start();

$referer = getenv("HTTP_REFERER");
if ($referer == PAGE_START) {
    unset($_SESSION["error"]);
}

if (!empty($_SESSION["id_user"])) {
    header("location: " . PAGE_MYFILES);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Submit</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="../js/sha1.js"></script>
        <script type="text/javascript" src="../js/handler.js"></script>
    </head>
    <body>
        <form action="createaccount.php" method="post" accept-charset="utf-8" id="form" role="form" style="width: 20%; margin: auto; margin-top: 10%;">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter your name" class="form-control" maxlength="30">
                <br>
                <label for="surname">Last name</label>
                <input type="text"  name="surname" placeholder="Enter last name" class="form-control" maxlength="35">
                <br>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter the email address" class="form-control" maxlength="30">
                <br>
                <label for="password">Password</label>
                <input type="password"  name="password" placeholder="enter password" class="form-control" maxlength="35">
                <div class="error">
                </div>
                <hr>
                <div id="error">
                    <?php
                    if (!empty($_SESSION["error"])) {
                        echo "<div class=\"alert alert-danger\">" . $_SESSION["error"] . "</div>";
                    }
                    ?>
                </div>
                <input type="submit" value="Submit" class="btn btn-primary" style="position: relative; float: left;">
                <h1>
                    <a href="../index.php" title="Authorization" class="navbar-brand glyphicon glyphicon-log-out" style="position: relative; float: right; margin-top: -5%;"></a>
                </h1>
        </form>
    </body>
</html>
