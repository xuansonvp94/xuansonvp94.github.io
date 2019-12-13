 <?php
/*
 *
 */
$router = new App_Libs_Router();


$account = trim($router->getPOST('account'));
$password = trim($router->getPOST('password'));
$identity =  new App_Libs_UserIdentity();
if ($identity->isLogin()) {
    $router->homePage();
}

if ($router->getPOST("submit") && $account && $password) {
    $identity->username = $account;
    $identity->password = $password;

    if ($identity->login()) {
        $router->homePage();
    } else {
        echo "Username or Password is incorrect";
    }
}
?>

<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div>
            <p>Demo</p>
        </div>
        <form action="<?php echo $router->createUrl("login") ?>" method="POST">
            Account:
            <br>
            <input type="text" name="account"> <br>
            Password:
            <br>
            <input type="password" name="password"><br>

            <input type="submit" name="submit" value="login">
        </form>
    </body>
</html>
