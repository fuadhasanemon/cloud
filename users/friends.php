<?php
require "../config.php.ini";
require "../classes/file.class.php";
require "../classes/user.class.php";

session_start();

if (empty($_SESSION["id_user"])) {
    header("location: " . PAGE_START);
    exit;
}

User::checkUsersOnline();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Friends</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    </head>
    <body>
        <?php
        require DIR_RESOURSES . "navbar.php";
        require DIR_RESOURSES . "menu.php";
        ?>
        <div style="margin: auto; width:40%;">
            <?php
            $user = new User();
            $id = isset($_GET["id"]) ? $_GET["id"] : $_SESSION["id_user"];
            $subscribe = $user->getSubscribers($id, isset($_GET["search"]) ? $_GET["search"] : null);
            while ($row = $subscribe->fetch_array(MYSQLI_NUM)):
                ?>
                <div style="font-size: 14px; font-weight: 700;">
                    <a href="<?= PAGE_PROFILE . $row[0] ?>">
                        <img src="<?= isset($user->getInfo($row[0])[4]) ? $user->getInfo($row[0])[4] : '../disc/defaultImage.jpg' ?>" style="border-radius: 100%; box-shadow: 0 0 7px #666; width: 50px; height: 50px; margin: auto; margin-right: 10px">
                        <?= $user->getInfo($row[0])[1] . " " . $user->getInfo($row[0])[2]; ?>
                        <sup style="color: #ADADAD"><?= User::isOnline($row[0]) ? "online" : "" ?></sup>
                    </a>
                    <form action="subscription.php" method="post" accept-charset="utf-8"  style="position: relative; float: right; margin-left: 10px;">
                        <input type="hidden" name="id" value="<?= $row[0] ?>">
                        <?php
                            $subscriptionExist = User::isSubscriptionExists($_SESSION["id_user"], $row[0]);
                        ?>
                        <input type="submit" class="btn btn-<?= $subscriptionExist ? "default" : "primary" ?>" value="<?= $subscriptionExist ? "Unfriend" : "Friend" ?>" style="width: 150px">
                    </form>
                    
                </div>
                <hr>
            <?php endwhile; ?>
        </div>
    </body>
</html>