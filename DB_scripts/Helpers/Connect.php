<?php
$sql_host = 'localhost';
$sql_username = 'Vaporware';
$sql_password = 'password';
$sql_database_name = 'cls';
//$sql_socket = '<NONE SELECTED>'

$mysqli = new mysqli($sql_host, $sql_username, $sql_password, $sql_database_name);

if ($mysqli->connect_errno)
{
    printf("Connection failed: %s\n", $mysqli->connect_error);
    exit();
}
?>