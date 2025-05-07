<?php
require_once '../includes/auth.php';
require_admin();
require_once '../config/db.php';

$user_id = intval($_GET['user_id']);

$check_sql = "SELECT * FROM users WHERE id = :user_id";
$check_query = $pdo->prepare($check_sql);
$check_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$check_query->execute();

if ($check_query->rowCount() > 0) {
    $sql = "DELETE FROM users WHERE id=:id";

    $delete_query = $pdo->prepare($sql);
    $delete_query->bindParam(':id', $user_id, PDO::PARAM_INT);
    $delete_query->execute();
    echo "<script>alert('User Deleted successfully!');</script>";
}else{
    echo "<script>alert('User does not exist!');</script>";
}
echo "<script>window.location.href='../public/index.php';</script>";
