<?php
/*
 * Connect to database
 * @author:
 * @date:
 * @version:
 */

class App_Libs_dbConnection {
    protected $username ="root";
    protected $password ="";
    protected $database ="practice";
    protected $host ="localhost";
    protected $tableName;
    protected $queryParams =[]; //storage params
    protected static $connectionInstance =null;


    public function __construct(){
        $this->connect();
    }

    /*
     * Create connect to databas
     * return: new PDOs
     */
    public function connect(){
        if (self::$connectionInstance === null) {
            try {
                self::$connectionInstance = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->username, $this->password);
                self::$connectionInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $ex){
                echo "ERROR: ".$ex->getMessage();
                die();
            }

        }
        return self::$connectionInstance;
    }

    /**
     * against SQL injections.
     */
    public function query($sql, $param = []) {
        $q = self::$connectionInstance->prepare($sql);
        if(is_array($param) && $param){
            $q->execute($param);
        } else {
            $q->execute();
        }

        return $q;
    }

    // gop param truyen vao voi default, giong nhau, n se ghi de gia tri theo gia tri truyen vao
    public function buildQueryParam($param = []){
        $default = [
            "select" => "*",
            "where" => "",
            "other" => "",
            "params" => "",
            "field" =>"",
            "value"=>[],
            "join"=>""
        ];
        $this->queryParams = array_merge($default, $param);
        return $this;
    }

    //neu co truyen vao gia tri cua where thif moi them where vao cau query.
    // tranh gap loi khi không truyền where mà từ where vẫn có trong câu query
    public function buildCondition($condition) {
        if (trim($condition)) {
            return "where ".$condition;
        }
        return "";

    }

    public function select() {
        $sql = "select ".$this->queryParams["select"]." from ".$this->tableName." "
            . " ".$this->queryParams["join"]." " .$this->buildCondition($this->queryParams["where"])." ".$this->queryParams["other"];
        $query = $this->query($sql,$this->queryParams["params"]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectOne() {
        $this->queryParams["other"] = "limit 1";
        $data = $this->select();
        if ($data) {
            return $data[0];
        }
        return [];
    }

    public function insert(){
        $sql = "insert into"." ".$this->tableName." ".$this->queryParams["field"];
        $result = $this->query($sql,$this->queryParams["value"]);
        if($result) {
            return self::$connectionInstance->lastInsertID();
        } else {
            return FAlSE;
        }
    }

    public function update(){
        $sql = "update ".$this->tableName." set ".$this->queryParams["value"]." ".
            $this->buildCondition($this->queryParams["where"])." ".$this->queryParams["other"];
        return $this->query($sql);
    }

    public function delete(){
        $sql = "delete from"." ".$this->tableName." ".
            $this->buildCondition($this->queryParams["where"])." ".$this->queryParams["other"];
        return $this->query($sql);
    }

}



