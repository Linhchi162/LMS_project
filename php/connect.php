<?php
    //server name
    $servername = "";
    //username
    $username = "";
    //take password from computer
    $password = getenv('mySQLPass');
    //database name
    $dbname = "project_DBMS";
    
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($mysqli->connect_error) {
        die("Kết nối cơ sở dữ liệu thất bại: " . $mysqli->connect_error);
    }
?>