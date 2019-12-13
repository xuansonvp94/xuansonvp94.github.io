<?php
    $router = new App_Libs_Router();
    $user = new App_Libs_UserIdentity();
    $post = new App_Models_Posts();
    $cate = new App_Models_Categories();
    $id = intval($router->getGET("id"));

    if ($id) {
        $postDetail = $post->buildQueryParam([
            "where"=>"id=:id",
            "params"=>["id"=>$id]
        ])->selectOne();

        if(!$postDetail) {
            $router->pageNotFound();
        }
    } else {
        $postDetail = [
            "id" =>"",
            "name"=>"",
            "content"=>"",
            "description"=>"",
            "cate_id"=>""
        ];
    }

    if ($router->getPOST("submit")
            && $router->getPOST("name")
            && $router->getPOST("content")
            && $router->getPOST("category")
        )
    {
        $params = [
            ":name"=>$router->getPOST("name"),
            ":content"=>$router->getPOST("content"),
            ":description"=>$router->getPOST("description"),
            ":category"=>$router->getPOST("category"),
        ];
        $result = FALSE;
        //neu co ID tien hanh update, neu khong co insert
        if ($id) {
            $params[":id"] = $id;
            $result = $post->buildQueryParam([
                "value"=>"name ="."'".$params[':name']."'". ", content = '".$params[':content']."', ".
                    "description = '".$params[':description']."', ". "cate_id = ".$params[':category'],
                "where"=>"id=".$params[':id'],
                "params"=>$params
            ])->update();
        } else {
            $result = $post->buildQueryParam([
                "field"=>"(cate_id, name, description, content, created_by, created_time) VALUES (?,?,?,?,?,now())",
                "value"=>[$params[":category"], $params[":name"], $params[":description"], $params[":content"], $user->getId()]
            ])->insert();
        }

        if ($result) {
            $router->redirect("posts/index");
        } else {
            $router->pageError("Can not update database");
        }
    }

?>

<html>
    <body>
        <?php require_once '../Public/header.php'?>
        <h1> <?= !$id ? "Create new" : "Viewing "?> Article: <?= $postDetail['name']?>  </h1>
        <div>
            <form action="<?= $router->createUrl('posts/detail', ['id'=>$postDetail['id']])?>" method="post">
                Title:
                <br>
                <input type="text" name="name" value="<?= $postDetail['name']?>"><br>
                Category:
                <br>
                <select name="category">
                    <?php
                    $listCategory = $cate->buildSelectBox();
                    foreach ($listCategory as  $key=>$value) {
                    ?>
                        <option <?= $key == $postDetail["cate_id"] ? "selected" : "" ?> value="<?= $key ?>"> <?= $value?> </option>
                    <?php } ?>
                </select>
                <br>
                Description:
                <br>
                <textarea name="description"> <?= $postDetail['description'] ?> </textarea>
                <br>
                Content:
                <br>
                <textarea name="content"> <?= $postDetail['content']?> </textarea>
                <br>
                <input type="submit" name="submit" value="Post">
                <input onclick="window.location.href ='<?= $router->createUrl("posts/index")?>'" type="button" value="Cancel">
            </form>
        </div>
    </body>
</html>
