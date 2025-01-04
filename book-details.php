<?php
include('config.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $query = "SELECT * FROM products WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/book-details.css">
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
                            <a class="nav-link" href="user_home.php#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_home.php#about-us">About Us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="user_home.php#collection" role="button" aria-expanded="false">
                                Collections
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="user_home.php#bestsellers">Best Sellers</a></li>
                                <li><a class="dropdown-item" href="user_home.php#newarrivals">New Arrivals</a></li>
                                <li><a class="dropdown-item" href="user_home.php#booksets">Book Sets</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_home.php#whyUs">Why us?</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">
                        <a href="#"><img src="images/svg/cart.svg" alt="Cart Logo" class="cart-logo"></a>
                        <a href="" style="margin-left: 20px;"><img src="images/svg/profile.svg" alt="Profile Logo" class="profile-logo"></a>
                    </div>

                </div>
            </nav>

            <main class="main">
                <section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
                            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>" /></div>
                            <div class="col-md-6">
                                <div class="mb-1"><?= htmlspecialchars($book['genre']) ?></div>
                                <h1 class="display-5 fw-bolder"><?= htmlspecialchars($book['title']) ?></h1>
                                <div class="fs-5 mb-5">
                                    <span>Author: <?= htmlspecialchars($book['author']) ?></span>
                                </div>
                                <p><?= htmlspecialchars($book['description']) ?></p>
                                <div class="d-flex">
                                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                        <i class="bi-cart-fill me-1"></i>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-5">
                    <div class="container px-4 px-lg-5 mt-5">
                        <h2 class="fw-bolder mb-4">Similar books</h2>
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                            <?php
                            include('config.php');

                            $limit = 4;
                            $currentBookId = isset($_GET['id']) ? intval($_GET['id']) : 0;

                            if ($currentBookId > 0) {
                                try {
                                    $query = "
                                        SELECT * 
                                        FROM products 
                                        WHERE genre LIKE CONCAT('%', (SELECT genre FROM products WHERE id = :id), '%') 
                                        AND id != :id 
                                        LIMIT :limit";

                                    $stmt = $conn->prepare($query);

                                    $stmt->bindParam(':id', $currentBookId, PDO::PARAM_INT);
                                    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

                                    $stmt->execute();
                                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    if ($products) {
                                        foreach ($products as $product): ?>
                                            <div class="col mb-5">
                                                <div class="card h-100">
                                                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>"
                                                        class="card-img-top"
                                                        style="width: 100%; height: 250px; object-fit: cover;" />
                                                    <div class="card-body p-4">
                                                        <div class="text-center">
                                                            <h5 class="fw-bolder"><?= htmlspecialchars($product['title']) ?></h5>
                                                            <p><?= number_format($product['price'], 2) ?>€</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                        <div class="text-center">
                                                            <a class="btn btn-outline-dark mt-auto" href="book-details.php?id=<?= htmlspecialchars($product['id']) ?>">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                            <?php endforeach;
                                    } else {
                                        echo '<p>No similar books found.</p>';
                                    }
                                } catch (PDOException $e) {
                                    echo "Query error: " . $e->getMessage();
                                }
                            } else {
                                echo '<p>Invalid book ID for similar books.</p>';
                            }
                            ?>
                        </div>
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
                                    <a href="user_home.php#home" class="link-light link-offset-2 link-underline link-underline-opacity-0">Home</a>
                                </p>
                                <p>
                                    <a href="user_home.php#about-us" class="link-light link-offset-2 link-underline link-underline-opacity-0">About Us</a>
                                </p>
                                <p>
                                    <a href="user_home.php#collection" class="link-light link-offset-2 link-underline link-underline-opacity-0">Collections</a>
                                </p>
                                <p>
                                    <a href="user_home.php#whyUs" class="link-light link-offset-2 link-underline link-underline-opacity-0">Why Us?</a>
                                </p>
                            </div>

                            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
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
        </body>

        </html>

<?php
    } else {
        echo "<p>Book not found.</p>";
    }
} else {
    echo "<p>Invalid book ID.</p>";
}
?>