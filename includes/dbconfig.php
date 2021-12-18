<?php
function getDBConnection()
{
    $dbhost = "remotemysql.com";
    $dbuser = "cU6G9jfUxz";
    $dbpass = "7UsmOA93Kf";
    $db = "cU6G9jfUxz";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
    return $conn;
}

function closeDbConnection($conn)
{
    $conn->close();
}
?>