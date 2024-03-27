<?php
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat_password'];

    if (!empty($username) && !empty($password)) {
        // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu chưa
        $check_username_sql = "SELECT `id` FROM account WHERE username='$username'";
        $check_username_result = $conn->query($check_username_sql);

        if ($check_username_result->num_rows > 0) {
            $response = array('error' => 'Username already exists.');
            echo json_encode($response);
            exit(); // Dừng chương trình nếu username đã tồn tại
        }

        // Kiểm tra xem mật khẩu đã nhập lại có khớp không
        if ($password !== $repeatPassword) {
            $response = array('error' => 'Passwords do not match.');
            echo json_encode($response);
            exit();
        }

        // Thêm dữ liệu vào bảng account với role là 1 và status là 1
        $sql = "INSERT INTO account (username, `password`, `role`, `status`) VALUES ('$username', '$password', 1, 1)";

        if ($conn->query($sql) === TRUE) {
            session_start();
            $_SESSION['username'] = $username;
            $response = array('success' => 'New user added successfully.');
            echo json_encode($response);
            exit();
            
        } else {
            $response = array('error' => 'Something gone wrong!');
            echo json_encode($response);
        }
    } else {
        $response = array('error' => 'Please enter password and account.');
        echo json_encode($response);
    }

    $conn->close();
}
