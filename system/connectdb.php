<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "blog";

    $conn = new mysqli($host,$username,$password,$db);

    if($conn -> connect_error){
        echo "Failed to connect to db".$conn -> connect_error;
    }

?>