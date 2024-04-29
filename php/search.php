<?php
function search_books($keyword)
{
    // Kết nối đến cơ sở dữ liệu
    include 'db_connection.php';

    // Sử dụng prepared statement để tránh lỗ hổng SQL Injection hoàn chỉnh
    $query = "SELECT * 
              FROM `book_detail`
              WHERE (`id` LIKE ? OR `title` LIKE ?) AND `title` IS NOT NULL";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        // Xử lý lỗi nếu prepare statement không thành công
        die("Error: " . $conn->error);
    }

    // Bind parameter và thiết lập giá trị của $keyword
    $keyword = trim($keyword);
    $searchKeyword = "%$keyword%";
    $stmt->bind_param("ss", $searchKeyword, $searchKeyword);

    // Thực thi truy vấn
    if (!$stmt->execute()) {
        // Xử lý lỗi nếu không thể thực thi truy vấn
        die("Error: " . $stmt->error);
    }

    // Lấy kết quả của truy vấn
    $result = $stmt->get_result();

    $data = array();
    // Tạo biến lưu trữ kết quả dưới dạng HTML
    // $html_output = '';

    // Đọc từng dòng dữ liệu từ kết quả truy vấn và tạo HTML tương ứng
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row['id'],
            'name' => $row['title'],
            'author' => "author",
            'imageSrc' => $row['image'],
        ];
    };

    // Đóng prepared statement
    $stmt->close();

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();

    // Trả về kết quả dưới dạng HTML
    // return $html_output;
    return $data;
}

// Kiểm tra xem dữ liệu đã được gửi từ form chưa
if (isset($_POST['searchData'])) {
    // Lấy từ khóa tìm kiếm từ dữ liệu POST
    $keyword = $_POST['searchData'];

    // Gọi hàm search_books để tìm kiếm và trả về kết quả dưới dạng HTML
    $searchResultData  = search_books($keyword);

    // Trả về kết quả tìm kiếm dưới dạng JSON
    echo json_encode($searchResultData);
}