<?php

$variations = mysqli_query($conn, "SELECT v.*, p.product_name FROM variation v JOIN product p ON v.id_product = p.id_product");

$variation_options = mysqli_query($conn, "SELECT vo.*, v.variation_name, p.product_name 
    FROM variation_option vo
    JOIN variation v ON vo.id_variation = v.id_variation
    JOIN product p ON v.id_product = p.id_product");

if (isset($_POST["create"])) {
    $id_variation = $_POST["id_variation"];
    $variation_price = $_POST["variation_price"];
    $variation_stock = $_POST["variation_stock"];

    $sql = mysqli_query($conn, "INSERT INTO variation_option(id_variation, variation_price, variation_stock) VALUES('$id_variation', '$variation_price', '$variation_stock')");
    if ($sql) {
        echo "<script>alert('Variation option added successfully')</script>";
        echo "<script>window.location.href='index.php?page=variation_option'</script>";
    }
}



if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    mysqli_query($conn, "DELETE FROM variation_option WHERE id_variation_option = '$id'");
    echo "<script>alert('Variation option deleted successfully')</script>";
    echo "<script>window.location.href='index.php?page=variation_option'</script>";
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
                        <label>Variation:</label>
                        <select name="id_variation" class="form-select">
                            <?php while ($variation = mysqli_fetch_assoc($variations)) { ?>
                                <option value="<?= $variation['id_variation']; ?>"><?= $variation['product_name']; ?> | <?= $variation['variation_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Price:</label>
                        <input type="number" name="variation_price" required class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Stock:</label>
                        <input type="number" name="variation_stock" required class="form-control">
                    </div>
                    <button type="submit" name="create" class="btn btn-primary">Add Variation Option</button>
                </form>
            </div>
        </div>
        <div class="card p-3 my-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Variation</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($variation_options as $vo) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $vo["product_name"]; ?></td>
                            <td><?= $vo["variation_name"]; ?></td>
                            <td><?= number_format($vo["variation_price"]); ?></td>
                            <td><?= $vo["variation_stock"]; ?></td>
                            <td>
                                <a href="index.php?page=variation_option_edit&id=<?= $vo['id_variation_option']; ?>" class="btn btn-primary">Edit</a>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $vo['id_variation_option']; ?>">
                                    <button name="delete" class="btn btn-primary" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>