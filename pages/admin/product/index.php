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
                        <input type="number" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Weight (g)</label>
                        <input type="number" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Size (cm)</label>
                        <input type="number" class="form-control" name="name">
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
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($categories_name as $cn) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $cn["categories_name"] ?></td>
                            <td>
                                <a href="index.php?page=product_categories_edit&id_categories=<?= $cn["id_categories"]; ?>" class="btn btn-primary">edit</a>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $cn["id_categories"] ?>">
                                    <button name="delete" class="btn btn-primary">delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>