<?php
include('config.php');

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $query = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $productId);

    if ($stmt->execute()) {
        header("Location: admin_products.php");
        exit;
    } else {
        echo "Error deleting product.";
    }
} else {
    echo "Invalid product ID.";
}
