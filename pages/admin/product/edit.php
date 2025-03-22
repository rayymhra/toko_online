<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM product WHERE id_product = '$id'");
    $product = mysqli_fetch_assoc($query);
}

$categories = mysqli_query($conn, "SELECT * FROM categories");

if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $desc = $_POST["description"];
    $weight = $_POST["weight"];
    $size = $_POST["size"];

    $sql = mysqli_query($conn, "UPDATE product SET product_name='$name', id_categories='$category', price='$price', stock='$stock', description='$desc', weight='$weight', product_size='$size' WHERE id_product='$id'");

    if ($sql) {
        echo "<script>alert('Product updated successfully')</script>";
        echo "<script>window.location.href='index.php?page=product'</script>";
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
                        <label>Product Name:</label>
                        <input type="text" name="name" value="<?= $product['product_name'] ?>" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Category:</label>
                        <select name="category" class="form-select">
                            <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                                <option value="<?= $cat['id_categories'] ?>" <?= $cat['id_categories'] == $product['id_categories'] ? 'selected' : '' ?>>
                                    <?= $cat['categories_name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Price:</label>
                        <input type="number" name="price" value="<?= $product['price'] ?>" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Stock:</label>
                        <input type="number" name="stock" value="<?= $product['stock'] ?>" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Description:</label>
                        <textarea name="description" class="form-control" rows="3"><?= $product['description'] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Weight:</label>
                        <input type="text" name="weight" value="<?= $product['weight'] ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Size:</label>
                        <input type="text" name="size" value="<?= $product['product_size'] ?>" class="form-control">
                    </div>


                    <button type="submit" name="update" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>



    </div>
</div>