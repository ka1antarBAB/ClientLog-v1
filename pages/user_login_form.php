<?php
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'user') {
    header('Location: ../public/user_profile.php');
    exit;
}
?>
<?php include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<body class="bg-light">
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">User Login</h2>
                </div>
                <div class="card-body">
                    <form action="../actions/user_login.php" method="post">
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="card-footer text-center">
                            <a href="../pages/admin_login_form.php" class="text-decoration-none">Login as Admin</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>