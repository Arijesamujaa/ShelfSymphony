<?php

include('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['id'];

$query = "SELECT username, email FROM users WHERE id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $username = $user['username'];
    $email = $user['email'];
}

$stmt = $conn->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$cart_row_number = $stmt->rowCount();
?>


<nav class="navbar navbar-expand-lg fixed-top bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="images/svg/logo.svg" alt="Logo" class="navbar-logo me-2">
            Shelf Symphony
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="user_home.php#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_home.php#about-us">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="user_home.php#collection" id="collectionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Collections
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="collectionDropdown">
                        <li><a class="dropdown-item" href="user_home.php#bestsellers">Best Sellers</a></li>
                        <li><a class="dropdown-item" href="user_home.php#newarrivals">New Arrivals</a></li>
                        <li><a class="dropdown-item" href="user_home.php#booksets">Book Sets</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_home.php#whyUs">Why Us?</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <div class="input-group rounded me-3" style="width: 180px;">
                    <form action="search.php" method="get" class="d-flex w-100">
                        <input type="search" name="query" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" required />
                        <button type="submit" class="input-group-text border-0" id="search-addon">
                            <img src="images/svg/search.svg" alt="Search">
                        </button>
                    </form>
                </div>

                <a href="cart.php" class="me-3">
                    <img src="images/svg/cart.svg" alt="Cart Logo" class="cart-logo">
                    <span id="cart-count" class="badge bg-warning">
                        <?php echo $cart_row_number ?>
                    </span>
                </a>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/svg/profile.svg" alt="Profile Logo" class="profile-logo">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown" style="position: absolute;
                                                                                                        right: 0;
                                                                                                        left: auto;
                                                                                                        margin-top: 10px;
                                                                                                        min-width: 200px;
                                                                                                        z-index: 1050;">
                        <li>
                            <p class="dropdown-item"><?= htmlspecialchars($username) ?></p>
                        </li>
                        <li>
                            <p class="dropdown-item"><?= htmlspecialchars($email) ?></p>
                        </li>
                        <li>
                            <button class="btn btn-warning" style="margin-left: 10px;">
                                <a href="logout.php" class="link-underline-opacity-0 text-dark text-decoration-none">Logout</a>
                            </button>
                        </li>
                    </ul>
                </li>
            </div>
        </div>
    </div>
</nav>