<?php
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat_password'];

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("CALL signup(?, ?, ?, @error_message)");
        $stmt->bind_param("sss", $username, $password, $repeatPassword);
        $stmt->execute();

        $result = $conn->query("SELECT @error_message AS error_message");
        $row = $result->fetch_assoc();
        $error_message = $row['error_message'];

        if ($error_message) {
            $response = array('error' => $error_message);
            echo json_encode($response);
            exit();
        } else {
            $sql = "SELECT `id` from `account` WHERE `username`= '$username'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = '1';

            $response = array('success' => 'New user added successfully.');
            echo json_encode($response);
            exit();
        }
    } else {
        $response = array('error' => 'Please enter password and account.');
        echo json_encode($response);
    }
    $conn->close();
}
