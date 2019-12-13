<?php
    $router = new App_Libs_Router();
    $user = new App_Libs_UserIdentity();
    $cate = new App_Models_Categories();
    $id = intval($router->getGET('id')); //ep kieu INT cho ID

    if ($id) {
        $cateDetail = $cate->buildQueryParam([
            "where"=>"id=:id",
            "params"=>["id"=>$id]
        ])->selectOne();

        if(!$cateDetail) {
            $router->pageNotFound();
        }
    } else {
        $cateDetail = [
            "id" =>"",
            "name"=>""
        ];
    }

    if ($router->getPOST("submit") && $router->getPOST("name")) {

        $params = [
            ":name"=>$router->getPOST("name"),
        ];
        $result = FALSE;
        //neu co ID tien hanh update, neu khong co insert
        if ($id) {
            $params[":id"] = $id;
            $result = $cate->buildQueryParam([
                "value"=>"name="."'".$params[':name']."'",
                "where"=>"id=".$params[':id'],
                "params"=>$params
            ])->update();
        } else {
            $result = $cate->buildQueryParam([
                "field"=>"(name, created_by, created_time) VALUES (?,?,now())",
                "value"=>[$params[":name"], $user->getId()]
            ])->insert();
        }

        if ($result) {
            $router->redirect("categories/index");
        } else {
            $router->pageError("Can not update database");
        }
    }

?>

<html>
    <body>
        <?php require_once '../Public/header.php'?>
        <h1> <?= !$id ? "Create new" : "Viewing "?>Category: <?= $cateDetail['name']?>  </h1>
        <div>
            <form action="<?= $router->createUrl('categories/detail', ['id'=>$cateDetail['id']])?>" method="post">
                Title:
                <br>
                <input type="text" name="name" value="<?= $cateDetail['name']?>"><br>
                <br>
                <input type="submit" name="submit" value="Post">
                <input onclick="window.location.href ='<?= $router->createUrl("categories/index")?>'" type="button" value="Cancel">
            </form>
        </div>
    </body>
</html>
