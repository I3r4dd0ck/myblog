<?php

if ($_GET['action'] == 'signout') {
    setcookie('username', '', time() - 3600, '/');
    header("Location: index.php?page=user&action=signin");
    exit();
}

