<?php
include_once "db_connection.php";

session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    echo 'Please log in first';
    exit();
}

$query = "SELECT `id` FROM `account` WHERE `username` = '$username'";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$user_id = $row['id'];

$book_id = $_GET['book_id'];

//add comment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['comment'];

    if (strlen($comment) > 3) {
        $addCommentQuery = "INSERT INTO `comment` (account_id, book_id, `comment`) VALUES ('$user_id', '$book_id', '$comment')";
        
        if ($conn->query($addCommentQuery) === TRUE) {
            echo "Comment added successfully.";
        } else {
            echo "Error: " . $addCommentQuery . "<br>" . $conn->error;
        }
    } else {
        echo "The comment should be at least 4 characters long.";
    }
}