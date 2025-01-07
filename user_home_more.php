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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include('navbar.php');

    ?>

    <section id="features" class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="container">

                <div class="row gy-4 align-items-center features-item">
                    <div class="col-lg-5 order-2 order-lg-1 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                        <h3></h3>
                        <p>
                            Since its early years, Shelf Symphony has been committed to curating a diverse collection of books, from literary classics to the newest authors that inspire and educate. We believe that every book is a new world, and we constantly strive to offer titles that will ignite the mind and heart of every reader.
                        </p>
                    </div>
                    <div class="col-lg-7 order-1 order-lg-2 d-flex align-items-center aos-init aos-animate" data-aos="zoom-out" data-aos-delay="100">
                        <div class="image-stack">
                            <img src="images/more-about-us-1.jpg" alt="" class="stack-front" style="max-width: 600px;">
                        </div>
                    </div>


                    <div class="row gy-4 align-items-stretch justify-content-between features-item ">
                        <div class="col-lg-6 d-flex align-items-center features-img-bg aos-init aos-animate" data-aos="zoom-out">
                            <img src="images/more-about-us-2.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-5 d-flex justify-content-center flex-column aos-init aos-animate" data-aos="fade-up">
                            <h2>Our Story</h2>
                            <p>
                                Shelf Symphony is a bookstore dedicated to bringing the world of books closer to reading enthusiasts.
                            </p>
                            <p>
                                Founded with passion and commitment by a small group of individuals, our bookstore was created to offer a space where every reader can experience the thrill of every page.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section id="whatWeOffer" class="m-4 bg-dark mx-4 py-5">
        <div class="container content-space-t-2 content-space-t-lg-3">
            <div class="row justify-content-lg-between align-items-lg-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img class="img-fluid rounded-2" src="images/ourBookstore.jpg" alt="Image Description">
                </div>

                <div class="col-lg-5">
                    <div class="mb-5">
                        <h2 class="text-white">What We Offer</h2>
                    </div>

                    <ul class="list-checked list-checked-soft-bg-primary list-checked-lg mb-5 text-white">
                        <li class="list-checked-item">A Wide Selection of Books</li>
                        <li class="list-checked-item">Gift Cards and Recommendations</li>
                        <li class="list-checked-item">Book Club</li>
                    </ul>
                    <p class="text-white">
                        As Shelf Symphony continues to grow, we aim to expand our offerings and foster an even
                        stronger community of book lovers. Our vision is to not only be a bookstore but a hub
                        where creativity, ideas, and stories come together.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team section light-background py-5">

        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Our Team</h2>
        </div>

        <div class="container">
            <div class="row gy-5">
                <!-- Team Member 1 -->
                <div class="col-lg-4 col-md-6 member aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-img">
                        <img src="images/staff-1.jpg" class="img-fluid rounded-circle" alt="Rita White">
                        <div class="social">
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="member-info text-center">
                        <h4>Rita White</h4>
                        <span>Chief Executive Officer</span>
                        <p>Leading our bookstore with a passion for literature and a vision for expanding the literary world.</p>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-lg-4 col-md-6 member aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <div class="member-img">
                        <img src="images/staff-2.jpg" class="img-fluid rounded-circle" alt="Sarah Johnson">
                        <div class="social">
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="member-info text-center">
                        <h4>Sarah Jhonson</h4>
                        <span>Product Manager</span>
                        <p>Expert in selecting the best books for our customers, managing our product inventory and bringing new exciting titles to the store.</p>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-lg-4 col-md-6 member aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <div class="member-img">
                        <img src="images/staff-3.jpg" class="img-fluid rounded-circle" alt="William Anderson">
                        <div class="social">
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="member-info text-center">
                        <h4>William Anderson</h4>
                        <span>Chief Technology Officer</span>
                        <p>Responsible for our online store, digital strategies, and ensuring that our technology is always up-to-date for a seamless shopping experience.</p>
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
    <script src="js/cart.js"></script>

</body>

</html>