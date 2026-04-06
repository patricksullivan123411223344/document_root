<?php
/* 
Name: Patrick Sullivan
File: db_connect.php
Description: Creates a PDO connection to the MySQL database
*/
$type = "mysql";
$server = "localhost";
$db = "client_site_db";
$port = "3306";
$charset = "utf8mb4";

$userName = "root";
$password = "";

$dsn = "$type:host=$server;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

try {
    $pdo = new PDO($dsn, $userName, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>