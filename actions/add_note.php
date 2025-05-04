<?php
    require_once '../config/db.php';
    $note_title = $note_content = "";
    $errors = array(
        "note_title" => "",
        "note_content" => "",
    );
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST["user_id"];
        $note_title = $_POST["note_title"];
        $note_content = $_POST["note_content"];

        if(empty($note_title)){
            $errors["note_title"] = "Title is required";
        }elseif(strlen($note_title) > 100){
            $errors["note_title"] = "Title must be less than 100 characters";
        }
        if(empty($note_content)){
            $errors["note_content"] = "Content is required";
        }elseif(strlen($note_content) > 500){
            $errors["note_content"] = "Content must be less than 500 characters";
        }
        if(!array_filter($errors)){
            $sql = "INSERT INTO notes (user_id, title, note)
                   values (:user_id, :note_title, :note_content) 
                   ";
            $insert_query = $pdo->prepare($sql);
            $insert_query->bindValue(':user_id', $user_id);
            $insert_query->bindValue(':note_title', $note_title);
            $insert_query->bindValue(':note_content', $note_content);

            if($insert_query->execute()){
                echo "<script>alert('note Added Successfully!'); window.location.href='../pages/user_notes.php?id=$user_id';</script>";
                exit;
            }else{
                echo "<script>alert('Somthing went wrong!'); window.location.href='../pages/user_notes.php?id=$user_id';</script>";
                exit;
            }
        }else{
            foreach ($errors as $error) {
                if (!empty($error)){
                    echo "<script>alert('$error'); window.history.back();</script>";
                }
            }
        }
    }
?>