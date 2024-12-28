<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
                    <h2>Users</h2>
                </div>
                <?php
                include('config.php');

                try{
                    $stmt = $conn->prepare("SELECT * FROM users WHERE is_admin = 0");
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        echo '<table class="table">';
                        echo '<thead class="table-dark">';
                        echo '<tr>';
                        echo '<th>User Id</th>';
                        echo '<th>Name</th>';
                        echo '<th>Username</th>';
                        echo '<th>Email</th>';
                        echo '<th>Action</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr>';
                            echo '<td>' .$row['id']. '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['username'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td><a href="delete_users.php?id=' .$row['id']. '" class="btn btn-danger">Delete</a></td>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<p>No users found. </p>';
                    }
                }catch(PDOException $e){
                    echo "Error fetching orders: ".$e->getMessage();
                }

                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin_dashboard.js"></script>
</body>

</html>