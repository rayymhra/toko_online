<?php

$products = mysqli_query($conn, "SELECT * FROM product");
$product_images = mysqli_query($conn, "SELECT img_product.*, product.product_name 
                                       FROM img_product 
                                       JOIN product ON img_product.id_product = product.id_product");

if (isset($_POST["create_image"])) {
    $id_product = $_POST["id_product"];
    $file_name = $_FILES["product_img"]["name"];
    $file_tmp = $_FILES["product_img"]["tmp_name"];

    move_uploaded_file($file_tmp, "assets/img/produk/" . $file_name);

    $sql = mysqli_query($conn, "INSERT INTO img_product(id_product, product_img) VALUES('$id_product', '$file_name')");
    if ($sql) {
        echo "<script>alert('Image added successfully');</script>";
        echo "<script>window.location.href='index.php?page=product&crud_type=image'</script>";
    }
}
if (isset($_POST["delete"])) {
    $id_img_product = $_POST["id_img_product"];

    $img_query = mysqli_query($conn, "SELECT product_img FROM img_product WHERE id_img_product = '$id_img_product'");
    $img = mysqli_fetch_assoc($img_query);
    unlink("assets/img/produk/" . $img["product_img"]);

    $sql = mysqli_query($conn, "DELETE FROM img_product WHERE id_img_product = '$id_img_product'");
    if ($sql) {
        echo "<script>alert('Image deleted successfully');</script>";
        echo "<script>window.location.href='index.php?page=product&crud_type=image'</script>";
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
                <!-- <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Product:</label>
                        <select name="id_product" required class="form-select">
                            <?php foreach ($products as $product) { ?>
                                <option value="<?= $product['id_product']; ?>"><?= $product['product_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Upload Image:</label>
                        <input type="file" name="product_img" accept="image/*" required class="form-control">
                    </div>


                    <button type="submit" name="create" class="btn btn-primary">Add Image</button>
                </form> -->
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_product" value="<?= $_GET['id_product'] ?? ''; ?>">
                    <div class="mb-3">
                        <label>Upload Image:</label>
                        <input type="file" name="product_img" accept="image/*" required class="form-control">
                    </div>
                    <button type="submit" name="create_image" class="btn btn-primary">Add Image</button>
                </form>

            </div>
        </div>
        <!-- <div class="card p-3 my-3">
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php $no = 1;
                foreach ($product_images as $img) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $img["product_name"]; ?></td>
                        <td><img src="assets/img/produk/<?= $img["product_img"]; ?>" width="100"></td>
                        <td>
                            <a href="index.php?page=product_images_edit&id_img_product=<?= $img["id_img_product"]; ?>" class="btn btn-primary">Edit</a>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="id_img_product" value="<?= $img["id_img_product"]; ?>">
                                <button name="delete" type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div> -->

    </div>
</div>