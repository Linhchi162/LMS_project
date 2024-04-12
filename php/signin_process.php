<?php
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "CALL login(?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if (isset($row['response'])) {
        $response = json_decode($row['response'], true);
        if (isset($response['success'])) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['user_id'];
            echo json_encode(array('success' => $response['success']));
        } elseif (isset($response['error'])) {
            echo json_encode(array('error' => $response['error']));
            exit();
        } else {
            echo json_encode(array('error' => 'Unexpected error occurred.'));
            exit();
        }
    }
    $conn->close();
}