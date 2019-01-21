<?php
/**
 * Created by PhpStorm.
 * user: Ali Mansour
 * Date: 10/16/2017
 * Time: 6:57 PM
 */

class Database
{
    private $conn;

    function __construct()
    {
        // Create a connection to database
        $this->conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER,
            DB_PASS, array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    // Get the current opened connection
    public function getConnection()
    {
        return $this->conn;
    }

    // Close the opened connection to database
    public function closeConnection()
    {
        if (isset($this->conn)) {
            $this->conn = null;
            unset($this->conn);
        }
    }
}