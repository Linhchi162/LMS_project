<?php
include_once "db_connection.php";
include_once "get_user.php";

if ($_SESSION['user_id'] == 0) {
    echo json_encode('Please log in first');
    exit();
}


$book_id = $_GET['book_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Kiểm tra xem sách đã có trong wishlist chưa
    $checkQuery = "SELECT * FROM wishlist WHERE account_id = $user_id AND book_id = $book_id";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Nếu sách đã có trong wishlist, xóa nó khỏi wishlist
        $removeQuery = "DELETE FROM wishlist WHERE account_id = $user_id AND book_id = $book_id";
        if ($conn->query($removeQuery) === TRUE) {
            // echo json_encode("Book removed from wishlist successfully.");
        } else {
            echo json_encode("Error removing book from wishlist: " . $conn->error);
            exit();
        }
    } else {
        // Nếu sách chưa có trong wishlist, thêm nó vào
        $addQuery = "INSERT INTO wishlist (account_id, book_id) VALUES ($user_id, $book_id)";
        if ($conn->query($addQuery) === TRUE) {
            echo json_encode("Book added to wishlist successfully.");
        } else {
            echo json_encode("Error adding book to wishlist: " . $conn->error);
        }
    }
}
