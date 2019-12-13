<?php

class App_Models_Categories extends App_Libs_dbConnection {
    protected $tableName = "categories";

    public function buildSelectBox() {
        $query = $this->buildQueryParam(["select"=>"id,name"])->select();
        $result = ["-- select category --"];
        foreach ($query as $row) {
            $result[$row['id']] = $row['name'];
        }
        return $result;
    }
}