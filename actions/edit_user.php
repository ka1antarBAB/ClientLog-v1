<?php
require_once 'dbconfig.php';
if(isset($_POST['update'])){
    $user_id = intval($_GET['id']);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = intval($_POST['phone_number']);
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "UPDATE users SET first_name=:first_name, last_name=:last_name, phone_number=:phone_number, email=:email, address=:address WHERE id=:id";

    $update_query = $pdo->prepare($sql);

    $update_query->bindParam(':id', $user_id, PDO::PARAM_INT); // ✅ این لازمه!
    $update_query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $update_query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $update_query->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
    $update_query->bindParam(':email', $email, PDO::PARAM_STR);
    $update_query->bindParam(':address', $address, PDO::PARAM_STR);

    $update_query->execute();

    echo "<script>alert('User Data Updated Successfully!');</script>";
    echo "<script>window.location.href='users.php';</script>";

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../public/css/register.css">
    <title>Document</title>
</head>
<body>
<div>
    <?php
    $user_id = intval($_GET['id']);
    $sql = "SELECT first_name, last_name, phone_number, email, address FROM users WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id', $user_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    ?>
    <form action="" method="post">
        <fieldset>
            <legend>Update</legend>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value = "<?php echo htmlentities(
                    $result['first_name']
                )?>">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value = "<?php echo htmlentities(
                    $result['last_name']
                )?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value = "<?php echo htmlentities(
                    $result['email']
                )?>">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label><br>
                <input type="tel" id="phone" name="phone_number" pattern="09[0-9]{9}" value = "<?php echo htmlentities(
                    $result['phone_number']
                )?>">
            </div>

            <div class="form-group">
                <label for="address">Address</label><br>
                <textarea id="address" name="address" rows="4" cols="30"><?php echo htmlentities($result['address'])?></textarea>
            </div>
        </fieldset>
        <!--        <button type="submit">Submit</button>-->
        <input type="submit" class="input_submit" name="update">
    </form>
</div>
</body>
</html>