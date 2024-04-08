<?php 
include_once "db_connection.php";

session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
}

$book_id = $_GET['book_id'];

$sql = "SELECT username, `comment`.`comment` FROM 
`comment` INNER JOIN `account` ON `account`.id = `comment`.account_id
WHERE `book_id` = $book_id";
$result = $conn->query($sql);

$response = array(); 

if ($result->num_rows > 0) {
    $comments = array(); 
    while ($row = $result->fetch_assoc()) {
        $comment = array(
            'username' => $row['username'],
            'comment' => $row['comment']
        );
        $comments[] = $comment;
    }
    $response['success'] = $comments; 
} else {
    $response['success'] = array(); 
}

echo json_encode($response); 
