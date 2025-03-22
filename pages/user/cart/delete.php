<?php
if (isset($_POST["id_product"])) {
    remove_from_cart($_POST["id_product"]);
    header("Location: index.php?page=cart");
    exit;
}