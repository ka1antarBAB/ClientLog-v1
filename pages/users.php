<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/auth.php';
require_admin();
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Users List</h2>
        <a href="../pages/user_form.php" class="btn btn-success">➕ Add New User</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Source</th>
                <th>Category</th>
                <th>Edit User</th>
                <th>Delete User</th>
                <th>Notes</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once '../config/db.php';
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $allowed = $_SESSION['allowed_categories'];
            if (empty($allowed)) {
                echo "<tr><td colspan='10' class='text-muted'>No allowed categories set.</td></tr>";
                exit;
            }
            $placeholders = implode(',', array_fill(0, count($allowed), '?'));
            $sql = "SELECT id, username, phone_number, email, address, source, category FROM users WHERE category IN ($placeholders)";
            $query = $pdo->prepare($sql);
            $query->execute($allowed);
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                $counter = 0;
                foreach ($result as $row) {
                    $counter++; ?>
                    <tr>
                        <td><?= $counter ?></td>
                        <td><?= htmlspecialchars($row->username) ?></td>
                        <td><?= htmlspecialchars($row->phone_number) ?></td>
                        <td><?= htmlspecialchars($row->email) ?></td>
                        <td><?= htmlspecialchars($row->address) ?></td>
                        <td><?= htmlspecialchars($row->source) ?></td>
                        <td><?= htmlspecialchars($row->category) ?></td>
                        <td>
                            <a href="../pages/edite_user_form.php?id=<?=$row->id?>" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                        <td>
                            <a href="../actions/delete_user.php?id=<?=$row->id?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                        <td>
                            <a href="../pages/user_notes.php?id=<?=$row->id?>" class="btn btn-sm btn-info">Notes</a>
                        </td>
                    </tr>
                <?php }} else { ?>
                <tr><td colspan="10" class="text-muted">No users found.</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div>
        <?php if($_SESSION['admin_role'] === 'superadmin'){
            echo '<a href="../pages/admins.php" class="btn btn-success">Manage Admins</a>';
        }
        ?>
    </div>
</div>