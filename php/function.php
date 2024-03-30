<?php
    //get data of borrowed books
    function get_borrowed($user_id) {
        //connect to database
        include 'db_connection.php';
    
        $query = "SELECT *
        
        FROM `account`
        INNER JOIN `borrow` ON `borrow`.account_id = `account`.id
        INNER JOIN `book` ON `borrow`.book_id = `book`.id
        INNER JOIN `book_detail` ON `book`.id = `book_detail`.id
        WHERE `account`.id = $user_id";
    
        $result = $mysqli->query($query);
        $mysqli->close();
        return $result;
    }

    //get data of borrowing books
    function get_borrowing($user_id) {
        //connect to database
        include 'db_connection.php';
        
        $query = "SELECT * 
        FROM `account`
        INNER JOIN `borrow` ON `borrow`.account_id = `account`.id
        INNER JOIN `book` ON `borrow`.book_id = `book`.id
        INNER JOIN `book_detail` ON `book`.id = `book_detail`.id
        WHERE `account`.id = $user_id AND `borrow`.return_date IS NULL";
    
        $result = $mysqli->query($query);
        $mysqli->close();
        return $result;
    }
