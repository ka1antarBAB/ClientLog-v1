<?php
    require_once '../includes/jdf.php';
    require_once '../includes/auth.php';
    require_admin();
?>
<?php
require_once '../config/db.php';
$user_id = $_GET['id'] ?? 0;

$user_sql = "SELECT username FROM users WHERE id = :id";
$user_query = $pdo->prepare($user_sql);
$user_query->bindParam(':id', $user_id, PDO::PARAM_INT);
$user_query->execute();
$user = $user_query->fetch(PDO::FETCH_OBJ);

$notes_sql = "SELECT * FROM notes WHERE user_id = :id ORDER BY contact_date DESC";
$notes_query = $pdo->prepare($notes_sql);
$notes_query->bindParam(':id', $user_id, PDO::PARAM_INT);
$notes_query->execute();
$notes = $notes_query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">
            <i class="fas fa-sticky-note me-2"></i>
            Notes for <?= htmlspecialchars($user->username ?? 'User') ?>
        </h1>
        <a href="../public/index.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Note</h5>
        </div>
        <div class="card-body">
            <form action="../actions/add_note.php" method="POST">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                <div class="mb-3">
                    <label for="note_title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="note_title" name="note_title" required>
                </div>
                <div class="mb-3">
                    <label for="note_content" class="form-label">Content</label>
                    <textarea class="form-control" id="note_content" name="note_content" rows="3" required></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="&#xf0c7; Save Note">
            </form>
        </div>
    </div>

    <h2 class="h4 mb-3"><i class="fas fa-list me-2"></i>User Notes</h2>

    <?php if (empty($notes)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i> No notes found for this user.
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($notes as $note): ?>
                <div class="col">
                    <div class="card note-card h-100 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><?= htmlspecialchars($note->title) ?></h5>
                            <small class="text-muted">
                                <?php
                                    $contact_date = $note->contact_date;
                                    $timestamp = strtotime($contact_date);
                                    echo jdate("Y/m/d - H:i", $timestamp);
                                ?>
                            </small>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= nl2br(htmlspecialchars($note->note)) ?></p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="../actions/delete_note.php?note_id=<?= $note->id ?>&user_id=<?= $user_id ?>"
                               class="btn btn-sm btn-danger float-end"
                               onclick="return confirm('Are you sure you want to delete this note?')">
                                <i class="fas fa-trash-alt me-1"></i> Delete
                            </a>
                            <a href="../actions/edite_note.php?note_id=<?= $note->id ?>&user_id=<?= $user_id ?>"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php include '../includes/footer.php'?>
