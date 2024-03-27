<?php
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat_password'];

    if (!empty($username) && !empty($password)) {
        // Kiểm tra xem mật khẩu đã nhập lại có khớp không
        if ($password !== $repeatPassword) {
            echo "<script>
                showError()
                document.getElementById('error_message').innerHTML =
               'Passwords do not match.';
               </script>";
            exit();
        }

        // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu chưa
        $check_username_sql = "SELECT `id` FROM account WHERE username='$username'";
        $check_username_result = $conn->query($check_username_sql);

        if ($check_username_result->num_rows > 0) {
            echo "<script>
                 showError()
                  document.getElementById('error_message').innerHTML =
                 'Username already exists.';
                 </script>";
            exit(); // Dừng chương trình nếu username đã tồn tại
        }

        // Thêm dữ liệu vào bảng account với role là 1 và status là 1
        $sql = "INSERT INTO account (username, `password`, `role`, `status`) VALUES ('$username', '$password', 1, 1)";

        if ($conn->query($sql) === TRUE) {
            session_start();
            $_SESSION['username'] = $username;
            echo "<script>
                showError()
                document.getElementById('error_message').innerHTML =
               'New user added successfully.';
               </script>";
            header("Location: ../html/home.php");
            
        } else {
            echo "<script>
                showError()
                document.getElementById('error_message').innerHTML =
               'Error: " . $sql . "<br>" . $conn->error . "';
               </script>";
        }
    } else {
        echo "<script>
            showError()
            document.getElementById('error_message').innerHTML =
           'Please enter password and account.';
           </script>";
    }

    $conn->close();
}
