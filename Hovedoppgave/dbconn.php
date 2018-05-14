<?php
$config = parse_ini_file('./config.ini');
$link = new mysqli($config['host'],$config['username'],$config['password'], $config['dbname']);
mysqli_set_charset($link, 'utf8');

if ($link->connect_error) {
    mysqli_close($link);
    trigger_error('Database connection failed: '  . $link->connect_error, E_USER_ERROR);
} else {
    return $link;
}
?>