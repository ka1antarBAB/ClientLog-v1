<?php
require_once '../includes/auth.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_superadmin();
require_once '../config/db.php';

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$allowed_categories = implode(',', $_POST['allowed_categories']);

$sql = "INSERT INTO admins (fullname, username, password, allowed_categories) VALUES (:fullname, :username, :password, :allowed_categories)";
$query = $pdo->prepare($sql);
$query->bindparam(':fullname', $fullname, PDO::PARAM_STR);
$query->bindparam(':username', $username, PDO::PARAM_STR);
$query->bindparam(':password', $password, PDO::PARAM_STR);
$query->bindParam(':allowed_categories', $allowed_categories, PDO::PARAM_STR);
$query->execute();

header('Location: ../public/index.php');