<?php

include ("models/Database.php");

function getAll() {
    // a php automatikusan átvesz adatokat
    //echo $_SERVER["REQUEST_URI"];

    //echo "ez egy valami nevű üzenet";
    
    $db = new Database();
    $result = $db->getAll();

    // ha egy elemet akarunk visszaadni
    //echo json_encode(json_decode($result)[0]);

    echo $result;
}

function getOne($id) {
    $db = new Database();
    $result = $db->getOne($id);
    if ($result != "null") {
        echo $result;
    }
}

?>