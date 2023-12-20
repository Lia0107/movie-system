<?php
class dbcon {
    public $conn;

    public function __construct($servername, $username, $password, $db) {
        // Create connection
        $this->conn =  new mysqli($servername, $username, $password, $db);

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}
?>