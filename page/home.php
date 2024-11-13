<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
</head>

<body>

    <?php
    echo 'Welcome ' . $_COOKIE['username'];
    ?>
    <br>
    <a style="text-decoration: none;" href="index.php?page=blog&action=create" id="save_btn">Viết Blog</a>
    <br>

</body>

</html>