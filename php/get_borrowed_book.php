<?php
include_once 'db_connection.php';
include_once 'get_user.php';

if ($_SESSION['user_id'] == 0) {
    echo json_encode(['error' => 'Please log in first']);
    exit();
}

// Database query to retrieve book data for the specified user ID
$query = "SELECT 
    book.id as book_id, book_detail.image as book_image,'author' as book_author, book_detail.title as book_name 
    FROM `account`
        INNER JOIN `borrow` ON `borrow`.account_id = `account`.id
        INNER JOIN `book` ON `borrow`.book_id = `book`.id
        INNER JOIN `book_detail` ON `book`.id = `book_detail`.id
        WHERE `account`.id = ? AND book_detail.title IS NOT NULL";

// Prepare the query
$stmt = $mysqli->prepare($query);
if ($stmt) {
    // Bind parameters
    $stmt->bind_param('i', $user_id);

    // Execute the query
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch all the results as an associative array
    if ($result->num_rows > 0) {
        $books = array();
        while ($row = $result->fetch_assoc()) {
            $book = array(
                'id' => $row['book_id'],
                'imageSrc' => $row['book_image'],
                'author' => $row['author'],
                'name' => $row['book_name']
            );
            $books[] = $book;
        }
        $response['success'] = $books;
    } else {
        $response['success'] = array();
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['error' => 'Failed to prepare the statement']);
}

// Close the database connection
$mysqli->close();
