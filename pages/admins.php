<?php
require_once '../includes/auth.php';
require_superadmin();
?>
<?php include '../includes/header.php'?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="../public/index.php" class="btn btn-outline-secondary me-2">← Back to Users List</a>
        </div>
        <div>
            <h2 class="h4 d-inline-block mb-0">Admins List</h2>
        </div>
        <div>
            <a href="../pages/admin_form.php" class="btn btn-success">➕ Add New Admin</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once '../config/db.php';
            $sql = "SELECT id, username FROM admins";
            $query = $pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                $counter = 0;
                foreach ($result as $row) {
                    $counter++; ?>
                    <tr>
                        <td><?= $counter ?></td>
                        <td><?= $row->username ?></td>
                        <td>
                            <a href="../pages/edite_admin_form.php?admin_id=<?= $row->id ?>" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                        <td>
                            <a href="../actions/delete_admin.php?admin_id=<?= $row->id ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php }} else { ?>
                <tr><td colspan="10" class="text-muted">There is No Admin, add some!</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../includes/footer.php'?>