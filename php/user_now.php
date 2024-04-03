<?php 
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

$query = "";

$user = array(
    'username' => $username,
    'user_id' => $user_id
);

echo json_encode($user);