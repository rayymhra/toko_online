<?php

function check_login (){
    return isset($_SESSION["user"]) ? true : false;
}

// var_dump(check_login());



function add_to_cart($id_product, $qty) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Jika produk sudah ada di cart, tambahkan jumlahnya
    if (isset($_SESSION['cart'][$id_product])) {
        $_SESSION['cart'][$id_product] += $qty;
    } else {
        $_SESSION['cart'][$id_product] = $qty;
    }
}

function remove_from_cart($id_product) {
    if (isset($_SESSION['cart'][$id_product])) {
        unset($_SESSION['cart'][$id_product]);
    }
}

function clear_cart() {
    unset($_SESSION['cart']);
}
