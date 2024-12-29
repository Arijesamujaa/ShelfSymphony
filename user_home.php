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
                a href="#"><img src="images/svg/cart.svg" alt="Cart Logo" class="cart-logo"></a>
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
                            <h2 class="display-5 fw-bold">About Us</h2>
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
                <h2 class="text-center mb-4">Best Sellers</h2>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Slide 1 -->
                        <div class="carousel-item active">
                            <div class="row row-cols-1 row-cols-md-6 g-4">
                                <div class="col">
                                    <div class="card" style="height: 320px;">
                                        <div class="image-container" style="height: 65%;">
                                            <img src="images/bookstore.jpg" class="card-img-top h-100" alt="Bookstore" style="object-fit: cover;">
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-between" style="height: 35%;">
                                            <h6 class="card-title">Book Title</h6>
                                            <p class="card-text">Author</p>
                                            <p class="card-text"><small class="text-success">Price</small></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card" style="height: 320px;">
                                        <div class="image-container" style="height: 65%;">
                                            <img src="images/bookstore_2.jpg" class="card-img-top h-100" alt="Bookstore" style="object-fit: cover;">
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-between" style="height: 35%;">
                                            <h6 class="card-title">Book Title</h6>
                                            <p class="card-text">Author</p>
                                            <p class="card-text"><small class="text-success">Price</small></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card" style="height: 320px;">
                                        <div class="image-container" style="height: 65%;">
                                            <img src="images/bookstore_3.jpg" class="card-img-top h-100" alt="Bookstore" style="object-fit: cover;">
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-between" style="height: 35%;">
                                            <h6 class="card-title">Book Title</h6>
                                            <p class="card-text">Author</p>
                                            <p class="card-text"><small class="text-success">Price</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="carousel-item">
                            <div class="row row-cols-1 row-cols-md-6 g-4">
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="images/bookstore_4.jpg" class="card-img-top" alt="Bookstore 4">
                                        <div class="card-body">
                                            <h5 class="card-title">Card Title 4</h5>
                                            <p class="card-text">Short description for card 4.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="images/bookstore.jpg" class="card-img-top" alt="Bookstore">
                                        <div class="card-body">
                                            <h5 class="card-title">Card Title 5</h5>
                                            <p class="card-text">Short description for card 5.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="images/bookstore_2.jpg" class="card-img-top" alt="Bookstore 2">
                                        <div class="card-body">
                                            <h5 class="card-title">Card Title 6</h5>
                                            <p class="card-text">Short description for card 6.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="carousel-item">
                            <div class="row row-cols-1 row-cols-md-6 g-4">
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="images/bookstore_3.jpg" class="card-img-top" alt="Bookstore 3">
                                        <div class="card-body">
                                            <h5 class="card-title">Card Title 7</h5>
                                            <p class="card-text">Short description for card 7.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="images/bookstore_4.jpg" class="card-img-top" alt="Bookstore 4">
                                        <div class="card-body">
                                            <h5 class="card-title">Card Title 8</h5>
                                            <p class="card-text">Short description for card 8.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="images/bookstore.jpg" class="card-img-top" alt="Bookstore">
                                        <div class="card-body">
                                            <h5 class="card-title">Card Title 9</h5>
                                            <p class="card-text">Short description for card 9.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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