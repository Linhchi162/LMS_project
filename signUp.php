<!DOCTYPE html>
<html>

<head>
    <title>Sign up</title>
    <link rel="stylesheet" href="css/signUp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho&display=swap" rel="stylesheet">
    <script src="functions.js"></script>
</head>

<body>
    <div class="board">
        <div class="board_img">
            <img src="img/9781911344186.png" width="575px" height="575px" class="the_img">
        </div>
        <div class="login_board">
            <div class="logo">
                LOGO
            </div>
            <form method="post">
                <div class="username">
                    <div class="Text">
                        User name
                    </div>
                    <input class="enterSpace" type="text" name="username" placeholder="Enter your user name">
                </div>
                <div class="password">
                    <div class="Text">
                        Password
                    </div>
                    <input class="enterSpace" type="text" name="password" placeholder="Enter your password">
                </div>
                <div class="password">
                    <div class="password">
                        <div class="Text">
                            Repeat password
                        </div>
                        <input class="enterSpace" type="text" name="repeat_password" placeholder="Enter your password">
                    </div>
                </div>
                
                <div class="sign_in">
                    <button class="signUpButton">
                            Sign up
                    </button>
                </div>
            </form>
            <div class="signInText">
                <p>
                    Already have an account? 
                    <button class="signInButton" onclick = "goToLogIn()">
                        Sign in.
                    </button>
                </p>
            </div>
            <div id="error_message" 
             style="display:none;
                   color:rgb(191, 78, 78);" 
             class="error_message"></div>
        </div>
    </div>

    <?php
    include_once "db_connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeat_password'];

        if (!empty($username) && !empty($password)) {
            // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu chưa
            $check_username_sql = "SELECT * FROM account WHERE username='$username'";
            $check_username_result = $conn->query($check_username_sql);

            if ($check_username_result->num_rows > 0) {
                echo "<script>
                 showError()
                  document.getElementById('error_message').innerHTML =
                 'Username already exists.';
                 </script>";
                exit(); // Dừng chương trình nếu username đã tồn tại
            }

            // Kiểm tra xem mật khẩu đã nhập lại có khớp không
            if ($password !== $repeatPassword) {
                echo "<script>
                showError()
                document.getElementById('error_message').innerHTML =
               'Passwords do not match.';
               </script>";
                exit(); 
            }

            // Thêm dữ liệu vào bảng account với role là 0 và status là 1
            $sql = "INSERT INTO account (username, password, role, status) VALUES ('$username', '$password', 1, 1)";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                showError()
                document.getElementById('error_message').innerHTML =
               'New user added successfully.';
               </script>";
            } else {
                echo "<script>
                showError()
                document.getElementById('error_message').innerHTML =
               'Error: " . $sql . "<br>" . $conn->error . "';
               </script>";
            }
        }
        else {
            echo "<script>
            showError()
            document.getElementById('error_message').innerHTML =
           'Please enter password and account.';
           </script>";
        }

        $conn->close();
    }
    ?>

</body>

</html>