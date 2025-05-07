<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function require_superadmin() {
    if(!isset($_SESSION['admin_role']) || $_SESSION['admin_role'] !== 'superadmin'){
        header('Location: ../public/index.php');
        exit;
    }
}

function require_admin(){
    if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin'){
        header("Location: ../pages/admin_login_form.php");
        exit;
    }
}

function require_login(){
    if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'user') {
        header("Location: ../pages/user_login_form.php");
        exit;
    }
}

