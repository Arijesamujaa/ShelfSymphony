<?php

include_once('config.php');
session_start();

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        echo "Please fill in all fields";
    }
    else{
        $sql = "SELECT id, name, username, email, password, is_admin FROM users WHERE username=:username";
        $selectUser = $conn->prepare($sql);
        $selectUser->bindParam(":username", $username);
        $selectUser->execute();
        $data = $selectUser->fetch();

        if($data == false){
            echo "The user does not exists";
        }
        else{
            if (password_verify($password, $data['password'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['name'] = $data['name'];
                $_SESSION['is_admin'] = $data['is_admin'];

                if ($_SESSION['is_admin'] == 1) {
                    header('Location: admin_dashboard.php');
                } else {
                    header('Location: user_home.php');
                }
            } else {
                echo "The password is not valid";
            }
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <form action="" method="POST">
        <section class="h-100 bg-dark">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block d-flex align-items-stretch">
                                    <img src="images/login.jpg"
                                        alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%;" />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">
                                        <form>

                                            <div class="d-flex align-items-center mb-3 pb-1">
                                                <img src="images/svg/logo.svg" alt="ShelfSymphony Logo" width="200" height="50">
                                            </div>

                                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log into your account</h5>

                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <input type="text" id="username" name="username" class="form-control form-control-lg" />
                                                <label class="form-label" for="username">Username</label>
                                            </div>

                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                                <label class="form-label" for="password">Password</label>
                                            </div>

                                            <div class="pt-1 mb-4">
                                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit" id="submit" name="submit">Login</button>
                                            </div>

                                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register.php"
                                                    style="color: #393f81;">Register here</a></p>
                                        </form>

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