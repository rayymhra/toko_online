<?php
if (isset($_POST["create"])) {
    $name = $_POST["name"];

    $sql = mysqli_query($conn, "INSERT INTO categories(categories_name) VALUES('$name')");
    if ($sql) {
        echo "<script>alert('categories inserted successfully')</script>";
        echo "<script>window.location.href='index.php?page=product_categories'</script>";
    }
}elseif(isset($_POST["delete"])){
    $id = $_POST["id"];

    $sql = mysqli_query($conn, "DELETE FROM categories WHERE id_categories = '$id'");
    if($sql){
        echo "<script>alert('categories deleted successfully')</script>";
        echo "<script>window.location.href='index.php?page=product_categories'</script>";
    }
}

$categories_name = mysqli_query($conn, "SELECT * FROM categories");

?>


<div class="row my-5">
    <div class="col-3">
        <?php include "pages/admin/components/sidebar.php"; ?>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h5>Categories</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Categories Name</label>
                        <input type="text" class="form-control" name="name">
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
                                <a href="index.php?page=product_categories_edit&id_categories=<?= $cn["id_categories"];?>" class="btn btn-primary">edit</a>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $cn["id_categories"]?>">
                                    <button name="delete" class="btn btn-primary" onclick="return confirm('Are you sure?')">delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>