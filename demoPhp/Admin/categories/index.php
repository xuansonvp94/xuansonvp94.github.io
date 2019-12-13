<?php
    $cate = new App_Models_Categories();
    $result = $cate->buildQueryParam(["other"=>"order by created_time DESC"])->select();
    $user = new App_Libs_UserIdentity();
    $router = new App_Libs_Router();

?>

<html>
    <body>
       <?php require_once '../Public/header.php'?>

        <div>
            <h1>
                MANAGER CATEGORIES
            </h1>
            <a href="<?= $router->createUrl('categories/detail') ?>">Add new</a>
        </div>

        <div>
            <table style="width: 100%"; border="1">
                <tr>
                    <td>ID</td>
                    <td>NAME</td>
                    <td>DATE</td>
                    <td>DELETE</td>
                </tr>
                <?php foreach ($result as $value) { ?>
                    <tr>
                        <td> <?= $value['id'] ?></td>
                        <td>
                            <a href="<?= $router->createUrl('categories/detail', ['id' => $value['id']]) ?>">
                                <?= $value['name']?>
                            </a>
                        </td>
                        <td><?= $value['created_time']?></td>
                        <td>
                           <a  href="<?= $router->createUrl('categories/delete',  ['id' => $value['id']]) ?>" >
                               Delete
                           </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </body>
</html>
