<?php

class Database {
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "restapi";
    public $conn = NULL;
    public $sql = NULL;
    public $result = NULL;
    public $row = NULL;

    public function __construct() {
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($this->conn->connect_error) {
			die ("Connection failed: " . $this->conn->connect_error);
		}
		$this->conn->query("SET NAMES 'UTF8';");
	}

    public function getAll() {
        $this->sql = "SELECT * FROM product";
        $this->result = $this->conn->query($this->sql);
        //echo $this->result;
        //$this->result = $this->conn->query("SELECT * FROM PRODUCT");

        //echo $result->num_rows==1;
        
        $arr = array();
        while ($row = $this->result->fetch_array(MYSQLI_ASSOC)) {
            $arr[] = $row;
        }
        return json_encode($arr);
        //echo $this->result;
    }

    public function __destruct() {
        $this->conn->close();
    }
}

?>