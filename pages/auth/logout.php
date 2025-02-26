<?php

session_destroy();
echo "<script>alert('logout success')</script>";
echo "<script>window.location.href='index.php?page=login'</script>";
