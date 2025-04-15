<?php
$id_user = $_SESSION["id_user"];

if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    echo "<script>alert('Your cart is empty!'); window.location.href='index.php?page=cart';</script>";
    exit;
}


$total_price = 0;

// Insert transaksi baru
mysqli_query($conn, "INSERT INTO transaction(id_user, total_price, status, payment_status) VALUES('$id_user', 0, 'pending', 'pending')");
$id_transaction = mysqli_insert_id($conn);

// Insert transaksi detail
foreach ($_SESSION["cart"] as $id_product => $qty) {
    $result = mysqli_query($conn, "SELECT price FROM product WHERE id_product = '$id_product'");
    $product = mysqli_fetch_assoc($result);
    $price = $product["price"];
    $subtotal = $price * $qty;
    
    mysqli_query($conn, "INSERT INTO transaction_details(id_transaction, id_product, price, qty) 
                         VALUES('$id_transaction', '$id_product', '$price', '$qty')");

    $total_price += $subtotal;
}

// Update total harga transaksi
mysqli_query($conn, "UPDATE transaction SET total_price = '$total_price' WHERE id_transaction = '$id_transaction'");

// Kosongkan cart
unset($_SESSION["cart"]);

echo "<script>alert('Checkout successful!'); window.location.href='index.php';</script>";
