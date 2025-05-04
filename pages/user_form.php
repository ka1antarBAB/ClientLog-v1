<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php include '../includes/header.php'?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="../actions/add_user.php" method="POST" class="bg-white p-4 rounded-3 shadow mt-5">
                <div class="mb-3">
                    <label for="name" class="form-label">User Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="source" class="form-label">How did you hear about us?</label>
                    <select name="source" id="source" class="form-select">
                        <option value="">Choose</option>
                        <option value="instagram">Instagram</option>
                        <option value="telegram">Telegram</option>
                        <option value="friends">Friends</option>
                        <option value="others">Others...</option>
                    </select>
                </div>

                <div class="mb-3" id="custom-source-container" style="display: none;">
                    <input type="text" name="custom_source" class="form-control" placeholder="Tell us!">
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">Choose</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>

                <div class="d-grid">
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Submit">
                </div>
            </form>
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