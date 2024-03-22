<!DOCTYPE html>
<html>

<head>
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
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
            <div class="sign_up">
                <button class="signUpButton" onclick="goToSignUp()">
                    <p>
                        No acount?
                    </p>
                        Sign up.
                    </p>
                </button>
            </div>
            <form method="post">
                <div class="username">
                 <div class="Text">User name</div>
                 <input class="enterSpace" type="text" name="username" placeholder="Enter your user name">
                </div>
                <div class="password">
                 <div class="Text">Password</div>
                 <input class="enterSpace" type="password" name="password" placeholder="Enter your password">
                </div>
                 <div class="sign_in">
                 <button type="submit" class="signInButton">Sign in</button>
                </div>
            </form>
            <div id="error_message"
            style="display:none;
                   color:rgb(191, 78, 78);
                   margin-top:-20px" 
            class="error_message">
                Your username or password is incorrect.
            </div>
        </div>
    </div>

    <?php
        include_once "db_connection.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $user = $_POST['username'];
            $pass = $_POST['password'];
    
            // truy vấn SQL
            $sql = "SELECT * FROM account WHERE username='$user' AND password='$pass'";
            $result = $conn->query($sql);
    
            // Kiểm tra kết quả trả về
            if ($result->num_rows > 0) {
                header("Location: home.php"); 
                exit();
            } else {
                echo "<script> showError(); </script>";
            }
        }
        $conn->close();
    ?>
</body>

</html>