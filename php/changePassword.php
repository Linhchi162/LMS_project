<?php
//sai 

session_start();
include_once "db_connection.php";
include_once "get_user.php";

if ($_SESSION['user_id'] == 0) {
    echo json_encode(array('error' => 'Please log in first'));
    exit();
}

$currentPass = $_POST['currentPass'];
$newPass = $_POST['newPass'];
$id = $_SESSION['user_id'];

$currentPass = md5($currentPass); 
$newPass = md5($newPass);

$sql = "SELECT * FROM account WHERE id = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $id, $currentPass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql_update = "UPDATE account SET password = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ss", $newPass, $id);
    if ($stmt_update->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$stmt_update->close();
$conn->close();

