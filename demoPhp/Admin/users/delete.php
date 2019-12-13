<?php
    $router = new App_Libs_Router();
    $user = new App_Libs_UserIdentity();
    $dataUsers = new App_Models_Users();
    $id = intval($router->getGET('id'));


$userDetail = $dataUsers->buildQueryParam([
    "where" => "id=:id",
    "params" => ["id" => $id]
])->selectOne();

if (!$userDetail) {
    $router->pageNotFound();
}


if ($id && $router->getPOST('submit')) {
    $params[":id"] = $id;
    $result = $dataUsers->buildQueryParam([
        "where"=>"id=".$params[':id']
    ]);
    if ($dataUsers->delete($params[":id"])) {
        $router->redirect('users/index');
    } else {
        $router->pageError("Can not delete this post ");
    }
}
?>

<html>
    <body>
        <?php require_once '../Public/header.php' ?>
        <h1 style="font-weight: bold"> Do you want to DELETE: <?= $userDetail['username'] ?> </h1>

        <div>
            <form method="post" action="<?= $router->createUrl('users/delete', ['id' => $id]) ?>">
                <input type="submit" name="submit" value="Yes">
                <input onclick="window.location.href='<?= $router->createUrl('users/index') ?>'" type="button" value="No">
            </form>
        </div>
    </body>
</html>
