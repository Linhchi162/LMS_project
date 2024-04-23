<?php
include_once "db_connection.php";

include_once "get_user.php";

$book_id = $_GET['book_id'];

$sql = "select bd.id as book_id, bd.title as book_title, p.`name` as publisher, bd.image as book_image, bd.`description` as book_description, bd.ISBN as book_ISBN, bd.year_of_publishing as release_date, b.owned as instock, a.`name` as author, g.title as book_genre
from book_detail bd 
join publisher p on bd.publisher = p.id
join book b on b.id = bd.id
join book_author ba on ba.book_id = b.id
join author a on a.id = ba.author_id
join book_genre bg on b.id = bg.book_id
join genre g on g.id = bg.genre_id
where b.id = $book_id";

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
