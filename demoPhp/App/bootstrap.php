<?php

spl_autoload_register(function ($className) {
    $export = str_replace("_", "/",$className);
    $path = str_replace("App", "",dirname(__FILE__));
    include_once $path."/".$export.".php";
});