<?php
//cần sửa lại
include_once "db_connection.php";

$filter = $_GET['filter'];

// Xây dựng truy vấn dựa trên giá trị của $filter
// if ($filter === 'all') {
//     $sql = "SELECT ROW_NUMBER() OVER (ORDER BY borrow_date desc) AS number,
//              borrow.id, book_detail.title, 
//              `account`.username AS borrower_name, 
//              borrow.borrow_date, borrow.design_return_date, 
//              borrow.return_date,
//             CASE
//                 WHEN borrow.return_date IS NOT NULL THEN 'Returned'
//                 WHEN borrow.design_return_date < NOW() THEN 'Overdue'
//                 ELSE 'Issued'
//             END AS status
//             FROM borrow
//             INNER JOIN book_detail ON borrow.book_id = book_detail.id
//             INNER JOIN account_profile ON borrow.account_id = account_profile.id
//             INNER JOIN `account` ON borrow.account_id = `account`.id";
// } else
if ($filter === 'issued') {
    $sql = "SELECT ROW_NUMBER() OVER (ORDER BY borrow_date desc) AS number,borrow.id, 
            book_detail.title, 
            `account`.username AS borrower_name, 
            borrow.borrow_date, 
            borrow.design_return_date, 
            borrow.return_date, 'Issued' AS status
            FROM borrow
            INNER JOIN book_detail ON borrow.book_id = book_detail.id
            INNER JOIN account_profile ON borrow.account_id = account_profile.id
            INNER JOIN `account` ON borrow.account_id = `account`.id
            WHERE borrow.return_date IS NULL";
} elseif ($filter === 'overdue') {
    $sql = "SELECT ROW_NUMBER() OVER (ORDER BY borrow_date desc) AS number, borrow.id as id, 
            book_detail.title, 
            `account`.username AS borrower_name, 
            borrow.borrow_date, borrow.design_return_date, 
            borrow.return_date, 'Overdue' AS status
            FROM borrow
            INNER JOIN book_detail ON borrow.book_id = book_detail.id
            INNER JOIN account_profile ON borrow.account_id = account_profile.id
            INNER JOIN `account` ON borrow.account_id = `account`.id
            WHERE borrow.design_return_date < NOW() AND borrow.return_date IS NULL";
} elseif ($filter === 'request') {
    $sql = "SELECT ROW_NUMBER() over (order by reservation_date desc) AS number, reservation.id as id, 
                book_detail.title, 
                `account`.username as borrower_name, 
                reservation_date, 
                CASE
                    WHEN reservation_status_id = 1 THEN 'Need checking'
                    WHEN reservation_status_id = 2 THEN 'Accepted'
                    WHEN reservation_status_id = 3 THEN 'Cancelled'
                    ELSE 'Rejected'
                END AS status
            FROM reservation
                INNER JOIN book_detail ON reservation.book_id = book_detail.id
                INNER JOIN account_profile ON reservation.account_id = account_profile.id
                INNER JOIN `account` ON reservation.account_id = `account`.id
                WHERE reservation_status_id = 1";
}

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
