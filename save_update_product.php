<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'];
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];

    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['productImage']['name'];
        $imageTmp = $_FILES['productImage']['tmp_name'];
        $imagePath = 'uploads/' . basename($image);
        move_uploaded_file($imageTmp, $imagePath);
    } else {
        $imagePath = $_POST['currentImage']; 
    }

    $query = "UPDATE products SET name = :name, price = :price, description = :description, image = :image WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $imagePath);
    $stmt->bindParam(':id', $productId);

    if ($stmt->execute()) {
        echo "Product updated successfully!";
        header("Location: admin_products.php");
        exit;
    } else {
        echo "Error updating product.";
    }
}
