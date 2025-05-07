<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/auth.php';
require_superadmin();
require_once '../config/db.php';

$admin_id = $_POST['admin_id'];

$check_sql = "SELECT * FROM admins WHERE id = :admin_id";
$check_query = $pdo->prepare($check_sql);
$check_query->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
$check_query->execute();

if ($check_query->rowCount() > 0) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $allowed_categories = implode(',', $_POST['allowed_categories']);
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "update admins set fullname = :fullname, username = :username, password = :password, allowed_categories = :allowed_categories where id = :admin_id";
        $query = $pdo->prepare($sql);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
    }else{
        $sql = "update admins set fullname = :fullname, username = :username, allowed_categories = :allowed_categories where id = :admin_id";
        $query = $pdo->prepare($sql);
    }
    $query->bindparam(':admin_id', $admin_id, PDO::PARAM_INT);
    $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':allowed_categories', $allowed_categories, PDO::PARAM_STR);

    $query->execute();
    echo "<script>alert('Admin info updated successfully!');</script>";
}else{
    echo "<script>alert('Admin Not Found!');</script>";
}
echo "<script>window.location.href='../pages/admins.php';</script>";
