<?php
// Include file kết nối cơ sở dữ liệu và kiểm tra quyền truy cập
include_once "db_connection.php";
include_once "get_user.php";

// Kiểm tra quyền truy cập của người dùng
if ($_SESSION['user_role'] != '0') {
    echo json_encode(array("error" => "You don't have permission to access this page."));
    exit();
}

// Lấy user cần xóa từ URL
$user_to_delete = $_GET['user'];


// Xóa user trong MySQL
$stmt = $conn->prepare("CALL GetUserInformation(?)");
$stmt->bind_param("i", $user_to_delete);

if ($stmt->execute()) {
    // Lấy kết quả từ việc gọi GetUserInformation
    $stmt->store_result();
    $stmt->bind_result(
        $account_id,
        $account_username,
        $account_firstname,
        $account_lastname,
        $account_age,
        $account_gender,
        $account_phoneNumber,
        $account_gmail
    );
    
    // Fetch kết quả
    $stmt->fetch();

    // Tiếp tục với thao tác lưu dữ liệu vào MongoDB
    require 'C:\xampp\htdocs\LMS_project-main\LMS_project-main\vendor\autoload.php';
    $connectionString = 'mongodb+srv://caovananhnd2021:6ZtSq8I3XDCcX2z2@cluster0.nurixz1.mongodb.net';
    $manager = new MongoDB\Client($connectionString);
    $mongoDB = $manager->selectDatabase('library');
    $mongoCollection = $mongoDB->selectCollection('deletedUser');

    // Tạo một mảng chứa thông tin người dùng
    $deletedUserData = [
        'id' => $account_id,
        'username' => $account_username ,
        'firstname' => $account_firstname ,
        'lastname' => $account_lastname,
        'age' => $account_age,
        'gender' => $account_gender ,
        'phoneNumber' => $account_phoneNumber ,
        'gmail' => $account_gmail
    ];

    // Kiểm tra xem dữ liệu đã tồn tại trong MongoDB chưa
    $existingUserData = $mongoCollection->findOne(['id' => $account_id]);

    if (!$existingUserData) {
        // Dữ liệu chưa tồn tại, tiến hành chèn mới
        $insertResult = $mongoCollection->insertOne($deletedUserData);

        if ($insertResult->getInsertedCount() == 1) {
            echo "Lưu thành công";
        } else {
            echo "Lỗi khi lưu dữ liệu";
        }
    } else {
        // Dữ liệu đã tồn tại, không cần chèn mới
        echo "Dữ liệu đã tồn tại trong MongoDB, không cần lưu lại.";
    }
} else {
    // Nếu thực thi thất bại, xuất thông báo lỗi
    echo json_encode(array("error" => "Failed to delete user."));
}
$stmt->close();
$conn->close();
