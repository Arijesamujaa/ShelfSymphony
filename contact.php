<?php
include 'config.php';
session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('location:login.php');
}

$stmt = $conn->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$cart_row_number = $stmt->rowCount();

if (isset($_POST['sendButton'])){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['emailAddress']);
    $number = htmlspecialchars($_POST['number']);
    $msg = htmlspecialchars($_POST['message']);

    $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = :name AND email = :email AND number = :number AND message = :message");
    $select_message->bindParam(':name', $name);
    $select_message->bindParam(':email', $email);
    $select_message->bindParam(':number', $number);
    $select_message->bindParam(':message', $msg);
    $select_message->execute();

    if ($select_message->rowCount() > 0) {
        $message[] = 'Message sent already!';
    } else {
        $insert_message = $conn->prepare("INSERT INTO `message` (user_id, name, email, number, message) VALUES (:user_id, :name, :email, :number, :message)");
        $insert_message->bindParam(':user_id', $user_id);
        $insert_message->bindParam(':name', $name);
        $insert_message->bindParam(':email', $email);
        $insert_message->bindParam(':number', $number);
        $insert_message->bindParam(':message', $msg);
        $insert_message->execute();

        $message[] = 'Message sent successfully!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php
include('navbar.php');
    ?>

    <section class="py-5">
        <div class="container-fluid px-5 my-5">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card border-0 rounded-3 shadow-lg overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-sm-6 d-none d-sm-block">
                                    <div class="mapouter">
                                        <div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Prishtine&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://sprunkiplay.com">Sprunki</a></div>
                                        <style>
                                            .mapouter {
                                                position: relative;
                                                text-align: right;
                                                width: 100%;
                                                height: 620px;
                                            }

                                            .gmap_canvas {
                                                overflow: hidden;
                                                background: none !important;
                                                width: 100%;
                                                height: 620px;
                                            }

                                            .gmap_iframe {
                                                width: 100% !important;
                                                height: 620px !important;
                                            }
                                        </style>
                                    </div>
                                </div>

                                <div class="col-sm-6 p-4">
                                    <div class="text-center">
                                        <div class="h3">Contact Us</div>
                                    </div>

                                    <form id="contactForm" method="post" action="">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Name" data-sb-validations="required" />
                                            <label for="name">Name</label>
                                            <div class="invalid-feedback" data-sb-feedback="name:required">Name is required.</div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="emailAddress" name="emailAddress" type="email" placeholder="Email Address" data-sb-validations="required,email" />
                                            <label for="emailAddress">Email Address</label>
                                            <div class="invalid-feedback" data-sb-feedback="emailAddress:required">Email Address is required.</div>
                                            <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address is not valid.</div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="number" name="number" type="text" placeholder="Number" data-sb-validations="required" />
                                            <label for="number">Number</label>
                                            <div class="invalid-feedback" data-sb-feedback="number:required">Number is required.</div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="message" name="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
                                            <label for="message">Message</label>
                                            <div class="invalid-feedback" data-sb-feedback="message:required">Message is required.</div>
                                        </div>

                                        <div class="d-none" id="submitSuccessMessage">
                                            <div class="text-center mb-3">
                                                <div class="fw-bolder">Form submission successful!</div>
                                            </div>
                                        </div>

                                        <div class="d-none" id="submitErrorMessage">
                                            <div class="text-center text-danger mb-3">Error sending message!</div>
                                        </div>

                                        <div class="d-grid" style="width: 80px; ">
                                            <button class="btn btn-warning btn-lg" id="sendButton" name="sendButton" type="submit">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center text-lg-start bg-dark text-white">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>

        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>Shelf Symphony
                        </h6>
                        <p>
                            Shelf Symphony is more than a bookstore—it's a haven for book lovers and a hub for
                            community connection. We offer a curated selection of books, expert recommendations,
                            and a welcoming space for readers of all ages. </p>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">

                        </h6>
                        <p>
                            <a href="#home" class="link-light link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">Home</a>
                        </p>
                        <p>
                            <a href="#about-us" class="link-light link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">About Us</a>
                        </p>
                        <p>
                            <a href="#collection" class="link-light link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">Collections</a>
                        </p>
                        <p>
                            <a href="#whyUs" class="link-light link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">Why Us?</a>
                        </p>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <a href="contact.php" class="link-light link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">
                            <i class="fas fa-home me-3"></i>Contact Us
                        </a>


                        <p><i class="fas fa-home me-3"></i> Prishtine, 10012, KS</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            shelfsymphony@example.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2025 Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/">Shelf Symphony</a>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>