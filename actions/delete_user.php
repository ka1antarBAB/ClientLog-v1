<?php
require_once '../config/db.php';
if(isset($_GET['delete'])){
    $user_id = intval($_GET['delete']);

    $sql = "DELETE FROM users WHERE id=:id";

    $delete_query = $pdo->prepare($sql);
    $delete_query->bindParam(':id', $user_id, PDO::PARAM_INT);
    $delete_query->execute();
    echo "<script>alert('User Deleted successfully!');</script>";
    echo "<script>window.location.href='../public/index.php';</script>";
//        header("Location: users.php");
}
?>