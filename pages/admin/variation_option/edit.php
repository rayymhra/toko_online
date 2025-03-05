<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM variation_option WHERE id_variation_option = '$id'");
    $variation_option = mysqli_fetch_assoc($query);
}

if (isset($_POST["update"])) {
    $variation_price = $_POST["variation_price"];
    $variation_stock = $_POST["variation_stock"];

    $sql = mysqli_query($conn, "UPDATE variation_option SET variation_price='$variation_price', variation_stock='$variation_stock' WHERE id_variation_option='$id'");
    if ($sql) {
        echo "<script>alert('Variation option updated successfully')</script>";
        echo "<script>window.location.href='index.php?page=variation_option'</script>";
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
                        <label>Price:</label>
                        <input type="number" name="variation_price" required class="form-control" value="<?= $variation_option['variation_price']; ?>">
                    </div>
                    <div class="mb-3">
                        <label>Stock:</label>
                        <input type="number" name="variation_stock" required class="form-control" value="<?= $variation_option['variation_stock']; ?>">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>