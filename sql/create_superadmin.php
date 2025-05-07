<?php
require_once 'config/db.php';

$username = 'adminmaster';
$password_plain = 'SuperSecure123!';
$fullname = 'Main Super Admin';
$role = 'superadmin';
$allowed_categories = 'A,B,C';


$hashed_password = password_hash($password_plain, PASSWORD_BCRYPT);


$stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
$stmt->execute([':username' => $username]);
$exists = $stmt->fetch();

if ($exists) {
    echo "🟡 Admin with username '$username' already exists.\n";
} else {

    $sql = "INSERT INTO admins (username, password, fullname, role, allowed_categories)
            VALUES (:username, :password, :fullname, :role, :allowed_categories)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashed_password,
        ':fullname' => $fullname,
        ':role' => $role,
        ':allowed_categories' => $allowed_categories
    ]);

    echo "✅ Superadmin '$username' created successfully.\n";
}
?>