<?php

if (isset($_GET["id_categories"])) {
    $id = $_GET["id_categories"];

    $get_update = mysqli_query($conn, "SELECT * FROM categories WHERE id_categories = '$id'");
    if ($get_update->num_rows > 0) {
        $category = mysqli_fetch_assoc($get_update);
    }
}

if (isset($_POST["update"])) {
    $name = $_POST["name"];

    $sql = mysqli_query($conn, "UPDATE categories SET categories_name='$name' WHERE id_categories = '$id'");
    echo "<script>alert('categories updated successfully')</script>";
    echo "<script>window.location.href='index.php?page=product_categories'</script>";
}


?>

<div class="row my-5">
    <!-- <div class="col-3">
        <?php //include "pages/admin/components/sidebar.php"; ?>
    </div> -->
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h5>Categories</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Categories Name</label>
                        <input type="text" class="form-control" name="name" value="<?= $category["categories_name"]; ?>">
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary" name="update" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>