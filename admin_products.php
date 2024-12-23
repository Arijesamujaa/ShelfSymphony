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
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h2>Products</h2>
                    </div>
                    <div class="col-md-3 text-right">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                            Add Product
                        </button>
                        <div class="modal fade" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Add Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="save_product.php" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="productName" name="productName" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productDescription" class="form-label">Product Description</label>
                                                <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productPrice" class="form-label">Price</label>
                                                <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productImage" class="form-label">Product Image</label>
                                                <input type="file" class="form-control" id="productImage" name="productImage" required>
                                            </div>
                                            <button type="submit" class="btn btn-secondary">Add Product</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                include('config.php');
                $query = "SELECT * FROM products";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <div class="row row-cols-2 g-3">
                    <?php foreach ($products as $product): ?>
                        <div class="col">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid rounded-start h-100" />
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                            <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                                            <p class="card-text"><small class="text-success">Price: €<?= htmlspecialchars($product['price']) ?></small></p>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal<?= $product['id'] ?>">
                                                Update
                                            </button> <a href="delete_product.php?id=<?= htmlspecialchars($product['id']) ?>" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="updateModal<?= $product['id'] ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $product['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalLabel<?= $product['id'] ?>">Update Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="save_update_product.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                                            <input type="hidden" name="currentImage" value="<?= $product['image'] ?>"> <!-- Hidden input to store the current image -->

                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="productName" name="productName" value="<?= htmlspecialchars($product['name']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productDescription" class="form-label">Product Description</label>
                                                <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required><?= htmlspecialchars($product['description']) ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productPrice" class="form-label">Price</label>
                                                <input type="number" class="form-control" id="productPrice" name="productPrice" value="<?= htmlspecialchars($product['price']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productImage" class="form-label">Product Image</label>
                                                <input type="file" class="form-control" id="productImage" name="productImage">
                                                <img src="<?= htmlspecialchars($product['image']) ?>" alt="Current Image" class="img-thumbnail mt-2" width="100">
                                            </div>
                                            <button type="submit" class="btn btn-secondary">Update Product</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin_dashboard.js"></script>
</body>

</html>