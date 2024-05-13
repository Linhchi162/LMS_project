<?php
//ok
include_once "db_connection.php";
include_once "get_user.php";

if ($_SESSION['user_role'] != '0') {
    echo json_encode(array("error" => "You don't have permission to access this page."));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {

    $borrow_id = $_GET['id'];

    $sql_update = "UPDATE borrow SET return_date = NOW(), borrow_status = 1 WHERE id = ?";
    
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("i", $borrow_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }


    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false]);
}
