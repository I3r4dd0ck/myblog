<?php

function remove_bad_characters($data)
{
    $bad_characters = array('&', '`', '\\', '/', '\'', '--');
    return str_replace($bad_characters, '', $data);
}

function get_client_ip()
{
    $ip_address = "";
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $ip_address = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip_address = "UNKNOWN";
    }
    return $ip_address;
}

function get_user_agent()
{
    return $_SERVER['HTTP_USER_AGENT'];
}

function generate_stamp($secret, $username, $ip_address, $user_agent)
{
    return md5($secret . $username . $ip_address . $user_agent);
}

function check_authentication()
{
    $secret = "I3radd0c4H4H4";
    $username = $_COOKIE['username'] ?? '';
    $client_stamp = $_COOKIE['stamp'] ?? '';

    if (empty($username) || empty($client_stamp)) {
        header("location: index.php?page=user&action=signin");
        exit();
    }

    $ip_address = get_client_ip();
    $user_agent = get_user_agent();
    $server_stamp = generate_stamp($secret, $username, $ip_address, $user_agent);
    if ($server_stamp !== $client_stamp) {
        header("location: index.php?page=user&action=signin");
        exit();
    }
}
