<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/auth.php';
require_superadmin();
require_once '../config/db.php';

$admin_id = $_GET['admin_id'];

$check_sql = "SELECT * FROM admins WHERE id = :admin_id";
$check_query = $pdo->prepare($check_sql);
$check_query->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
$check_query->execute();

if ($check_query->rowCount() > 0) {
    $sql = "DELETE FROM admins WHERE id = :admin_id";
    $query = $pdo->prepare($sql);
    $query->bindparam(':admin_id', $admin_id, PDO::PARAM_INT);
    $query->execute();
    echo "<script>alert('Admin Deleted successfully!');</script>";
}else{
    echo "<script>alert('Admin Not Found!');</script>";
}
echo "<script>window.location.href='../pages/admins.php';</script>";
