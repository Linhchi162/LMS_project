
<?php
session_start();
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ request
    $json_data = file_get_contents('php://input');
    $data_array = json_decode($json_data, true); 

    if (is_array($data_array)) {
        $id = $_SESSION['user_id'];
        $current_password = $data_array['current_password'];
        $new_password = $data_array['new_password'];
        $confirm_password = $data_array['confirm_password'];

       
        if ($new_password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'New password and confirm password do not match.']);
            exit;
        }

        $sql_select_user = "SELECT * FROM account WHERE id = ?";
        $stmt_select_user = $conn->prepare($sql_select_user);
        $stmt_select_user->bind_param("i", $id);
        $stmt_select_user->execute();
        $result_select_user = $stmt_select_user->get_result();

        // Kiểm tra xem người dùng có tồn tại không
        if ($result_select_user->num_rows !== 1) {
            
            echo json_encode(['success' => false, 'message' => 'User not found.']);
            exit;
        }

        // Lấy thông tin người dùng từ kết quả truy vấn
        $user_row = $result_select_user->fetch_assoc();
        $stored_password = $user_row['password'];

        // Kiểm tra mật khẩu hiện tại có chính xác không
        if ($current_password != $stored_password) {
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect.']);
            
            exit;
        }

        // Cập nhật mật khẩu mới trong cơ sở dữ liệu
        $sql_update_password = "UPDATE account SET password = ? WHERE id = ?";
        $stmt_update_password = $conn->prepare($sql_update_password);
        $stmt_update_password->bind_param("si", $new_password, $id);
        if ($stmt_update_password->execute()) {
            echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update password.']);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Error decoding JSON data.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>

