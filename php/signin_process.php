<?php
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // truy vấn SQL
    $sql = "SELECT `id`, `status`, (select `name` from `status` where `status`.id = `account`.`status`) as newStatus FROM `account` WHERE `username`= '$user' AND `password`= '$pass'";
    $result = $conn->query($sql);

    // Kiểm tra kết quả trả về
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['status'] != 0) {
            $response = array('error' => 'your account has been '. $row['newStatus']);
            echo json_encode($response);
            exit();
        }
        session_start();
        $_SESSION['username'] = $user;
        $_SESSION['user_id'] = $row['id'];
        
        $response = array('success' => 'login successfully');
        echo json_encode($response);
        exit();
    } else {
        $response = array('error' => 'Your username or password is incorrect!');
        echo json_encode($response);
    }
}
$conn->close();
