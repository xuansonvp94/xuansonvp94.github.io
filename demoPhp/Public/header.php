<div>
    HI <?= $user->getSESSION("username"); ?><br>
    <a href="<?= $router->createUrl('logout')?>">Logout</a><br>
    <a href="<?= $router->createUrl('signup')?>">Sign Up</a>
    <a href="<?= $router->createUrl('index') ?>"><h2>WELCOME TO DEMO</h2></a>
</div>
