<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="css/admin_products.css">
</head>

<body>
    <div class="d-flex">
        <?php include('sidebar.php'); ?>

        <div class="col py-3">
            <div class="container my-4">
                <div class="col-md-9">
                    <h2>Orders</h2>
                </div>
                <?php
                include('config.php');

                try {
                    $stmt = $conn->prepare("SELECT * FROM orders ORDER BY placed_on DESC");
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        echo '<table class="table">';
                        echo '<thead class="table-dark">';
                        echo '<tr>';
                        echo '<th>#</th>';
                        echo '<th>Name</th>';
                        echo '<th>Number</th>';
                        echo '<th>Email</th>';
                        echo '<th>Address</th>';
                        echo '<th>Total Products</th>';
                        echo '<th>Total Price</th>';
                        echo '<th>Payment Status</th>';
                        echo '<th>Placed On</th>';
                        echo '<th>Actions</th>';
                        echo '<th></th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['number'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['address'] . '</td>';
                            echo '<td>' . $row['total_products'] . '</td>';
                            echo '<td>' . $row['total_price'] . '</td>';
                            echo '<td>' . $row['payment_status'] . '</td>';
                            echo '<td>' . $row['placed_on'] . '</td>';
                            echo '<td></button><a href="update_payment_status.php?id=' . $row['id'] . '" class="btn btn-secondary">Update</a></td>';
                            echo '<td><a href="delete_order.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a></td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<p>No orders found.</p>';
                    }
                } catch (PDOException $e) {
                    echo "Error fetching orders: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>