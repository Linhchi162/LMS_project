<?php
// Kết nối tới cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root"; 
$password = "1616lclc"; 
$dbname = "lms_project"; 

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
