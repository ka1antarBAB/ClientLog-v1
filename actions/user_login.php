<?php
session_start();
require_once '../config/db.php';

$phone_number = $_POST['phone_number'];

$sql = "SELECT * FROM users WHERE phone_number = :phone_number";
$query = $pdo->prepare($sql);
$query->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
$query->execute();
$user = $query->fetch(PDO::FETCH_OBJ);

if ($user) {
    $_SESSION["user_type"] = 'user';
    $_SESSION["user_id"] = $user->id;
    header('Location: ../public/user_profile.php');
}else{
    echo "Invalid phone number";
}