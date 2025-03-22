<?php

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $check_email = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");

    if ($check_email->num_rows > 0) {
        $user = mysqli_fetch_assoc($check_email);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user; // set session
            if ($user["level"] == "user") {
                echo "<script>alert('login success')</script>";
                echo "<script>window.location.href='index.php'</script>";
            } else {
                echo "<script>alert('login success')</script>";
                echo "<script>window.location.href='index.php?page=admin'</script>";
            }
            echo "<script>alert('login success')</script>";
            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('wrong email/password')</script>";
            echo "<script>window.location.href='index.php?page=login'</script>";
        }
    }
}


?>


<div class="row justify-content-center my-5">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h5>Register</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary" name="login">Login</button>
                        <a href="index.php?page=register" class="d-inline-block ms-auto">doesn't have account? Register</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>