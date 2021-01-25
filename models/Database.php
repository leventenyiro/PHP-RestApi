<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "restapi";
    private $conn = NULL;

    public function __construct() {
		$this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if ($this->conn->connect_error) {
			die ("Connection failed: " . $this->conn->connect_error);
		}
		$this->conn->query("SET NAMES 'UTF8';");
	}

    public function getAll() {
        $sql = "SELECT * FROM product";
        $result = $this->conn->query($sql);
        //echo $this->result;
        //$this->result = $this->conn->query("SELECT * FROM PRODUCT");

        //echo $result->num_rows==1;
        
        $arr = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $arr[] = $row;
        }
        return json_encode($arr);
    }

    public function getOne() {
        $sql = sprintf("SELECT * FROM product WHERE id = '%s'", $_GET["id"]);
        $result = $this->conn->query($sql);

        return json_encode($result->fetch_assoc());
    }

    // SESSION
    public function login() {
        $sql = sprintf("SELECT id, password, email, email_verified FROM user WHERE username = '%s' OR email = '%s'", $_POST["usernameEmail"], $_POST["usernameEmail"]);
        $result = $this->conn->query($sql);

        return json_encode($result->fetch_assoc());
    }

    public function __destruct() {
        $this->conn->close();
    }
}

?>