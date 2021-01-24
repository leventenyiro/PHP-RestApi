<?php

class Database {
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $database = "restapi";
    public $conn = NULL;
    public $sql = NULL;
    public $result = NULL;
    public $row = NULL;

    public function __construct() {
		$this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
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

    public function getOne($id) {
        $this->sql = sprintf("SELECT * FROM product WHERE id = '%s'", $id);
        $this->result = $this->conn->query($this->sql);

        return json_encode($this->result->fetch_assoc());
    }

    public function __destruct() {
        $this->conn->close();
    }
}

?>