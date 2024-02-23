<?php

$host = 'ec2-23-22-172-65.compute-1.amazonaws.com';
$database = 'dalq796sma21ev';
$user = 'brubuyhseaegrn';
$password = 'ab0eae51ebfc47bf38bd5c59c7564ed4a0fc9519c29ec1263ac1400deb4f5b2b';

try {
    $dsn = "pgsql:host=$host;dbname=$database";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die(); // Stop further execution if connection fails
}
