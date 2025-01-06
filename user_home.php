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
    <title>Shelf Symphony</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php
    include('navbar.php');

    ?>


    <main class="main">
        <section class="" id="home">
            <div class="container-fluid bg-image">
                <h2>Welcome to Shelf Symphony</h2>
                <h3>Where Every Book Tells a Story</h3>
                <p>Discover a world of imagination, knowledge, and inspiration.
                    From timeless classics to the latest bestsellers, find your next favorite book right here.
                </p>
                <br>
                <!-- <a href="user_home_more.php">
                    <button type="button" class="home_btn btn btn-outline-light" style="width: 150px;">
                        More
                    </button>
                </a> -->
            </div>
        </section>

        <section class="" id="about-us">
            <div class="container-fluid">
                <div class="row gx-4 align-items-center justify-content-between">
                    <div class="col-md-5 order-2 order-md-1">
                        <div class="mt-5 mt-md-0">
                            <h4 class="display-6 fw-bold">About Us</h4>
                            <br>
                            <p><em>At Shelf Symphony, we believe books are more than just words on a page;
                                    they're symphonies of stories that resonate with your soul. Our curated selection of
                                    books spans genres, authors, and cultures to ensure every reader finds their harmony.</em></p>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-1 order-1 order-md-2">
                        <div class="row gx-2 gx-lg-3">
                            <div class="col-6">
                                <div class="mb-2"><img class="img-fluid rounded-3" src="images/bookstore.jpg"></div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2"><img class="img-fluid rounded-3" src="images/bookstore_2.jpg"></div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2"><img class="img-fluid rounded-3" src="images/bookstore_3.jpg"></div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2"><img class="img-fluid rounded-3" src="images/bookstore_4.jpg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="collection" id="collection">
            <div class="bestsellers" style="background-color: rgb(37, 37, 37); margin-top:10px">
                <section id="bestsellers">
                    <div class="sectionTitle" style="padding: 20px 0 10px 30px;">
                        <h4 class="display-6 fw-bold" id="title" style="font-size:xx-large; color:aliceblue;">Best Sellers</h4>
                    </div>
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            include('config.php');
                            $query = "SELECT * FROM products";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $chunks = array_chunk($products, 6);
                            $isFirstSlide = true;
                            foreach ($chunks as $chunk): ?>
                                <div class="carousel-item <?= $isFirstSlide ? 'active' : '' ?>">
                                    <div class="row row-cols-1 row-cols-md-6 g-3">
                                        <?php foreach ($chunk as $product): ?>
                                            <a href="book-details.php?id=<?= htmlspecialchars($product['id']) ?>" style="text-decoration: none; color: inherit;">
                                                <div class="col">
                                                    <div class="card" style="height: 330px;">
                                                        <div class="image-container" style="height: 65%;">
                                                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="card-img-top h-100" style="object-fit: cover;" />
                                                        </div>
                                                        <div class="card-body d-flex flex-column justify-content-between" style="height: 35%;">
                                                            <h6 class="card-title"><?= htmlspecialchars($product['title']) ?></h6>
                                                            <p class="card-text"><?= htmlspecialchars($product['author']) ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php $isFirstSlide = false; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            </div>

            <section class="m-4" id="newarrivals">
                <h4 class="display-6 fw-bold" style="font-size:xx-large; padding:10px">New Arrivals</h4>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        include('config.php');

                        $limit = 12;

                        $query = "SELECT * FROM products ORDER BY id DESC LIMIT :limit";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                        $stmt->execute();
                        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        $chunks = array_chunk($products, 6);
                        $isFirstSlide = true;

                        foreach ($chunks as $chunk): ?>
                            <div class="carousel-item <?= $isFirstSlide ? 'active' : '' ?>">
                                <div class="row row-cols-1 row-cols-md-6 g-3">
                                    <?php foreach ($chunk as $product): ?>
                                        <a href="book-details.php?id=<?= htmlspecialchars($product['id']) ?>" style="text-decoration: none; color: inherit;">
                                            <div class="col">
                                                <div class="card" style="height: 330px;">
                                                    <div class="image-container" style="height: 65%;">
                                                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="card-img-top h-100" style="object-fit: cover;" />
                                                    </div>
                                                    <div class="card-body d-flex flex-column justify-content-between" style="height: 35%;">
                                                        <h6 class="card-title"><?= htmlspecialchars($product['title']) ?></h6>
                                                        <p class="card-text"><?= htmlspecialchars($product['author']) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php $isFirstSlide = false; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="m-4" id="booksets">
                <div class="container text-center">
                    <h4 class="display-6 fw-bold" style="font-size: xx-large;">Book Sets</h4>
                    <div class="row g-4">
                        <div class="col g-4 text-bg-dark p-3">
                            <a href="book-sets.php?id=18" style="text-decoration: none; color: inherit;">
                                <?php
                                include('config.php');
                                $query = "SELECT * FROM products WHERE id=18";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $book = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
                                    <div class="my-3 py-3">
                                        <h2 class="display-5 fw-normal"><?php echo htmlspecialchars($book['title']); ?></h2>
                                        <p class="lead">Shatter Me Series By Tahereh Mafi 6 Books Collection Set</p>
                                    </div>
                                    <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                                        <img src="images/bookSets/shatterMe.jpg" alt="Shatter Me" class="img-fluid rounded-start h-100" style="width: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col g-4">
                            <a href="book-sets.php?id=19" style="text-decoration: none; color: inherit;">
                                <?php
                                include('config.php');
                                $query = "SELECT * FROM products WHERE id=19";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $book = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                                    <div class="my-3 p-3">
                                        <h2 class="display-5 fw-normal"><?php echo htmlspecialchars($book['title']); ?></h2>
                                        <p class="lead">The Maze Runner Series By James Dashner 5 Books Collection Set</p>
                                    </div>
                                    <div class="bg-dark box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                                        <img src="images/bookSets/mazeRunner.jpg" alt="Shatter Me" class="img-fluid rounded-start h-100" style="width: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col g-4">
                            <a href="book-sets.php?id=20" style="text-decoration: none; color: inherit;">
                                <?php
                                include('config.php');
                                $query = "SELECT * FROM products WHERE id=20";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $book = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                                    <div class="my-3 p-3">
                                        <h2 class="display-5 fw-normal"><?php echo htmlspecialchars($book['title']); ?></h2>
                                        <p class="lead">A Court of Thorns and Roses 5 Books Box Set by Sarah J. Maas</p>
                                    </div>
                                    <div class="bg-dark box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                                        <img src="images/bookSets/courtOfThrones.jpg" alt="Shatter Me" class="img-fluid rounded-start h-100" style="width: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col g-4 text-bg-dark p-3">
                            <a href="book-sets.php?id=21" style="text-decoration: none; color: inherit;">
                                <?php
                                include('config.php');
                                $query = "SELECT * FROM products WHERE id=21";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $book = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
                                    <div class="my-3 py-3">
                                        <h2 class="display-5 fw-normal"><?php echo htmlspecialchars($book['title']); ?></h2>
                                        <p class="lead">Slammed Series by Colleen Hoover 3 Books Collection Set - Fiction - Paperback</p>
                                    </div>
                                    <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                                        <img src="images/bookSets/slammed.jpg" alt="Shatter Me" class="img-fluid rounded-start h-100" style="width: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </section>

        <section class="m-4" id="whyUs">
            <div class="container wrapabout" style="background-color: rgb(37, 37, 37);">
                <div class="row">
                    <div class="col-lg-6 align-items-center justify-content-left d-flex mb-5 mb-lg-0">
                        <div class="blockabout">
                            <div class="blockabout-inner text-center text-sm-start">
                                <div class="title-big pb-3 mb-3">
                                    <h3>Why Us?</h3>
                                </div>
                                <p class="description-p pe-0 pe-lg-0">
                                    We offer a diverse selection of books for every reader, from fiction and
                                    non-fiction to children's and academic texts. Benefit from expert
                                    recommendations to discover your next favorite read. More than a bookstore,
                                    we're a community hub hosting events, book clubs, and workshops. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5 mt-lg-0">
                        <figure class="potoaboutwrap">
                            <img src="images/ourBookstore.jpg" alt="potoabout" class="img-fluid h-100" style="width: 100%; object-fit: cover;" />
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials">
            <div class="row d-flex justify-content-center" style="padding-top: 20px;">
                <div class="col-md-10 col-xl-8 text-center">
                    <h3 class="mb-4">What Readers Say About Us</h3>
                </div>
            </div>

            <div class="row text-center" style="padding-bottom: 30px;">
                <div class="col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="images/profil_1.jpg"
                            class="rounded-circle shadow-1-strong" width="150" height="150" />
                    </div>
                    <h5 class="mb-3">Sarah J.</h5>
                    <p class="px-xl-3">
                        <i class="fas fa-quote-left pe-2"></i>"I found my all-time favorite book here!
                        Shelf Symphony is a paradise for book lovers."
                    </p>
                </div>
                <div class="col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="images/profil_2.jpg"
                            class="rounded-circle shadow-1-strong" width="150" height="150" />
                    </div>
                    <h5 class="mb-3">James P.</h5>
                    <p class="px-xl-3">
                        <i class="fas fa-quote-left pe-2"></i>"Amazing collection and friendly staff.
                        I always discover something new every visit!"
                    </p>
                </div>
                <div class="col-md-4 mb-0">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="images/profil_3.jpg"
                            class="rounded-circle shadow-1-strong" width="150" height="150" />
                    </div>
                    <h5 class="mb-3">Emily R.</h5>
                    <p class="px-xl-3">
                        <i class="fas fa-quote-left pe-2"></i>"The community events are fantastic.
                        Shelf Symphony is more than just a bookstore!"
                    </p>
                </div>
            </div>
            <div>

            </div>
        </section>

    </main>

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