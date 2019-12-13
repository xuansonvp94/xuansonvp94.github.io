<?php
session_start();
//quản lý login
class App_Libs_UserIdentity {
    public $username;
    public $password;

    protected $id;

    //nạp vào username và password
    public function __construct($username= "", $password = "") {
        $this->username = $username;
        $this->password = $password;
    }

    //mã hóa 1 chiều password
    public function encryptPassword() {
        return md5($this->password);
    }


    public function login() {
        $db = new App_Models_Users();
        $query = $db->buildQueryParam([
            "where"=>"username =:username AND password =:password",
            "params"=>[
                ":username"=>trim($this->username),
                ":password"=>$this->encryptPassword()
            ]
        ])->selectOne();  //select ra username, password

        //kiểm tra $query có du lieu hay ko
        if ($query) {
            //tạo session
            $_SESSION["userId"] = $query["id"];
            $_SESSION["username"] = $query["username"];
            return true;
        }
        return false;
    }


    public function logout() {
        unset($_SESSION["userId"]); //xóa session đã tạo
        unset($_SESSION["username"]);
    }
     //lay ten da tao trong session
    public function getSESSION($name) {
        if($name !== NULL) {
            return isset($_SESSION[$name]) ? $_SESSION[$name] : NULL;
        }
        return $_SESSION;
    }

    //kiểm tra xem login hay chua
    public function isLogin() {
        if ($this->getSESSION("userId")) {
            return true;
        }
        return false;
    }

    //lấy ra user id
    public function getId() {
        return $this->getSESSION("userId");
    }
}
