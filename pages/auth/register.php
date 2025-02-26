<?php 

if(isset($_POST["register"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    $username = 'user' . rand(1111, 9999);

    if($password != $repeat_password) {
        echo "<script>alert('password doesn't match')</script>";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $check_email = mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");
    if($check_email->num_rows > 0){
        echo "<script>alert('email already exist')</script>";
    } else {
        $sql = mysqli_query($conn,"INSERT INTO user(id_user, username, name, email, password) VALUES(NULL, '$username', '$name', '$email', '$password')");
        echo "<script>alert('register success')</script>";
        echo "<script>window.location.href='index.php?page=login'</script>";

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
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Repeat Password</label>
                        <input type="password" class="form-control" name="repeat_password">
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary" name="register" type="submit">Register</button>
                        <a href="index.php?page=login" class="d-inline-block ms-auto">already have account? Login</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>