<?php
/**
 *
 */
$user = new App_Libs_UserIdentity();
$user->logout();

(new App_Libs_Router())->loginPage();
?>




