<?php

function Connect(){
    $conn = new mysqli('localhost', 'root', '', 'bastion_db') or die($conn->connect_error);
    return $conn;
}

?>