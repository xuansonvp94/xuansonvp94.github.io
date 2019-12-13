<?php
    $user = new App_Libs_UserIdentity();
    $router = new App_Libs_Router();
    $tableUsers = new App_Models_Users();
    $name = $email = $website = $gender = $comment = "";
    $nameErr = $emailErr = $websiteErr = $genderErr = "";

    $listUsernames = $tableUsers->buildQueryParam([
        "select" => "username"
    ])->select();
    var_dump(count($listUsernames));
    

?>
<html>
    <body>
        <?php require_once "../Public/header.php"?>
        <h1>CREATE NEW ACCOUNT</h1>
        <form action="<?= $router->createUrl('signup') ?>" method="post">
            Username:<br>
            <input type="text" name="username">
            <br><br>
            Password: <br>
            <input type="password" name="password">
            <br><br>
            <input type="submit" name="submit" value="Create">
            <input onclick="window.location.href='<?= $router->createUrl("index") ?>'" type="button" value="Cancel">
        </form>
    </body>
</html>
