<?php

class DB
{
    private $dbName = 'petitions_db';
    private $login = 'root';
    private $password = '';
    private $pdo;
    private function __construct()
    {
        $this->pdo = new PDO ( "mysql:host=localhost;dbname=$this->dbName", $this->login, $this->password, array (
            PDO::ATTR_PERSISTENT => true
        ) );
    }

    private static $instance = null;
    public static function GetInstance(){
        if(self::$instance == null){
            $db = new DB();
            self::$instance = $db->pdo;
        }
        return self::$instance;
    }
}