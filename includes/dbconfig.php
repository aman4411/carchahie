<?php
function getDBConnection()
{
    // $dbhost = "remotemysql.com";
    // $dbuser = "cU6G9jfUxz";
    // $dbpass = "7UsmOA93Kf";
    // $db = "cU6G9jfUxz";

    $dbhost = "db4free.net";
    $dbuser = "root_aman";
    $dbpass = "P@ssw0rd";
    $db = "codeigniter";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
    return $conn;
}

function closeDbConnection($conn)
{
    $conn->close();
}
?>