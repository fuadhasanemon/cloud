<?php
require "/config.php.ini";

header("Content-Type: text/html; charset=utf-8");

session_start();

$referer = getenv("HTTP_REFERER");

if ($referer == PAGE_REGISTRATION) {
    unset($_SESSION["error"]);
}

if (!empty($_SESSION["id_user"])) {
    header("location: " . PAGE_MYFILES);
}

if (!file_exists("disc")) {
    mkdir("disc");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Authorization</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="js/sha1.js"></script>
        <script type="text/javascript" src="js/handler.js"></script>
    </head>
    <body>
        <form action="users/auth.php"  method="post" enctype="multipart/form-data" name="login_form" id="form" role="form" style="width: 20%; margin: auto; margin-top: 15%;" onsubmit="onSubmit()">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email"  placeholder="Enter the email address" id="email" class="form-control" maxlength="30">
                <br>
                <label for="pas">Password</label>
                <input type="password"  name="password" placeholder="enter password" class="form-control" maxlength="35">
                <hr>
                <div id="error">
                    <?php
                    if (!empty($_SESSION["error"])) {
                        echo "<div class=\"alert alert-danger\">" . $_SESSION["error"] . "</div>";
                    }
                    ?>
                </div>
                <input type="submit" value="Login" class="btn btn-primary">
                <a href="users/registration.php" class="btn btn-success">Registration</a>
            </div>
        </form>
    </body>
</html>