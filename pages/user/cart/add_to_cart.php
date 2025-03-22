<?php
if (isset($_POST["id_product"]) && isset($_POST["qty"])) {
    $id_product = $_POST["id_product"];
    $qty = $_POST["qty"];
    
    add_to_cart($id_product, $qty);

    // Redirect ke halaman cart dengan format index.php?page=cart
    header("Location: index.php?page=cart");
    exit;
}