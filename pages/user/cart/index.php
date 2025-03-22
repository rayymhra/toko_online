<?php
$cart_items = [];
$total_price = 0;

if (!empty($_SESSION["cart"])) {
    $ids = implode(",", array_keys($_SESSION["cart"]));
    $result = mysqli_query($conn, "SELECT * FROM product WHERE id_product IN ($ids)");
    while ($row = mysqli_fetch_assoc($result)) {
        $id_product = $row["id_product"];
        $row["qty"] = $_SESSION["cart"][$id_product];
        $row["subtotal"] = $row["price"] * $row["qty"];
        $total_price += $row["subtotal"];
        $cart_items[] = $row;
    }
}
?>

<h3>Your Cart</h3>

<table class="table">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>
    <?php foreach ($cart_items as $item) { ?>
        <tr>
            <td><?= $item["product_name"]; ?></td>
            <td><?= number_format($item["price"]); ?></td>
            <td><?= $item["qty"]; ?></td>
            <td><?= number_format($item["subtotal"]); ?></td>
            <td>
                <form action="index.php?page=remove_from_cart" method="post">
                    <input type="hidden" name="id_product" value="<?= $item["id_product"]; ?>">
                    <button type="submit" class="btn btn-primary">Remove</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

<h4>Total Price: <?= number_format($total_price); ?></h4>

<a href="index.php?page=checkout" class="btn btn-primary">Proceed to Checkout</a>
