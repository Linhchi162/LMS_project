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
    $comment = $_POST['comment'];

    if (strlen($comment) > 3) {
        try {
            $addCommentQuery = "INSERT INTO `comment` (account_id, book_id, `comment`) VALUES ('$user_id', '$book_id', '$comment')";
            
            if ($conn->query($addCommentQuery) === TRUE) {
                echo "Comment added successfully.";
            } else {
                throw new Exception("Error adding comment: " . $conn->error);
            }
        } catch (Exception $e) {
            if ($conn->errno == 1062) { 
                echo 'You have already commented on this book.';
            } else {
                echo "An error occurred while adding the comment: " . $e->getMessage();
            }
        }
    } else {
        echo "The comment should be at least 4 characters long.";
    }
}