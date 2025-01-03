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