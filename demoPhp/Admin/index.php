<?php
include "../App/bootstrap.php";

$a = new App_Models_Users(); //Tuong tac data voi bang Users

$router = new App_Libs_Router(__DIR__);
$router->router();

$cate = new App_Models_Categories();

//select du lieu
$result = $cate->buildQueryParam() ->select();


// insert du lieu
/*$result = $a->buildQueryParam([
    "field"=>"(username, password) values (?,?)",
    "value"=>["xuansonvp94", md5("ilikebreak")]
])->insert();
var_dump($result);*/


$router = new App_Libs_Router(__DIR__);
$router->router();

