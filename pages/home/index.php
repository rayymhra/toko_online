welcome to online shop

<?php 

$result = mysqli_query($conn, "SELECT p.*, 
                               (SELECT product_img FROM img_product ip WHERE ip.id_product = p.id_product LIMIT 1) AS product_img 
                               FROM product p");

?>

<div class="container my-5 products">
    <h2 class="text-center mb-4">All Products</h2>
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)) { 
            $image_path = !empty($row['product_img']) ? "assets/img/produk/" . $row['product_img'] : "assets/img/produk/default.jpg";
        ?>
            <div class="col-md-3">
                <div class="card mb-4">
                    <img src="<?= $image_path; ?>" class="card-img-top" alt="Product Image" 
                         onerror="this.onerror=null;this.src='assets/img/produk/default.png';">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['product_name']; ?></h5>
                        <p class="card-text">Rp <?= number_format($row['price']); ?></p>
                        <form action="index.php?page=add_to_cart" method="post">
                            <input type="hidden" name="id_product" value="<?= $row['id_product']; ?>">
                            qty: <input type="number" name="qty" value="1" min="1" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


