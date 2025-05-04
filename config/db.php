<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'ehsan');
define('DB_PASS', 'sql');
define('DB_NAME', 'ClientLog');
define('DB_CHARSET', 'utf8mb4');

$dns = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;

try {
    $pdo = new PDO($dns, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";

}catch (Exception $e){
    echo "connection failed: " . $e->getMessage();
}

