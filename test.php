<?php
require_once '../config/db.php';

$username = 'admin';
$password = '123456';
$hashed = password_hash($password, PASSWORD_DEFAULT); // بسیار مهم!
$fullname = 'ادمین تست';

$sql = $pdo->prepare("INSERT INTO admins (username, password, fullname) VALUES (?, ?, ?)");
$sql->execute([$username, $hashed, $fullname]);

echo "ادمین ساخته شد.";
