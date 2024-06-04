<?php
$host = 'localhost';
$dbname = 'test';
$username= 'root';
$password = '';
$port = '3306';

$dsn = "mysql:host=$host;dbname=$dbname;port=$port;";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
