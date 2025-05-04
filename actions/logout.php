<?php
session_start();
$user_type = $_SESSION['user_type'] ?? null;

session_unset();
session_destroy();

if ($user_type === 'admin') {
    header("Location: ../pages/admin_login_form.php");
} else {
    header("Location: ../pages/user_login_form.php");
}
exit;
