<?php

include_once('config.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $tempPass = $_POST['password'];
    $password = password_hash($tempPass, PASSWORD_DEFAULT);

    $tempConfirm = $_POST['passwordConfirm'];
    $confirm_password = password_hash($tempConfirm, PASSWORD_DEFAULT);

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "You have not filled in all the fields.";
    } else {
        $is_admin = 0;

        if (strpos($email, '@bookstore.com') !== false) {
            $is_admin = 1;
        }

        $sql = "INSERT INTO users(name, username, email, password, confirm_password, is_admin) VALUES (:name, :username, :email, :password, :confirm_password, :is_admin)";

        $insertSql = $conn->prepare($sql);

        $insertSql->bindParam(':name', $name);
        $insertSql->bindParam(':username', $username);
        $insertSql->bindParam(':email', $email);
        $insertSql->bindParam(':password', $password);
        $insertSql->bindParam(':confirm_password', $confirm_password);
        $insertSql->bindParam(':is_admin', $is_admin);

        $insertSql->execute();

        header("Location: login.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form action="" method="post">
        <section class="h-100 bg-dark">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card card-registration my-4">
                            <div class="row g-0">
                                <div class="col-xl-6 d-none d-xl-block">
                                    <img src="images/register.jpg"
                                        alt="Sample photo" class="img-fluid"
                                        style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                                </div>
                                <div class="col-xl-6">
                                    <div class="card-body p-md-5 text-black">
                                        <h3 class="mb-5 text-uppercase">Registration form</h3>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" id="name" name="name" class="form-control form-control-lg" />
                                                    <label class="form-label" for="name">Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" id="username" name="username" class="form-control form-control-lg" />
                                                    <label class="form-label" for="username">Username</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                            <label class="form-label" for="email">Email</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="passwordConfirm" name="passwordConfirm" class="form-control form-control-lg" />
                                            <label class="form-label" for="passwordConfirm">Confirm Password</label>
                                        </div>

                                        <div class="d-flex justify-content-end pt-3">
                                            <button type="reset" data-mdb-button-init data-mdb-ripple-init class="btn btn-light btn-lg" id="reset" name="reset">Reset all</button>
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-warning btn-lg ms-2" id="submit" name="submit" style="background-color: #E5AA70;">Sign Up</button>
                                        </div>

                                        <span>Already have an account: </span><a href="login.php">Sign in</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</body>

</html>