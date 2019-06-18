<?php

namespace App;

class Connection {
    private static $host = "localhost";
    private static $dbName = "banco-projeto";
    private static $user = "admin";
    private static $password = "";
    private static $port = "5432";
    protected $con;

    public function __construct(){
        try {
            $this->con = new \PDO("pgsql:dbname=".self::$dbName.";host=".self::$host, self::$user, self::$password);
            return $this->con;
        }
        catch(PDOException $e){
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public function openConnection(){
        return $this->con;
    }

    public function closeConnection() {
        $this->con = null;
    }
}
