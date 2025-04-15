<?php
if (isset($_POST["id_product"]) && isset($_POST["qty"])) {
    $id_product = $_POST["id_product"];
    $qty = $_POST["qty"];
    
    add_to_cart($id_product, $qty);

    echo "<script>alert('Product Added to Cart')</script>";
        echo "<script>window.location.href='index.php'</script>";
    exit;
}