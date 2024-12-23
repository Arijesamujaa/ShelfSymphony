<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>

<body>
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <a href="" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-5 d-none d-sm-inline">User Dashboard</span>
            </a>
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