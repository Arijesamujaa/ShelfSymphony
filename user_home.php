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
    <nav class="navbar fixed-top bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/svg/logo.svg" alt="Logo" class="navbar-logo">
                Shelf Symphony
            </a>

            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about-us">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#collection" role="button" aria-expanded="false">
                        Collections
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#bestsellers">Best Sellers</a></li>
                        <li><a class="dropdown-item" href="#">New Arrivals</a></li>
                        <li><a class="dropdown-item" href="#">Staff Picks</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Why us?</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <a href="#"><img src="images/svg/cart.svg" alt="Cart Logo" class="cart-logo"></a>
                <a href="" style="margin-left: 20px;"><img src="images/svg/profile.svg" alt="Profile Logo" class="profile-logo"></a>
            </div>

        </div>
    </nav>


    <main class="main">
        <section class="" id="home">
            <div class="container-fluid bg-image">
                <h2>Welcome to Shelf Symphony</h2>
                <h3>Where Every Book Tells a Story</h3>
                <p>Discover a world of imagination, knowledge, and inspiration.
                    From timeless classics to the latest bestsellers, find your next favorite book right here.
                </p>
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

        <section class="" id="collection">
            <section class="m-4" id="bestsellers">
                <h4 class="display-6 fw-bold">Best Sellers</h4>
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
                                <div class="row row-cols-1 row-cols-md-6 g-4">
                                    <?php foreach ($chunk as $product): ?>
                                        <div class="col">
                                            <div class="card" style="height: 340px;">
                                                <div class="image-container" style="height: 65%;">
                                                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="card-img-top h-100" style="object-fit: cover;" />
                                                </div>
                                                <div class="card-body d-flex flex-column justify-content-between" style="height: 35%;">
                                                    <h6 class="card-title"><?= htmlspecialchars($product['title']) ?></h6>
                                                    <p class="card-text"><?= htmlspecialchars($product['author']) ?></p>
                                                    <p class="card-text"><small class="text-success">Price: €<?= htmlspecialchars($product['price']) ?></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php $isFirstSlide = false; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>



        </section>

        <section>

        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>