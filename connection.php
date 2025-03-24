<?php

function Connect(){
    // $dbhost = "localhost";
    // $dbuser = "root";
    // $dbpass = "";
    // $dbname = "bastion_db";
    
    
    $conn = new mysqli("localhost", "root", "", "bastion_db");
    return $conn;
}

?>