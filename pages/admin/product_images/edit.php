<?php

$id_img_product = $_GET["id_img_product"];
$image_query = mysqli_query($conn, "SELECT * FROM img_product WHERE id_img_product = '$id_img_product'");
$image = mysqli_fetch_assoc($image_query);
$products = mysqli_query($conn, "SELECT * FROM product");

if (isset($_POST["update"])) {
    $id_product = $_POST["id_product"];
    $file_name = $_FILES["product_img"]["name"];
    $file_tmp = $_FILES["product_img"]["tmp_name"];

    if ($file_name) {
        unlink("assets/img/produk/" . $image["product_img"]);
        move_uploaded_file($file_tmp, "assets/img/produk/" . $file_name);
        $sql = mysqli_query($conn, "UPDATE img_product SET id_product='$id_product', product_img='$file_name' WHERE id_img_product='$id_img_product'");
    } else {
        $sql = mysqli_query($conn, "UPDATE img_product SET id_product='$id_product' WHERE id_img_product='$id_img_product'");
    }

    if ($sql) {
        echo "<script>alert('Image updated successfully');</script>";
        echo "<script>window.location.href='index.php?page=product_images'</script>";
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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Product:</label>
                        <select name="id_product" required class="form-select">
                            <?php foreach ($products as $product) { ?>
                                <option value="<?= $product['id_product']; ?>" <?= ($product['id_product'] == $image['id_product']) ? 'selected' : ''; ?>><?= $product['product_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Current Image:</label>
                        <img src="assets/img/produk/<?= $image["product_img"]; ?>" width="100">
                    </div>
                    <div class="mb-3">
                        <label>Upload New Image (optional):</label>
                        <input type="file" name="product_img" accept="image/*" class="form-control">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update Image</button>
                </form>
            </div>
        </div>
    </div>
</div>