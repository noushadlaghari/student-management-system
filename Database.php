<?php

// require_once("config.php");

class Database
{


    private $host = "localhost";
    private  $username = "root";
    private  $password = "";
    private $db_name = "students";

    private $conn;



    public function __construct()
    {

        $this->connect();
    }


    private function connect()
    {

        if (!$this->conn) {

            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            if ($this->conn->connect_error) {
                die("Connection Error: " . $this->conn->connect_error);
            }
        }
    }

    public function get_connection()
    {
        return $this->conn;
    }
}
