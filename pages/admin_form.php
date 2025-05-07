<?php
require_once '../includes/auth.php';
require_superadmin();
require_once '../config/db.php';

?>
<?php include '../includes/header.php'?>
<!doctype html>
<html lang="en">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center">Creat New Admin</h2>
                </div>
                <div class="card-body">
                    <form action="../actions/add_admin.php" method="POST">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">full name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">username : </label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">password : </label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">allowed categories : </label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="allowed_categories[]" id="categoryA" value="a">
                                <label class="form-check-label" for="categoryA">A</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="allowed_categories[]" id="categoryB" value="b">
                                <label class="form-check-label" for="categoryB">B</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="allowed_categories[]" id="categoryC" value="c">
                                <label class="form-check-label" for="categoryC">C</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" value="create admin" class="btn btn-primary">Submit and Create </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>