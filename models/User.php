<?php

class User {
    private $conn = NULL;
    private $tableName = "user";

    public function __construct($db) {
        $this->conn = $db;
    }

    // SESSION
    public function login() {
        $sql = sprintf("SELECT id, password, email, email_verified FROM %s WHERE username = '%s' OR email = '%s'", $this->tableName, $_POST["usernameEmail"], $_POST["usernameEmail"]);
        $result = $this->conn->query($sql);
    
        $arr = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $arr[] = $row;
        }
        return json_encode($arr);
    }
}

?>