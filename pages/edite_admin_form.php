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
    $row = $check_query->fetch(PDO::FETCH_OBJ);
}else{
    echo "<script>alert('Admin Not Found!');</script>";
    echo "<script>window.location.href='../pages/admins.php';</script>";
}
$allowed = explode(',', $row->allowed_categories);
?>
<?php include '../includes/header.php'?>
    <!doctype html>
    <html lang="en">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center">Edite Admin info</h2>
                    </div>
                    <div class="card-body">
                        <form action="../actions/edite_admin.php" method="POST">
                            <input type="hidden" name="admin_id" id="admin_id" value="<?=$admin_id?> ">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">full name : </label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $row->fullname ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">username : </label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $row->username ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">password : </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (optional)">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">allowed categories : </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allowed_categories[]" id="categoryA" value="a"
                                        <?= in_array('a', $allowed) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="categoryA">A</label>

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allowed_categories[]" id="categoryB" value="b"
                                        <?= in_array('b', $allowed) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="categoryB">B</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allowed_categories[]" id="categoryC" value="c"
                                        <?= in_array('c', $allowed) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="categoryC">C</label>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" value="create admin" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include '../includes/footer.php'; ?>