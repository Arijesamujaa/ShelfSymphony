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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        body {
            margin-left: 220px;
        }
    </style>
</head>

<body>
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sidebar">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">

            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-white fs-5"><?= htmlspecialchars($username) ?></span>
                <a href="logout.php" class="btn btn-warning text-dark text-decoration-none ms-3" style="height: 40px; line-height: 30px; padding: 5px 15px; font-size: 14px;">Logout</a>
            </div>

            <ul class="nav flex-column w-100" id="menu">
                <li class="nav-item w-100">
                    <a href="admin_home.php" class="nav-link custom-link">
                        <span class="ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item w-100">
                    <a href="admin_products.php" class="nav-link custom-link">
                        <span class="ms-1">Products</span>
                    </a>
                </li>
                <li class="nav-item w-100">
                    <a href="admin_orders.php" class="nav-link custom-link">
                        <span class="ms-1">Orders</span>
                    </a>
                </li>
                <li class="nav-item w-100">
                    <a href="admin_users.php" class="nav-link custom-link">
                        <span class="ms-1">Users</span>
                    </a>
                </li>
                <li class="nav-item w-100">
                    <a href="admin_messages.php" class="nav-link custom-link">
                        <span class="ms-1">Messages</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>