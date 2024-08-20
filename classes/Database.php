<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'blog_db';
    private $username = 'root';
    private $password = '';
    public $conn;

    // ======> Create the database method <====== //
    private function createDatabase()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS " . $this->db_name;
        if ($this->conn->query($sql) === FALSE) {
            die("Database creation failed: " . $this->conn->error);
        }
    }

    // ======> Connect to the database method <====== //
    // 1- Connect to MySQL server, then check for connection error
    // 2- Create the database if it doesn't exist, then select it
    // 3- Create the tables after connecting to the database
    public function connect()
    {
        $this->conn = null;
        $this->conn = new mysqli($this->host, $this->username, $this->password);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->createDatabase();
        $this->conn->select_db($this->db_name);

        $this->createTables();
        return $this->conn;
    }

    // ======> Create tables method <====== //
    // 1- Get the absolute path of the script
    // 2- Check if the file exists before attempting to read it
    // 3- Read it
    // 4- Execute it
    private function createTables()
    {
        $scriptPath = realpath(__DIR__ . '/../script.sql');

        if (!$scriptPath || !file_exists($scriptPath)) {
            die("SQL script file not found at: " . $scriptPath);
        }

        $sql = file_get_contents($scriptPath);

        if ($this->conn->multi_query($sql)) {
            do {
                if ($result = $this->conn->store_result()) {
                    $result->free();
                }
            } while ($this->conn->more_results() && $this->conn->next_result());
        } else {
            die("Table creation failed: " . $this->conn->error);
        }
    }

    // ======> Fetch data from post table <====== //
    // 1- Get the absolute path of the script
    // 2- Check if the file exists before attempting to read it
    // 3- Read it
    // 4- Execute it
    // // Return null if the query execution failed or no rows were returned.
    public function fetch()
    {
        $data = [];
        $query = "SELECT * FROM posts";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }
}
