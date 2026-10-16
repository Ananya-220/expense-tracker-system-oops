<?php
class DB
{
    private $host = "localhost";
    private $username  = "root";
    private $password = "";
    private $db_name = "oops-crud";

    // Create connection
    public function getConnection()
    {
        $conn = new mysqli($this -> host, $this -> username, $this -> password, $this -> db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
