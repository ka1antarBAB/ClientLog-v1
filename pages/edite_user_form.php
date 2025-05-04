<?php
require_once '../includes/auth.php';
require_admin();
?>
<?php
require_once '../config/db.php';
if(isset($_POST['update'])){
    $user_id = intval($_GET['id']);
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $source = htmlspecialchars($_POST['source']);
    $custom_source = htmlspecialchars($_POST['custom_source'] ?? '');
    $category = htmlspecialchars($_POST['category']);

    $sql = "UPDATE users SET username=:name, phone_number=:phone, email=:email, address=:address, source=:source, category=:category WHERE id=:id";

    $update_query = $pdo->prepare($sql);

    $update_query->bindParam(':id', $user_id, PDO::PARAM_INT);
    $update_query->bindParam(':name',$name);
    $update_query->bindParam(':phone', $phone);
    $update_query->bindParam(':email', $email);
    $update_query->bindParam(':address', $address);
    $final_source = $source === 'others' ? $custom_source : $source;
    $update_query->bindParam(':source', $final_source);
    $update_query->bindParam(':category', $category);

    $update_query->execute();

    echo "<script>alert('User Data Updated Successfully!');</script>";
    echo "<script>window.location.href='../public/index.php';</script>";
}
?>
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php include '../includes/header.php'?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Edit User</h4>
                </div>
                <div class="card-body">
                    <?php
                    $user_id = intval($_GET['id']);
                    $sql = "SELECT username, phone_number, email, address, source ,category FROM users WHERE id = :id";
                    $query = $pdo->prepare($sql);
                    $query->bindParam(':id', $user_id, PDO::PARAM_INT);
                    $query->execute();
                    $result = $query->fetch();
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" id="name" name="name" class="form-control" required value="<?php echo $result['username'];?>">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control" required value="<?php echo $result['phone_number'];?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required value="<?php echo $result['email'];?>">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" class="form-control" required value="<?php echo $result['address'];?>">
                        </div>

                        <div class="mb-3">
                            <label for="source" class="form-label">How did you hear about us?</label>
                            <select name="source" id="source" class="form-select">
                                <option value="">Choose</option>
                                <option value="instagram" <?php if($result['source'] == 'instagram') echo 'selected'; ?>>Instagram</option>
                                <option value="telegram" <?php if($result['source'] == 'telegram') echo 'selected'; ?>>Telegram</option>
                                <option value="friends" <?php if($result['source'] == 'friends') echo 'selected'; ?>>Friends</option>
                                <option value="others" <?php if(!in_array($result['source'], ['instagram','telegram','friends']) && $result['source'] != '') echo 'selected'; ?>>Others...</option>
                            </select>
                        </div>

                        <div class="mb-3" id="custom-source-container" style="display: <?php echo (!in_array($result['source'], ['instagram','telegram','friends']) && $result['source'] != '') ? 'block' : 'none'; ?>;">
                            <input type="text" name="custom_source" class="form-control" placeholder="Tell us!" value="<?php echo (!in_array($result['source'], ['instagram','telegram','friends']) && $result['source'] != '') ? htmlspecialchars($result['source']) : ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">Choose</option>
                                <option value="A" <?php if($result['category'] == 'A') echo 'selected'; ?>>A</option>
                                <option value="B" <?php if($result['category'] == 'B') echo 'selected'; ?>>B</option>
                                <option value="C" <?php if($result['category'] == 'C') echo 'selected'; ?>>C</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleCustomSource(selectElement) {
        const container = document.getElementById("custom-source-container");
        if (selectElement.value === "others") {
            container.style.display = "block";
        } else {
            container.style.display = "none";
        }
    }

    document.getElementById("source").addEventListener("change", function () {
        toggleCustomSource(this);
    });
</script>
<?php include '../includes/footer.php'?>