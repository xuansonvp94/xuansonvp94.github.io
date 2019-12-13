<?php

/**
 * Class App_Models_Users
 * Viết đè tên bảng, tránh phải sửa $tableName bằng tay
 */
class App_Models_Users extends App_Libs_dbConnection {
        protected $tableName = "users";
    }
