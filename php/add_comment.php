<?php
//test add comment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = trim($_POST['comment']);

    if (strlen($comment) > 3) {
        echo $comment;
    } else {
        echo "An error has occurred.";
    }
}