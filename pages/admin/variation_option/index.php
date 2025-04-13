<?php
$id_variation = $_GET['show_option'];

$variation_info = mysqli_query($conn, "SELECT * FROM variation WHERE id_variation = $id_variation");
$variation = mysqli_fetch_assoc($variation_info);

if (isset($_POST["create_option"])) {
    $id_variation = $_POST["id_variation"];
    $option_name = $_POST["option_name"];

    $sql = mysqli_query($conn, "INSERT INTO variation_option(id_variation, option_name) VALUES('$id_variation', '$option_name')");
    if ($sql) {
        echo "<script>alert('Variation option added successfully')</script>";
        // echo "<script>window.location.href='index.php?page=variation_option'</script>";
        echo "<script>window.location.href='index.php?page=product&crud_type=variation&id_product=" . $_GET['id_product'] . "&show_option=$id_variation'</script>";

    }
}



if (isset($_POST["delete_option"])) {
    $id_option = $_POST["id_option"];
    mysqli_query($conn, "DELETE FROM variation_option WHERE id_variation_option = '$id_option'");
    echo "<script>alert('Option deleted successfully');</script>";
    echo "<script>window.location.href='index.php?page=product&crud_type=variation&id_product=" . $_GET['id_product'] . "&show_option=$id_variation'</script>";

}

$options = mysqli_query($conn, "SELECT * FROM variation_option WHERE id_variation = $id_variation");

?>


<div class="row my-5">
    <!-- <div class="col-3">
        <?php include "pages/admin/components/sidebar.php"; ?>
    </div> -->
    <!-- <div class="col-9"> -->
    <div class="card">
        <div class="card-header">
            <h5>Variation Option</h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <input type="hidden" name="id_variation" value="<?= $id_variation ?>">
                <div class="mb-3">
                    <h5>Options for: <strong><?= $variation["variation_name"] ?></strong></h5>
                </div>
                <div class="mb-3">
                    <label>Option Name</label>
                    <input type="text" name="option_name" required class="form-control">
                </div>
                <!-- <div class="mb-3">
                        <label>Price:</label>
                        <input type="number" name="variation_price" required class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Stock:</label>
                        <input type="number" name="variation_stock" required class="form-control">
                    </div> -->
                <button type="submit" name="create_option" class="btn btn-primary">Add Variation Option</button>
            </form>
        </div>
    </div>
    <div class="card p-3 my-3">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Option Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($options as $opt): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $opt["option_name"] ?></td>
                        <td>
                            <form method="post" onsubmit="return confirm('Are You Sure to Delete this Option?')"
                                style="display:inline-block;">
                                <input type="hidden" name="id_option" value="<?= $opt['id_variation_option'] ?>">
                                <button type="submit" name="delete_option" class="btn btn-primary">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- </div> -->
</div>