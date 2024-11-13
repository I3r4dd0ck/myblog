<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width/n initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Đăng Nhập</title>
</head>

<body>
    <div class="container" id="signin">
        <h1 class="form-title">Đăng nhập</h1>
        <form method="post" action="?page=user&action=signin">
            <div class="input-group">
                <i class='bx bxs-user'></i>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <label for="username">Tên</label>
            </div>
            <div class="input-group">
                <i class='bx bxs-lock'></i>
                <input type="password" name="password" id="signin_password" placeholder="Password" required>
                <label for="signin_password">Mật khẩu</label>
            </div>
            Remember Me: <input type="checkbox" name="rememberme" value="1"><br>
            <input type="submit" class="btn" value="Đăng Nhập" name="signin">
        </form>
        <p class="or">
            --------or--------
        </p>
        <div class="links">
            <p>Chưa có tài khoản ?</p>
            <a href="?page=user&action=signup">
                <button id="signup_button">Đăng Ký</button>
            </a>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['signin'])) {
    $username = remove_bad_characters($_POST['username']);
    $password = remove_bad_characters($_POST['password']);
    $rememberme = $_POST['rememberme'];

    $check = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($check);
    $rows = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        if (isset($_POST['rememberme'])) {
            /* Cookie tồn tại trong 1 ngày */
            setcookie("username", $_POST['username'], time() + 86400, "/", "", true, true);
            setcookie("islogin", TRUE, time() + 86400, "/", "", true, true);
            setcookie("stamp", generate_stamp($secret, $username, $ip_address, $user_agent), time() + 86400, "/", "", true, true);
        } else {
            /* Cookie sẽ hết hạn sau khi đóng trang web */
            setcookie("username", $_POST['username'], false, "/", "", true, true);
            setcookie("islogin", TRUE, false, "/", "", true, true);
            setcookie("stamp", generate_stamp($secret, $username, $ip_address, $user_agent), false, "/", "", true, true);
        }
        session_start();
        $rows = $result->fetch_assoc();
        $_SESSION['username'] = $rows['username'];
        header("location: index.php");
        exit;
    } else {
        echo "<script>alert('Sai Tên hoặc Mật Khẩu')</script>";
    }
}

?>