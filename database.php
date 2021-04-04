<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $db_name = "testdb";
    private $password = "";
    public $conn = null;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(PDO::ATTR_PERSISTENT => true));
            $this->conn->exec("set names utf8");
        } catch (PDOException $th) {
            echo "Connection error" . $th->getMessage();
            die();
        }
    }

    public function getConnection()
    {

        return $this->conn;
    }
}

$database = new Database();
$db = $database->getConnection();

class Medecine
{
    private $conn;
    private $table_name = "medic";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // Read all medics

        $query = "
            SELECT m.* from $this->table_name as m";
        // $query = "select e.val as expertise from expertise e";
        $stmt = $this->conn->prepare($query);


        $stmt->execute();

        return $stmt;
    }
}
