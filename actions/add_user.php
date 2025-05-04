<?php
require_once '../config/db.php';

$name = $phone = $email = $address = $source = $custom_source = $category = '';
$errors = array(
    'name' => '', 'phone' => '', 'email' => '',
    'address' => '', 'source' => '', 'custom_source' => '', 'category' => ''
);

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $source = htmlspecialchars($_POST['source']);
    $custom_source = htmlspecialchars($_POST['custom_source'] ?? '');
    $category = htmlspecialchars($_POST['category']);

    if (empty($name)) {
        $errors['name'] = 'Name is required';
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $errors['name'] = 'Name must contain only letters and spaces';
    }

    if (empty($phone)) {
        $errors['phone'] = 'Phone number is required';
    } elseif (!preg_match('/^\d{10,15}$/', $phone)) {
        $errors['phone'] = 'Phone number must be between 10 to 15 digits';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email';
    }

    if (empty($address)) {
        $errors['address'] = 'Address is required';
    }

    if (empty($source)) {
        $errors['source'] = 'Source is required';
    } elseif ($source === 'others' && empty($custom_source)) {
        $errors['custom_source'] = 'Please specify how you heard about us';
    }

    if (empty($category)) {
        $errors['category'] = 'Category is required';
    }

    if (!array_filter($errors)) {
        $check_phone_number = $pdo->prepare("SELECT COUNT(*) FROM users WHERE phone_number = :phone");
        $check_phone_number->bindParam(':phone', $phone);
        $check_phone_number->execute();
        $count = $check_phone_number->fetchColumn();

        if ($count > 0) {
            echo "<script>alert('This phone number already exists!'); window.history.back();</script>";
            exit;
        }
        $sql = "INSERT INTO users (username, phone_number, email, address, source, category)
                VALUES (:username, :phone_number, :email, :address, :source, :category)";
        $insert_query = $pdo->prepare($sql);

        $insert_query->bindParam(':username', $name);
        $insert_query->bindParam(':phone_number', $phone);
        $insert_query->bindParam(':email', $email);
        $insert_query->bindParam(':address', $address);
        $final_source = $source === 'others' ? $custom_source : $source;
        $insert_query->bindParam(':source', $final_source);
        $insert_query->bindParam(':category', $category);

        if ($insert_query->execute()) {
            echo "<script>alert('User Added Successfully!'); window.location.href='../public/index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Something went wrong!'); window.location.href='../public/index.php';</script>";
            exit;
        }
    } else {
        // Display errors in a Bootstrap alert box
        echo '<div class="alert alert-danger">';
        foreach ($errors as $field => $error) {
            if (!empty($error)) {
                echo "<script>alert('$error'); window.location.href='../pages/user_form.php';</script>";
                exit;
            }
        }
        echo '</div>';
    }
}
?>
