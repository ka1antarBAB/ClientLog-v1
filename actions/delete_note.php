<?php
require_once '../config/db.php';

if (isset($_GET['note_id']) && isset($_GET['user_id'])) {
    $note_id = intval($_GET['note_id']);
    $user_id = intval($_GET['user_id']);

    $sql = "DELETE FROM notes WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $note_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: ../pages/user_notes.php?id=" . $user_id);
    exit;
}
?>
