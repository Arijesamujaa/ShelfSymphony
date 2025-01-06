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
?>


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
            <div class="input-group rounded" style="width: 180px;">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <span class="input-group-text border-0" id="search-addon">
                    <img src="images/svg/search.svg">
                </span>
            </div>
            <a href="cart.php" style="margin-left: 10px;">
                <img src="images/svg/cart.svg" alt="Cart Logo" class="cart-logo">
                <span id="cart-count" class="badge bg-warning">
                    <?php echo $cart_row_number ?>
                </span>
            </a>

            <li class="nav-item dropdown" id="profile_nav">
                <a class="" href="" role="button" aria-expanded="false">
                    <img src="images/svg/profile.svg" alt="Profile Logo" class="profile-logo">
                </a>
                <ul class="dropdown-menu" style="position: absolute;
                                                right: 0;
                                                left: auto;
                                                margin-top: 10px;
                                                min-width: 200px;
                                                z-index: 1050;">
                    <li>
                        <p class="dropdown-item"><?= htmlspecialchars($username) ?>
                    </li>
                    <li>
                        <p class="dropdown-item"><?= htmlspecialchars($email) ?>
                    </li>
                    <li><button class="btn btn-warning" style="margin-left: 10px;">
                            <a href="logout.php" class="link-underline-opacity-0 text-dark text-decoration-none">Logout</a>
                        </button>
                    </li>
                </ul>
            </li>
        </div>
    </div>
</nav>