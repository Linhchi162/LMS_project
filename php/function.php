<?php
    //get data of borrowed books
    function get_borrowed($user_id) {
        //connect to database
        include 'connect.php';
    
        $query = "SELECT *
        
        FROM `account`
        INNER JOIN `borrow` ON `borrow`.account_id = `account`.id
        INNER JOIN `book` ON `borrow`.book_id = `book`.id
        INNER JOIN `book_detail` ON `book`.id = `book_detail`.id
        WHERE `book`.id = $user_id";
    
        $result = $mysqli->query($query);
        $mysqli->close();
        return $result;
    }

    //get data of borrowing books
    function get_borrowing($user_id) {
        //connect to database
        include 'connect.php';
    
        $query = "SELECT * 
        FROM `account`
        INNER JOIN `borrow` ON `borrow`.account_id = `account`.id
        INNER JOIN `book` ON `borrow`.book_id = `book`.id
        INNER JOIN `book_detail` ON `book`.id = `book_detail`.id
        WHERE `book`.id = $user_id AND `borrow`.return_date IS NULL";
    
        $result = $mysqli->query($query);
        $mysqli->close();
        return $result;
    }


    // Hàm tìm kiếm sách dựa trên tiêu đề hoặc tác giả
    function search_books($keyword) {
        // Kết nối đến cơ sở dữ liệu
        include 'connect.php';
    
        // Sử dụng prepared statement để tránh lỗ hổng SQL Injection hoàn chỉnh
        $query = "SELECT * 
                  FROM `book_detail`
                  WHERE `id` LIKE ? OR `title` LIKE ? ";
        $stmt = $mysqli->prepare($query);
    
        if (!$stmt) {
            // Xử lý lỗi nếu prepare statement không thành công
            die("Error: " . $mysqli->error);
        }
    
        // Bind parameter và thiết lập giá trị của $keyword
        $searchKeyword = "%$keyword%";
        $stmt->bind_param("ss", $searchKeyword, $searchKeyword);
    
        // Thực thi truy vấn
        if (!$stmt->execute()) {
            // Xử lý lỗi nếu không thể thực thi truy vấn
            die("Error: " . $stmt->error);
        }
    
        // Lấy kết quả của truy vấn
        $result = $stmt->get_result();
    
        // Đóng prepared statement
        $stmt->close();
    
        // Đóng kết nối cơ sở dữ liệu
        $mysqli->close();
    
        // Trả về kết quả tìm kiếm
        return $result;
    }
    
?>