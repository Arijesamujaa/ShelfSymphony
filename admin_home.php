<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="d-flex">
        <?php include('sidebar.php'); ?>
        <?php include('config.php'); ?>

        <?php
        try {
            // Total Users
            $stmt = $conn->query("SELECT COUNT(*) as total_users FROM users");
            $total_users = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'] ?? 0;

            // Total Admins
            $stmt = $conn->query("SELECT COUNT(*) as total_admins FROM users WHERE is_admin = 1");
            $total_admins = $stmt->fetch(PDO::FETCH_ASSOC)['total_admins'] ?? 0;

            // Total Products
            $stmt = $conn->query("SELECT COUNT(*) as total_products FROM products");
            $total_products = $stmt->fetch(PDO::FETCH_ASSOC)['total_products'] ?? 0;

            // Total Orders
            $stmt = $conn->query("SELECT COUNT(*) as total_orders FROM orders");
            $total_orders = $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'] ?? 0;

            // Pending Orders
            $stmt = $conn->query("SELECT COUNT(*) as pending_orders FROM orders WHERE payment_status = 'pending'");
            $pending_orders = $stmt->fetch(PDO::FETCH_ASSOC)['pending_orders'] ?? 0;

            // Completed Orders
            $stmt = $conn->query("SELECT COUNT(*) as completed_orders FROM orders WHERE payment_status = 'completed'");
            $completed_orders = $stmt->fetch(PDO::FETCH_ASSOC)['completed_orders'] ?? 0;

            // Total Sales Revenue
            $stmt = $conn->query("SELECT SUM(total_price) as total_revenue FROM orders WHERE payment_status = 'completed'");
            $total_revenue = $stmt->fetch(PDO::FETCH_ASSOC)['total_revenue'] ?? 0;

            // Sales Trends Data
            $stmt = $conn->query("SELECT placed_on, SUM(total_price) as daily_revenue 
                                  FROM orders 
                                  WHERE payment_status = 'completed' 
                                  GROUP BY placed_on 
                                  ORDER BY placed_on");
            $sales_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dates = [];
            $revenues = [];
            foreach ($sales_data as $row) {
                $dates[] = $row['placed_on'];
                $revenues[] = $row['daily_revenue'];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $total_users = $total_admins = $total_products = $total_orders = $pending_orders = $completed_orders = $total_revenue = 0;
        }
        ?>

        <div class="col py-3">
            <div class="container my-4">
                <div class="col-md-9">
                    <h2>Home</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary p-3">
                            <h5>Total Users</h5>
                            <h3><?php echo $total_users; ?></h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info p-3">
                            <h5>Total Admins</h5>
                            <h3><?php echo $total_admins; ?></h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning p-3">
                            <h5>Total Products</h5>
                            <h3><?php echo $total_products; ?></h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success p-3">
                            <h5>Total Orders</h5>
                            <h3><?php echo $total_orders; ?></h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger p-3">
                            <h5>Pending Orders</h5>
                            <h3><?php echo $pending_orders; ?></h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-secondary p-3">
                            <h5>Completed Orders</h5>
                            <h3><?php echo $completed_orders; ?></h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-dark p-3">
                            <h5>Total Revenue</h5>
                            <h3>$<?php echo number_format($total_revenue, 2); ?></h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card p-3">
                            <h5>Sales Trends</h5>
                            <canvas id="salesChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const labels = <?php echo json_encode($dates); ?>;
        const data = <?php echo json_encode($revenues); ?>;

        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Daily Revenue',
                    data: data,
                    borderColor: 'rgb(55, 29, 83)',
                    backgroundColor: 'rgb(97, 56, 154)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Revenue ($)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>