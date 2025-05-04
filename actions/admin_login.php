<?php
session_start();
require_once '../config/db.php';

$username = $_POST["username"];
$password = $_POST["password"];

$sql = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
$sql->bindValue(':username', $username);
$sql->execute();
$admin = $sql->fetch(PDO::FETCH_OBJ);

if ($admin && password_verify($password, $admin->password)) {
    $_SESSION['user_type'] = 'admin';
    $_SESSION['user_id'] = $admin->id;
    $_SESSION['username'] = $admin->username;
    header('Location: ../public/index.php');
}else{
    echo "Wrong username or password";
}