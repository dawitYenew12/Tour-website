<?php
error_log("Hello");
class main
{

    protected $conn;


    function __construct()
    {
        try {
        error_log("in constructor");
            $this->conn = new PDO("mysql:host=localhost;dbname=tour", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("done connecting to db in constructor");
        } catch (PDOException $e) {
            error_log("error in constructor " . $e->getMessage());
            die();
        }
    }

    function getconnection()
    {
        return $this->conn;
    }

    function closeconnection()
    {
        $this->conn = null;
    }
}
