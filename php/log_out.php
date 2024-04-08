<?php 
session_start();
$_SESSION['username'] = "";
$_SESSION['user_id'] = null;

echo 'Loged out!';