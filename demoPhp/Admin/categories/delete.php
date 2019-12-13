<?php
    $router = new App_Libs_Router();
    $user = new App_Libs_UserIdentity();
    $cate = new App_Models_Categories();
    $id = intval($router->getGET('id'));


    $cateDetail = $cate->buildQueryParam([
        "where" => "id=:id",
        "params" => ["id" => $id]
    ])->selectOne();

    if (!$cateDetail) {
        $router->pageNotFound();
    }


    if ($id && $router->getPOST('submit')) {
        $params[":id"] = $id;
        $result = $cate->buildQueryParam([
            "where"=>"id=".$params[':id']
        ]);
        if ($cate->delete($params[":id"])) {
            $router->redirect('categories/index');
        } else {
            $router->pageError("Can not delete this row ");
        }
    }
?>

<html>
    <body>
        <?php require_once '../Public/header.php' ?>
        <h1 style="font-weight: bold"> Do you want to DELETE: <?= $cateDetail['name'] ?> </h1>

        <div>
            <form method="post" action="<?= $router->createUrl('categories/delete', ['id' => $id]) ?>">
                <input type="submit" name="submit" value="Yes">
                <input onclick="window.location.href='<?= $router->createUrl('categories/index') ?>'" type="button" value="No">
            </form>
        </div>

    </body>
</html>
