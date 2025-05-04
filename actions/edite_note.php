<?php
require_once '../config/db.php';

$user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT) ?? 0;
$note_id = filter_input(INPUT_GET, 'note_id', FILTER_VALIDATE_INT) ?? 0;

if (isset($_POST['update'])){
    $note_title = filter_input(INPUT_POST, 'note_title', FILTER_SANITIZE_STRING);
    $note_content = filter_input(INPUT_POST, 'note_content', FILTER_SANITIZE_STRING);
    $sql = "UPDATE notes SET note = :note_content, title = :note_title WHERE id = :note_id AND user_id = :user_id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':note_content', $note_content, PDO::PARAM_STR);
    $query->bindValue(':note_title', $note_title, PDO::PARAM_STR);
    $query->bindValue(':note_id', $note_id, PDO::PARAM_INT);
    $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    header("Location: ../pages/user_notes.php?id=$user_id");
    exit;
}


$note_sql = "SELECT note, title FROM notes WHERE id = :id AND user_id = :user_id";
$note_query = $pdo->prepare($note_sql);
$note_query->bindParam(':id', $note_id, PDO::PARAM_INT);
$note_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

if (!$note_query->execute()) {
    // خطا در اجرای کوئری
    die("Error fetching note");
}

$note = $note_query->fetch(PDO::FETCH_OBJ);

// اگر نت وجود نداشت
if (!$note) {
    die("Note not found");
}
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
            <a href="../pages/user_notes.php?id=<?= $user_id ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Notes
            </a>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Edit Note</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <input type="hidden" name="note_id" value="<?= $note_id ?>">
                    <div class="mb-3">
                        <label for="note_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="note_title" name="note_title" required
                               value="<?= htmlspecialchars($note->title ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="note_content" class="form-label">Content</label>
                        <textarea class="form-control" id="note_content" name="note_content" rows="3" required><?= htmlspecialchars($note->note ?? '') ?></textarea>
                    </div>
                    <input type="submit" name="update" class="btn btn-primary" value="&#xf0c7; Update Note">
                </form>
            </div>
        </div>
    </div>
<?php include '../includes/footer.php'?>