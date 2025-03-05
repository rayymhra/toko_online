<?php
session_start();
include "core/koneksi.php";
include "core/function.php";




?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="#">Toko Online</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php if (!check_login()) : ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php?page=login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php?page=register">Register</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php?page=logout">Logout</a>
            </li>

          
          <?php endif; ?>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php?page=cart">Cart</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <?php
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      switch ($page) {
        case 'login':
          include "pages/auth/login.php";
          break;
        case 'register':
          include "pages/auth/register.php";
          break;
        case 'logout':
          include "pages/auth/logout.php";
          break;
        case 'product_categories':
          include "pages/admin/product_categories/index.php";
          break;
        case 'product_categories_edit':
          include "pages/admin/product_categories/edit.php";
          break;
        case 'product':
          include "pages/admin/product/index.php";
          break;
        case 'product_edit':
          include "pages/admin/product/edit.php";
          break;
        case 'variation':
          include "pages/admin/variation/index.php";
          break;
        case 'variation_edit':
          include "pages/admin/variation/edit.php";
          break;
        case 'variation_option':
          include "pages/admin/variation_option/index.php";
          break;
        case 'variation_option_edit':
          include "pages/admin/variation_option/edit.php";
          break;
        default:
          echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
          break;
      }
    } else {
      include "pages/home/index.php";
    }

    ?>
  </div>

  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>