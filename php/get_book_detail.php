<?php
include_once "db_connection.php";

include_once "get_user.php";

$book_id = $_GET['book_id'];

$sql = "SELECT 
            bd.id AS book_id,
            bd.title AS book_title,
            p.`name` AS publisher,
            bd.image AS book_image,
            bd.`description` AS book_description,
            bd.ISBN AS book_ISBN,
            bd.year_of_publishing AS release_date,
            b.owned AS instock,
            group_concat(a.`name`) AS author,
            g.title AS book_genre
        FROM
            book_detail bd
                JOIN
            publisher p ON bd.publisher = p.id
                JOIN
            book b ON b.id = bd.id
                JOIN
            book_author ba ON ba.book_id = b.id
                JOIN
            author a ON a.id = ba.author_id
                JOIN
            book_genre bg ON b.id = bg.book_id
                JOIN
            genre g ON g.id = bg.genre_id
        GROUP BY g.title, b.id
        HAVING
            b.id = $book_id";

$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $details = array();
    while ($row = $result->fetch_assoc()) {
        $detail = array(
            'imageSrc' => $row['book_image'],
            'genreIconSrc' => "../img/icons8-book-96.png",
            'genreText' => $row['book_genre'],
            'bookName' => $row['book_title'],
            'author' => $row['author'],
            'releaseYear' => $row['release_date'],
            'instockCount' => $row['instock'],
            'description' => $row['book_description']
        );
        $details[] = $detail;
    }
    $response['success'] = $details;
} else {
    $response['success'] = array();
}

echo json_encode($response);