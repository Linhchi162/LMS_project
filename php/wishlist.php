<?php
    // Kết nối đến cơ sở dữ liệu
    include 'db_connection.php';
    include 'get_user.php';

    // Sử dụng prepared statement để tránh lỗ hổng SQL Injection hoàn chỉnh
    $query = "SELECT book_id, book_detail.title AS title, book_detail.image
            FROM book
            JOIN book_detail ON book.id = book_detail.id
            JOIN wishlist ON book.id = wishlist.book_id
            WHERE account_id = $user_id";
    $result = $conn->query($query);

    $wishlistData = array();

    // Kiểm tra và lưu trữ dữ liệu từ bảng wishlist vào mảng
    if ($result->num_rows > 0) {
        // Duyệt qua từng dòng dữ liệu
        while($row = $result->fetch_assoc()) {
            $wishlistData[] = [
            'id' => $row['book_id'],
            'name' => $row['title'],
            'author' => "author",
            'imageSrc' => $row['image'],
            ];
        }
    }

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();

    // Trả về kết quả dưới dạng JSON
    echo json_encode($wishlistData);
