<?php

/**
 * Class App_Libs_Router
 */
class App_Libs_Router {
    const PARAM_NAME = "r";
    const HOME_PAGE = "home";
    const INDEX_PAGE = "index";

    public static $sourcePath;

    public function __construct($sourcePath="") {
        if ($sourcePath) {
            self::$sourcePath = $sourcePath;
        }
    }


    public function getGET($name = NULL) {
        if($name !== NULL) {
            return isset($_GET[$name]) ? $_GET[$name] : NULL;
        }
        return $_GET;
    }

    public function getPOST($name = NULL) {
        if($name !== NULL) {
            return isset($_POST[$name]) ? $_POST[$name] : NULL;
        }
        return $_POST;
    }

    /**
     *
     */
    public function router() {
        $url = $this->getGET(self::PARAM_NAME);
        if (!is_string($url) || $url == self::INDEX_PAGE) {
            $url = self::HOME_PAGE;
        }

        $path = self::$sourcePath."/".$url.".php";

        if (file_exists($path)) {
            return require_once $path;
        } else {
            return $this->pageNotFound();
        }
    }

    public function pageNotFound() {
        $this->pageError("404 Page Not Found");
    }

    /**
     * tạo ra url: vd truyen vao createUrl("post") => /projects/src/Admin/index.php?r=post
     * @param $url
     * @param array $param
     * @return string
     */
    public function createUrl($url, $param=[]) {
        if ($url)
            $param[self::PARAM_NAME] = $url;
        return $_SERVER['PHP_SELF']."?".http_build_query($param);
    }

    /**
     * tu dong chuyen sang 1 trang khac khi goi ham
     * login đúng sẽ chuyển sang trang ..., login sai sẽ chuyển về trang .....
     */
    public function redirect($url) {
        $u = $this->createUrl($url);
        header("Location:$u"); // tự động chuyển sang đường dẫn truyền vào
    }

    public function homePage() {
        $this->redirect(self::HOME_PAGE);
    }

    public function loginPage() {
        $this->redirect("login");
    }

    public function pageError($error) {
        echo $error;
        die();
    }
}