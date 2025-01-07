<?php
include('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$search_query = '';
$results = [];

if (isset($_GET['query'])) {
    $search_query = trim($_GET['query']);
    $query = "
        SELECT * 
        FROM products 
        WHERE title LIKE :search_query 
           OR description LIKE :search_query 
           OR genre LIKE :search_query 
           OR author LIKE :search_query
    ";
    $stmt = $conn->prepare($query);
    $search_param = '%' . $search_query . '%';
    $stmt->bindParam(':search_query', $search_param, PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include('navbar.php');
    ?>


    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <h1>Search Results for: <?= htmlspecialchars($search_query) ?></h1>

            <?php if (count($results) > 0): ?>
                <ul class="list-unstyled">
                    <?php foreach ($results as $product): ?>
                        <li class="mb-4">
                            <div class="card" style="max-width: 400px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="<?= htmlspecialchars($product['image']) ?>"
                                            alt="<?= htmlspecialchars($product['title']) ?>"
                                            class="img-fluid rounded-start"
                                            style="height: 150px; object-fit: cover;">
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($product['title']) ?></h5>
                                            <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($product['author']) ?></h6>
                                            <p class="card-text text-truncate"><?= htmlspecialchars($product['genre']) ?></p>
                                            <a href="book-details.php?id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">View Product</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No results found for "<?= htmlspecialchars($search_query) ?>"</p>
            <?php endif; ?>
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