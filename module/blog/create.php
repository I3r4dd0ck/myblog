<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Blog</title>
</head>

<body>

    <div class="top-bar" style="margin: 0; text-align: center; padding: 10px;">
        <span id="top_bar_title" style="text-align: center; margin: 0; font-size: 30px;">Blog | New Post</span>
    </div>

    <div class="writing-section" style="margin: 10px;">
        <form action="index.php?page=blog&action=create" method="POST" enctype="multipart/form-data" style="text-align: center;">
            <input id="blog_title" name="blog_title" type="text" placeholder="Tiêu đề..." autocomplete="off" required style="font-size: 20px; width: 37.5%; margin-bottom: 5px; border-radius: 5px; padding: 5px 5px;">
            <br>
            <span id="author_label">Tác giả: </span>
            <input id="blog_author" name="blog_author" required></input>
            <br><br>
            <img src="public/media/vozer.jpg">
            <br><br>
            <textarea id="blog_content" name="blog_content" cols="75" rows="40" type="text" placeholder="Nội dung..." autocomplete="off" required></textarea>
            <br><br>
            <button id="save_btn" type="submit" name="create">Đăng</button>
        </form>
        <br>

        <center><a style="text-decoration: none;" href="index.php" id="save_btn">Trở về trang chủ</a></center>
    </div>

</body>

</html>

<?php

check_authentication();

if (isset($_POST['create']) && isset($_COOKIE['username'])) {

    $title = remove_bad_characters($_POST['blog_title']);
    $content = remove_bad_characters($_POST['blog_content']);
    $author = $_COOKIE['username'];

    $sql = "SELECT user_id FROM users WHERE username = '$author'";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        $user_id = $row['user_id'];

        $insert_query = "INSERT INTO blogs (title,content,user_id) VALUES ('$title','$content','$user_id')";

        if ($conn->query($insert_query) == TRUE) {
            echo "Tạo Blog thành công";
        } else {
            echo "Tạo Blog thất bại";
        }
    } else {
        echo "Người dùng không tồn tại";
    }
} else {
    echo "<script>alert('Vui lòng đăng nhập để tạo Blog')</script>";
    header("location: index.php?page=user&action=signin");
}

$conn->close();

?>