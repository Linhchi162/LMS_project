<?php
include_once "db_connection.php";
include_once "get_user.php";

if ($_SESSION['user_id'] == 0) {
    echo 'Please log in first';
    exit();
}


$book_id = $_GET['book_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
}