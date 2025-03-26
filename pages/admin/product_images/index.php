<?php
$id_product = $_GET['id_product'];

$products = mysqli_query($conn, "SELECT * FROM product");
$product_images = mysqli_query($conn, "SELECT * FROM img_product WHERE id_product = $id_product");

// $product = $_GET["id_product"];

if (isset($_POST["create_image"])) {
    $id_product = $_POST["id_product"];
    $file_name = $_FILES["product_img"]["name"];
    $file_tmp = $_FILES["product_img"]["tmp_name"];

    move_uploaded_file($file_tmp, "assets/img/produk/" . $file_name);

    $sql = mysqli_query($conn, "INSERT INTO img_product(id_product, product_img) VALUES('$id_product', '$file_name')");
    if ($sql) {
        echo "<script>alert('Image added successfully');</script>";
        echo "<script>window.location.href='index.php?page=product&crud_type=image&id_product=" . $id_product . "'</script>";
    }
}
if (isset($_POST["delete_img"])) {
    $id_img_product = $_POST["id_img_product"];
    $id_product = $_POST["id_product"];

    $img_query = mysqli_query($conn, "SELECT product_img FROM img_product WHERE id_img_product = '$id_img_product'");
    $img = mysqli_fetch_assoc($img_query);
    unlink("assets/img/produk/" . $img["product_img"]);

    $sql = mysqli_query($conn, "DELETE FROM img_product WHERE id_img_product = '$id_img_product'");
    if ($sql) {
        echo "<script>alert('Image deleted successfully');</script>";
        echo "<script>window.location.href='index.php?page=product&crud_type=image&id_product=" . $id_product . "'</script>";
    }
}
?>


<div class="row my-5">

    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h5>Product</h5>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_product" value="<?= $_GET['id_product'] ?? ''; ?>">
                    <div class="mb-3">
                        <label>Upload Image:</label>
                        <input type="file" name="product_img" accept="image/*" required class="form-control">
                    </div>
                    <button type="submit" name="create_image" class="btn btn-primary">Add Image</button>
                </form>
            </div>

            <div class="row m-1">
                <?php foreach ($product_images as $img) { ?>
                    <div class="col-4">
                        <div class="card p-1">
                            <img src="assets/img/produk/<?= $img["product_img"] ?>" alt="" class="w-100">
                            <form action="" method="post">
                                <input type="hidden" name="id_img_product" value="<?= $img["id_img_product"] ?>">
                                <input type="hidden" name="id_product" value="<?= $_GET['id_product'] ?? ''; ?>">
                                <button type="submit" name="delete_img" class="btn btn-primary mt-1">Delete</button>
                            </form>
                        </div>
                    </div> <?php } ?>
            </div>

        </div>

    </div>
</div>