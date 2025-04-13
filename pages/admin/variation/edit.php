<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM variation WHERE id_variation = '$id'");
    $variation = mysqli_fetch_assoc($query);
}

if (isset($_GET['id_product'])) {
    $id_product = $_GET['id_product'];
}


if (isset($_POST["update"])) {
    $variation_name = $_POST["variation_name"];

    $sql = mysqli_query($conn, "UPDATE variation SET variation_name='$variation_name' WHERE id_variation='$id'");
    if ($sql) {
        echo "<script>alert('Variation updated successfully')</script>";
        echo "<script>window.location.href='index.php?page=product&crud_type=variation&id_product=" . $id_product . "'</script>";
    }
}

?>


<div class="row my-5">
    <div class="col-3">
        <?php include "pages/admin/components/sidebar.php"; ?>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h5>Product</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label>Variation Name:</label>
                        <input type="text" name="variation_name" required class="form-control" value="<?= $variation['variation_name']; ?>">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Add Variation</button>
                </form>
            </div>
        </div>
        

    </div>
</div>