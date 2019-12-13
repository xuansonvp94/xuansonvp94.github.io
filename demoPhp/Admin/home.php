<?php
    $user = new App_Libs_UserIdentity();
    $router = new App_Libs_Router();

    ?>
<html>
    <head>
        <title>Welcome Home</title>
    </head>
    <body>
        <div>
            <?php require_once  "../Public/header.php"?>
            <h1>
                ADMIN PAGE
            </h1>
        </div>

        <div class="show-data">
            <ul>
                <li><a href="<?= $router->createUrl('posts/index') ?>">Manage Posts</a></li>
                <li><a href="<?= $router->createUrl('categories/index') ?>">Manage Category</a></li>
                <li><a href="<?= $router->createUrl('users/index') ?>">Manage User</a></li>
            </ul>
        </div>
    </body>
</html>

