<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'admin') {
    header('Location: ../admin/dashboard.php');
    exit;
}
?>
<?php include '../includes/header.php'?>
<!DOCTYPE html>
<html lang="en">
<style>
    body {
        background-color: #f8f9fa;
    }
    .admin-card {
        border-top: 4px solid #dc3545;
    }
</style>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow admin-card">
                <div class="card-header bg-danger text-white text-center">
                    <h2 class="mb-0">Admin Login</h2>
                </div>
                <div class="card-body">
                    <form action="../actions/admin_login.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">Login</button>
                        </div>
                        <div class="card-footer text-center">
                            <a href="../pages/user_login_form.php" class="text-decoration-none">Login as User</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'?>