<?php

function Connect(){
    
    $conn = new mysqli("localhost", "root", "", "bastion_db");
    return $conn;
}

?>