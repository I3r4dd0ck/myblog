<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>BLOGQUY</title>
</head>
<body>
    
</body>
</html>

<?php
include 'system/connectdb.php';
include 'system/utilities.php';
include 'layout/header.php';
?>
<?php
$page = $_GET['page'];
$action = $_GET['action'];

if(!isset($page) || empty($page)){
    $file = "page/home.php";
} else {
    $file = "module/$page/$action.php";
}
if(file_exists($file)){
    include($file);
}else{
    echo '404 not found';
}

?>
<?php
include 'layout/footer.php';
?>