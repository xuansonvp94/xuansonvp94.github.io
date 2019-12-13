<?php
    $post = new App_Models_Posts();
    $user = new App_Libs_UserIdentity();
    $router = new App_Libs_Router();
    $listPost = $post->buildQueryParam([
            "select"=> "posts.id, posts.name, posts.description, posts.created_time, categories.name as cate_name",
            "join"=>"INNER JOIN categories ON categories.id = posts.cate_id"
    ])->select();
?>

<html>
    <body>
        <?php require_once '../Public/header.php'?>

        <div>
            <h1>
                LIST ARTICLES
            </h1>
            <a href="<?= $router->createUrl('posts/detail') ?>">Add new</a>
        </div>

        <div>
            <table style="width: 100%"; border="1">
                <tr>
                    <td>ID</td>
                    <td>NAME</td>
                    <td>CATEGORY</td>
                    <td>DESCRIPTION</td>
                    <td>DATE</td>
                    <td>DELETE</td>
                </tr>
                <?php foreach ($listPost as $data) { ?>
                    <tr>
                        <td> <?= $data['id'] ?></td>
                        <td>
                            <a href="<?= $router->createUrl('posts/detail', ['id' => $data['id']]) ?>">
                                <?= $data['name']?>
                            </a>
                        </td>
                        <td><?= $data['cate_name']?></td>
                        <td/> <?= $data['description']?> </td>
                        <td><?= $data['created_time']?></td>
                        <td>
                            <a  href="<?= $router->createUrl('posts/delete',  ['id' => $data['id']]) ?>" >
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </body>
</html>
