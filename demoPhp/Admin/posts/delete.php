<?php
    $router = new App_Libs_Router();
    $user = new App_Libs_UserIdentity();
    $post = new App_Models_Posts();
    $id = intval($router->getGET('id'));


    $postDetail = $post->buildQueryParam([
        "where" => "id=:id",
        "params" => ["id" => $id]
    ])->selectOne();

    if (!$postDetail) {
        $router->pageNotFound();
    }


    if ($id && $router->getPOST('submit')) {
        $params[":id"] = $id;
        $result = $post->buildQueryParam([
            "where"=>"id=".$params[':id']
        ]);
        if ($post->delete($params[":id"])) {
            $router->redirect('posts/index');
        } else {
            $router->pageError("Can not delete this post ");
        }
    }
?>

<html>
    <body>
        <?php require_once '../Public/header.php' ?>
        <h1 style="font-weight: bold"> Do you want to DELETE: <?= $postDetail['name'] ?> </h1>

    <div>
        <form method="post" action="<?= $router->createUrl('posts/delete', ['id' => $id]) ?>">
            <input type="submit" name="submit" value="Yes">
            <input onclick="window.location.href='<?= $router->createUrl('posts/index') ?>'" type="button" value="No">
        </form>
    </div>

    </body>
</html>
