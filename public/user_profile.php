<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/jdf.php';
require_once '../includes/auth.php';
require_login();

require_once '../config/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = :user_id";
$query = $pdo->prepare($sql);
$query->bindValue(':user_id', $user_id);
$query->execute();
$user = $query->fetch(PDO::FETCH_OBJ);

$notes_sql = "SELECT * FROM notes WHERE user_id = :user_id";
$query_notes = $pdo->prepare($notes_sql);
$query_notes->bindValue(':user_id', $user_id);
$query_notes->execute();
$notes = $query_notes->fetchAll(PDO::FETCH_OBJ);
?>

<?php include '../includes/header.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Welcome <?php echo htmlspecialchars($user->username); ?></h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="card-title">User Information</h5>
                            <p class="card-text"><strong>Phone number:</strong> <?php echo htmlspecialchars($user->phone_number); ?></p>
                        </div>

                        <hr>

                        <div>
                            <h5 class="card-title">Your Notes</h5>
                            <?php if (count($notes) > 0): ?>
                                <div class="list-group">
                                    <?php foreach ($notes as $note): ?>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <small class="text-muted">
                                                    <?php
                                                        $contact_date = $note->contact_date;
                                                        $timestamp = strtotime($contact_date);
                                                        echo jdate("Y/m/d - H:i", $timestamp);
                                                    ?>
                                                </small>
                                            </div>
                                            <p class="mb-1"><?php echo htmlspecialchars($note->note); ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">You don't have any notes yet.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        last login: <?php echo jdate('Y/m/d H:i:s'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include '../includes/footer.php'; ?>