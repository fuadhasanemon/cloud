<?php
require "../config.php.ini";
require "../classes/file.class.php";
require "../classes/user.class.php";

header("Content-Type: text/html; charset=utf-8");

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
        <title>Files</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    </head>
    <body>
        <?php
        require DIR_RESOURSES . "navbar.php";
        require DIR_RESOURSES . "menu.php";
        ?>
        <div style="width: 40%; margin: auto;">
            <?php
            $file = new File();
            if ($file->countFiles() > 0):
                ?>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="alert alert-info">
                            <th>File name</th>
                            <th>Size</th>
                            <th><span class="glyphicon glyphicon-download-alt"></span></th>
                            <th><span class="glyphicon glyphicon-trash"></span></th>
                        </tr>
                    </thead>
                    <?php
                    $stmt = $file->getFiles(0, 'public');
                    while ($row = $stmt->fetch_array(MYSQLI_NUM)):
                        $owner = $file->isOwner($_SESSION["id_user"], $row[0])
                        ?>
                        <tr>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            
                           
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-success">No one has downloaded the files, you can be the first :)</div>
<?php endif; ?>
            </table>
            <form action="load.php" method="post" enctype="multipart/form-data" id="upload" style="position: relative; float: top; float: left; margin: auto; width: 20%">
                <label for="uploadbtn" class="label label-primary" style="font-size: 16px;">Upload file</label>
                <input type="file" name="filename" id="uploadbtn" onchange="document.getElementById('upload').submit()" style="opacity: 0; z-index: -1;" for="load">
            </form>
        </div>
    </body>
</html>