<<<<<<< HEAD
<?php
include_once "db_connection.php";

session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
} else {
    echo 'Please log in first';
    exit();
}


$book_id = $_GET['book_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
=======
<?php
include_once "db_connection.php";

session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
} else {
    echo 'Please log in first';
    exit();
}


$book_id = $_GET['book_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
>>>>>>> main
}