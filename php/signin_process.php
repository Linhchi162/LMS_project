<?php
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // truy vấn SQL
    $sql = "SELECT `id` FROM `account` WHERE `username`= '$user' AND `password`= '$pass'";
    $result = $conn->query($sql);

    // Kiểm tra kết quả trả về
    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['username'] = $user;
        $response = array('success' => 'login successfully');
        echo json_encode($response);
        exit();
    } else {
        $response = array('error' => 'Your username or password is incorrect!');
        echo json_encode($response);
    }
}
$conn->close();
