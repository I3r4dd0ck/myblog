<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width/n initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Đăng Ký</title>
</head>

<body>
    <div class="container" id="signup">
        <h1 class="form-title">Đăng ký</h1>
        <form method="post" action="index.php?page=user&action=signup">
            <div class="input-group">
                <i class='bx bxs-user'></i>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <label for="username">Tên</label>
            </div>
            <div class="input-group">
                <i class='bx bxs-envelope'></i>
                <input type="email" name="email" id="signup_email" placeholder="Email" required>
                <label for="signup_email">Email</label>
            </div>
            <div class="input-group">
                <i class='bx bxs-lock'></i>
                <input type="password" name="password" id="signup_password" placeholder="Password" required>
                <label for="signup_password">Mật khẩu</label>
            </div>
            <input type="submit" class="btn" value="Đăng Ký" name="signup">
        </form>
        <p class="or">
            --------or--------
        </p>
        <div class="links">
            <p>Đã có tài khoản ?</p>
            <a href="index.php?page=user&action=signin">
                <button id="signin_button">Đăng Nhập</button>
            </a>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['signup'])) {
    $username = remove_bad_characters($_POST['username']);
    $email = remove_bad_characters($_POST['email']);
    $password = remove_bad_characters($_POST['password']);

    $check = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        echo "<script>alert('Username hoặc Email đã tồn tại!')</script>";
    } elseif (strlen($password) < 8 || strlen($password) > 12){
        echo "<script>alert('Mật khẩu phải trong khoảng từ 8 đến 12 kí tự')</script>";
    } else {
        $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($insert_query) == TRUE) {
            header("location: index.php?page=user&action=signin");
        } else {
            echo "Lỗi" . $conn->error;
        }
    }
}
?>