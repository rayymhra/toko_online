<?php
$id_product = $_GET["id_product"];
$variations = mysqli_query($conn, "SELECT * FROM variation WHERE id_product = $id_product");

if (isset($_POST["create_variation"])) {
    $id_product = $_POST["id_product"];
    $variation_name = $_POST["variation_name"];

    $sql = mysqli_query($conn, "INSERT INTO variation(id_product, variation_name) VALUES('$id_product', '$variation_name')");
    if ($sql) {
        echo "<script>alert('Variation added successfully')</script>";
        echo "<script>window.location.href='index.php?page=product&crud_type=variation&id_product=" . $id_product . "'</script>";

    }
}
if (isset($_POST["delete_variation"])) {
    $id = $_POST["id"];
    mysqli_query($conn, "DELETE FROM variation WHERE id_variation = '$id'");
    echo "<script>alert('Variation deleted successfully')</script>";
    echo "<script>window.location.href='index.php?page=product&crud_type=variation&id_product=" . $id_product . "'</script>";
}

$products = mysqli_query($conn, "SELECT * FROM product");

?>


<div class="row my-5">
    <!-- <div class="col-3">
        <?php //include "pages/admin/components/sidebar.php"; 
        ?>
    </div> -->
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h5>Variation</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="id_product" value="<?= $_GET['id_product']; ?>">

                    <div class="mb-3">
                        <label>Variation Name:</label>
                        <input type="text" name="variation_name" required class="form-control">
                    </div>

                    <button type="submit" name="create_variation" class="btn btn-primary">Add Variation</button>
                </form>

            </div>
        </div>
        <div class="card p-3 my-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Variation Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($variations as $var) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $var["variation_name"] ?></td>
                            <td>
                                <a href="index.php?page=variation_edit&id=<?= $var["id_variation"]; ?>&id_product=<?= $id_product ?>"
                                    class="btn btn-primary">Edit</a>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $var["id_variation"] ?>">
                                    <button name="delete_variation" class="btn btn-primary"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <a href="index.php?page=product&crud_type=variation&id_product=<?= $id_product ?>&show_option=<?= $var["id_variation"] ?>"
                                    class="btn btn-primary">Add Option</a>
                            </td>
                        </tr>
                    <?php }
                    ; ?>
                </tbody>
            </table>
            <?php
            if (isset($_GET["show_option"])) {
                $id_variation = $_GET["show_option"];
                include "pages/admin/variation_option/index.php";
            }
            ?>
        </div>

    </div>
</div>