<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $authors = $_POST["authors"];
    $in_stock = $_POST["in_stock"];
    $isbn = $_POST["isbn"];
    $description = $_POST["description"];
}

$return = array($title, $authors, $in_stock, $isbn, $description);
echo json_encode($return);