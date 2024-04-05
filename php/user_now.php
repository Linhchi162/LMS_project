<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
} else {
    $username = "Guest";
    $user_id = 0;
}

$query = "";

$user = array(
    'username' => $username,
    'user_id' => $user_id
);

echo json_encode($user);
