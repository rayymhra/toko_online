<?php 

$categories = mysqli_query($conn, "SELECT * FROM categories");
$products = mysqli_query($conn, "SELECT * 
                                                FROM product 
                                                JOIN categories 
                                                ON product.id_categories = categories.id_categories");

if (isset($_POST["create"])) {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $desc = $_POST["description"];
    $weight = $_POST["weight"];
    $size = $_POST["size"];

    $sql = mysqli_query($conn, "INSERT INTO product (product_name, id_categories, price, stock, description, weight, product_size) VALUES ('$name', '$category', '$price', '$stock', '$desc', '$weight', '$size')");
    
    if ($sql) {
        echo "<script>alert('Product added successfully')</script>";
        echo "<script>window.location.href='index.php?page=product'</script>";
    }
}
if(isset($_POST["delete"])){
    $id = $_POST["id"];
    $sql = mysqli_query($conn, "DELETE FROM product WHERE id_product = '$id'");
    if($sql){
        echo "<script>alert('Product deleted successfully')</script>";
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
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="mb-3">
                        <label>Category:</label>
                        <select name="category" class="form-select">
                            <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                                <option value="<?= $cat['id_categories'] ?>"><?= $cat['categories_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Weight (g)</label>
                        <input type="number" class="form-control" name="weight">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Size (cm)</label>
                        <input type="number" class="form-control" name="size">
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary" name="create" type="submit">Add</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="card p-3 my-3">
        <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Weight</th>
                            <th>Size</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($products as $product) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $product["product_name"] ?></td>
                                <td><?= $product["categories_name"] ?></td>
                                <td><?= $product["price"] ?></td>
                                <td><?= $product["stock"] ?></td>
                                <td><?= $product["weight"] ?></td>
                                <td><?= $product["product_size"] ?></td>
                                <td><?= $product["description"] ?></td>
                                <td>
                                    <a href="index.php?page=product_edit&id=<?= $product["id_product"]; ?>" class="btn btn-primary">Edit</a>
                                    <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <input type="hidden" name="id" value="<?= $product["id_product"] ?>">
                                        <button name="delete" class="btn btn-primary">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
        </div>

    </div>
</div>