<?php
// Include file kết nối cơ sở dữ liệu và kiểm tra quyền truy cập
include_once "db_connection.php";
include_once "get_user.php";

// Kiểm tra quyền truy cập của người dùng

if ($_SESSION['user_role'] != 0) {
    echo json_encode(array("error" => "You don't have permission to access this page."));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_GET['book_id'])) {
        echo json_encode(array("error" => "Book ID is missing.\n"));
        exit();
    } else {
        $book_id = $_GET['book_id'];
    }
// Prepare and execute the call to the stored procedure
$stmt = $conn->prepare("CALL DeleteBooks(?)");
$stmt->bind_param("i", $book_id);

if ($stmt->execute()) {
    // Lấy kết quả từ việc gọi DeleteBooks
    $stmt->store_result();
    $stmt->bind_result(
        $book_title,
        $book_publisher_id,
        $book_image,
        $book_description,
        $book_ISBN,
        $book_year_of_publishing,
        $author_name,
        $genre_title,
        $genre_description
    );

    // Fetch kết quả
    $stmt->fetch();

    // Lưu thông tin sách vào MongoDB
    require 'C:\xampp\htdocs\LMS_project-main\LMS_project-main\vendor\autoload.php';
    $connectionString = 'mongodb+srv://caovananhnd2021:6ZtSq8I3XDCcX2z2@cluster0.nurixz1.mongodb.net';
    $manager = new MongoDB\Client($connectionString);
    $mongoDB = $manager->selectDatabase('library');
    $mongoCollection = $mongoDB->selectCollection('deleted_books');

    // Kiểm tra xem dữ liệu đã tồn tại trong MongoDB chưa
    $existingBook = $mongoCollection->findOne(['book_title' => $book_title]);

    if (!$existingBook) {
        // Dữ liệu chưa tồn tại, tiến hành chèn mới
        $deletedBookData = [
            //'book_id' => $book_id,
            'book_title' => $book_title,
            'book_publisher_id' => $book_publisher_id,
            'book_image' => $book_image,
            'book_description' => $book_description,
            'book_ISBN' => $book_ISBN,
            'book_year_of_publishing' => $book_year_of_publishing,
            'author_name' => $author_name,
            'genre_title' => $genre_title,
            'genre_description' => $genre_description
            // Các trường khác nếu cần
        ];

        $insertResult = $mongoCollection->insertOne($deletedBookData);

        if ($insertResult->getInsertedCount() == 1) {
            echo "Lưu thành công";
        } else {
            echo "Lỗi khi lưu dữ liệu";
        }
    } else {
        // Dữ liệu đã tồn tại, không cần chèn mới
        echo "Dữ liệu đã tồn tại trong MongoDB, không cần lưu lại.";
    }
} else {
    // Nếu thực thi thất bại, xuất thông báo lỗi
    echo json_encode(array("error" => "Failed to delete book."));
}

// Đóng câu lệnh và kết nối
$stmt->close();
$conn->close();
}

